<?php
$userid = $_GET['ID']; // lấy id từ chatfuel
#$gioitinh = $_POST['gt'];// lấy giới tính
$token = $_GET['token'];
$timgt = $_GET['gt'];
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
            "subtitle":"Hiện hệ thống đang lỗi xin vui lòng bạn quay lại sau ít phút.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
  }
  $gioitinh =  ktgiotinh($userid);
echo $gioitinh;
if ( $gioitinh == 0 ) {
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

  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user2, `hangcho` = 0 WHERE `ID` = $user1");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user1, `hangcho` = 0 WHERE `ID` = $user2");
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
//moi
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
//moi
//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}
function ketnoi($userid,$gioitinh,$timgt,$token) { //tìm người chát   nam tìm nữ 2 nữ tìm nam 3 nam tìm nam 4 nữ tìm nữ 5    tim 9x 6 tim 2k 7
  global $conn;
  echo $timgt;
  echo $gioitinh;
    //mới 
     /*
      $chiase = getchiase($userid);
  echo $chiase;
  if($chiase <5 )
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
          "text":"Bạn đã hết xu💰 không thể thực hiện \nxu của bạn còn: '.$xu.'xu💰.",
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
          "text":"Đang tìm kiếm theo giới tính bạn -10xu 💰 \nXu của bạn còn: '.$xu.'xu💰",
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
     //mới
     
  //tìm đối tượng theo giới tính 
if($gioitinh == "1" AND $timgt =="timnu"  )//nam tìm nữ
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 3)AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");

}
else if($gioitinh == "2" AND $timgt =="timnu"  )// nữ tìm nữ
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 5)AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  
}
else if($gioitinh == "1" AND $timgt =="timnam"  )// nam tìm nam
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 4)AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");

}
else if($gioitinh == "2" AND $timgt =="timnam"  )// nữ tìm nam
{
 $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND (`hangcho` = 1 OR `hangcho` = 2)AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  
}

  else{ // không xác thì tìm kiếm người không xác định
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 1  AND `gioitinh` = 0 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }
  //echo $result;
  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ
       echo 'pa';
     echo $timgt;
  echo $gioitinh;
    if($gioitinh == "1" AND $timgt =="timnu"  )//nam tìm nữ
{
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 2 WHERE `ID` = $userid"); 

}
else if($gioitinh == "2" AND $timgt =="timnu"  )// nữ tìm nữ
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 5 WHERE `ID` = $userid"); 
  
}
else if($gioitinh == "1" AND $timgt =="timnam"  )// nam tìm nam
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 4 WHERE `ID` = $userid"); 

}
else if($gioitinh == "2" AND $timgt =="timnam"  )// nữ tìm nam
{
 mysqli_query($conn, "UPDATE `users` SET `hangcho` = 3 WHERE `ID` = $userid"); 
}
else
{
   mysqli_query($conn, "UPDATE `users` SET `hangcho` = 1 WHERE `ID` = $userid"); 
}

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
            "title":"Tìm kiếm sẽ mất 1 thời gian...",
            "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
    #$tokenpa = gettoken($partner);

    $idpage = getidpage($partner);
 $page = tokenpage($idpage);
 $tokenpa = $page[0];
 $chatfuelpa = $page[1];
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
            "subtitle":"Gõ pp hoặc end chat để kết thúc.\n\nBạn kết nối với id:'.$userid.'",
          }
        ]
      }
    }
  }
}';
sendchat($tokenpa,$jsonData);
  }
  die();
}
if (!trangthai($userid)){// nếu chưa chát

if (!hangcho($userid)) { // nếu chưa trong hàng chờ
  
ketnoi($userid,$gioitinh,$timgt,$token);

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
      "text": "Bạn phải kết thúc cuộc trò chuyện trước khi bắt đầu cuộc trò chuyện mới. Gõ pp hoặc end chat để kết thúc",
      "quick_replies":[
        {
          "content_type":"text",
          "title":"Kết thúc",
          "payload":"endchat",
        },
        {
          "content_type":"text",
          "title":"BLOCK",
          "payload":"endchat",
        },
         {
        "content_type":"text",
        "title":"Tố cáo",
        "payload":"endchat",
      },
        {
          "content_type":"text",
          "title":"Không.",
          "payload":"Khong",
        }
        
      ]
    }
  }';
sendchat($token,$jsonData);
}
#mysqli_close($conn);
die();


?>
