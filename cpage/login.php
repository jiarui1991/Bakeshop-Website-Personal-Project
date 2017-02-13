<?php 
session_start();
include'../head.php' ?>

<div class="middle">
<!--left banner flash-->
<iframe class="left" src="http://files.bannersnack.com/iframe/embed.html?hash=bzkaglqq&amp;bgcolor=%233D3D3D&amp;wmode=opaque&amp;t=1393996298"></iframe>

<?php 
 if(!isset($_SESSION['userId'])){
	 ?>

<div class="middletitle">
<p class="subtitle">Log in</p>
<div class="subline"></div>
</div>
<!--to login aready exited account-->
<div class="aboutleft">
     <form method="POST" action="authenticate.php">
     <br><br>
    <b><span>&nbsp;My Account Login</span></b>
           <br><br>
            <label for="username">
                <span>&nbsp;</span>
                <span class="label">Username: </span>
                <input type="text" id ="username" name="username" maxlength="45"/>
            </label><br><br>
            <label for="password">
                <span>&nbsp;</span> 
                <span class="label">Password: </span>
                <input type="password" id="password" name="password" maxlength="12"/>
            </label><br><br>
            <label>
                <span class="label">&nbsp;</span>
                <input type="submit" id="submit" value="Log In" />
             </label>   
     
        </form>
     </div>
<div class="dot">
</div>
<!-- to register a new account-->
<div class="aboutright">
     <br><br>
    <b><span>&nbsp;Register New Account</span></b>
   <form method="post" action="register.php">
   <br>
   <span>&nbsp;</span>
   <label for="newuser"><span>Username: </span>
        <input type="text" name="user" id="newuser" maxlength="45"/>
    </label><br><br>
    <span>&nbsp;</span>
    <label for="newpassword"><span>Password: </span>
        <input type="password" name="password" id="newpassword" maxlength="12"/>
    </label><br><br>
    <span>&nbsp;</span>
   <input class="button" type="submit" value="Log In"/>
      </form>     
</div>
</div>
<?php }else {
?><div style="font-size:24px;color:red;float:center;"><?php	echo $_SESSION['msg'];?></div>
<?php
}

?>

<?php include'../footer.php' ?>