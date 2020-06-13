<?php
	require_once 'config.php'; //lấy thông tin từ config
	$conn = mysqli_connect($DBHOST, $DBUSER, $DBPW, $DBNAME)or die("Lỗi kết nối tới cơ sở dữ liệu"); // kết nối data
	$sql = "SELECT ID, trangthai, gioitinh, hangcho, ketnoi FROM users";
	$result = mysqli_query($conn, $sql);
  
  ?>
