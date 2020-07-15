<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$partner = $_GET['id'];
$noidung = $_GET['noidung'];
$tokenpa = $_GET['token'];
$chatfuel = $_GET['chatfuel'];
$chatfuelpa  = $_GET['chatfuelpa'];
$userid = $_GET['idsend'];

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

function sendchat($token,$jsonData)
{
$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";

  $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsonData));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
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
        "text":"Người lạ đã gửi một video cho bạn.",
        "buttons":[
          
              {
            "type":"web_url",
            "url":"https://anhnguoila01.herokuapp.com/postvideo.php?&url='.$message.'",
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
    curl_close($ch);
    
    die();

}
$admin ='{
  "recipient":{
    "id":"3687458354602826"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Video\n page: '.$chatfuel.'\n ID:'.$userid.' \n .\nTới ID:'.$partner.'\npage:'.$chatfuelpa.'\n. ",
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
sendchat(EAADn4qwXcIQBAMDbT3Saxog8LRzDYIaRWipTBZAKCQJjoO2x0ra6jcBhdcHurzOyCZA6BMXWLcp1rWXZCNnGn6VcfLQ9DB4UsiWmyR4lX7kCL5bNmMszb8Y2XKmeCumZCJ2ZAoeRb7OgVRIRmFBs0byhotrGF9CwNiSsFnqguCbV73L4HKqQRAxyBtGgyU0sZD,$admin);

sendchat2($noidung,$partner,$tokenpa);
die();
?>