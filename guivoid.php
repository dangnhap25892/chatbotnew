<?php
$partner = $_GET['id'];
$noidung = $_GET['noidung'];
$tokenpa = $_GET['token'];

$url = $_GET['noidung'];
$v2 = '&_nc_sid=';
$v3 = $_GET['_nc_sid'];
$v4 = '&_nc_ohc=';
$v5 = $_GET['_nc_ohc'];
$v6 = '&_nc_ht=';
$v7 = $_GET['_nc_ht'];
$v8 = '&oh=';
$v9 = $_GET['oh'];
$v10 = '&oe=';
$v11 = $_GET['oe'];
$v12 = '&_nc_oc=';
$v13 = $_GET['_nc_oc'];
if (isset($v5))
{
$noidung="".$url."".$v2."".$v3."".$v4."".$v5."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."";
#echo "$hihi";
}
else
{
  $noidung="".$url."".$v2."".$v3."".$v12."".$v13."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."";
  #echo "$hihi";
}
function sendchat3($message,$userID,$token)
{

$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";
  $jsonData ='{
  "recipient":{
    "id": "'.$userID.'"
  },
  '.$message.'
}';
  $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
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
    "attachment":{
      "type":"audio", 
      "payload":{
        "url":"'.$message.'", 
      }
    }
  }
}';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
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
*/
    curl_close($ch);
    
 

}

sendchat2($noidung,$partner,$tokenpa);
#sendchat3($noidung,$partner,$tokenpa);
die();
?>
