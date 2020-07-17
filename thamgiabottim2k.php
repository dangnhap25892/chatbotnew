<?php
$userid = $_GET['ID']; // lấy id từ chatfuel
#$gioitinh = $_POST['gt'];// lấy giới tính
$token = $_GET['token'];
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data

#$token = gettoken($userid);

if (!$conn) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Lỗi!",
            "subtitle":"Hiện hệ thống đang lỗi xin vui lòng bạn quai lại sau.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
}


if ( !isUserExist($userid) ) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Thông báo",
            "subtitle":"Hiện hệ thống đang lỗi xin vui lòng bạn không làm gì và quay lại sau ít phút.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
  }

$ktgt = ktgiotinh($userid);
echo $ktgt;
if ( $ktgt == 0 ) {
     $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Giới tính của bạn là gì",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Nam",
        "payload":"nam",
      },{
        "content_type":"text",
        "title":"Nữ",
        "payload":"nữ",
      },
    ]
  }
}';
sendchat($token,$jsonData);
die();
  }
//new
$tocao = kttocao($userid);
echo $tocao;
if($tocao > 3 )
{
  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Tài khoản bạn bị tố cáo quá nhiều nên bị cấm chat.",
    
  }
}';
sendchat($token,$jsonData);
$jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Quảng cáo",
            "image_url":"https://scontent.xx.fbcdn.net/v/t1.15752-9/106172885_681131429109549_6534314368925002486_n.png?_nc_cat=106&_nc_sid=b96e70&_nc_ohc=mvq8TKyT8lsAX_g0bHi&_nc_ad=z-m&_nc_cid=0&_nc_zor=&_nc_ht=scontent.xx&oh=8b8e643e23e722d094af712d86051873&oe=5F35D72F",
            "subtitle":"Nhóm chat trò chuyện về người lạ .",
            "default_action": {
              "type": "web_url",
              "url": "m.me/101976294907930",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"m.me/101976294907930",
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
sendchat($token,$jsonData);


die();


}
//new
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
function ktgiotinh($userid) { //hàm kiểm tra xem gt đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `gioitinh` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['gioitinh'];
  return $relationship;
}
function kttocao($userid) { //hàm kiểm tra xem gt đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `tocao` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['tocao'];
  return $relationship;
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
    $st=curl_exec($ch);

  $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);



    curl_close($ch);
    */
}

///// hàm kiểm tra hàng chờ ///////
function hangcho($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `hangcho` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['hangcho']) !== 0;
}

//// Kết nối hai người /////
function addketnoi($user1, $user2) {
  global $conn;
     $d = date(d);
     $h = date(h);
      $time = ("d".$d."h".$h."");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user2, `hangcho` = 0,`token` = '$d' WHERE `ID` = $user1");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user1, `hangcho` = 0,`token` = '$d' WHERE `ID` = $user2");
       
}

//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `ketnoi` from `users` WHERE `ID` = $userid");
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
//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}

function ketnoi($userid,$token) { //tìm người chát nữ tìm nam
  global $conn;
  
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 7 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");


  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ nam tìm nữ 2 nữ tìm nam 3 nam tìm nam 4 nữ tìm nữ 5 tim 9x 6 tim 2k 7
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 7 WHERE `ID` = $userid"); 
    $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Đang tìm kiếm...",
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
   
} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
# $chatfuelpa = getChatfuel($partner);
 # $tokenpa = gettoken($partner);
    #$tokenpa = $token;


# $tokenpa = gettoken($partner);
 $idpage = getidpage($partner);
 $page = tokenpage($idpage);
 $tokenpa = $page[0];
 $chatfuelpa = $page[1];
       $jsonData1 ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "messaging_type": "RESPONSE",
  
  "message":{
    "text": "Chat bot có thể gửi ảnh, video và void chat hãy gửi ảnh của mình để cuộc trò chuyện thú vị hơn😍\nBạn có thể BLOCK để tránh gặp lại người trò chuyện trước đó🤔\n\nGõ\nEND ( để kết thúc cuộc trò chuyện )\nBLOCK ( để block đối phương )\nHUONGDAN (Để đọc hướng dẫn trước khi dùng)\nChúc các bạn có cuộc trò chuyện vui vẻ🤗",
    }
  
}';
sendchat($token,$jsonData1);
 $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Người lạ đã tham gia cuộc trò chuyện",
            "subtitle":"Gõ pp hoặc end chat để kết thúc.\nBạn kết nối với id:'.$partner.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
       $jsonData1 ='{
  "recipient":{
    "id":"'.$partner.'"
  },
  "messaging_type": "RESPONSE",
  
  "message":{
    "text": "Chat bot có thể gửi ảnh, video và void chat hãy gửi ảnh của mình để cuộc trò chuyện thú vị hơn😍\nBạn có thể BLOCK để tránh gặp lại người trò chuyện trước đó🤔\n\nGõ\nEND ( để kết thúc cuộc trò chuyện )\nBLOCK ( để block đối phương )\nHUONGDAN (Để đọc hướng dẫn trước khi dùng)\nChúc các bạn có cuộc trò chuyện vui vẻ🤗",
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
            "title":"Người lạ đã tham gia cuộc trò chuyện",
            "subtitle":"Gõ pp hoặc end chat để kết thúc.\nBạn kết nối với id:'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($tokenpa,$jsonData);
 }
 
}

//// Xử lý //////
if (!trangthai($userid)){// nếu chưa chát
if (!hangcho($userid)) { // nếu chưa trong hàng chờ
ketnoi($userid,$token);
     
}else{
  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Đang tìm kiếm...",
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
}
}else{
// khi đang chát ! giải quyết sau !!
  $jsonData ='{
  "recipient":{
    "id":"'.$userid.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"THÔNG BÁO",
            "subtitle":"Bạn đang được kết nối chát với người khác ! Hãy gõ \'End\' để thoát",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
}
#mysqli_close($conn);
die();

?>
