<?php
$userid = $_GET['ID']; // lấy id từ chatfuel
#$gioitinh = $_POST['gt'];// lấy giới tính
$token = $_GET['token'];
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
function ketnoi($userid,$token) { //tìm người chát 
  global $conn;
  
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");


  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 1 WHERE `ID` = $userid"); 
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
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
   
} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
# $chatfuelpa = getChatfuel($partner);
 # $tokenpa = gettoken($partner);
    #$tokenpa = $token;
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
            "title":"Người lạ đã tham gia trò chuyện",
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
            "title":"Người lạ đã tham gia trò chuyện",
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

//// Xử lý //////
if (!trangthai($userid)){// nếu chưa chát
if (!hangcho($userid)) { // nếu chưa trong hàng chờ
ketnoi($userid,$token);
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
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗",
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
mysqli_close($conn);
die();

?>
