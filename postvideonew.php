<!DOCTYPE html>
<html>
<head>
	<title>Video</title>
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
  top: 15%;
  left: 5%;
  width: 94%;
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

<?php
$url = $_GET['url'];
$v2 = '&_nc_sid=';
$v3 = $_GET['_nc_sid'];
$v4 = '&_nc_ohc=';
$v5 = $_GET['_nc_ohc'];
$v6 = '&vabr';
$v7 = $_GET['vabr'];
$v8 = '&_nc_ht=';
$v9 = $_GET['_nc_ht'];
$v10 = '&oh=';
$v11 = $_GET['oh'];
$v12 = '&oe=';
$v13 = $_GET['oe'];
$v14 = '&_nc_oc=';
$v15 = $_GET['_nc_oc'];

if (isset($v5)){
$hihi ="".$url."".$v2."".$v3."".$v4."".$v5."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."".$v12."".$v13."";
}
else
{
	$hihi = "".$url."".$v2."".$v3."".$v14."".$v15."".$v6."".$v7."".$v8."".$v9."".$v10."".$v11."".$v12."".$v13."";
}
	if (isset($url)){ 
#header("Location: https://halochatanhnguoila05.herokuapp.com/video.php?&url=$hihi");
	}
  else{
    $hihi="Không có video";
    die();
}
?>
<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
}
</script>
<form method="post" action="index.php">
  <input type="hidden" name="fname" value=<?php echo "$hihi"?> >
  
 <center> <input type="submit" value="Xem Ảnh"></center>
</form>
<br>Đối với điện thoại iphone vui lòng sao chép link mở trình duyệt để xem video</br>
<input type="text" value=<?php echo "$hihi"?> id="myInput">
<button  onclick="myFunction()">Copy</button>

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
<form name="form" method="post" action="video0.php">
  Name: <input type="text" name="fname" value=<?php echo "$hihi"?> >
</form>

<video id="player" controls="" loop="" autoplay="">
    <source id="video" type="video/mp4" src=<?php echo "$hihi"?> >
  </video>
 <p>
    <small>This is the content sent from the user in
      <a href="https://m.me/102206461510133?ref=anh">Chatbot</a> on Facebook Messenger Platform
      <br> People can talk with each other, send messages, photos, videos to each other and share their interesting stories.
    </small>
  </p>
-->
  </body>
</html>