<?php
require_once 'config.php';
if (isset($_REQUEST['hub_challenge']))
{
  $c = $_REQUEST['hub_challenge'];
  $v = $_REQUEST['hub_verify_token'];
}
$token = 'EAADupogSIckBAFYQRTPO4YRllOUHpJeLMjfU2iqBqYaPQjlPsqOUZBin5H6TsFwk2vWVWGhDwbTXZCKTM0XJ4DZBqcVpYaalOd9pnzL2OGwjOiLIFrWLXbBcReSk8sZBDTxp5PKPm34OBEUZCmlTcSU5UEXwtZAw3ctJjYM5uO9AZDZD';
if($v =="123")
{
  echo $c;
  exit;
}
$input = json_decode(file_get_contents('php://input'),true);
#file_put_contents("text.txt", $input);
$userID = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$getstart = $input['entry'][0]['messaging'][0];
$type = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['type'];
$image = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['url'];
$page = $input['entry'][0]['id'];

if($message=='hi'){
  $jsonData ='{
  "messaging_type" : "RESPONSE",
  "recipient":{
    "id": "'.$userID.'"
  },
  "message":{
    "text":"hello232\nchfug '.$message.'"
    }
}';
sendchat($token,$jsonData);
}
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
if(isset($message)){
	$result = mysqli_query($conn, "SELECT trangthai, gioitinh, hangcho, ketnoi, chatfuel from users WHERE ID = $message");
	$row = mysqli_fetch_assoc($result);
	$ketnoi = $row['ketnoi'];
	$gioitinh = $row['gioitinh'];
	$chatfuel = $row['chatfuel'];

	$noidung = "id:$message kết nối:$ketnoi Giới tính: $gioitinh chatfuel: $chatfuel ";
	mysqli_close($conn);
   sendchat2($noidung,$userID,$token);

  die();
 }
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
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $st=curl_exec($ch);

    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);



    curl_close($ch);
    die();

}
