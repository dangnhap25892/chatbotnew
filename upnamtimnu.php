<?php
require_once 'config.php'; //lấy thông tin từ config
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

if ( !isUserExist($ID) ) { // nếu chưa tồn tại thì update lên sever nếu người không có ai trong hàng chờ nam tìm nữ 2 nữ tìm nam 3 nam tìm nam 4 nữ tìm nữ 5 tim 9x 6 tim 2k 7
    $sql = "INSERT INTO `users` (`ID`, `trangthai`, `hangcho` ,`gioitinh`,`chatfuel`,`token`) VALUES (".$ID.", 0, 2 , '$h','$chatfuel','$d')";
   $info = mysqli_query($conn,$sql );
  header("Location: thamgiabotnamtimnu.php?ID=$ID&token=$token");
  }
header("Location: thamgiabotnamtimnu.php?ID=$ID&token=$token");
#mysqli_close($conn);

?>
