<?php
  session_start();
 //to connect to the database.
$resource = mysql_connect("127.0.0.1", "bakeuser", "bake") or die("Unable to connect" . mysql_error());

mysql_select_db("Bakeshop", $resource) or die("Unable to connect to patient database");

//post the user and password when logining in.
  $username = $_POST['username'];
  $pswd =  $_POST['password'];
  $pswd=md5($pswd);
 

//checking the customer information before log in
$users = mysql_query("select count(1) numuser, customerID from customers where emailAddress = '$username' and password = '$pswd'", $resource);

$row = mysql_fetch_assoc($users);  


if ( $row['numuser'] == 1 ) {
	
	$_SESSION['userId'] = $row['customerID'];
	
    $_SESSION['msg'] = "Welcome Back !";
	
} else {
    $_SESSION['msg'] = "Login Failed";
}
 
?>


<?php include '../head.php'
 ?>
 
<div class="middle">
<!--left banner flash-->
<iframe class="left" src="http://files.bannersnack.com/iframe/embed.html?hash=bzkaglqq&amp;bgcolor=%233D3D3D&amp;wmode=opaque&amp;t=1393996298"></iframe>

<div class="middletitle">       
 <p class="subtitle"><?php echo $_SESSION['msg'] ?></p>   
 </div>
 </div>
 <?php
 include '../footer.php' ?>
 

