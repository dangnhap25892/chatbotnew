<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$userid = $_GET['id'];
#$noidung = $_GET['noidung'];
$token = gettoken($userid);
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
$url2 = '&_nc_sid=';
$url3 = $_GET['_nc_sid'];
$url4 = '&_nc_oc=';
$url5 = $_GET['_nc_oc'];
$url6 = '&_nc_ad=';
$url7 = $_GET['_nc_ad'];
$url8 = '&_nc_cid=';
$url9 = $_GET['_nc_cid'];
$url10 = '&_nc_zor=';
$url11 = $_GET['_nc_zor'];
$url12 = '&_nc_ht=';
$url13 = $_GET['_nc_ht'];
$url14 = '&oh=';
$url15 = $_GET['oh'];
$url16 = '&oe=';
$url17 = $_GET['oe'];
$url18 = '&_nc_ohc=';
$url19 = $_GET['_nc_ohc'];

if (isset($url5)){
    

$noidung = "".$url."".$url2."".$url3."".$url4."".$url5."".$url6."".$url7."".$url8."".$url9."".$url10."".$url11."".$url12."".$url13."".$url14."".$url15."".$url16."".$url17."";
}
else{

$noidung= "".$url."".$url2."".$url3."".$url18."".$url19."".$url6."".$url7."".$url8."".$url9."".$url10."".$url11."".$url12."".$url13."".$url14."".$url15."".$url16."".$url17."";
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
function sendchat2($message,$userID,$token)
{

$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";
  $jsonData ='{
  "recipient":{
    "id": "'.$userID.'"
  },
  "message":{
    "text":"https://chathihi.herokuapp.com/index.php?&url='.$message.'"
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
/// Lấy token ////
function gettoken($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `token` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['token'];
  return $relationship;
}
$partner = getRelationship($userid);

if($partner!= 0){
# $chatfuelpa = getChatfuel($partner);
  $tokenpa = gettoken($partner);
if(isset($noidung)){
    $admin ='{
  "recipient":{
    "id":"2781358401974957"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Ảnh",
            "image_url":"'.$noidung.'",
            "subtitle":"ID:'.$userid.' ... ",
            "buttons":[
              {
                "type":"web_url",
                "url":"'.$noidung.'",
                "title":"View Website"
              },{
                "type":"postback",
                "title":"'.$userid.'",
                "payload":"DEVELOPER_DEFINED_PAYLOAD"
              }              
            ]      
          }
        ]
      }
    }
  }
}';
sendchat(EAADn4qwXcIQBAJ6CvwIuNNKKrmMth45eZAAWGMIsk2DjkvgmtKpcc1Qx3YbxTpQROcIrj1DNTApctIMjxsSxbPx0I6zLBFXXYIowhPBXkn867b5Jp7mwZBfqZBKXORv9CnEm4buXNquk9YtanVmHDvbHjfPHIobuw4Npil4XgZDZD,$admin);
  echo $partner;
  echo $tokenpa;
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
