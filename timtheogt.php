<?php
$userid = $_GET['ID']; // lấy id từ chatfuel
#$gioitinh = $_POST['gt'];// lấy giới tính
$token = $_GET['token'];
$timgt = $_GET['gt'];
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
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
  $gioitinh =  ktgiotinh($userid);
echo $gioitinh;
if ( $gioitinh == 0 ) {
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
     curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
   curl_close($ch);
     /*
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $st=curl_exec($ch);

  $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);



    curl_close($ch);
    */
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
/// Lấy idpage ////
function getidpage($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
  return $relationship;
}
//moi
function getxu($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `xu` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['xu'];
  return $relationship;
}
function getchiase($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chiase` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chiase'];
  return $relationship;
}
//moi
//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}
function ketnoi($userid,$gioitinh,$timgt,$token) { //tìm người chát   nam tìm nữ 2 nữ tìm nam 3 nam tìm nam 4 nữ tìm nữ 5    tim 9x 6 tim 2k 7
  global $conn;
  echo $timgt;
  echo $gioitinh;
     //mới
      $chiase = getchiase($userid);
  echo $chiase;
  if($chiase <5 )
  {
  $xu = getxu($userid);
       if($xu<10)
       {
            $jsonData ='{
    "recipient":{
      "id": "'.$userid.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Bạn đã hết xu không thể thực hiện xu của bạn còn: '.$xu.'xu.số lần bạn chia sẻ '.$chiase.' chia sẻ để nhận thêm xu.",
          "buttons":[
            {
              "type":"Postback",
              "title":"Nhận xu",
              "payload":"chiase"
            }
          ]
        }
      }
    }
  }';
      sendchat($token,$jsonData);
            $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Cuộc trò chuyện đã kết thúc.",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
      },
      
      {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"9X Tâm Sự",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"Team 2K+",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';

sendchat($token,$jsonData);
            die();
       }
  $xu = $xu - 10;
  echo $xu;

  mysqli_query($conn, "UPDATE `users` SET `xu` = $xu WHERE `ID` = $userid");
   $jsonData ='{
    "recipient":{
      "id": "'.$userid.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Đang tìm kiếm theo giới tính bạn -10xu xu của bạn còn: '.$xu.'xu.số lần bạn chia sẻ '.$chiase.'\n Nếu đủ 5 lượt chia sẻ bạn sẽ mở tìm theo giới tính miễn phí.",
          "buttons":[
            {
              "type":"Postback",
              "title":"Nhận xu",
              "payload":"chiase"
            }
          ]
        }
      }
    }
  }';
      sendchat($token,$jsonData);
}
     //mới
     
  //tìm đối tượng theo giới tính 
if($gioitinh == "1" AND $timgt =="timnu"  )//nam tìm nữ
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 3)AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");

}
else if($gioitinh == "2" AND $timgt =="timnu"  )// nữ tìm nữ
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 5)AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  
}
else if($gioitinh == "1" AND $timgt =="timnam"  )// nam tìm nam
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 4)AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");

}
else if($gioitinh == "2" AND $timgt =="timnam"  )// nữ tìm nam
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2)AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  
}

  else{ // không xác thì tìm kiếm người không xác định
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 1  AND `gioitinh` = 0 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }
  //echo $result;
  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ
       echo 'pa';
     echo $timgt;
  echo $gioitinh;
    if($gioitinh == "1" AND $timgt =="timnu"  )//nam tìm nữ
{
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 2 WHERE `ID` = $userid"); 

}
else if($gioitinh == "2" AND $timgt =="timnu"  )// nữ tìm nữ
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 5 WHERE `ID` = $userid"); 
  
}
else if($gioitinh == "1" AND $timgt =="timnam"  )// nam tìm nam
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 4 WHERE `ID` = $userid"); 

}
else if($gioitinh == "2" AND $timgt =="timnam"  )// nữ tìm nam
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 3 WHERE `ID` = $userid"); 
}
else
{
   mysqli_query($conn, "UPDATE `users` SET `hangcho` = 1 WHERE `ID` = $userid"); 
}

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
die();
} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
    #$tokenpa = gettoken($partner);

    $idpage = getidpage($partner);
 $page = tokenpage($idpage);
 $tokenpa = $page[0];
 $chatfuelpa = $page[1];
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
            "subtitle":"Gõ pp hoặc end chat để kết thúc.\nBạn kết nối với id:'.$partner.'",
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
            "subtitle":"Gõ pp hoặc end chat để kết thúc.\n\nBạn kết nối với id:'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($tokenpa,$jsonData);
  }
  die();
}
if (!trangthai($userid)){// nếu chưa chát

#if (!hangcho($userid)) { // nếu chưa trong hàng chờ
  
ketnoi($userid,$gioitinh,$timgt,$token);
/*
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
*/
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


?>
