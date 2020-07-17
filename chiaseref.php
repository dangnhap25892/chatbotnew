<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME) or die ('Không thể kết nối tới database');
$ID = $_GET['ID'];// lấy id từ chatfuel
$gioitinh = $_GET['gt']; // lấy giới tính
$chatfuel = $_GET['chatfuel'];
$token = $_GET['token'];
$ref = $_GET['ref'];
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
$d = date(d);
$h = date(h);
$time = ("d".$d."h".$h."");
echo $time;
/// Xét giới tính
if ($gioitinh == 'male'){
$gioitinh = 1;
} else if ($gioitinh == 'female'){
$gioitinh = 2;
}

function getchiase($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chiase` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chiase'];
  return $relationship;
}
function getxu($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `xu` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['xu'];
  return $relationship;
}
function sendchat($token,$jsonData)
{
$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";

  $ch = curl_init($url);
     curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
   curl_close($ch);
}
function getidpage($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
  return $relationship;
}
if ( !isUserExist($ID) ) { // nếu chưa tồn tại thì update lên sever chia se + 1 xu + 50
	$jsonData ='{
  "recipient":{
    "id":"'.$ref.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"THÔNG BÁO",
            "subtitle":"Bạn được +200xu từ link chia sẻ cho bạn bè.",
          }
        ]
      }
    }
  }
}';



	$idpage = getidpage($ref);
	$chiase = getchiase($ref);
	$xu = getxu($ref);
	$chiase = $chiase + 1;
	echo $chiase;
	$xu = $xu + 200 ;
	echo $xu;
	$page = tokenpage($idpage);
 	$tokenpa = $page[0];
 	echo $tokenpa;
	mysqli_query($conn, "UPDATE `users` SET `chiase` = $chiase, `xu` = $xu,`token` = '$d' WHERE `ID` = $ref");

sendchat($tokenpa,$jsonData);
    $sql = "INSERT INTO `users` (`ID`, `trangthai`, `hangcho` ,`gioitinh`,`chatfuel`,`token`,`tocao`,`chiase`,`xu`) VALUES (".$ID.", 0, 1 , 0,'$chatfuel','$d',0,0,50)";
   $info = mysqli_query($conn,$sql );
  header("Location: thamgiabot.php?ID=$ID&token=$token");
  }
header("Location: thamgiabot.php?ID=$ID&token=$token");
#mysqli_close($conn);

?>
