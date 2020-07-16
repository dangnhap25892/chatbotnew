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
  body{
    max-width: 100%;
  position: absolute;
  top: 25%;
  left: 0%;
  width: 99%;
  height: 2.4em;
  text-align: center;
}
input[type=submit]{
  margin-left: -1.5em;
  height: 2.5em;
  padding: 0.2em 1em 0.2em 2.25em;
  font-size: 1em;
  font-weight: bold;
  font-family: "Open Sans";
  text-transform: uppercase;
  color: #696666;
  background: url(https://i.imgur.com/Th606mh.png) no-repeat scroll 0.70em 0.17em transparent;
  background-size: 30px 100px;
  border-radius: 2em;
  border: 0.15em solid #F9C23C;
  cursor: pointer;
  transition: all 0.3s ease 0s;
}
input[type="submit"]:hover {
    color: #fff;
    background-color: #EAA502;
    border-color: #EAA502;
    background-position: 0.75em bottom;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
input[type="submit"]:focus {
    background-position: 2em -4em;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
/* Webfonts */

@font-face {
    font-family: 'Open Sans';
    font-style: normal;
    font-weight: 700;
    src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://themes.googleusercontent.com/static/fonts/opensans/v8/k3k702ZOKiLJc3WVjuplzHhCUOGz7vYGh680lGh-uXM.woff) format('woff');
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
 <!--
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
<form name="form" method="post" action="index.php">
	<input type="hidden" name="fname" value=<?php echo "$hihi"?> >
	  <?php echo "$hihi"?>
</form>
  -->
<form method="post" action="index.php">
  <input type="hidden" name="fname" value=<?php echo "$hihi"?> >
  
 <center> <input type="submit" value="Xem Ảnh"></center>
</form>


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
	  <!-- =
	<form action="xuly.php" method="POST">
            Name: <input type="text" name="fullname" ><br>
            E-mail: <input type="email" name="email"><br>
            <input type="submit"  >
        </form>
	     -->
	<!--
<img id="image" src= <?php echo "$hihi"?> >

</h1>
  <p>
    <small>This is the content sent from the user in
      <a href="https://m.me/102206461510133?ref=anh">Chatbot</a> on Facebook Messenger Platform
      <br> People can talk with each other, send messages, photos, videos to each other and share their interesting stories.
    </small>
  </p>
	-->
</body>
</html>