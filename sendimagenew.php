<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$userid = $_GET['id'];
$noidung = $_GET['noidung'];
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
/*
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
*/
// $message = '"message":{
//     "attachment":{
//       "type":"audio", 
//       "payload":{
//         "url":"'.$noidung.'", 
//       }
//     }
//   }';
/*
function isNudeImage($url)
{
    $url = urlencode($url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.sightengine.com/1.0/check.json?models=nudity&api_user=$NUDE_API_USER&api_secret=$NUDE_API_SECRET&url=$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    
    $headers = array();
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $res = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($res, true);
    if($result['status'] == 'success'){
       // echo 'Raw: '. $result['nudity']['raw'] . 'Safe: '. $result['nudity']['safe'] . 'Patial: '. $result['nudity']['partial'];
        if($result['nudity']['raw'] >= max($result['nudity']['safe'], $result['nudity']['partial'])) return 1;
        else if($result['nudity']['partial'] >= max($result['nudity']['raw'], $result['nudity']['safe'])) 
        {
            if($result['nudity']['partial_tag'] == 'bikini' || $result['nudity']['partial_tag'] == 'lingerie') return 1;
        }
    }
    return 0;
}
   $isNude = isNudeImage($message);
if($isNude == 0)
{
    $nude = 'Người lạ đã gửi ảnh cho bạn.';
}  
else
{
    $nude = 'Ảnh có chứa nội dụng nhạy cảm';
}
*/

  ////// Hàm Gửi JSON //////////
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
    #curl_setopt($ch, CURLOPT_TIMEOUT, 5);
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
  global $nude;
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
        "text":"'.$nude.'",
        "buttons":[
          
              {
            "type":"web_url",
            "url":"https://anhnguoila01.herokuapp.com/postanh.php?&url='.$message.'",
            "title":"Xem ảnh"
          },
          {
              "type":"Postback",
              "title":"HướngDẫnXemTrên iphone",
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
    curl_close($ch);
    die();
    /*
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    #curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $st=curl_exec($ch);
    $errors = curl_error($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    var_dump($errors);
    var_dump($response);
    curl_close($ch);
    die();
*/
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
//// Lấy Id chatfuel////
function getidpage($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
  return $relationship;
}
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
$partner = getRelationship($userid);

if($partner!= 0){
$idpage = getidpage($userid);
$page = tokenpage($idpage);
 $token = $page[0];
 $chatfuel = $page[1];

  $idpagepa = getidpage($partner);
  $pagepa = tokenpage($idpagepa);
 $tokenpa = $pagepa[0];
 $chatfuelpa = $pagepa[1];
if(isset($noidung)){
    
    
  echo $partner;
  echo $tokenpa;
  
#sendchat2($noidung,$partner,$tokenpa); //$chatfuelpa $userid
header("Location: https://sendimage003.herokuapp.com/guianh.php?id=$partner&noidung=$noidung&token=$tokenpa&idsend=$userid&chatfuel=$chatfuel&chatfuelpa=$chatfuelpa");
die();
}

     }

    else
    {
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