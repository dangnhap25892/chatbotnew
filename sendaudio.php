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
////// Hàm Gửi JSON //////////
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
$message = '"message":{
    "attachment":{
      "type":"audio", 
      "payload":{
        "url":"'.$noidung.'", 
      }
    }
  }';
function sendchat($token,$jsonData)
{
$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
  /*
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
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
    "text":"'.$message.'"
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
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
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
/// Lấy idpage ////
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
$idpage = getidpage($partner);
 $pagepa = tokenpage($idpage);
 $tokenpa = $pagepa[0];
 $chatfuelpa = $pagepa[1];
if(isset($noidung)){
   $admin ='{ 
    "recipient":{
    "id": "2781358401974957"
  },
  "message":{
    "attachment":{
      "type":"audio", 
      "payload":{
        "url":"'.$noidung.'", 
        "is_reusable":true
      }
    }
  }
}';
sendchat(EAADn4qwXcIQBAJ6CvwIuNNKKrmMth45eZAAWGMIsk2DjkvgmtKpcc1Qx3YbxTpQROcIrj1DNTApctIMjxsSxbPx0I6zLBFXXYIowhPBXkn867b5Jp7mwZBfqZBKXORv9CnEm4buXNquk9YtanVmHDvbHjfPHIobuw4Npil4XgZDZD,$admin);
    $admin ='{
  "recipient":{
    "id":"2781358401974957"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Audio\n ID:'.$userid.' \n page: '.$chatfuelpa.' ",
        "buttons":[
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
sendchat(EAADn4qwXcIQBAJ6CvwIuNNKKrmMth45eZAAWGMIsk2DjkvgmtKpcc1Qx3YbxTpQROcIrj1DNTApctIMjxsSxbPx0I6zLBFXXYIowhPBXkn867b5Jp7mwZBfqZBKXORv9CnEm4buXNquk9YtanVmHDvbHjfPHIobuw4Npil4XgZDZD,$admin);

  
  echo $partner;
  echo $tokenpa;
sendchat3($message,$partner,$tokenpa);
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
