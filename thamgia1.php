
<?php
$ID = $_POST['ID']; // lấy id từ chatfuel
$gioitinh = $_POST['gt'];// lấy giới tính

require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data
////// Hàm Gửi JSON //////////

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
              "subtitle":"Đã xảy ra lỗi gửi tin. Bạn gửi lại sau thử nhé."
            }
          ]
        }
      }
    }
  ]
}';
}
function request($userid,$chatfuel,$token,$jsondata) { 
  global $DATHAMGIA;
  $url = "https://api.chatfuel.com/bots/$chatfuel/users/$userid/send?chatfuel_token=$token&chatfuel_block_name=$DATHAMGIA";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_exec($ch);
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
///// Hàm gửi tin nhắn //////////

function sendchat($userid,$chatfuel,$token,$noidung){
global $JSON;
$payload = '{"'.$JSON.'":"'.$noidung.'"}';
request($userid,$chatfuel,$token,$payload);		
}


///// hàm kiểm tra hàng chờ ///////
function hangcho($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `hangcho` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['hangcho']) !== 0;
}

//// Kết nối hai người /////
function addketnoi($user1, $user2) {
  global $conn;

  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user2, `hangcho` = 0 WHERE `ID` = $user1");
  mysqli_query($conn, "UPDATE `users` SET `trangthai` = 1, `ketnoi` = $user1, `hangcho` = 0 WHERE `ID` = $user2");
}


function ketnoi($userid,$gioitinh) { //tìm người chát 
  global $conn;
  
  //tìm đối tượng theo giới tính 

  if($gioitinh == "female"){// nếu giới tính là nữ thì kiếm người mang giới tính nam 
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 2 AND `gioitinh` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  //echo "result : " . $result."<br>";
  }else if($gioitinh == "male"){// giới tính là nam thì tìm kiếm người là nữ
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND  `hangcho` = 2 AND `gioitinh` = 2 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }else{ // không xác thì tìm kiếm người không xác định
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND  `hangcho` = 2 AND `gioitinh` = 0 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");
  }
  //echo $result;
  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) {
    ketnoi2($userid,$gioitinh);

  }
  else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
 $chatfuelpa = getChatfuel($partner);
 # $tokenpa = gettoken($partner);
    #$tokenpa = $token;
 $tokenpa = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
   echo '{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Người lạ đã tham gia trò chuyện",
              "subtitle":"Gõ pp hoặc end chat để kết thúc."
            }
          ]
        }
      }
    }
  ]
}';
 sendchat($partner,$chatfuelpa,$tokenpa," ✅ Người lạ đã tham gia trò chuyện"); 
 //sendchat($partner,$chatfuelpa,$tokenpa,"Gõ pp hoặc end chat để kết thúc.");  

 }
 
}


/////Tìm kiếm kết nối /////

function ketnoi2($userid,$gioitinh) { //tìm người chát 
  global $conn;
  
  $result = mysqli_query($conn, "SELECT `ID` FROM `users` WHERE `ID` != $userid AND `hangcho` = 1 AND `ID` NOT IN (SELECT `idBlocked` FROM `block` WHERE `idBlock` = $userid) LIMIT 1");


  $row = mysqli_fetch_assoc($result);
  $partner = $row['ID'];
  // xử lý kiểm tra
  if ($partner == 0) { // nếu người không có ai trong hàng chờ
  mysqli_query($conn, "UPDATE `users` SET `hangcho` = 1 WHERE `ID` = $userid"); 
    
   echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Đang tìm kiếm...",
              "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗"
            }
          ]
        }
      }
    }
  ]
}'; 
} else {  // neu co nguoi trong hàng chờ
    addketnoi($userid, $partner);
 $chatfuelpa = getChatfuel($partner);
 # $tokenpa = gettoken($partner);
    #$tokenpa = $token;
 $tokenpa = 'mELtlMAHYqR0BvgEiMq8zVek3uYUK3OJMbtyrdNPTrQB9ndV0fM7lWTFZbM4MZvD';
   echo '{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Người lạ đã tham gia trò chuyện",
              "subtitle":"Gõ pp hoặc end chat để kết thúc."
            }
          ]
        }
      }
    }
  ]
}';
 sendchat($partner,$chatfuelpa,$tokenpa," ✅ Người lạ đã tham gia trò chuyện"); 
 //sendchat($partner,$chatfuelpa,$tokenpa,"Gõ pp hoặc end chat để kết thúc.");  

 }
 
}

//////// LẤY ID NGƯỜI CHÁT CÙNG ////////////
function getRelationship($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `ketnoi` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);
  $relationship = $row['ketnoi'];
  return $relationship;
}

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

//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}

//// Xử lý //////
if (!trangthai($ID)){// nếu chưa chát
if (!hangcho($ID)) { // nếu chưa trong hàng chờ
ketnoi($ID,$gioitinh);
}else{
echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
             "title":"Đang tìm kiếm...",
              "subtitle":"Vui lòng đợi chút nha. Mình đang kết nối giúp bạn đây 😗"
            }
          ]
        }
      }
    }
  ]
}';
}
}else{
// khi đang chát ! giải quyết sau !!
echo'{
 "messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"⛔️ CẢNH BÁO",
              "subtitle":"Bạn đang được kết nối chát với người khác ! Hãy gõ \'End\' để thoát"
            }
          ]
        }
      }
    }
  ]
}';
}
mysqli_close($conn);
?>
