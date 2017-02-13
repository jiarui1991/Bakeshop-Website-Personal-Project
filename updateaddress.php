<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
   	<script src="js/address_list.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>

  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">

  <script>
  //set the date picker display

  $(function() {

    $( "#datepicker2" ).datepicker({

      showButtonPanel: true

    });

  });
  
  // check the payment form input is valid or not
  function check2() {
		var isValid2 = true;
// validate the cardtype entry  
			if ($("#cardtype2").val() == "") {
				$("#cardtype_error2").text("Field required.");
				isValid2 = false;
			} 
			else {
				$("#cardtype_error2").text("");
			}
			
// validate the cardnum entry  
			if ($("#cardnum2").val() == "") {
				$("#cardnum_error2").text("Field required.");
				isValid2 = false;
			} 
			else {
				$("#cardnum_error2").text("");
			}
// validate the datepicker entry  
			if ($("#datepicker2").val() == "") {
				$("#datepicker_error2").text("Field required.");
				isValid2 = false;
			} 
			else {
				$("#datepicker_error2").text("");
			}
if (isValid2) {
                 $("#payment_form2").submit(); 
			}
             $("#cardtype2").focus();
		} // end function
  
</script>
    
<?php

session_start();

error_reporting(E_ALL ^ E_NOTICE);
require_once('util/main.php');

require_once('model/database.php');

//get the address information that the customer update
$customerid = $_SESSION['userId'];
$line1 = $_POST['line1'];
$line2 = $_POST['line2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipcode = $_POST['zip'];
$phone = $_POST['phone'];

//define the function to update the address table
function update_address($line1, $line2, $city, $state, $zipcode,$phone,$customerid) {
    global $db;
    $query = 'UPDATE addresses
              SET line1 = ?,
                  line2 = ?,
                  city = ?,
                  state = ?,
				  zipCode = ?,
				  phone = ?
              WHERE customerID = ?';
  //use try-throw-catch model to handle PDO exceptions
  try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $line1);
        $statement->bindValue(2, $line2);
        $statement->bindValue(3, $city);
        $statement->bindValue(4, $state);
        $statement->bindValue(5, $zipcode);
		$statement->bindValue(6, $phone);
		$statement->bindValue(7, $customerid);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

update_address($line1, $line2, $city, $state, $zipcode,$phone,$customerid);

?>




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
margin-left:10px;
/*border:solid #660000 2px;*/
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

<?php
include'head.php';
?>

<div class="middle">

<?php
include'order_history.php';
//get data from cartitem 
$orderitem=$_SESSION['orderitems'];
?>
<div style="float:left;height:703px;margin-top:10px;">
<img src="../images/margin.jpg" alt="" height="703px" width="10px">
</div>

<!--display the order product in table-->
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
  ?><td style="width:200px;"><img src="images/<?php echo $cartproduct['productCode']; ?>_s.jpg"
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
<!-- display the ship address information in table-->
<div class="shipaddress">
<div class="brownbar" style="width:375px;" >
Update Shipping Address
</div>
<div style="padding:3px;">
<span style="color:red;">Address Table has been updated. Please Fill Payment Form</span><hr>
 <section>
        <form id="address_form" name="address_form" action="<?php echo  'updateaddress.php' ?>" method="post">
	        <label for="address_address1">Address Line 1:</label>
	        <input type="text" id="address_address1" name="line1">
	        <span id="address_address1_error">*</span><br>
	        
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
	        <span id="phone_error">*</span><br>
            
            <label>&nbsp;</label>
	        <input type="button" id="update_address" value="Update Address"><br>
	        
	        <label>&nbsp;</label>
	        <input type="button" id="clear_entries" value="Clear Entries"  />
	    </form>
    </section>
</div>
</div>
<div style="float:left;height:350px;margin-top:150px;">
<img src="images/margin.jpg" alt="" height="352px" weight="10px">
</div>
<!-- display the payment information in form-->
<div class="payment">
<div class="brownbar" style="width:340px;" >
Order and Payment Information
</div>
<div style="padding:3px;">
 <section>
        <form id="payment_form2" name="payment_form" action="<?php echo  'inputorder.php' ?>" method="post">
        
        <span style="color:blue;font-size:20px;font-weight:bold;">Choose Shipping Date:</span>
        <br><br><label>&nbsp;</label><input type="text" id="datepicker2" name="datepicker"><span id="datepicker_error2">*</span>
        <br><br><br><br>
        
	       <label for="cardtype" >Card Type:</label>
	        <input type="text" id="cardtype2" name="cardtype">
	        <span id="cardtype_error2">*</span><br>
            
             <label for="cardnum">Card Number:</label>
	        <input type="text" id="cardnum2" name="cardnum">
	        <span id="cardnum_error2">*</span><br>
	        
              <label>&nbsp;</label>
	        <input type="button" id="input_payment2" value="Submit" onclick="check2()"><br>
            
	        <label>&nbsp;</label>
	        <input type="button" id="clear_entries3" value="Clear Entries"  />
	    </form>
    </section>
    
</div>



</div>

</div>

<?php 
include'footer.php' 
?>
