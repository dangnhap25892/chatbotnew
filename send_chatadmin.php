<?php
require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
$id = $_POST['id'];
$noidung = $_POST['noidung'];
if (!$conn) {
    echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Lỗi !!!",
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại thử nhé."
            }
          ]
        }
      }
    }
  ]
}';
}
//$noidung = substr($noidung,1,strlen($noidung) - 1);
$errorChat = '{
     "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Lỗi !!!",
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại thử nhé."
            }
          ]
        }
      }
    }
  ]
} ';
//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT ketnoi from users WHERE ID = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
///// Hàm gửi tin nhắn //////////
function isImage($url){
  $o = parse_url($url);
  if($o["scheme"] != 'https') return false;
  if((strpos($o["host"], 'fbcdn.net') !== false || strpos($o["host"], 'cdn.fbsbx.com') !== false)  && (endsWith($o["path"], '.png') || endsWith($o["path"], '.jpg') || endsWith($o["path"], '.jpeg') || endsWith($o["path"], '.gif')))
      return explode(" ", $url);
  return false;
}
function isVoid($url){
  $o = parse_url($url);
  if($o["scheme"] != 'https') return false;
  if(strpos($o["host"], 'cdn.fbsbx.com') !== false && (endsWith($o["path"], '.mp4') || endsWith($o["path"], '.acc') || endsWith($o["path"], '.mp3') ))
      return explode(" ", $url);
  return false;
}
function isVideo($url){
  $o = parse_url($url);
  if($o["scheme"] != 'https') return false;
  if(strpos($o["host"], 'video.xx.fbcdn.net') !== false && (endsWith($o["path"], '.mp4')  ))
      return explode(" ", $url);
  return false; 
}
function isFile($url){
  $o = parse_url($url);
  if($o["scheme"] != 'https') return false;
  if(strpos($o["host"], 'cdn.fbsbx.com') !== false && (endsWith($o["path"], '.pdf') || endsWith($o["path"], '.txt') || endsWith($o["path"], '.pptx') || endsWith($o["path"], '.xlxs') || endsWith($o["path"], '.docx') || endsWith($o["path"], '.zip') || endsWith($o["path"], '.rar') ))
      return explode(" ", $url);
  return false;
}
function sendchat($userid,$chatfuel,$token,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":'.json_encode($noidung).'}';
if(isImage($noidung)) requestImage($userid,$chatfuel,$token, $payload);
else if(isVoid($noidung)) requestVoid($userid,$chatfuel,$token, $payload);
else if(isVideo($noidung)) requestVideo($userid,$chatfuel,$token, $payload);
else if(isFile($noidung)) requestFile($userid,$chatfuel,$token, $payload);
else requestText($userid,$chatfuel,$token,$payload);    
}

function requestText($userid,$chatfuel,$token,$jsondata) { // hàm gửi chát :)))
  
  global $BLOCK_NAME;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_NAME";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, html_entity_decode($jsondata));
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);

  if (curl_errno($ch)) {
    echo errorChat;
  } else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
      // send ok
    } else {
      echo errorChat;
    }
  }
  curl_close($ch);

}
function requestImage($userid,$chatfuel,$token,$jsondata) { // hàm gửi chát :)))
  global $BLOCK_IMAGE;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_IMAGE";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
    if (curl_errno($ch)) {
    echo errorChat;
  } else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
      // send ok
    } else {
      echo errorChat;
    }
  }
  curl_close($ch);
}
function requestVoid($userid,$chatfuel,$token,$jsondata) { // hàm gửi chát :)))
  global $BLOCK_VOID;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_VOID";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
    if (curl_errno($ch)) {
    echo errorChat;
  } else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
      // send ok
    } else {
      echo errorChat;
    }
  }
  curl_close($ch);
}
function requestVideo($userid,$chatfuel,$token,$jsondata) { // hàm gửi chát :)))
  global $BLOCK_VIDEO;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_VIDEO";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
    if (curl_errno($ch)) {
    echo errorChat;
  } else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
      // send ok
    } else {
      echo errorChat;
    }
  }
  curl_close($ch);
}
function requestFile($userid,$chatfuel,$token,$jsondata) { // hàm gửi chát :)))
  
  global $BLOCK_FILE;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$BLOCK_FILE";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
    if (curl_errno($ch)) {
    echo errorChat;
  } else {
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus == 200) {
      // send ok
    } else {
      echo errorChat;
    }
  }
  curl_close($ch);
}
//// Lấy Id chatfuel////
function getChatfuel($partner) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `chatfuel` from `users` WHERE `ID` = $partner");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['chatfuel'];
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
$partner = 3312640912103286;
$partnerid = getRelationship($id);
$chatfuelpa1 = getChatfuel($partnerid);
switch ($chatfuelpa1)
{
    case '5ecd72767bd3e478ed7e2ca4' :
        $trang = 'chat love.';
        break;
    case '5ecce4540f8d6879c4742bed' :
        $trang = 'chatvn tcvsnl love';
        break;
    case '5ecab3e2502f0650dcf35afc' :
        $trang = 'Chatible / Trò chuyện với người lạ';
        break;
    case '5ec81255aece7d7b31ce8a99' :
        $trang = 'Chattible';
        break;
    case '5ec80ff2aece7d7b31c0176e' :
        $trang = 'Chatvn / Love';
        break;
    case '5ec68b7f26fc27126598312d' :
        $trang = 'NTU ChatBot';
        break;
    case '5ec4efad327fdc1b6611649f' :
        $trang = 'Chatbot chat với người lạ';
        break;
    case '5ec4ede4327fdc1b660dc6bc' :
        $trang = 'Thả Thính';
        break;
    case '5ec4ed1a327fdc1b660bde02' :
        $trang = 'Chat Love';
        break;
    case '5ec4ec03327fdc1b6608b4d7' :
        $trang = 'Chatible / Trò chuyệ với người lạ.';
        break;
    case '5ec4eb16327fdc1b6606778e' :
        $trang = 'Chatible/Trò chuyện với người lạ';
        break;
    case '5ec4ea66327fdc1b66052808' :
        $trang = 'Chatible / Trò chuyện với người lạ.';
        break;
    case '5ec4e90d327fdc1b66040858' :
        $trang = 'Chatible Friends';
        break;
    case '5ec4e778327fdc1b66ff86ab' :
        $trang = 'Chatible Love';
        break;
    case '5ec4e696327fdc1b66fe5fea' :
        $trang = 'Chatbile';
        break;
    case '5ec4e618327fdc1b66fe2cc0' :
        $trang = 'Chatible';
        break;
    case '5ec4e5b0327fdc1b66fe12ed' :
        $trang = 'Chatvn / Chatible';
        break;
    case '5ec4e508327fdc1b66fd30e3' :
        $trang = 'Chatvn Thả Thính';
        break;
    case '5ec4e400327fdc1b66fbb661' :
        $trang = 'Chatvn';
        break;
    case '5ec4e31e327fdc1b66f948f6' :
        $trang = 'Chatvn.';
        break;
        case '5ec4e261327fdc1b66f83e33' :
        $trang = 'Thính Chat';
        break;


    default:
        $trang = 'Không tìm thấy';
        break;
}

if($partnerid!= 0){
   $chatfuelpa = '5ecd72767bd3e478ed7e2ca4';
  $tokenpa = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
    $noidung1 = "".$noidung." kết nối với ".$partnerid." trang ".$trang." ";
sendchat($partner,$chatfuelpa,$tokenpa,$noidung1);
     
     ?>

  
<?php
}
else{
echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Thông Báo",
              "subtitle":"Hãy Gõ start để tìm kiếm..."
            }
          ]
        }
      }
    }
  ]
}';
}

?>