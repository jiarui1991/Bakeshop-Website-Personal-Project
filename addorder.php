<html>
<head>
<meta charset="UTF-8">

<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
   	<script src="js/address_list.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>

  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">

  <script>
//create datepicker to choose shipping date
  $(function() {

    $( "#datepicker" ).datepicker({

      showButtonPanel: true

    });

  });
//check the textfield is filled or not.

function check() {
		var isValid = true;
// validate the cardtype entry  
			if ($("#cardtype").val() == "") {
				$("#cardtype_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#cardtype_error").text("");
			}
			
// validate the cardnum entry  
			if ($("#cardnum").val() == "") {
				$("#cardnum_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#cardnum_error").text("");
			}
// validate the datepicker entry  
			if ($("#datepicker").val() == "") {
				$("#datepicker_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#datepicker_error").text("");
			}
if (isValid) {
                 $("#payment_form").submit(); 
			}
             $("#cardtype").focus();
		} // end function

 

	   //play function

	

</script>

<style type="text/css">
.brownbar{
background-color:#660000;
height:17px;
font-size:19px;
font-weight:bold;
color:white;
padding:10px;

}

.orderitems{
float:left;
width:750px;
height:200px;
margin-top:10px; 


}

.shipaddress{
	width:375px; 
	float:left; 

	margin-top:150px; 
	border:solid #660000 1px;
    height:350px;
}

.payment{
	width:360px; 
	float:left; 
	
	margin-top:150px; 
	border:solid #660000 1px;
    height:350px;
	
	
}

label {
	float: left;
    width: 6em;
    text-align: left;
}
input {
    width: 10em;
    margin-left: 1em;
    margin-bottom: .5em;
}
span {
	color: red;
}
</style>
</head>
<body>
<?php
include'head.php';
session_start();
?>

<div class="middle">

<?php
include'order_history.php';

//get data from cartitem 
$orderitem=$_SESSION['orderitems'];

?>
<div style="float:left;height:703px;margin-top:10px;">
<img src="images/margin.jpg" alt="" height="703px" width="10px">
</div>

<div class="orderitems">
<div class="brownbar">
Order Items
</div>
<div>
<hr>
<table>
<tr>
<th style="width:200px;text-align:left;">Product Code</th>
<th style="width:450px;text-align:left;">Product Name</th>
<th style="width:100px;text-align:left;">Product Price</th>
</tr>
<?php 
//echo $cartitems;
 foreach ($orderitem as $carteach) :
 ?><tr><?php
  $a = $carteach['productID']; 
  $cartproduct = get_product($a);
  ?><td style="width:200px;"> <img src="images/<?php echo $cartproduct['productCode']; ?>_s.jpg"
                     alt="&nbsp;" width="50px" height="50px"></td><td style="width:450px;">
   <?php 
   echo $cartproduct['productName'];
   ?></td><td style="width:100px;">
   <?php 
   $discount=$cartproduct['discountPercent'];
 $price=$cartproduct['listPrice'];
  $discount_amount = round($price * ($discount/ 100), 2);
    $unit_price = $price - $discount_amount;
	$cost=$carteach['productNum']*$unit_price;
 echo '$'.$cost;
   ?></td>
 </tr><?php  
 endforeach;
 ?>
 </table>
 <hr>
 <div style="float:left;height:20px;font-size:20px;color:red;font-weight:bold;">
 Your Total Amount:
 </div>
 <div style="float:right;height:20px;margin-right:50px;font-size:20px;color:red;font-weight:bold;">
  <?php
  echo '$'.$_SESSION['totalamount'];
  ?>
 </div>
 </div>
 </div>
<div class="shipaddress">
<div class="brownbar" style="width:375px;" >
Update Shipping Address
</div>
<!--create addess_form-->
<div style="padding:3px;">
 <section>
        <form id="address_form" name="address_form" action="<?php echo  'updateaddress.php' ?>" method="post">
	        <label for="address_address1">Address Line 1:</label>
	        <input type="text" id="address_address1" name="line1">
	        <span id="address_address1_error">*</span><br><br>
	        
	        <label for="address_address2">Address Line 2:</label>
	        <input type="text" id="address_address2" name="line2">
	        <span id="address_address2_error">*</span><br><br>
	        
	        <label for="city">City:</label>
	        <input type="text" id="city" name="city">
	        <span id="city_error">*</span><br>
            
             <label for="state">State:</label>
	        <input type="text" id="state" name="state">
	        <span id="state_error">*</span><br>
            
             <label for="zipcode">Zip Code:</label>
	        <input type="text" id="zipcode" name="zip">
	        <span id="zipcode_error">*</span><br>
            
             <label for="phone">Phone Number:</label>
	        <input type="text" id="phone" name="phone">
	        <span id="phone_error">*</span><br><br>
            
            <label>&nbsp;</label>
	        <input type="button" id="update_address" value="Update Address"><br>
	        
	        <label>&nbsp;</label>
	        <input type="button" id="clear_entries" value="Clear Entries"  />
	    </form>
    </section>
</div>
</div>
<div style="float:left;height:350px;margin-top:150px;">
<img src="images/margin.jpg" alt="" height="352px" width="10px">
</div>
<!--create paymeny form-->
<div class="payment">
<div class="brownbar" style="width:350px;" >
Order and Payment Information
</div>
<div style="padding:3px;">
 <section>
        <form id="payment_form" name="payment_form" action="<?php echo  'inputorder.php' ?>" method="post">
        <span style="color:blue;font-size:20px;font-weight:bold;">Choose Shipping Date:</span>
        <br><br><label>&nbsp;</label><input type="text" id="datepicker" name="datepicker"><span id="datepicker_error">*</span>
        <br><br><br><br>
        
	       <label for="cardtype">Card Type:</label>
	        <input type="text"  id="cardtype" name="cardtype">
	        <span id="cardtype_error">*</span><br>
            
             <label for="cardnum">Card Number:</label>
	        <input type="text"  id="cardnum" name="cardnum">
	        <span id="cardnum_error">*</span><br>
	        
              <label>&nbsp;</label>
	        <input type="button" id="input_payment" value="Submit"  onclick="check()"><br>
            
	        <label>&nbsp;</label>
	        <input type="button" id="clear_entries2" value="Clear Entries"  />
	    </form>
    </section>
    
</div>
</div>
<div style="float:left;height:702px;margin-top:-200px;">
<img src="images/margin.jpg" alt="" height="702px" width="10px">
</div>
</div>


<?php 
include'footer.php' 
?>


</body>
</html>



