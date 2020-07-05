<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$userid = $_GET['id'];
#$noidung = $_GET['noidung'];
#$token = gettoken($userid);
// if (!$conn) {
//     echo'{
//  "messages": [
//     {
//       "attachment":{
//         "type":"template",
//         "payload":{
//           "template_type":"generic",
//           "elements":[
//             {
//               "title":"Lỗi !!!",
//               "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại thử nhé."
//             }
//           ]
//         }
//       }
//     }
//   ]
// }';
// }

$url = $_GET['noidung'];
$v2 = '&_nc_sid=';
$v3 = $_GET['_nc_sid'];
$v4 = '&_nc_ohc=';
$v5 = $_GET['_nc_ohc'];
$v6 = '&vabr';
$v7 = $_GET['vabr'];
$v8 = '&_nc_ht=';
$v9 = $_GET['_nc_ht'];
$v10 = '&oh=';
$v11 = $_GET['oh'];
$v12 = '&oe=';
$v13 = $_GET['oe'];
$v14 = '&_nc_oc=';
$v15 = $_GET['_nc_oc'];

if (isset($v5))
{
$noidung="".$url."".$v2."".$v3."".$v4."".$v5."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."".$v12."".$v13."";
#echo "$hihi";
}
else
{
  $noidung= "".$url."".$v2."".$v3."".$v14."".$v15."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."".$v12."".$v13."";
  #echo "$hihi";
}
// $message = '"message":{
//     "attachment":{
//       "type":"audio", 
//       "payload":{
//         "url":"'.$noidung.'", 
//       }
//     }
//   }';
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    $st=curl_exec($ch);

  $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);


*/
    curl_close($ch);
    
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
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Người lạ đã gửi video cho bạn.",
        "buttons":[
          
              {
            "type":"web_url",
            "url":"https://halochatanhnguoila04.herokuapp.com/chuyenvideo.php?&url='.$message.'",
            "title":"Xem video"
          },
          {
              "type":"Postback",
              "title":"Hướng dẫn xem trên iphone",
              "payload":"iphone"
            }
         
        ]
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
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    #curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $st=curl_exec($ch);

    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    var_dump($errors);
    var_dump($response);


*/
    curl_close($ch);
    
    die();

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
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}
//// Lấy Id chatfuel////
function getidpage($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
  return $relationship;
}
$partner = getRelationship($userid);

if($partner!= 0){
# $chatfuelpa = getChatfuel($partner);
  #$tokenpa = gettoken($partner);

  $idpage = getidpage($userid);
$page = tokenpage($idpage);
 $token = $page[0];
 $chatfuelpa = $page[1];

  $idpagepa = getidpage($partner);
  $pagepa = tokenpage($idpagepa);
 $tokenpa = $pagepa[0];
if(isset($noidung)){
    $admin ='{ 
    "recipient":{
    "id": "3914040262003252"
  },
  "message":{
    "attachment":{
      "type":"video", 
      "payload":{
        "url":"'.$noidung.'", 
      }
    }
  }
}';
#sendchat(EAADn4qwXcIQBAI6hNHyJsozNRbKK1EZAjZASlKawyjK0adKzu6bYsOeoOC1HpBnpor7SDjpqohEU912VFTxFHXY20BhfwBXCPzrElbHKDYOgpJC3DimDAVq9BBshfR7P7RL9juMUZCCd35ZBoy68lC6ZAmBaPa4Y8CRFZCoXZATguQGuLicHce8ZBsOddjfdlBUZD,$admin);
    $admin ='{
  "recipient":{
    "id":"3914040262003252"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Video\n page: '.$chatfuelpa.'\n ID:'.$userid.' \n . ",
        "buttons":[
          {
            "type":"web_url",
            "url":"'.$noidung.'",
            "title":"Xem video"
          },
          {
            "type":"Postback",
            "title":"'.$userid.'",
            "payload":"'.$userid.'"
          }
        ]
      }
    }
  }
}';
sendchat(EAADn4qwXcIQBAI6hNHyJsozNRbKK1EZAjZASlKawyjK0adKzu6bYsOeoOC1HpBnpor7SDjpqohEU912VFTxFHXY20BhfwBXCPzrElbHKDYOgpJC3DimDAVq9BBshfR7P7RL9juMUZCCd35ZBoy68lC6ZAmBaPa4Y8CRFZCoXZATguQGuLicHce8ZBsOddjfdlBUZD,$admin);
 
  echo $partner;
  echo $tokenpa;
  /*
   $thongbao ='{
  "messaging_type" : "RESPONSE",
  "recipient":{
    "id": "'.$partner.'"
  },
  "message":{
    "text":"Người lạ đã gửi video cho bạn."
    }
}';
sendchat($tokenpa,$thongbao);
*/
sendchat2($noidung,$partner,$tokenpa);
die();
}

     }
else{
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 1 WHERE `ID` = $userid"); 
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
            "subtitle":"Bạn có thể gõ start để tìm kiếm nhanh hơn.",
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData);
die();
}
?>
