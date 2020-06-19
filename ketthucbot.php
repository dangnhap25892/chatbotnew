<?php

$ID = $_GET['ID'];// lấy id từ chatfuel
#$chatfuel = $_POST['chatfuel'];
$token = $_GET['token'];
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
$jsonData1 ='{
  "recipient":{
    "id":"'.$ID.'"
  },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Này bạn ơi...",
            "image_url":"https://i.imgur.com/BC5gUjA.jpg",
            "subtitle":"Bạn tham gia Group chưa\nGroup mới tạo nên bạn vào giúp Group lớn mạnh nhé.",
            "default_action": {
              "type": "web_url",
              "url": "m.me/ThinhChatVN",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"https://www.facebook.com/groups/3321905804486436/",
                "title":"Tham gia Group"
              },
              {
                "type":"web_url",
                "url":"m.me/ThinhChatVN",
                "title":"Thêm bạn chat"
              },
              {
                "type":"postback",
                "title":"Ủng hộ donate",
                "payload":"donate"
              }              
            ]      
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData1);
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
function outchat($userid,$token) {
  global $conn;
  $partner = getRelationship($userid);
  #$chatfuelpa = getChatfuel($partner);
  $tokenpa = gettoken($partner);
  echo $partner;
  echo $tokenpa;
  #$tokenpa = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $userid");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 0, `ketnoi` = NULL, `hangcho` = 0 WHERE `ID` = $partner");
    
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
      },
      {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"9X Tâm Sự",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Team 2K+",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';
sendchat($token,$jsonData);
    $jsonData1 ='{
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
            "title":"Này bạn ơi...",
            "image_url":"https://i.imgur.com/BC5gUjA.jpg",
            "subtitle":"Bạn tham gia Group chưa\nGroup mới tạo nên bạn vào giúp Group lớn mạnh nhé.",
            "default_action": {
              "type": "web_url",
              "url": "m.me/ThinhChatVN",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"https://www.facebook.com/groups/3321905804486436/",
                "title":"Tham gia Group"
              },
              {
                "type":"web_url",
                "url":"m.me/ThinhChatVN",
                "title":"Thêm bạn chat"
              },
              {
                "type":"postback",
                "title":"Ủng hộ donate",
                "payload":"donate"
              }              
            ]      
          }
        ]
      }
    }
  }
}';
sendchat($tokenpa,$jsonData1);
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
      },
      {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      }, 
      {
        "content_type":"text",
        "title":"9X Tâm Sự",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Team 2K+",
        "payload":"endchat",
      },
      
      {
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';
sendchat($tokenpa,$jsonData);
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
      },
      {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"9X Tâm Sự",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Team 2K+",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';
sendchat($token,$jsonData);
}else{ // nếu đang ở trong hàng chờ
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
      },
      
      {
        "content_type":"text",
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"9X Tâm Sự",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Team 2K+",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Menu",
        "payload":"Menuchat",
      }
    ]
  }
}';

sendchat($token,$jsonData);
mysqli_query($conn, "UPDATE `users` SET `hangcho` = 0 WHERE `ID` = $ID");
}
}else{
// nếu đang chát
//giải quyết sau
outchat($ID,$token);
}
#mysqli_close($conn);
die();
?>
