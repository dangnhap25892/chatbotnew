<?php

$partner = $_GET['id'];
$noidung = $_GET['noidung'];
$tokenpa = $_GET['token'];
$chatfuel = $_GET['chatfuel'];
$chatfuelpa  = $_GET['chatfuelpa'];
$userid = $_GET['idsend'];

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
        "text":"Người lạ đã gửi bạn một ảnh",
        "buttons":[
          
              {
            "type":"web_url",
            "url":"https://anhnguoila02.herokuapp.com/postanh.php?&url='.$message.'",
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
}

    $sub = '100x100';
    $uuu = 'https://scontent.xx.fbcdn.net/v/t39.1997-6/cp0/39178562_1505197616293642_5411344281094848512_n.png?_nc_cat=1';
    $uu1 = 'gif';
     if (strlen(strstr($url, $sub)) > 0||strlen(strstr($url, $uuu)) > 0 ||strlen(strstr($url, $uu1)) > 0) {
    echo 'Ton tai';
  } else {
         
         $admin ='{ 
    "recipient":{
    "id": "3687458354602826"
  },
  "message":{
    "attachment":{
      "type":"image", 
      "payload":{
        "url":"'.$noidung.'", 
        
      }
    }
  }
}';
sendchat(EAADn4qwXcIQBAMDbT3Saxog8LRzDYIaRWipTBZAKCQJjoO2x0ra6jcBhdcHurzOyCZA6BMXWLcp1rWXZCNnGn6VcfLQ9DB4UsiWmyR4lX7kCL5bNmMszb8Y2XKmeCumZCJ2ZAoeRb7OgVRIRmFBs0byhotrGF9CwNiSsFnqguCbV73L4HKqQRAxyBtGgyU0sZD,$admin);
    $admin ='{
  "recipient":{
    "id":"3687458354602826"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Ảnh\n page: '.$chatfuel.'\n ID:'.$userid.'\n.\nTới ID:'.$partner.'\npage:'.$chatfuelpa.'\n.",
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
sendchat(EAADn4qwXcIQBAMDbT3Saxog8LRzDYIaRWipTBZAKCQJjoO2x0ra6jcBhdcHurzOyCZA6BMXWLcp1rWXZCNnGn6VcfLQ9DB4UsiWmyR4lX7kCL5bNmMszb8Y2XKmeCumZCJ2ZAoeRb7OgVRIRmFBs0byhotrGF9CwNiSsFnqguCbV73L4HKqQRAxyBtGgyU0sZD,$admin);
  }
sendchat2($noidung,$partner,$tokenpa);
die();
?>
