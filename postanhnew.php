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
  top: 0%;
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
	/*new*/
	#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
/*new*/
</style>
<body onload="myFunction()" style="margin:0;">
	<!-- https://a-ads.com?partner=1433203-->
	<iframe data-aa="1433203" src="//ad.a-ads.com/1433203?size=300x250" scrolling="no" style="width:300px; height:250px; border:0px; padding:0; overflow:hidden" allowtransparency="true"></iframe>
<!-- https://a-ads.com?partner=1433203-->
	<!-- https://beta.propellerads.com/-->
     <h1 style="1">
	     
     <!--   <p>Ảnh người lạ đã gửi cho bạn</p> -->
<?php	
	     
	     
	 /*    
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
*/

 $url = $_GET['url'];
 $hihi = $url;
 $hihi = str_replace ("dangnhap0935","&",$hihi);
if (isset($url)){ 
    
#header("Location: https://halochatanhnguoila05.herokuapp.com/index5.php?&url=$hihi");
}
else{
    $hihi="Khôngcóảnh";
	die();
}
?>
<script>
function myFunction1() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
}
</script>
	     <!-- new -->
	<script>
	var myVar;

	function myFunction() {
	  myVar = setTimeout(showPage, 200);
	}

	function showPage() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("myDiv").style.display = "block";
	}
</script>
<!-- new -->
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
  --><!-- new -->
	     <div id="loader"></div>
	     
<div style="display:none;" id="myDiv" class="animate-bottom" >
	<!-- new -->
<form method="post" action="https://halochatanh0.herokuapp.com/index.php">
  <input type="hidden" name="fname" value=<?php echo "$hihi"?> >
  
 <center> <input type="submit" value="Hiển Thị Ảnh"></center>
</form>
	     
</br></br></br>Nếu không xem được ảnh vui lòng sao chép link mở trình duyệt để xem ảnh</br>
<form method="post" action="https://halochatanh0.herokuapp.com/linkduphong.php">
  <input type="hidden" name="fname" value=<?php echo "$hihi"?> >
  
 <center> <input type="submit" value="Dự Phòng"></center>
</form>

</div>


<!--
<input type="text" value=<?php echo "$hihi"?> id="myInput">
<button  onclick="myFunction()">Copy</button>
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
</h1>
</body>
</html>