<?php
$userid = $_GET['ID']; // lấy id từ chatfuel
#$gioitinh = $_POST['gt'];// lấy giới tính
$token = $_GET['token'];
$gt = $_GET['gt'];
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data

#$token = gettoken($userid);

if (!$conn) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Lỗi!",
            "subtitle":"Hiện hệ thống đang lỗi xin vui lòng bạn quai lại sau.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
}
if ( !isUserExist($userid) ) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Thông báo",
            "subtitle":"Hiện hệ thống đang lỗi xin vui lòng bạn quay lại sau ít phút.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
  }
$ktgt = ktgiotinh($userid);
echo $ktgt;
if ( $ktgt == 0 ) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Giới tính của bạn là gì",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Nam",
        "payload":"nam",
      },{
        "content_type":"text",
        "title":"Nữ",
        "payload":"nữ",
      },
      {
        "content_type":"text",
        "title":"Giới tính thứ 3",
        "payload":"gtt3",
      }
    ]
  }
}';
sendchat($token,$jsonData);
die();
  }
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
function ktgiotinh($userid) { //hàm kiểm tra xem gt đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `gioitinh` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['gioitinh'];
  return $relationship;
}
////// Hàm Gửi JSON //////////
function sendchat($token,$jsonData)
{
$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";

  $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $st=curl_exec($ch);

  $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);



    curl_close($ch);
}
///// hàm kiểm tra hàng chờ ///////
function hangcho($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `hangcho` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['hangcho']) !== 0;
}

//// Kết nối hai người /////
function addketnoi($user1, $user2) {
  global $conn;

  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user2, `hangcho` = 0 WHERE `ID` = $user1");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user1, `hangcho` = 0 WHERE `ID` = $user2");
}
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `ketnoi` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}
/// Lấy token ////
function gettoken($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `token` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['token'];
  return $relationship;
}
//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}
function ketnoi($userid,$gioitinh,$token) { //tìm người chát 
  global $conn;
  
  //tìm đối tượng theo giới tính 

  if($gioitinh == "timnam"){// nếu giới tính là nữ thì kiếm người mang giới tính nam 
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2)AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  //echo "result : " . $result."<br>";
  }else if($gioitinh == "timnu"){// giới tính là nam thì tìm kiếm người là nữ
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2) AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }else if($gioitinh == "timgtt3"){ // không xác thì tìm kiếm người không xác định
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2) AND `gioitinh` = 3 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }else{ // không xác thì tìm kiếm người không xác định
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2) AND `gioitinh` = 0 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }
  //echo $result;
  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 2 WHERE `ID` = $userid"); 
    $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Đang tìm kiếm...",
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);

} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
    $tokenpa = gettoken($partner);
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Người lạ đã tham gia cuộc trò chuyện",
            "subtitle":"Gõ pp hoặc end chat để kết thúc.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
 $jsonData ='{
  "recipient":{
    "id":"'.$partner.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Người lạ đã tham gia cuộc trò chuyện",
            "subtitle":"Gõ pp hoặc end chat để kết thúc.",
          }
        ]
      }
    }
  }
}';
sendchat($tokenpa,$jsonData);
  }
}
if (!trangthai($userid)){// nếu chưa chát
if (!hangcho($userid)) { // nếu chưa trong hàng chờ
ketnoi($userid,$gt,$token);
}else{

  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Đang tìm kiếm...",
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
}
}else{
// khi đang chát ! giải quyết sau !!
  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"⛔️ CẢNH BÁO",
            "subtitle":"Bạn đang được kết nối chát với người khác ! Hãy gõ \'End\' để thoát",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
}
#mysqli_close($conn);
die();
