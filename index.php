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
if (isset($url)){
	
}
else
{
	die();
}
*/
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $hihi = $_POST['fname'];
    if (empty($hihi)) {
        echo "Không có ảnh";
    } else {
        #echo $name;

    }
}	   
if (isset($hihi)){
	
}
else
{
	echo'Không có ảnh';
	die();
}  


?>
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

<!-- new -->
	<script>
	var myVar;

	function myFunction() {
	  myVar = setTimeout(showPage, 2000);
	}

	function showPage() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("myDiv").style.display = "block";
	}
</script>
<!-- new -->
	<!-- Quảng cáo -->
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  300x250_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : 'dc5121e073d0b5024c8851c4fa4579fc',
		'format' : 'iframe',
		'height' : 250,
		'width' : 300,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/dc5121e073d0b5024c8851c4fa4579fc/invoke.js"></scr' + 'ipt>');
</script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  300x50_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : '5b8af646bd8073edd466651a45a066a8',
		'format' : 'iframe',
		'height' : 50,
		'width' : 320,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/5b8af646bd8073edd466651a45a066a8/invoke.js"></scr' + 'ipt>');
</script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  300x50_1 -->
	<!-- Quảng cáo -->
	<!-- Quảng cáo -->
     <h1 style="1">
	     
        <p>Ảnh người lạ đã gửi cho bạn</p>

<div id="loader"></div>
	     
<div style="display:none;" id="myDiv" class="animate-bottom" >
	     
<img id="image" src= <?php echo "$hihi"?> >

</div>


</h1>
  <p>
    <small>This is the content sent from the user in
      <a href="https://m.me/102206461510133?ref=anh">Chatbot</a> on Facebook Messenger Platform
      <br> People can talk with each other, send messages, photos, videos to each other and share their interesting stories.
    </small>
  </p>
	<!-- Quảng cáo -->
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  468x60_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : '4bf0e2ab2f639cd82b8e0cb09bafba81',
		'format' : 'iframe',
		'height' : 60,
		'width' : 468,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/4bf0e2ab2f639cd82b8e0cb09bafba81/invoke.js"></scr' + 'ipt>');
</script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  NativeBanner_1 -->
	<script async="async" data-cfasync="false" src="//w3plywbd72pf.com/ff3a32547adb4311f7dfa0aede354000/invoke.js"></script>
<div id="container-ff3a32547adb4311f7dfa0aede354000"></div>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  SocialBar_1 -->
	<script type='text/javascript' src='//w3plywbd72pf.com/97/e1/52/97e152760174a26cf4e0934996daf82a.js'></script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  160x600_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : 'c2e53ce0608365a19adad21a046c6e74',
		'format' : 'iframe',
		'height' : 600,
		'width' : 160,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/c2e53ce0608365a19adad21a046c6e74/invoke.js"></scr' + 'ipt>');
</script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  160x300_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : '01a7d2ae60a14be7b40cec0a732f0ff6',
		'format' : 'iframe',
		'height' : 300,
		'width' : 160,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/01a7d2ae60a14be7b40cec0a732f0ff6/invoke.js"></scr' + 'ipt>');
</script>
	<!-- https://publishers.adsterra.com/referral/TJ3batmyH2  728x90_1 -->
	<script type="text/javascript">
	atOptions = {
		'key' : 'b8b283af2c12a9494dfd747f1c0f4729',
		'format' : 'iframe',
		'height' : 90,
		'width' : 728,
		'params' : {}
	};
	document.write('<scr' + 'ipt type="text/javascript" src="http' + (location.protocol === 'https:' ? 's' : '') + '://w3plywbd72pf.com/b8b283af2c12a9494dfd747f1c0f4729/invoke.js"></scr' + 'ipt>');
</script>
	<!-- Quảng cáo -->
	<!-- https://beta.publishers.adsterra.com// -->
	
</body>
</html>