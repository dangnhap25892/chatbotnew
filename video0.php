<?php
/*
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
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $hihi = $_POST['fname'];
    if (empty($hihi)) {
        echo "Không có video";
    } else {
        #echo $name;

    }
}	   
if (isset($hihi)){
	
}
else
{
	echo"Không có video";
	die();
}  
?>



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
		</style>
<body>
	<h2>Video ở dưới</h2>
	<script type="text/javascript">
	atOptions = {
		'key' : 'fe68e43250345f57adacbd19c67b8d11',
		'format' : 'iframe',
		'height' : 250,
		'width' : 300,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.topdisplaynetwork.com/fe68e43250345f57adacbd19c67b8d11/invoke.js"></scr' + 'ipt>');
</script>
	
	<script type="text/javascript">
	atOptions = {
		'key' : 'bb80e142b04619715be076484834af02',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.topdisplaynetwork.com/bb80e142b04619715be076484834af02/invoke.js"></scr' + 'ipt>');
</script>
	
	
	<h1>
 <p>Video người lạ đã gửi cho bạn</p>
	

<video id="player" controls="" loop="" autoplay="">
    <source id="video" type="video/mp4" src=<?php echo "$hihi"?> >
  </video>
		</h1>
	<script type='text/javascript' src='//pl15587779.profitablegate.com/62/01/f7/6201f7a5a3c8f50bcf9e87da249bfd2f.js'></script>
 <p>
    <small>This is the content sent from the user in
      <a href="https://m.me/102206461510133?ref=anh">Chatbot</a> on Facebook Messenger Platform
      <br> People can talk with each other, send messages, photos, videos to each other and share their interesting stories.
    </small>
  </p>
	<script type="text/javascript">
	atOptions = {
		'key' : 'a38b790527179b97a7f7598b2f3028ce',
		'format' : 'iframe',
		'height' : 60,
		'width' : 468,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://www.topdisplaynetwork.com/a38b790527179b97a7f7598b2f3028ce/invoke.js"></scr' + 'ipt>');
</script>
	
	<script async="async" data-cfasync="false" src="//pl15588055.profitablegate.com/afd0bff84920629a844bf1a7156e8a1d/invoke.js"></script>
<div id="container-afd0bff84920629a844bf1a7156e8a1d"></div>
	
	<script type="text/javascript">
	atOptions = {
		'key' : '989aea2f2fb05d573ed08e0a5b7c6376',
		'format' : 'iframe',
		'height' : 600,
		'width' : 160,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/989aea2f2fb05d573ed08e0a5b7c6376/invoke.js"></scr' + 'ipt>');
</script>
	
	<script type="text/javascript">
	atOptions = {
		'key' : 'e51f9a995c49d9a1ea9032975a8582b9',
		'format' : 'iframe',
		'height' : 300,
		'width' : 160,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/e51f9a995c49d9a1ea9032975a8582b9/invoke.js"></scr' + 'ipt>');
</script>
	
	<script type="text/javascript">
	atOptions = {
		'key' : 'fadd456465c562262d019c0895272c8a',
		'format' : 'iframe',
		'height' : 90,
		'width' : 728,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/fadd456465c562262d019c0895272c8a/invoke.js"></scr' + 'ipt>');
</script>
	
  </body>
</html>
