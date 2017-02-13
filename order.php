
<style type="text/css">
/*for order tables' css format*/
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

margin-top:10px; 
}

#addressshow{
width:750px;
height:360px;
background-image:url('images/addressbg1.jpg');	
background-repeat:no-repeat;
margin-top:1px;
color:#660000;
font-size:20px;
font-weight:bold;
}

#detail td{
	border-bottom:1px dotted #660000;
	height:30px;
}
</style>
<?php

session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('util/main.php');
require_once('util/tags.php');
require_once('model/database.php');
require_once('model/product_db.php');
require_once('model/category_db.php');

//get the user id
$user_id=$_SESSION['userId'];

//get the address information for the sepecific customer
function get_address($customer_id) {
    global $db;
    $query =   'SELECT *
			                      FROM  addresses
								  WHERE customerID =?
								   ORDER BY addressID';
  //use try-throw-catch model to handle PDO exceptions
  try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $customer_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
//get the order information for the sepecific customer
function get_orderinfor($customer_id) {
    global $db;
    $query =   'SELECT *
			                      FROM  orders
								  WHERE customerID =?
								   ORDER BY  orderID';
  //use try-throw-catch model to handle PDO exceptions
  try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $customer_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

//get the order information and show out by user id
$rso=get_orderinfor($user_id);
//get the customer's address information
$rs=get_address($user_id);

include'head.php';



?>

<div class="middle">

<?php
include'order_history.php';
?>
<!--for set the tables' lay out-->
<div style="float:left;height:703px;margin-top:10px;">
<img src="images/margin.jpg" alt="" height="703px" width="10px">
</div>
<div class="orderitems" style="height:300px;">
<div class="brownbar">
Order Details
</div>
<div style="background-image:url('images/orderdetail.jpg');height:300px;">

<table style="width:750px;color:#660000;font-size:18px;text-align:center;" id="detail">
<tr style="background-color:#FFFF99;height:20px;font-size:19px;">
<th>OrderID</th>
<th>Total Cost</th>
<th>Estimated Ship Date</th>
</tr>
<?php
//get the detail information in order table
foreach ($rso as $personalorder) :

 $orderid = $personalorder['orderID']; 
 $totalcost = $personalorder['productAmount'];
 $shipdate = $personalorder['shipDate']; 
?>
<tr>
<td>
<?php
echo $orderid;
?>
</td>
<td><?php echo '$'.$totalcost;?>
</td><td>
<?php echo $shipdate;?>
</td>
</tr>
<?php
endforeach;
?>
</table>

</div>
</div>

<div class="orderitems" style="margin-top:5px;height:400px;">
<div class="brownbar">
View Your Shipping Address
</div>
<?php
//get the addresss
foreach ($rs as $personaladdress) :

 $line1 = $personaladdress['line1']; 
 $line2 = $personaladdress['line2'];
 $city = $personaladdress['city']; 
 $state = $personaladdress['state']; 
 $zipcode = $personaladdress['zipCode']; 
 $phone = $personaladdress['phone'];

?>
<!-- show address information-->
<div id="addressshow">
<span style="color:yellow;font-size:24px;font-weight:bold;">Your order will be delivered to .........</span>
<div style="height:30px;width:750px;margin-top:20px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;Address Line1: </div><div style="width:400px;float:left;height:30px;"><?php
echo $line1;
?></div></div>
<div style="height:40px;width:750px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;Address Line2: </div><div style="width:400px;float:left;height:30px;"><?php
echo $line2;
?></div></div>
<div style="height:40px;width:750px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;City: </div><div style="width:400px;float:left;height:30px;"><?php
echo $city;
?></div></div>
<div style="height:40px;width:750px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;State: </div><div style="width:400px;float:left;height:30px;"><?php
echo $state;
?></div></div>
<div style="height:40px;width:750px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;Zip  Code: </div><div style="width:400px;float:left;height:30px;"><?php
echo $zipcode;
?></div></div>
<div style="height:40px;width:750px;"><div style="width:200px;height:30px;float:left;text-align:left;">&nbsp;&nbsp;Phone Number: </div><div style="width:400px;float:left;height:30px;"><?php
echo $phone;
?></div></div>
</div>
<?php
endforeach;
?>
</div>
<div style="float:left;height:703px;margin-top:-300px;">
<img src="images/margin.jpg" alt="" height="703px" width="10px">
</div>



</div>
<?php 
include'footer.php' 
?>


