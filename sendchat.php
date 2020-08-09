<?php

$partner = $_GET['id'];
$noidung = $_GET['noidung'];
$tokenpa = $_GET['token'];


if (preg_match('/sex/', $noidung)||preg_match('/xxx/', $noidung)||preg_match('/dâm/', $noidung)||preg_match('/Sex/', $noidung)||preg_match('/Xxx/', $noidung)||preg_match('/Dâm/', $noidung)) {
    echo 'true';
  $jsonData ='{
  "recipient":{
    "id":"'.$partner.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Người lạ gửi chat có chứa nội nhạy cảm bạn có muốn tố cáo đối phương.",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Tố cáo và kết thúc",
        "payload":"endchat",
      },{
        "content_type":"text",
        "title":"Không.",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($tokenpa,$jsonData);
}

//new
$noidung = str_replace("sex","s.e.x",$noidung);
$noidung = str_replace("xxx","x.x.x",$noidung);
$noidung = str_replace("dâm","d.â.m",$noidung);
$noidung = str_replace("cặc","c.ặ.c",$noidung);
$noidung = str_replace("lồn","l.ồ.n",$noidung);
$noidung = str_replace("Sex","s.e.x",$noidung);
$noidung = str_replace("Xxx","x.x.x",$noidung);
$noidung = str_replace("Dâm","d.â.m",$noidung);
$noidung = str_replace("Cặc","c.ặ.c",$noidung);
$noidung = str_replace("Lồn","l.ồ.n",$noidung);
//new

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
  curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
 
   
}
sendchat2($noidung,$partner,$tokenpa);

die();
?>
