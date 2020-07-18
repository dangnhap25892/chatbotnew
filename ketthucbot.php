<?php

$ID = $_GET['ID'];// lấy id từ chatfuel
#$chatfuel = $_POST['chatfuel'];
$token = $_GET['token'];
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
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
    "text": "❤️❤️Tìm thêm bạn chat❤️❤️ \nm.me/ThinhChatVN\nm.me/HaloChatVN",
    }
  
}';
sendchat($token,$jsonData1);
 $jsonData ='{
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
            "title":"Quảng cáo",
            "image_url":"https://scontent.xx.fbcdn.net/v/t1.15752-9/109559025_304474290747717_343722034921086264_n.jpg?_nc_cat=107&_nc_sid=b96e70&_nc_ohc=BuquTGHl8tkAX87zE0q&_nc_ad=z-m&_nc_cid=0&_nc_zor=&_nc_ht=scontent.xx&oh=b4ef103cdd9f8f8cc13cd69d6239d08c&oe=5F373222",
            "subtitle":"Nhóm chat trò chuyện về người lạ tìm hiểu về những vấn đề tình dục. Bạn có thể chia sẻ kinh nghiệm cho mọi người.",
            "default_action": {
              "type": "web_url",
              "url": "m.me/DongChatLeuLeu",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"m.me/DongChatLeuLeu",
                "title":"Tham gia"
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
#sendchat($token,$jsonData);
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
////// Hàm Gửi JSON //////////
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
  $idpage = getidpage($partner);
  $page = tokenpage($idpage);
  $tokenpa = $page[0];

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
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
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
    "text": "❤️❤️Tìm thêm bạn chat❤️❤️ \nm.me/ThinhChatVN\nm.me/HaloChatVN",
    }
  
}';
sendchat($tokenpa,$jsonData1);
    $jsonData ='{
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
            "title":"Quảng cáo",
            "image_url":"https://scontent.xx.fbcdn.net/v/t1.15752-9/109559025_304474290747717_343722034921086264_n.jpg?_nc_cat=107&_nc_sid=b96e70&_nc_ohc=BuquTGHl8tkAX87zE0q&_nc_ad=z-m&_nc_cid=0&_nc_zor=&_nc_ht=scontent.xx&oh=b4ef103cdd9f8f8cc13cd69d6239d08c&oe=5F373222",
            "subtitle":"Nhóm chat trò chuyện về người lạ tìm hiểu về những vấn đề tình dục. Bạn có thể chia sẻ kinh nghiệm cho mọi người.",
            "default_action": {
              "type": "web_url",
              "url": "m.me/DongChatLeuLeu",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"m.me/DongChatLeuLeu",
                "title":"Tham gia"
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
#sendchat($tokenpa,$jsonData);
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
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
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
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
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
        "title":"Tìm theo giới tính",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
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
