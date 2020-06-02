<?php

$ID = $_POST['ID'];// lấy id từ chatfuel
$chatfuel = $_POST['chatfuel'];
$token = $_POST['token'];
require_once 'config.php'; //lấy thông tin từ config

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
if (!$conn) {
    echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Lỗi !!!",
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại sau thử nhé."
            }
          ]
        }
      }
    }
  ]
}';
}
$errorChat = '{
     "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Lỗi !!!",
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại thử nhé."
            }
          ]
        }
      }
    }
  ]
} ';
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}
//// Lấy Id chatfuel////
function getChatfuel($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
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

////// Hàm Gửi JSON //////////
function request($userid,$chatfuel,$token,$jsondata) { 
  global $BLOCK_NAME;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_NAME";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  	if (curl_errno($ch)) {
		echo errorChat;
	} else {
		$resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($resultStatus == 200) {
			// send ok
		} else {
			echo errorChat;
		}
	}
	curl_close($ch);
}
///// Hàm gửi tin nhắn //////////

function sendchat($userid,$chatfuel,$token,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'"}';
request($userid,$chatfuel,$token,$payload);   
}

function endchat($userid,$chatfuel,$token,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'","chat":"off"}';
request($userid,$chatfuel,$token,$payload);   
}

function outchat($userid,$chatfuel,$token) {
  global $conn;
  $partner = getRelationship($userid);
  $chatfuelpa = getChatfuel($partner);
  #$tokenpa = gettoken($partner);
  $tokenpa = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $userid");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $partner");
  sendchat($userid,$chatfuel,$token,"💔 Bạn đã dừng chát ! Để tiếp tục hãy gõ 'Start'");
  endchat($partner,$chatfuelpa,$tokenpa,"💔 Người lạ đã rời chát ! Để tiếp tục hãy gõ 'Start'");
}


function hangcho($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `hangcho` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['hangcho']) !== 0;
}

function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}


if (!trangthai($ID)){ // nếu chưa chát
if (!hangcho($ID)) { // nếu không ở trong hàng chờ

sendchat($ID,$chatfuel,$token,"💔 Bạn đã dừng chát ! Để tiếp tục hãy gõ 'Start'");	
}else{ // nếu đang ở trong hàng chờ
sendchat($ID,$chatfuel,$token,"💔 Bạn đã dừng chát ! Để tiếp tục hãy gõ 'Start'");
mysqli_query($conn, "UPDATE `users` SET `hangcho` = 0 WHERE `ID` = $ID");
}
}else{
// nếu đang chát
//giải quyết sau
outchat($ID,$chatfuel,$token);
}
mysqli_close($conn);
?>
