
<?php
$ID = $_GET['ID'];// lấy id từ chatfuel
$gioitinh = $_GET['gt']; // lấy giới tính

require_once 'config.php'; //lấy thông tin từ config
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME); // kết nối data

if ($gioitinh == 'nam'){
$gioitinh = 1;
} else if ($gioitinh == 'n%E1%BB%AF'){
$gioitinh = 2;
}
else{
	$gioitinh = 0;
}


function capnhatgt($id,$gioitinh) {
  global $conn;

  mysqli_query($conn, "UPDATE `users` SET `gioitinh` = 1 WHERE `ID` = $id");
 
}
capnhatgt($ID,$gioitinh);
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
              "subtitle":"đã cập nhật thành công."
            }
          ]
        }
      }
    }
  ]
}';

mysqli_close($conn);
?>
