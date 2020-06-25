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
$quick_reply = $input['entry'][0]['messaging'][0]['message']['quick_reply']['payload'];
$hihi = $input['entry'][0]['messaging'][0]['postback'];
switch ($page)
{
    case '103456168065673' :
        $token = '1EAADn4qwXcIQBAKSsMOUU47FIIFZAERrUvpikobbXRlyWNCjhnTN0qFu5dUq2z1C2VamYZCM54htqV5wA4bmxZCZAkn3wAxkadEy4dzZAnec7BZBxOR3L6nY1QkEPIpd5gNgooDPFInyJBDVUUlHGTE45v11AizwV7J6KyvfbcpmgZDZD';
       
        $chatpage ='Test chatbot';
     break;
    case '106013841142376' :
        $token = 'EAADn4qwXcIQBAPd61ca1Ee35hssJqhQz4qJFscbZCAXyeshGwCNmQl7hy6vpWqQB6uV8Vr97XTgmghTcMs1CeG7KrUJGHXeIP94PgUjJRfZBdyMDHMyDO7XI1HOHTFgUmAKWyDmJU2i5yFAvWN8YG0dPmzJpVcHSDwx8vGwgZDZD';
        
          $chatpage ='Test chatbot2';
    break;
    case '103303021315529' :
        $token = 'EAADn4qwXcIQBADg5rViE4XKDYpZBHV7zy8vmfZAY1ihtJQYZAN1CvYPkjArBeF06OQhT9iAQ2yrTptpCP5wjcuNzdtVIKDN5GmhaSmekhOkjfRguZBZC0PSEkZA26AvDGwl53CHeiK3GfIykZARul3ZAQtQHBI9SViSKKi2AXVLQ5wZDZD';
        
        $chatpage ='Thính chat';
    break;
    case '100514801700726' :
        $token = 'EAADn4qwXcIQBAHago30KtnDb4Leyy0y7xW1mWLB9FXTP8uo0sQieEZBKZBCZAI6JbjG2fGx8Gq7a10iPtiPqXgsAVn09RsZAKjslag7ZBC5KQ8PNzD8FQ2jqBecL4a3TyIWJqV8ZCwm9ELKArHNfiZALf9kbuzG0IIX2jK2WGwztAZDZD';
        break;
        $chatpage ='Chat với người lạ';
    case '101355291513790' :
        $token = 'EAADn4qwXcIQBAPeQDPVBXQDsN8y9OvqnnnF6TlFIAGzXX7pqgR54NfR6mpD9qA8VmsHkBPn83uxQZAnLTLHT0Gks63KR0IZBh6AmR9ILUi11ZCuZBblSZCVEDsrX8F9baXKkpp58uWOI7OBhtEYe8TskzifpcyzRpui76J64KtQZDZD';
        $chatpage ='Chat love';   
    break;
     case '103817501348244' :
        $token = 'EAADn4qwXcIQBAJzVwvr5u2OgM3OpcUmkj1wgSnifdMb7ZB0AmWfHZBJ51M7eMlGbK3hJbv2wTYGUaxCb46y95YKZBKBg3YhvEyItZCwmKzQKDzAjZCGBQ33SRKDlYHEhUWXpPWfIyvRyl6clgoVn8RY2ZCf7UWeSR7QUcqI3rvkwZDZD';
        $chatpage ='Chat love.';   
    break;
    case '104256927946178' :
        $token = 'EAADn4qwXcIQBANl9bpGZCp3ZANIsS6f7VLxMgutOOqEBEZAqtwbhfc8oCoUCoJ1vvAHCf1aPe6KwUo4Fy6P4wB9H8Dale68qYy1KbTBrjBRZCZB9HKSMRghqIuS2sdPpVZBFW66RDgpgfhN1fO7VISg1RewcW7R83i2CHd40dy8gZDZD';
        $chatpage ='Chatbile';   
    break;
    case '114769690219396' :
        $token = 'EAADn4qwXcIQBAPKNOZB2jZCaZBG8ZBrQW0t5xnY8vvXbZB5w02vVoE1d6y9QiZBdQZAcsCXfzzL8UapOYfl3s4IxfSYZALFBBVRWvUnD2MFb2CLiZAmPQ0z3lyJotLZAwX4Ml2JlNsUIW34SpATpNZCD0LbFmZA1og3WFw9NL9v1qO5wfwZDZD';
        $chatpage ='Chatbot chat với người lạ';   
    break;
    case '110179824011282' :
        $token = 'EAADn4qwXcIQBAJqqWzMYUgphdg4LO3T7RZCwK8nlNYoyLiGhYibZAIai4x2ETi83t2RK1kxWXPGM16TGBrgpwndwp424oK396SlCG5JPBWLtldYT5ZBT6vDQKUmkOQSZAoV3gqmrUUYmArZCDptoBlD1MOCGp9YACDF49d0JJAwZDZD';
        $chatpage ='Chatible';   
    break;
    case '113373193713336' :
        $token = 'EAADn4qwXcIQBADP03kZCEEZCgZAJdQThFitf4zEsVjI5JrPZCHKKpjsi0YvTpnb1d7UAfUkrJdrIYBFwPdJdGlZAhdv42C541AgG0OZCwwHrEpDXfCZAZBjtnmKUu5jyvE8Y5ZBbuzNfkepBVOSlLX0RicxqaNHT9Ati6cs1Rdq8zWAZDZD';
        $chatpage ='Chatible / Trò chuyệ với người lạ.';   
    break;
    case '110680147294195' :
        $token = 'EAADn4qwXcIQBABEEZA6oEIjaOs7FltSFVXlNJeAWEWyZBoB7JZCxZB1B2ZBZCV5Ka4qrqKKErVXYt7TRks4Kj0WTMhEr824qW0rP4MSZCTedNBNYnxB8YyRkqle4KRUsq5UtCXA2vo9clEeFG0jphDI5sHfEZAR5gTVkUZCL2fU5WagZDZD';
        $chatpage ='Chatible / Trò chuyện với người lạ';   
    break;
    case '100440421688945' :
        $token = 'EAADn4qwXcIQBAL9akRYrZCWER8m3wwEzZA58biLbAT8sWBZCif4j7IISYxGL7JHvTnHAnld16wO9XQnMWr4U2AUZBZBwGUdmxXFor8mYZApuPlLrwlpNhSRmkgyODf4oAvPQdcMaOyQZAuKH2MfeFvZAggznsXaV3vKOyE1554GfhAZDZD';
        $chatpage ='Chatible / Trò chuyện với người lạ.';   
    break;
     case '113246053701669' :
        $token = 'EAADn4qwXcIQBAI8ZAhqg2eg0dL7ToDFBtMTcWh7YbXZAHfw1zF82c50TNyov5SiwlU6HcdDKj1kOpUbIS1LQoeVgHzkvbPfBglhrzVusHwgh3uCIeRBqdRKDHN2Wt06w3Ow17eicto9Mf8yxyHB0YHQWxgPPZCal7NZB20mCQgZDZD';
        $chatpage ='Chatible Friends';   
    break;
    case '105598234473922' :
        $token = 'EAADn4qwXcIQBAOTdiBtsKu5PJhu7dAWwZBEjBykY3awlGXtP7FoOP1UxVuWfIY7pEauhavG2nYG2N4Lqdlj9KRSRTZBTZA6nJeW6eiScbqUgNdX5tHZA05tr2xwC5bcVrQ4cbDBYTx9oVRh51OGEUJBWo2U14DfgCMZBs6TmxewZDZD';
        $chatpage ='Chatible Love';   
    break;
    case '100427601688975' :
        $token = 'EAADn4qwXcIQBAOOGMklVYJmoyWv0BARvLxoobPCcNciK0b8AqCkRUPoZBDfGRdZC3TFZCi1y1UnHbzB2c7PmQnR0k3UZCnpFe7gdLuLkjSvv9xfB3Pcke3o2iGb9ueIKEQe7FROEoAv2cUmlizpeg2DgTQwTQSHPpaLg9YWdaQZDZD';
        $chatpage ='Chatible/Trò chuyện với người lạ';   
    break;
    case '120069963047718' :
        $token = 'EAADn4qwXcIQBAJTvZCMJZAEoLZAuKJtw1vttls5ZAIOCZA18AzwNFcY1Mg6oAWQ9nRK2ykg5JAetmtHGyQd6d7SSrZCw3yO3XKQIhHwnYWW8QgqHBhAmbB2IjiSf6EtHX1GYfDcJjZBgoVXwTWsYLrAHapWZAxZBujOXzy8OVZCqvj0AZDZD';
        $chatpage ='Chattible';   
    break;
    case '101487468218838' :
        $token = 'EAADn4qwXcIQBAAx5E7ImCafCih9mjVC6IZAHllclZA1H9dGnFILj0m9WJxwr6riNRHZBC3uDuIExgKkmENttbJXvZCBaRAQf6jESDBnsLzI99t1vLBHoch2LM5htVwZCoGXTcm9npU6ZAtwre44UZB1kP4MZBZCQnKwApTBYINpR3ZCwZDZD';
        $chatpage ='Chatvn';   
    break;
    case '111898040524687' :
        $token = 'EAADn4qwXcIQBAGuP6ZC0mwyR0i9IZB05PKWZBZCHSxnZCC4nsif3SptzyrNxYO2f1ZB5QCYZCmDgUkpjc9HkQbyV6VtYhGbXFv0aYzQgkUYB0i7b62UZBYbdXCU6lR2DoYh0jFc4f3EmYQZC1BsZBlPrZCDBUiJRwIuhjoCYHVLa4ftmQZDZD';
        $chatpage ='Chatvn / Chatible';   
    break;
    case '101737548228773' :
        $token = 'EAADn4qwXcIQBAFz0tD6YlDMRMdarNUNT2kfCeSEt9AEt2fPD4dIQZB7lHxzp5VZATvNzrfcriGWifCKdYNZCajJIsrajbx93dZApQtph8fPOufewHODHi4B509qoH5ZBFn4vc83RH9dA9YiJdbcqcZBY1gEGWZC0qmGn4iFs5rZBPQZDZD';
        $chatpage ='Chatvn / Love';   
    break;
     case '106392681094996' :
        $token = 'EAADn4qwXcIQBAH701Xj0XZCQlduqBqxZC157tZC659DMW0i6hNh2bt9ochSzUPbDB5Ojt6vWPSWm9SFlBQCZAT2np7rZCieuJbwX05u3ih3q9x1A5zHuGjux3B4AsvgiLiZAZAhKMkk40f0ia84nG7buob88ZBXihJ2tMXAUZBOjYRgZDZD';
        $chatpage ='Chatvn / Trò chuyện với người lạ Love';   
    break;
    case '108756324190760' :
        $token = 'EAADn4qwXcIQBAOmlp1g029sZB3ZBvkTse9rCq0rqr2gFittuOrMu5CgvCupLr8OvhT1ZBRwMTTfWIZAAIUmbEja0dtaTj81ruKkRlQAFVWAoL6sZCnBub89wXIBgTyOOIti7vvImYoJZAKgWjxJ8a86RZCd473ZAvE3MXnlBVu1bVAZDZD';
        $chatpage ='Chatvn / Trò chuyện với người lạ Thả Thính';   
    break;
    case '102206461510133' :
        $token = 'EAADn4qwXcIQBAANnZA8L8XAZBTJCrhxshNbKKwGYKIa7Pusm5wB26WzMLZCweqbx6btuT3nR9e85bNroZCmbymCIuv6eZAYR1Gzli9ksrPvOpggZB25U0eHZAJ7xgfxjbL8PZBnxlBTJYluxetd54EN9NaH83SJrxTizwndxRQy3egZDZD';
        $chatpage ='Chatvn Thả Thính';   
    break;
    case '103768777982171' :
        $token = 'EAADn4qwXcIQBAAyI4J4kUzivsPZBD4aPbiSRy1Ljo1dL6C1bevlQFlttqvgzikajZCdwO9ia24MzZAMslV55Qm7NXvdKbtQxT0wh5crCvdjGo9bNEMDWZBmO7sy7bM2GNZBrMZBBgK3Ax44lGS5YmFAlmtOEl8AgHyVZCfxOrb9iQZDZD';
        $chatpage ='Chatvn.';   
    break;
    case '110643363990453' :
        $token = 'EAADn4qwXcIQBACpKOs3ObYlp9g0KXj0T5j79ZBaaNCe8rDywGsXAZBzzmKZCEf35QZCZBc4kDSweiJzXOtETYDQvsTQVWFJeksCGCKahdCYvQApE9ElawKckewUABBZAvkhOEo4OuKZACmZAEUhKcyHtsPj7Gz085igGH43pwRfpQgZDZD';
        $chatpage ='Thả Thính';   
    break;
    case '106986154392261' :
        $token = 'EAADn4qwXcIQBAIcZBoIBem6f4VZCxAkGq36nvpgLYDjSZAVjS5S3g4QU1Vv7zftpgQPowjd2rWYdaETsM0LzYbmAmAmt1xBI1ePdYdTJTmPxBLQgBgSZBKcrEEAXHYa9ENxNT7mKOpwcsbfAyGXhLIlNqh9kxGobqgsniogOKwZDZD';
        $chatpage ='Chat với người lạ';   
    break;
    case '106525104438779' :
        $token = 'EAADn4qwXcIQBADScA12ZBGNEB6k0ELmnqw0b4hejjGZApGyqLHlEJdXwkifdKv0RbxZAinY8ZBYO1uZAnNWOANHeZBIa5TGRWKeHmZB2wqHH5nCITL8omU4NwdGrX7RXJojdHRxFQZBlPNIZCtc0VQXBjjvptSChAfCUW2LfB57mq8AZDZD';
        $chatpage ='Chatible Việt Nam';   
    break;
    case '105986961166650' :
        $token = 'EAADn4qwXcIQBACmJGeSmrlV2KZCiSeKsMxQUXGvKlHFBVBaEOyRWqZCv0iBco50ZABKkClFdRimtns6RzeGK61fbZCc5JuQldA8Aann4YipO8MQrYx13nrY0zFEpf9WBVPSoZBgUkowxUeSuu05GA7V97cADzNz0ivudRcnxg9UhDDdYSV6Wc';
        $chatpage ='Bạn Muốn Hẹn Hò ?';   
    break;
     case '105184504581236' :
        $token = 'EAADn4qwXcIQBADx1MyJnrJKTpTaxPgiejc0UbFpZAHs0PFFLomdBcauaJnpgI4fu0GArGByiF8DGq40M6xSE2ld4eMbj3BBm7GWi3wejJ5GgN2UYeHbqsU7LZACt5gAO3SDgV3fk0ZAJB5ZAOr9IjWIvcD5jbLBx6LsO61Wjk4Rx3KdSQZA0ZC';
        $chatpage ='Hẹn Hò';   
    break;
    case '107049221059443' :
        $token = 'EAADn4qwXcIQBAFlzW73p2ztrEOE1Lk0lrOS6kejdq3ODZCn1k3Sh0ZCc7iWsl7W5AGfZAMEjtc9IIqrA70eQyRZAzBqm7HM0ZAMs8bt9RGtoclnlfzTlJZCu7v7fG2aJQ1QdFF6a2DpyD9u9rk6Kp9dBTBVpZBZBZBRbrFc3NOKHJqJZCuqhBKgIxw';
        $chatpage ='Hẹn Hò Với Người Lạ';   
    break;
    case '110807250679458' :
        $token = 'EAADn4qwXcIQBALbL9HUww5Vc5ynvRYDrJZChSTTbFZBOhcbHjTWJ5Osd4mtZASjIkAzGO9f7XiSgbMZBcADVDRSL3FXZBZBOI5zPVGxfiSJuA3L48W1LZCLHP201qhsuBGulab9PZAzZB8wOij7CUuiZBeBAaejDsUDNp6tSIT335rS32rnRoPgdN6';
        $chatpage ='Hẹn Hò Bí Mật';   
    break;
    case '101976294907930' :
        $token = 'EAADn4qwXcIQBAOSTi5pjZCKuvmHc91eQKtiHpOTefudylZCMcpmBsRWaIbE3fMb227x3WYqdr3QejZCs4erwZCuP6wjPZBgX7WbsIphIqOTqXTiOOyJosrLCksmjIhbQsUdSIgtZB0GDEE4QwqvUV9xc03UK1h8NTNznwBrmO8iOZCXnpuWWbWN';
        $chatpage ='Chat ẩn danh';   
    break;
    
    
    
    
}

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
    header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
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
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"endchat",
      },
      {
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
        "title":"Cập nhập giới tính",
        "payload":"hihi",
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
  }
if(isset($quick_reply)){
  if($quick_reply=="nam"){
     header("Location: capnhapgt.php?ID=$userID&token=$token&gt=$quick_reply");
    die();
  }
  if($quick_reply=="nữ"){
     header("Location: capnhapgt.php?ID=$userID&token=$token&gt=$quick_reply");
    die();
  }
  if($quick_reply=="gtt3"){
     header("Location: capnhapgt.php?ID=$userID&token=$token&gt=$quick_reply");
    die();
  }
  if($quick_reply=="timnam"){
     #header("Location: thamgiabotgt.php?ID=$userID&token=$token&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
    header("Location: updatebotgt.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=$quick_reply");
    die();
  }
  if($quick_reply=="timnu"){
     #header("Location: thamgiabotgt.php?ID=$userID&token=$token&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
    header("Location: updatebotgt.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=$quick_reply");
    die();
  }
  if($quick_reply=="timgtt3"){
     #header("Location: thamgiabotgt.php?ID=$userID&token=$token&gt=$quick_reply");
    #header("Location: updatebot.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
    header("Location: updatebotgt.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=$quick_reply");
    die();
  }
    

  
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
   if(isset($type)){
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
  header("Location: sendvideo.php?id=$userID&noidung=$image");
    die();
}
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
  header("Location: updatebot2k.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
  die();
}
if ($message=='9X Tâm Sự') {
  #header("Location:  thamgiabot9x.php?ID=$userID&token=$token");
  header("Location: updatebot9x.php?ID=$userID&token=$token&chatfuel=$chatpage&gt=0");
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
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"endchat",
      },
       {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"endchat",
      },
      {
        "content_type":"text",
        "title":"Chat ngẫu nhiên",
        "payload":"endchat",
      },
      
      {
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
        "title":"Cập nhập giới tính",
        "payload":"hihi",
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
      {
        "content_type":"text",
        "title":"Giới tính thứ 3",
        "payload":"gtt3",
      }
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
        "title":"Nam",
        "payload":"timnam",
      },{
        "content_type":"text",
        "title":"Nữ",
        "payload":"timnu",
      },
      {
        "content_type":"text",
        "title":"Giới tính thứ 3",
        "payload":"timgtt3",
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
  die();
 }
if(isset($message)){
  $hi = (rand(1,3));
   $message = preg_replace('/\n+/', '\n', $message);
 
  if($hi == 1)
{
 header("Location: https://sendchatbot3.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
}
if($hi == 2)
{
 header("Location: https://sendchatbot.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");

}
  if($hi == 3)
{
 header("Location: https://sendchatbot.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");

}

 # header("Location: https://sendchatbot.herokuapp.com/sendchatbot.php?id=$userID&noidung=$message&token=$token");
 
  #header("Location: sendchatbot.php?id=$userID&noidung=$message&token=$token");
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
