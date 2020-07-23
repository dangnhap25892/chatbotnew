<?php
require_once ('tokenpage.php'); 
if (isset($_REQUEST['hub_challenge']))
{
  $c = $_REQUEST['hub_challenge'];
  $v = $_REQUEST['hub_verify_token'];
}

if($v =="123")
{
  echo $c;
  exit;
}
$input = json_decode(file_get_contents('php://input'),true);
#file_put_contents("text.txt", $input);
$userID = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$getstart = $input['entry'][0]['messaging'][0];
$type = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['type'];
$image = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['url'];
$idpage = $input['entry'][0]['id'];
$quick_reply = $input['entry'][0]['messaging'][0]['message']['quick_reply']['payload'];
$hihi = $input['entry'][0]['messaging'][0]['postback'];
$ref = $input['entry'][0]['messaging'][0]['postback']['referral']['ref'];

$page = tokenpage($idpage);
 $token = $page[0];
 $chatpage = $page[1];
#$link1='https://sendchatbot11.herokuapp.com';
$link1='https://halochatbot1sendchat11.herokuapp.com';

if(isset($ref))
{
   header("Location: $link1/chiaseref.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0&ref=$ref");
  $jsonData ='{
    "recipient":{
      "id": "'.$userID.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Chào bạn! \nChat giúp bạn kết nối và trò chuyện với người lạ. Thật thú vị!.Bạn đến từ link chia sẻ.",
          "buttons":[
            {
              "type":"Postback",
              "title":"Bắt đầu",
              "payload":"newchat"
            }
          ]
        }
      }
    }
  }';
      sendchat($token,$jsonData);
  die();
  
}
if($getstart['postback']['payload']=="chiase" ){
    $jsonData ='{
   "messaging_type" : "RESPONSE",
   "recipient":{
     "id": "'.$userID.'"
   },
   "message":{
     "text": "Sao chép liên kiết và mời bạn bè sử dụng Halochat. Khi có người mới tham gia Halochat qua liên kết giới thiệu này, bạn sẽ được thưởng 100 xu."
     }
 }';
 sendchat($token,$jsonData);
  $jsonData ="{
   'messaging_type' : 'RESPONSE',
   'recipient':{
     'id': $userID
   },
   'message':{
     'text': 'm.me/Halochat.VN1?ref=".$userID."'
     }
 }";
 sendchat($token,$jsonData);
    die();
}
if($message=='chiase'){
   $jsonData ="{
   'messaging_type' : 'RESPONSE',
   'recipient':{
     'id': $userID
   },
   'message':{
     'text': 'https://m.me/HaloChatVN?ref=".$userID."'
     }
 }";
 sendchat($token,$jsonData);
  die();
 }

if(isset($getstart['postback'])){
  if($getstart['postback']['payload']=="Getstared"||$hihi['title']=="Get Started"||$getstart['postback']['payload']=="GetStared"||$getstart['postback']['payload']=="Get Stared"){
      $jsonData ='{
    "recipient":{
      "id": "'.$userID.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Chào bạn! \nChat giúp bạn kết nối và trò chuyện với người lạ. Thật thú vị!",
          "buttons":[
            {
              "type":"Postback",
              "title":"Bắt đầu",
              "payload":"newchat"
            }
          ]
        }
      }
    }
  }';
      sendchat($token,$jsonData);
      header("Location: $link1/updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
      die();
  }

  if($getstart['postback']['payload']=="newchat"){
     header("Location: $link1/updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
    die();
  }

 if($getstart['postback']['payload']=="thongtin"){
    $jsonData ='{
    "recipient":{
      "id": "'.$userID.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Hiện tại chat bot đang cần nâng cấp hệ thống để khắc phục lỗi, cần sự trợ giúp của các bạn để có giây phút chat vui vẻ hơn. Hãy Donate cho chúng tôi chúng tôi sẽ không làm bạn thất vọng.\nHãy ủng hộ chúng tôi Link Donate : 0061001155911 Vietcombank",
          "buttons":[
          
            {
              "type":"web_url",
              "url":"https://unghotoi.com/1585289035xy8fn#",
              "title":"Donate"
            },
            {
              "type":"web_url",
              "url":"https://playerduo.com/5ee9d32c76bd436dd464a3d3",
              "title":"Donate PlayerDuo"
            }
          ]
        }
      }
    }
  }';
  sendchat($token,$jsonData);
    die();
  }
  
  if($getstart['postback']['payload']=="Menuchat"){
    $jsonData1 ='{
  "recipient":{
    "id":"'.$userID.'"
  },
   "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"generic",
        "elements":[
           {
            "title":"Này bạn ơi...",
            "subtitle":"Bạn tham gia Group để tìm lại bạn chat\nGroup mới tạo nên bạn vào giúp Group lớn mạnh nhé.",
            "default_action": {
              "type": "web_url",
              "url": "m.me/halochatvn2",
              "webview_height_ratio": "tall"
              
            },
            "buttons":[
              {
                "type":"web_url",
                "url":"https://www.facebook.com/groups/3321905804486436/",
                "title":"Tìm lại bạn chat"
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
              },     
            ]      
          }
        ]
      }
    }
  }
}';
sendchat($token,$jsonData1);
    die();
  }
if($getstart['postback']['payload']=="donate"){
    
    $jsonData ='{
    "recipient":{
      "id": "'.$userID.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Chat bot đang cần nâng cấp và thêm 1 số tính năng nếu bạn ủng hộ thì hãy giúp team chúng tôi để làm tốt hơn😍\nHãy ủng hộ chúng tôi Link Donate : 0061001155911 Vietcombank ",
          "buttons":[
          
            {
              "type":"web_url",
              "url":"https://unghotoi.com/1585289035xy8fn#",
              "title":"Donate"
            },
            {
              "type":"web_url",
              "url":"https://playerduo.com/5ee9d32c76bd436dd464a3d3",
              "title":"Donate PlayerDuo"
            },
            {
              "type":"web_url",
              "url":"https://forms.gle/sMv4tTyk9dSSW8rT9",
              "title":"Góp ý kiến"
            },
          ]
        }
      }
    }
  }';
    sendchat($token,$jsonData);
   
    die();
  }
  if($getstart['postback']['payload']=="endchat"){
    $jsonData ='{
    "recipient":{
      "id":"'.$userID.'"
    },
    "messaging_type": "RESPONSE",
    "message":{
      "text": "Bạn muốn kết thúc cuộc trò chuyện?",
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
    die();
}
if($getstart['postback']['payload']=="sualoi"){
    header("Location: $link1/upxuloi.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
    die();
}
  if($getstart['postback']['payload']=="iphone" ){
  $jsonData ='{ 
    "recipient":{
    "id": "'.$userID.'"
  },
  "message":{
    "attachment":{
      "type":"image", 
      "payload":{
        "url":"https://scontent.xx.fbcdn.net/v/t1.15752-9/107800634_275005093824055_7505363074398219503_n.jpg?_nc_cat=111&_nc_sid=b96e70&_nc_ohc=wRKD2jJCx74AX-un3xB&_nc_ad=z-m&_nc_cid=0&_nc_zor=&_nc_ht=scontent.xx&oh=2aaf26f4bc69587af1fd5feb22d93816&oe=5F2B0CE1", 
        "is_reusable":true
      }
    }
  }
}';
sendchat($token,$jsonData);
  die();
}

}



if ($message=='upxuloi') {
  header("Location: $link1/upxuloi.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
  die();
}

  if(isset($quick_reply)){
  if($quick_reply=="test"){
    $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn đã tham gia Group chưa hãy tham gia để kết thêm nhiều bạn nào.Tham gia để tìm lại bạn chat.",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
      },{
        "content_type":"text",
        "title":"Kết thúc",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Hướng dẫn",
        "payload":"huongdan",
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

  if($quick_reply=="nam"){
     header("Location: $link1/capnhapgt.php?ID=$userID&token=$token&gt=$quick_reply");
    die();
  }
  if($quick_reply=="nữ"){
     header("Location: $link1/capnhapgt.php?ID=$userID&token=$token&gt=$quick_reply");
    die();
  }
  
  if($quick_reply=="timnam"){
     #header("Location: thamgiabotgt.php?ID=$userID&token=$token&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
    #header("Location: updatebotgt.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
    header("Location: $link1/uptimtheogt.php?ID=$userID&token=$token&chatfuel=$idpage&gt=$quick_reply");
    die();
  }
  if($quick_reply=="timnu"){
     #header("Location: thamgiabotgt.php?ID=$userID&token=$token&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
    #header("Location: updatebotgt.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=$quick_reply");
    header("Location: $link1/uptimtheogt.php?ID=$userID&token=$token&chatfuel=$idpage&gt=$quick_reply");
    die();
  }
  if($quick_reply=="Khong"){
    die();
  }
    
    //$quick_reply
 }
    

  
   if(isset($type)){
if ($type=="image")
{
  $image = str_replace("&","dangnhap0935",$image);
  header("Location: $link1/sendimagenew.php?id=$userID&noidung=$image");
  #sendchat2($image,$userID,$token);
    die();
}
if ($type=="audio")
{
  $image = str_replace("&","dangnhap0935",$image);
  header("Location: $link1/sendaudionew.php?id=$userID&noidung=$image");
    die();
}
     if(isset($type)){
if ($type=="video")
{
 /* $jsonData ="{
   'messaging_type' : 'RESPONSE',
   'recipient':{
     'id': $userID
   },
   'message':{
     'text': 'Hiện đang lỗi gửi video chờ sửa lỗi trong vài phút'
     }
 }";
 sendchat($token,$jsonData);*/
  #header("Location: sendimage.php?id=$userID&noidung=$image");
 $image = str_replace("&","dangnhap0935",$image);
  header("Location: $link1/sendvideonew.php?id=$userID&noidung=$image");
    die();
}
     }
   }

if ($message=='Kết thúc'||$message =='End chat'||$message =='end chat'||$message =='endchat'||$message =='Endchat'||$message =='END') {
  header("Location: $link1/ketthucbot.php?ID=$userID&token=$token");
  die();
}
if ($message=='block') {
  header("Location: $link1/blockbot.php?ID=$userID&token=$token");
  die();
}

if ($message=='tham gia test') {
  header("Location: thamgiatest.php?ID=$userID&token=$token");
  die();
}
if ($message=='tham gia test1') {
  header("Location: thamgialan1.php?ID=$userID&token=$token");
  die();
}
if ($message=='Team 2K+') {
  #header("Location:  thamgiabot2k.php?ID=$userID&token=$token");
  #header("Location: updatebot2k.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
  #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
  header("Location: $link1/uptim2k.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
  die();
}
if ($message=='9X Tâm Sự') {
  #header("Location:  thamgiabot9x.php?ID=$userID&token=$token");
  #header("Location: updatebot9x.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
 #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
  header("Location: $link1/uptim9x.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
  die();
}
if ($message=='Chat ngẫu nhiên'||$message =='Start'||$message =='start'||$message =='Bắt đầu') {
  header("Location: $link1/updatebot.php?ID=$userID&token=$token&chatfuel=$idpage&gt=0");
 
  die();
 
}
if ($message=='Menu'||$getstart['postback']['payload']=="Menu1") {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn đã tham gia Group chưa hãy tham gia để kết thêm nhiều bạn nào.Tham gia để tìm lại bạn chat.\nhttps://www.facebook.com/groups/halochatvoinguoila/",
    "quick_replies":[
    
      {
        "content_type":"text",
        "title":"Hướng dẫn",
        "payload":"huongdan",
      },
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
        "title":"Kết Thúc",
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

if ($message=='Cập nhập giới tính') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
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
if ($message=='Tìm theo giới tính') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn muốn tìm giới tính nào",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Tìm Nam",
        "payload":"timnam",
      },{
        "content_type":"text",
        "title":"Tìm Nữ",
        "payload":"timnu",
      },
      {
        "content_type":"text",
        "title":"Cập nhập giới tính",
        "payload":"capnhapgt",
      },
      
    ]
  }
}';
    sendchat($token,$jsonData);
    die();
}
if ($message=='Hướng dẫn'||$message =='HUONGDAN') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Gõ ký tự bất kỳ để bắt đầu chat. Gõ pp hoặc end chat để kết thúc cuộc trò chuyện.Hiện tại Chat có hỗ trợ gửi ảnh, video, chatvoice, và file đính kèm.",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
      },{
        "content_type":"text",
        "title":"Kết thúc",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Hướng dẫn",
        "payload":"huongdan",
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
if ($message=='dangnhap0935') {
 $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "message":{
    "quick_replies":[
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"newchat",
      },{
        "content_type":"text",
        "title":"Kết thúc",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Hướng dẫn",
        "payload":"huongdan",
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
if ($message=='pp'||$message =='Pp'||$message =='End'||$message =='end'||$message =='Kết Thúc') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn muốn kết thúc cuộc trò chuyện?",
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
  die();
}
if ($message=='BLOCK') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn muốn block đối phương khi đã block bạn sẽ không gặp lại người lạ này nữa",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"block",
        "payload":"endchat",
      },{
        "content_type":"text",
        "title":"Không.",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($token,$jsonData);
  die();
}
if ($message=='Tố cáo'||$message=='Tố cáo và kết thúc') {
  $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn muốn tố cáo đối phương. Những hành vi xấu như là show ảnh nhạy cảm chat gạ chịch.Lưu ý Không lạm dụng tính năng này nếu tố cáo sai bạn sẽ bị cấm chat",
    "quick_replies":[
      {
        "content_type":"text",
        "title":"tố cáo",
        "payload":"endchat",
      },{
        "content_type":"text",
        "title":"Không.",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($token,$jsonData);
  die();
}
if ($message=='tố cáo') {
  header("Location: $link1/tocaobot.php?ID=$userID&token=$token");
  die();
}
if($message=='kiemtra2'){
   $jsonData ="{
   'messaging_type' : 'RESPONSE',
   'recipient':{
     'id': $userID
   },
   'message':{
     'text': 'userid:".$userID." tin nhắn :".$message." idpage:".$page."'
     }
 }";
 sendchat($token,$jsonData);
  die();
 }
if(isset($message)){
  $hi = (rand(1,4));
   $message = preg_replace('/\n+/', '\n', $message);
 
  if($hi == 1)
{
 #header("Location: https://sendchatbot10.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
 header("Location: https://halochatbot1sendchat21.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token"); 
    die();
}
if($hi == 2)
{
 #header("Location: https://sendchatbot10.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
  header("Location: https://halochatbot1sendchat21.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
  die();
}
  if($hi == 3)
{
 #header("Location: https://sendchatbot10.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
    header("Location: https://halochatbot1sendchat21.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
    die();
}
  if($hi == 4)
{
 #header("Location: https://sendchatbot10.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
    header("Location: https://halochatbot1sendchat11.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
    die();
}

 

  

 # header("Location: https://sendchatbot.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
 
  #header("Location: sendchatbot.php?id=$userID&noidung=$message&token=$token");
  die();
 }
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
function sendchat2($message,$userID,$token)
{

$url = "https://graph.facebook.com/v7.0/me/messages?access_token=$token";
  $jsonData ="{
  
  'recipient':{
    'id': $userID
  },
  'message':{
    'text':'".$message."'
    }
}";
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
die();
?>