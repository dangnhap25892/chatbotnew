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


  /// Xét giới tính
if ($gt == 'nam'){
$gioitinh = 1;
} else if ($gt == 'nữ'){
$gioitinh = 2;
}
else{
  $gioitinh = 3;
}
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
function ktgiotinh($userid) { //hàm kiểm tra xem gt đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `gioitinh` WHERE `ID` = $userid LIMIT 1");
  $relationship = $row['gioitinh'];
  return $row;
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

$jsonData ='{
  "recipient":{
    "id":"'.$ID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Cập nhập giới tính thành công.Giới tính của bạn là",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
      },{
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';
mysqli_query($conn, "UPDATE `users` SET `gioitinh` = $gioitinh WHERE `ID` = $userid"); 
sendchat($token,$jsonData);



#mysqli_close($conn);
die();

?>
