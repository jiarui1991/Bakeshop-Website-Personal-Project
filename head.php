<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Cherry's Bake Shop</title>
<?php
//get the path.
 $app_path =  "http://" . $_SERVER['HTTP_HOST'] ."/Bakeshop3/cpage/";

 $app_path2 =  "http://" . $_SERVER['HTTP_HOST'] ."/Bakeshop3/";
?>
<link rel="stylesheet" href="<?php echo $app_path2.'homecss.css'?>" >
	
<!--head animation-->
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
       <!--Script element for JQuery UI-->
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
   	<script src="<?php echo $app_path2.'js/head.js'?>"></script>
</head>
<body>
<!--add backsound music-->
<embed  src="images/music.mp3" loop="-1" width="2" height="0">
<!--way to go back to home page-->
<div id="title"><a class="home" href="<?php echo $app_path2.'home.php'?>">
Cherry's Bake Shop</a>
</div>
<div class="contain">
<!--nav row-->
<div class="nav">
<!--head navigation bar to link to each child pages-->
<div class="navfontl"><a href="<?php echo $app_path.'about.php'?>">ABOUT</a></div>
<div class="navfontl"><a href="<?php echo $app_path2.'menu.php'?>">MENU</a></div>
<div class="navfontl"><a href="<?php echo $app_path2.'order.php'?>">ORDER</a></div>
<div class="navfontl" style="width:200px;"><a href="<?php echo $app_path.'HL.php'?>">HOURS & LOCATION</a></div>
<div class="navfontl"><a href="<?php echo $app_path2.'cart.php'?>">CART</a></div>
<div class="navfontl"><a href="<?php echo $app_path.'login.php'?>">LOGIN</a></div>
<div class="navfontr"><a href="<?php echo $app_path.'faq.php'?>">FAQs</a></div>
<div class="navfontr"><a href="<?php echo $app_path.'logout.php'?>">LOGOUT</a></div>
</div>
<div>