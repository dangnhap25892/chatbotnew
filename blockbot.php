<?php

$ID = $_GET['ID'];// lấy id từ chatfuel
$token = $_GET['token'];
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
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
//new
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
//new
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
///// Hàm gửi tin nhắn //////////


function outchat($userid,$token) {
  global $conn;
  $partner = getRelationship($userid);
      $idpage = getidpage($partner);
      $page = tokenpage($idpage);
      $tokenpa = $page[0];
     
 //new
     /*
     $chiase = getchiase($userid);
  echo $chiase;
  if($chiase <10 )
  {
  */
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
          "text":"Bạn đã hết xu💰 không thể thực hiện tính năng này \nXu💰 của bạn còn: '.$xu.'xu💰.",
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
          "text":"Bạn đã block đối phương -10xu💰. \nXu của bạn còn:'.$xu.'xu💰. ",
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
#}
   //new  
     
  echo $partner;
  echo $tokenpa;
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $userid");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $partner");
  mysqli_query($conn, "INSERT INTO `block` (idBlock, idBlocked) VALUES ($userid, $partner) ");
  mysqli_query($conn, "INSERT INTO `block` (idBlock, idBlocked) VALUES ($partner, $userid) ");

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
      },{
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';
sendchat($token,$jsonData);
  $jsonData ='{
  "recipient":{
    "id":"'.$partner.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Cuộc trò chuyện đã kết thúc.",
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
sendchat($tokenpa,$jsonData);

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

$jsonData ='{
  "recipient":{
    "id":"'.$ID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Cuộc trò chuyện đã kết thúc.",
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
sendchat($token,$jsonData);	   	
}
}else{
// nếu đang chát
//giải quyết sau
outchat($ID,$token);
}
die();
#mysqli_close($conn);
?>
