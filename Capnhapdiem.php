<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME) or die ('Không thể kết nối tới database');
$MM = $_POST['MM'];// lấy id từ chatfuel
$chatfuel = $_POST['chatfuel'];
$token = $_POST['token'];
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}

congdiem($MM,$chatfuel,$token,"Bạn được cộng 100 điểm.");
function congdiem($userid,$chatfuel,$token,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'"}';
request($userid,$chatfuel,$token,$payload);   
}
function request($userid,$chatfuel,$token,$jsondata) { 
  global $BLOCK_NAME;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=congdiem";
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
mysqli_close($conn);
?>
