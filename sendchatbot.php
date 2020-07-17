<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$userid = $_GET['id'];
$noidung = $_GET['noidung'];
$token = $_GET['token'];

function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
function ktidtime($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `thoigian` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}

////// Hàm Gửi JSON //////////

function sendchat($token,$jsonData)
{
$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
    /*
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    $st=curl_exec($ch);

  $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);


*/
   # curl_close($ch);
    die();
    
}
function sendchat2($message,$userID,$token)
{

$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";
 $jsonData ='{
  "recipient":{
    "id": "'.$userID.'"
  },
  "message":{
    "text":"'.$message.'"
    }
}';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
  curl_exec($ch);
 #curl_close($ch);
  die();
   /*
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $st=curl_exec($ch);

    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);



    curl_close($ch);
    die();
    */

}
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
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
$partner = getRelationship($userid);

if($partner!= 0){
# $chatfuelpa = getChatfuel($partner);
  $idpage = getidpage($partner);
 $page = tokenpage($idpage);
 $tokenpa = $page[0];
 $chatfuelpa = $page[1];
 # $tokenpa = gettoken($partner);
if(isset($noidung)){
 
 /*
      $d = date(d);
      $h = date(h);
      $time = ("d".$d."h".$h."");
  mysqli_query($conn, "UPDATE `users` SET `token` = '$d' WHERE `ID` = $userid");
  echo $partner;
  echo $tokenpa;
 */
   $hi = (rand(1,3));
  if($hi == 1)
{
 header("Location: https://sendchat002.herokuapp.com/sendchat.php?id=$partner&noidung=$noidung&token=$tokenpa");
    die();
}
if($hi == 2)
{
  header("Location: https://sendchat003.herokuapp.com/sendchat.php?id=$partner&noidung=$noidung&token=$tokenpa");
  die();
}
  if($hi == 3)
{
    header("Location: https://sendchat004.herokuapp.com/sendchat.php?id=$partner&noidung=$noidung&token=$tokenpa");
    die();
}
  

  
#sendchat2($noidung,$partner,$tokenpa);
die();
}

     }
else{
  if ( !isUserExist($userid) ) {
     $jsonData ='{
  "recipient":{
    "id": "'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Tin nhắn chưa gửi đi\nHiện hệ thống đang lỗi xin vui lòng bạn quay lại sau ít phút.\nVui lòng ấn vào sửa lỗi.",
        "buttons":[
          {
            "type":"Postback",
            "title":"Sửa lỗi",
            "payload":"sualoi"
          },
          {
            "type":"Postback",
            "title":"Thông tin chi tiết",
            "payload":"thongtin"
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
  }
    else
    {
  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
      "text": "Bạn chưa bắt đầu cuộc trò chuyện gõ start để bắt đầu",
      "quick_replies":[
        {
          "content_type":"text",
          "title":"Chat ngẫu nhiên",
          "payload":"endchat",
        },
       
      ]
    }
  }';
sendchat($token,$jsonData);
die();
    }
}
#mysqli_close($conn);
die();
?>
