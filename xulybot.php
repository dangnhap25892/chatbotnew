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
#file_put_contents("text.txt", $input);
$userID = $input['entry'][0]['messaging'][0]['sender']['id'];
$message = $input['entry'][0]['messaging'][0]['message']['text'];
$getstart = $input['entry'][0]['messaging'][0];
$type = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['type'];
$image = $input['entry'][0]['messaging'][0]['message']['attachments'][0]['payload']['url'];
$page = $input['entry'][0]['id'];
$quick_replies = $input['entry'][0]['messaging'][0]['message']['quick_replies']['payload'];
switch ($page)
{
    case '103456168065673' :
        $token = 'EAADn4qwXcIQBAFHRcn1PVuyAjPrYaJbqRJZBAMPWJiVNH4IDnu2Q1zv1hNORLZBKj1MT0eYJudICNjQTaycesDiZBvtyhhOLqKuFgTapMm9Bt9tSNdPocIaC3aBcOAzHg8hUsxMrxnj9sZAQiBwVmzZBJOfu4WjgnvbU9igFuVQZDZD';
        break;
        $chatpage ='Test chatbot';
    case '106013841142376' :
        $token = 'EAADn4qwXcIQBAPd61ca1Ee35hssJqhQz4qJFscbZCAXyeshGwCNmQl7hy6vpWqQB6uV8Vr97XTgmghTcMs1CeG7KrUJGHXeIP94PgUjJRfZBdyMDHMyDO7XI1HOHTFgUmAKWyDmJU2i5yFAvWN8YG0dPmzJpVcHSDwx8vGwgZDZD';
        break;
          $chatpage ='Test chatbot2';
    case '103303021315529' :
        $token = 'EAADn4qwXcIQBAExg4ufcz8X1w4DgN6UP6ZAIEq6U9ZCodDzvFbZBkBsofbZBCGx29YU0ABV6YRRvZA8u6umZB71q7tOM7HpI4zRkrQasQs6CSHrpCMyj4yLaCHH34IGosUgljfEf4biZCAnZBsvlu3maLKoOn0dqEjCtZBsyBDit5zwZDZD';
        break;
        $chatpage ='Thính chat';
    case '100514801700726' :
        $token = 'EAADn4qwXcIQBAHago30KtnDb4Leyy0y7xW1mWLB9FXTP8uo0sQieEZBKZBCZAI6JbjG2fGx8Gq7a10iPtiPqXgsAVn09RsZAKjslag7ZBC5KQ8PNzD8FQ2jqBecL4a3TyIWJqV8ZCwm9ELKArHNfiZALf9kbuzG0IIX2jK2WGwztAZDZD';
        break;
        $chatpage ='Chat với người lạ';
    case '101355291513790' :
        $token = 'EAADn4qwXcIQBAGECIuZC6NrbBdZAX4FzqpHSy5pma4pZBjBv2N6L7DRMYXSJO1pq7ZBq6JA940YRLvlZASceageitMcQmKMc66GyYHcehr0fI4dFl3CiXLfzSwuHQhU3zOdahMmgumlq40fOEhZAjaRxGKVG2PRUxoGF2NHseeCwZDZD';
        $chatpage ='Chat love';   
    break;
     case '103817501348244' :
        $token = 'EAADn4qwXcIQBAJzVwvr5u2OgM3OpcUmkj1wgSnifdMb7ZB0AmWfHZBJ51M7eMlGbK3hJbv2wTYGUaxCb46y95YKZBKBg3YhvEyItZCwmKzQKDzAjZCGBQ33SRKDlYHEhUWXpPWfIyvRyl6clgoVn8RY2ZCf7UWeSR7QUcqI3rvkwZDZD';
        $chatpage ='Chat love.';   
    break;
    case '104256927946178' :
        $token = 'EAADn4qwXcIQBAKRT6puU4pekzTFb7JXuY73FHsJ5mTvyLBCiWrL0fwz1aqb9G0xUM9CdY74WuEenqDbGEgPc3P9SjmVgCGvh3ftQah6o6J8wZCDCyVEb1lVX6y7IpAmFqtxaudeDvR322bPZAi0dKSvFJe3X96kZC4GO7DjZCgZDZD';
        $chatpage ='Chatbile';   
    break;
    case '114769690219396' :
        $token = 'EAADn4qwXcIQBABSaDIk5Y3IlBil6bKasXCEF41VtgRqhPZAkfJkjDQWMJngjrdH15ZA1Obk3mrE5g4xviRBfGTRwf74ZBK0GjSN1KRXjHrrlMa66gQcXPoeOISilCyfk3DoUZCfFOoyfcR1h5wez0k19EzCxzdT1PkkINLg9VQZDZD';
        $chatpage ='Chatbot chat với người lạ';   
    break;
    case '110179824011282' :
        $token = 'EAADn4qwXcIQBACCMCge3pDnv1fcZCxAQ3iyGEYPEnb1IsFfRGGwLqFSfNjutEdFnYCkrVZBXnwlF3gjczcYLoZBbKRFKnq0E7hsDIwNP6sTStyulBF76bd8n2UkD0Idl7ufo2dFtZC8QJMPhdGNDaqQDzkkVLQxVG3wKlTG9MwZDZD';
        $chatpage ='Chatible';   
    break;
    case '113373193713336' :
        $token = 'EAADn4qwXcIQBADP03kZCEEZCgZAJdQThFitf4zEsVjI5JrPZCHKKpjsi0YvTpnb1d7UAfUkrJdrIYBFwPdJdGlZAhdv42C541AgG0OZCwwHrEpDXfCZAZBjtnmKUu5jyvE8Y5ZBbuzNfkepBVOSlLX0RicxqaNHT9Ati6cs1Rdq8zWAZDZD';
        $chatpage ='Chatible / Trò chuyệ với người lạ.';   
    break;
    case '110680147294195' :
        $token = 'EAADn4qwXcIQBAGxfc4bPMQ84RZAhElZALekD1HKk7LFV3tnpEz6dLClOvR2Gut0mwWpUZAlwWjdvSQadZBRlMEVH8mZB8xJ53ZBZBT8qpgBKLSmdopl0ppeKVtqVBBkfQsK9ntxeiWpkH6aef5HFTZAE8HBdSL75aXZB4weYszkLd8QZDZD';
        $chatpage ='Chatible / Trò chuyện với người lạ';   
    break;
    case '100440421688945' :
        $token = 'EAADn4qwXcIQBAL9akRYrZCWER8m3wwEzZA58biLbAT8sWBZCif4j7IISYxGL7JHvTnHAnld16wO9XQnMWr4U2AUZBZBwGUdmxXFor8mYZApuPlLrwlpNhSRmkgyODf4oAvPQdcMaOyQZAuKH2MfeFvZAggznsXaV3vKOyE1554GfhAZDZD';
        $chatpage ='Chatible / Trò chuyện với người lạ.';   
    break;
     case '113246053701669' :
        $token = 'EAADn4qwXcIQBABKAxUmLZAZA685iLqOKZCpkfCDJFxx4PRO5VGmZCOKCBpiOsO5avZCoOhh5EwgzKRoP9FLuEaDD5ciAKwtW4pby9KQGDDcFGxf28sw10srQX5xaNzwtnGBJ1N10SaY67PIZCEiIZBQzeszsV3CJc2mdW9PVINn7gZDZD';
        $chatpage ='Chatible Friends';   
    break;
    case '105598234473922' :
        $token = 'EAADn4qwXcIQBAJ8krj5ooRuZCjWCnV339O7WyB4zNJCQUue28GXgBlcWaZCA8zDDZCmyqqE7xPsPkIdKx9iXVgIw1j5i4Y44I6ovuNYu6niSIpAxHVbps5CYrPlqbbEMERiZCZCbAwg3yf8xF31AYZBbRJqN6ZBJEJCMQPnjC89wQZDZD';
        $chatpage ='Chatible Love';   
    break;
    case '100427601688975' :
        $token = 'EAADn4qwXcIQBAAJoKf9irlKQ4J4nRPMZADjXDJSVkJGXxPxtXRsEzdfWyTavCc0irA85AaTlBzxMwqBg7QyBoIdZB2GsTuia6QDzjatRreoUaZBocncgo3ik2L1XnsRguAJR58pf7jBZAKqgLyGTENdj1JpjaSW1FZC71SxvZA7gZDZD';
        $chatpage ='Chatible/Trò chuyện với người lạ';   
    break;
    case '120069963047718' :
        $token = 'EAADn4qwXcIQBAA5aJPNZAYNGbIMNGirX9sOKYSdC01nA97ZCByuZB2IN1maKSFotNuoHLMIRXWEkZB5DLhHxLj9AoYp2s1fKhQVudgtRZBZCBFa9UNbRbQQ7uTAUds1nGdjnMpUVqLrlGZAditDvGU4RGxl4KVfVhxNe1TAEp2HQwZDZD';
        $chatpage ='Chattible';   
    break;
    case '101487468218838' :
        $token = 'EAADn4qwXcIQBAHeNXMZBezrW4tDMbadNSua9N0D8kWJeWZCBehpAaTDL7LuDPqxZCQUoQWUAqRRcSTXlhw3JTBy0rwH4nn1sHJOt6kAvx5mQrIZBpyQOEc21PrhQTooCzHF6wASCqDz06Acd1sIkP7iiaaHHeeZBUg9nYqBZAaPgZDZD';
        $chatpage ='Chatvn';   
    break;
    case '111898040524687' :
        $token = 'EAADn4qwXcIQBAN82oyRTPis7G1H4B0l36SwHap1ZCWnz3ONvbssNXlelPUX4R5NqjNe4EMTEf0C3dmjWLVdtNiLgXEuT1rthGIIGkl3yyPmnvoMVa718suGjEvF8pbNyGKu99pYbsEGb3uMg12NM4ZA3vkx0yXNnqMRYErLwZDZD';
        $chatpage ='Chatvn / Chatible';   
    break;
    case '101737548228773' :
        $token = 'EAADn4qwXcIQBAJJAfGACGt7oDDpeNrUqujZAFLHRGBwhl3lZAwmyagqZBEESTZAoB2glZAR45CeG2aPOwnxLiJchPjLrrMkZC8QfhQzGcM43ZBRcQ50FefHI67Po89urmyb0S6VuAQDfdyRmPcAPsOFFtpWsItY31HTQvCzcSdH5gZDZD';
        $chatpage ='Chatvn / Love';   
    break;
     case '106392681094996' :
        $token = 'EAADn4qwXcIQBAHLvgoiFVuZAkA50EpT1xUZAeM3dupcXtRZBbRfKTKNatMfU2FbnHCoTYx4kkhJSZAQDvCQara3m2Yqtlgn0ZBqOKKrDZA8AmAeMnOefdlu4lX0LtFnIrL2EQFbTWeiyst8rJSQygIbCMktDgamLheuRNBjKsCeQZDZD';
        $chatpage ='Chatvn / Trò chuyện với người lạ Love';   
    break;
    case '108756324190760' :
        $token = 'EAADn4qwXcIQBAARllpUgO8pKg5Kb23xAJIfBGqy37BQY7G8yLya0x1kyB9FaciOKheK43zZBZBFnS11rDKr2QZCZCPDy4NBpiZCrZBUDbyxp10Yr53LVeEmLtDLbSteWHQQpSnFjkTuOnlNttGlVPBs6vTtZBN818UEtSxp2TxoowZDZD';
        $chatpage ='Chatvn / Trò chuyện với người lạ Thả Thính';   
    break;
    case '102206461510133' :
        $token = 'EAADn4qwXcIQBAAdfEAlYNPFTpuc45TcCUKtNUgaJtQtZBxcLu4ZCpZBtk50WnVLKa2dscl3LjQDvEFHh5ZBLN8r6bTRpxmrtJavoGrxLvHKOMZAypop75JltpiFcBBThBJP2JiZApYsOLN70dfGjjuolr7YckGBqWdtEVto53GzQZDZD';
        $chatpage ='Chatvn Thả Thính';   
    break;
    case '103768777982171' :
        $token = 'EAADn4qwXcIQBAKejuxxjYrZB9YKRRhMDTpPMVUl0XEHMEieZBtJnNG2ZClYsQZAGxE7gDhzwhSIFSNvAE2Fk88uCUbPBluRpVUeHsFLkp0AZCqiSZAunU2VatRhZAFZChcUPO2riZC3cEKpTdYbd4f6YrkMkC8qTfwyZC0dmB9gKBrXgZDZD';
        $chatpage ='Chatvn.';   
    break;
    case '110643363990453' :
        $token = 'EAADn4qwXcIQBAIDCWQANHei7MufNk7FmLDd4sViH9p4KzmIME6BJZBzgC1yi9C5ns3aXhfSo5JgLu0Ulo0gLrPrXHlKeg2ZADcRuoKIZAVfYvcal7K24oZBWGMoFsI5qNs6I3fHgjbbrBBDUD2nMIkL02HHNxgEotNFedywuWAZDZD';
        $chatpage ='Thả Thính';   
    break;
    
    
    
    
}

if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="Getstared"){
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
    die();
  }
  if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="newchat"){
    header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
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
        "text":"Hiện tại chat bot đang cần nâng cấp hệ thống để khắc phục lỗi, cần sự trợ giúp của các bạn để có giây phút chat vui vẻ hơn. Hãy Donate cho chúng tôi chúng tôi sẽ không làm bạn thất vọng.",
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
  if(isset($getstart['postback'])){
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
        "title":"không",
        "payload":"test",
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
  }}
  if(isset($quick_replies)){
  if($quick_replies=="endchat"){
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
    

  if(isset($getstart['postback']))
  if($getstart['postback']['payload']=="endchat"){
    $jsonData ='{
  "recipient":{
    "id":"'.$userID.'"
  },
  "messaging_type": "RESPONSE",
  "message":{
    "text": "Bạn muốn kết thúc cuộc trò chuyện?\nHoặc gõ End chat để kết thúc nhanh.",
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
        "title":"Không.",
        "payload":"Khong",
      }
      
    ]
  }
}';
    sendchat($token,$jsonData);
    die();
}
  
if ($type=="image")
{
  header("Location: sendimage.php?id=$userID&noidung=$image");
  #sendchat2($image,$userID,$token);
    die();
}
if ($type=="audio")
{
  header("Location: sendaudio.php?id=$userID&noidung=$image");
    die();
}
if ($type=="video")
{
  header("Location: sendvideo.php?id=$userID&noidung=$image");
    die();
}


if ($message=='Kết thúc'||$message =='End chat'||$message =='end chat'||$message =='endchat'||$message =='Endchat'||$message =='END') {
  header("Location: ketthucbot.php?ID=$userID&token=$token");
  die();
}
if ($message=='block') {
  header("Location: blockbot.php?ID=$userID&token=$token");
  die();
}
if ($message=='Không.') {
  die();
}
if ($message=='Chat ngẫu nhiên'||$message =='Start'||$message =='start'||$message =='Bắt đầu') {
  header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
 
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
    "id": "'.$userID.'"
  },
  "message":{
    "attachment":{
      "type":"template",
      "payload":{
        "template_type":"button",
        "text":"Hiện hệ thống đang lỗi xin vui lòng bạn quay lại sau ít phút.",
        "buttons":[
          {
            "type":"Postback",
            "title":"Sửa lỗi",
            "payload":"newchat"
          },
          {
            "type":"Postback",
            "title":"Thông tin chi tiết",
            "payload":"thongtin"
          }
        ]
      }
    }
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
    "text": "Bạn muốn kết thúc cuộc trò chuyện?\nHoặc gõ End chat để kết thúc nhanh.",
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
 }
if(isset($message)){
   $message = preg_replace('/\n+/', '\n', $message);
  header("Location: sendchatbot.php?id=$userID&noidung=$message&token=$token");
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
