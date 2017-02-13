
<?php include 'head.php'; ?>
<!--Script for slide show-->
 <script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="js/slide.js"></script>
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

 <script type="text/javascript">
	//to create the first function,has two parameters, to create the dialog output for different input result.
	function multipleSelection(mua){	

		 var dynamicDialog = $(mua);	 
	  dynamicDialog.animate({
            backgroundColor: "#ff9999",

          color: "#fff",
             }, 5000 );
	
	 dynamicDialog.dialog({ 
                    modal: true,
					 show: {
                  effect: "blind",
                  duration: 800
                  },
                  hide: {
                   effect: "explode",
                   duration: 800
                  },
			//okay button: to return the value user selected and alert it. 

                });
	}
	   //play function, check the email address is valid or not.
        $(document).ready(function () {
            //default first dialog 			
            $("#sbm").click(function () { 
			var emailStr=document.all.email.value;
			var emailPat= /^(?:[a-zA-Z0-9]+[_\-\+\.]?)*[a-zA-Z0-9]+@(?:([a-zA-Z0-9]+[_\-]?)*[a-zA-Z0-9]+\.)+([a-zA-Z]{2,})+$/;
			
			var matchArray=emailStr.match(emailPat);
			if (matchArray==null) { 
			var m='<div id="MyDialog">\
            <P>Invalid Email Address, Please Try Again</P>\
            </div>';
					multipleSelection(m);}
            		
			else
			{var n='<div id="MyDialog">\
            <P>Thank you so much! You have joined our mail list</P>\
            </div>';
					multipleSelection(n);
				}});
        });
    </script>
<!--banner flash  in center-->
<div style="margin-top:5px;font-size:20px; text-align:center; color:#990033;">
Welcome! You are the
<a href="http://www.hitwebcounter.com/how-to/how-to-what-is-free-blog-counter.php" target="_blank">
<img src="http://hitwebcounter.com/counter/counter.php?page=5457241&style=0005&nbdigits=4&type=page&initCount=0" title="no registration needed counter" Alt="no registration needed counter"   border="0" >
</a> 
</div>
<div id="pic"  style="margin-top:-1px;">
<!--<div id="slidetext">
<p>Welcome to Cherry's Bake Shop</p>
</div>-->


<div id="slides" >
    <div class="active"> 
        <img src="images/cake1.jpg" alt="Taste Cake"  />
    </div><div>
        <img src="images/cake2.jpg" alt="Taste Cake" >
    </div><div>
        <img src="images/cake3.jpg" alt="Taste Cake">
    </div><div>
        <img src="images/cake4.jpg" alt="Taste Cake" >
    </div><div>
        <img src="images/cake5.jpg" alt="Taste Cake" >
    </div><div>
        <img src="images/cake6.jpg" alt="Taste Cake" >
    </div>

</div>
</div>
<!--mail area-->
<div id="mail" >
  <div id="mailfont">
    <p id="mailp">Join our mailing list</p>
    </div>
  <div id="mailright" style="width:440px;">
   <p>Enter your E-mail address here</p>
 </div>
<!--textbox and button-->
  <div id="mailbox" style="width:450px;">
     <input type="text" name="email" id="email" size="30" value class="text-input">
    <input id="sbm" type="image" src="images/submit.jpg" />
  </div>
  <div style="margin-top:-30px;margin-left:20px;float:left;width:50px;">
  <a href="http://www.facebook.com/"><img src="images/facebook.jpg" alt="" style="wdith:60px;height:60px;"></a>
  <a href="http://www.twitter.com/"><img src="images/twitter.jpg" alt="" style="wdith:60px;height:60px;"></a>
  </div>
</div>
<?php include 'footer.php'; ?>