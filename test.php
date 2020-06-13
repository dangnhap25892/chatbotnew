<?php
	require_once 'config.php'; //lấy thông tin từ config
	$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME)or die(echo 'lỗi'); // kết nối data
	$sql = "SELECT ID, trangthai, gioitinh, hangcho, ketnoi FROM users";
	$result = mysqli_query($conn, $sql);
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
  
  ?>
