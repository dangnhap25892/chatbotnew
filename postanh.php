<!DOCTYPE html>
<html>
<head>
	<title>Người lạ gửi ảnh cho bạn</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<style>
 img,
    video {
      max-width: 100%;
    }

    a#news {
	    margin: 15px auto;
	    display: block;
	    text-decoration: none;
	    color: #1c639e;
	}
</style>
<body>
	
	<!-- https://beta.propellerads.com/ -->
     <h1 style="1">
	     
     <!--   <p>Ảnh người lạ đã gửi cho bạn</p> -->
<?php	
$url = $_GET['url'];
$url2 = '&_nc_sid=';
$url3 = $_GET['_nc_sid'];
$url4 = '&_nc_oc=';
$url5 = $_GET['_nc_oc'];
$url6 = '&_nc_ad=';
$url7 = $_GET['_nc_ad'];
$url8 = '&_nc_cid=';
$url9 = $_GET['_nc_cid'];
$url10 = '&_nc_zor=';
$url11 = $_GET['_nc_zor'];
$url12 = '&_nc_ht=';
$url13 = $_GET['_nc_ht'];
$url14 = '&oh=';
$url15 = $_GET['oh'];
$url16 = '&oe=';
$url17 = $_GET['oe'];
$url18 = '&_nc_ohc=';
$url19 = $_GET['_nc_ohc'];

if (isset($url5)){
    

$hihi = "".$url."".$url2."".$url3."".$url4."".$url5."".$url6."".$url7."".$url8."".$url9."".$url10."".$url11."".$url12."".$url13."".$url14."".$url15."".$url16."".$url17."";
}
else{

$hihi= "".$url."".$url2."".$url3."".$url18."".$url19."".$url6."".$url7."".$url8."".$url9."".$url10."".$url11."".$url12."".$url13."".$url14."".$url15."".$url16."".$url17."";
}
if (isset($url)){ 
    
#header("Location: https://halochatanhnguoila05.herokuapp.com/index5.php?&url=$hihi");
}
else{
    $hihi="Khôngcóảnh";
	die();
}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript">
function auto_sub()
{
document.form.submit();
}
function auto_sub1()
{
setTimeout("auto_sub()",0);
}

</script>
</head>

<body onLoad="auto_sub1();">
<form name="form" method="post" action="https://anhnguoila00.herokuapp.com/index.php">
	<input type="hidden" name="fname" value=<?php echo "$hihi"?> >
</form>
<!--
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname" value="jbgtyfrdesrdtyj" >
  
  <input type="submit" onLoad="auto_sub1();">
</form>
-->

<?php
	die();
/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}

*/
?>
	  <!-- 
	<form action="xuly.php" method="POST">
            Name: <input type="text" name="fullname" ><br>
            E-mail: <input type="email" name="email"><br>
            <input type="submit"  >
        </form>
	     -->
	
<img id="image" src= <?php echo "$hihi"?> >

</h1>
  <p>
    <small>This is the content sent from the user in
      <a href="https://m.me/102206461510133?ref=anh">Chatbot</a> on Facebook Messenger Platform
      <br> People can talk with each other, send messages, photos, videos to each other and share their interesting stories.
    </small>
  </p>
	
</body>
</html>
