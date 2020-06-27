<?php
require_once 'config.php'; //lấy thông tin từ config
require_once ('tokenpage.php'); 
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME) or die ('Không thể kết nối tới database');
$ID = $_GET['ID'];// lấy id từ chatfuel
$gioitinh = $_GET['gt']; // lấy giới tính
$chatfuel = $_GET['chatfuel'];
$token = $_GET['token'];
function isUserExist($userid) { //hàm kiểm tra xem user đã tồn tại chưa 
  global $conn;
  $result = mysqli_query($conn, "SELECT `ID` from `users` WHERE `ID` = $userid LIMIT 1");
  $row = mysqli_num_rows($result);
  return $row;
}
$d = date(d);
$h = date(h);
$time = ("d".$d."h".$h."");
echo $time;
/// Xét giới tính
if ($gioitinh == 'male'){
$gioitinh = 1;
} else if ($gioitinh == 'female'){
$gioitinh = 2;
}
//// hàm kiểm tra trạng thái
function trangthai($userid) {
  global $conn;

  $result = mysqli_query($conn, "SELECT `trangthai` from `users` WHERE `ID` = $userid");
  $row = mysqli_fetch_assoc($result);

  return intval($row['trangthai']) !== 0;
}

////// Hàm Gửi JSON //////////
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
$page = tokenpage($chatfuel);
$token = $page[0];


if ( !isUserExist($ID) ) { // nếu chưa tồn tại thì update lên sever
    $sql = "INSERT INTO `users` (`ID`, `trangthai`, `hangcho` ,`gioitinh`,`chatfuel`,`token`) VALUES (".$ID.", 0, 0 , 0,'$chatfuel','$d')";
   $info = mysqli_query($conn,$sql );
   if ( !isUserExist($ID) ) { // nếu chưa tồn tại thì 
  header("Location: thamgiabot.php?ID=$ID&token=$token");

  // lỗi
	}
  }
  if (!trangthai($ID)){// nếu chưa chát
	$jsonData ='{
	    "recipient":{
	      "id": "'.$ID.'"
	    },
	    "message":{
	      "attachment":{
	        "type":"template",
	        "payload":{
	          "template_type":"button",
	          "text":"Bạn chưa bắt đầu hoặc bạn đã bị ngắt kết nối với người lạ.",
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
  	//chưa bắt đầu
  }
  else
  {
  	$jsonData ='{
    "recipient":{
      "id": "'.$ID.'"
    },
    "message":{
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"button",
          "text":"Đã sửa lỗi...\nChúc bạn và người lạ chat vui vẻ\n Vì quá nhiều người sửa dụng cùng lúc nên đã xãy ra lỗi này.\n Hãy giúp chúng tôi hạn chế lỗi này bằng cách donate để chúng tôi nâng cấp hệ thống",
          "buttons":[
            {
              "type":"Postback",
              "title":"Donate",
              "payload":"thongtin"
            }
          ]
        }
      }
    }
  }';


sendchat($token,$jsonData);
  	//chat vui vẻ
  }


#mysqli_close($conn);

?>