<?php

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
file_put_contents("text.txt", $input);
$userID = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$getstart = $input['entry'][0]['messaging'][0];
$type = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['type'];
$image = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['url'];
$page = $input['entry'][0]['id'];
switch ($page)
{
    case '103456168065673' :
        $token = 'EAADn4qwXcIQBAFHRcn1PVuyAjPrYaJbqRJZBAMPWJiVNH4IDnu2Q1zv1hNORLZBKj1MT0eYJudICNjQTaycesDiZBvtyhhOLqKuFgTapMm9Bt9tSNdPocIaC3aBcOAzHg8hUsxMrxnj9sZAQiBwVmzZBJOfu4WjgnvbU9igFuVQZDZD';
        break;
    case '106013841142376' :
        $token = 'EAADn4qwXcIQBAPd61ca1Ee35hssJqhQz4qJFscbZCAXyeshGwCNmQl7hy6vpWqQB6uV8Vr97XTgmghTcMs1CeG7KrUJGHXeIP94PgUjJRfZBdyMDHMyDO7XI1HOHTFgUmAKWyDmJU2i5yFAvWN8YG0dPmzJpVcHSDwx8vGwgZDZD';
        break;
    case '103303021315529' :
        $token = 'EAADn4qwXcIQBAExg4ufcz8X1w4DgN6UP6ZAIEq6U9ZCodDzvFbZBkBsofbZBCGx29YU0ABV6YRRvZA8u6umZB71q7tOM7HpI4zRkrQasQs6CSHrpCMyj4yLaCHH34IGosUgljfEf4biZCAnZBsvlu3maLKoOn0dqEjCtZBsyBDit5zwZDZD';
        break;
}

if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="Getstared"){
    header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=testchat&gt=0");
    $jsonData ='{
  "recipient":{
    "id": "'.$userID.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Chào bạn! Chat giúp bạn kết nối và trò chuyện với người lạ. Thật thú vị!",
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
    header("Location: thamgiabot.php?ID=$userID");
    die();
  }
  if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="newchat"){
    header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=testchat&gt=0");
    header("Location: thamgiabot.php?ID=$userID&token=$token");
    die();
  }
  if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="Menuchat"){
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
        "title":"Kết Thúc",
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
  if(isset($getstart['postback']))
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
      },{
        "content_type":"text",
        "title":"Không",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($token,$jsonData);
    die();
}
if ($message=='Kết thúc') {
  header("Location: ketthucbot.php?ID=$userID&token=$token");
  die();
}
if ($message=='Chat ngẫu nhiên'||$message =='Start'||$message =='start'||$message =='Bắt đầu') {
  header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=testchat&gt=0");
  header("Location: thamgiabot.php?ID=$userID&token=$token");
  die();
}
if ($message=='Menu') {
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
if ($message=='Hướng dẫn') {
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
if ($message=='pp'||$message =='Pp'||$message =='End chat'||$message =='End'||$message =='end') {
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
      },{
        "content_type":"text",
        "title":"Không",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($token,$jsonData);
  die();
}
if(isset($message)){
  header("Location: sendchatbot.php?id=$userID&noidung=$message");
  die();
 }
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
    die();
}
die();
?>
