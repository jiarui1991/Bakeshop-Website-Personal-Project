<style>
<!-- Codes by HTML.am -->
<!-- Start Styles. Move the 'style' tags and everything between them to between the 'head' tags -->
<style type="text/css">
.myOtherTable { background-color:#FFFFE0;border-collapse:collapse;color:#000;font-size:18px; }
.myOtherTable th { background-color:#BDB76B;color:#660000; }
.myOtherTable td, .myOtherTable th { padding:5px;border:0; }
.myOtherTable td { border-bottom:1px dotted #660000;color:#660000; }
</style>
<!-- End Styles -->


<?php

//session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('util/main.php');
require_once('util/tags.php');
require_once('model/database.php');
require_once('model/product_db.php');
require_once('model/category_db.php');

$user_id=$_SESSION['userId'];


//retrieve past order information for one customer
function get_order($customer_id) {
    global $db;
    $query = 'SELECT *
              FROM orders
              WHERE customerID = ?  ORDER BY orderID';
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

//retrieve items in an order in orderitems table
function get_orderitems($order_id) {
    global $db;
    $query = 'SELECT *
              FROM orderitems
              WHERE orderID = ? ORDER BY itemID';
  //use try-throw-catch model to handle PDO exceptions
  try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $order_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


?>

<!--out put the order history html-->
<div class="left" style="float:left;width:300px;height:700px;margin-top:10px;background-image:url('images/historyview.jpg');background-repeat:no-repeat; margin-left:10px;border:solid #660000 2px;">
<div class="brownbar">
Order History
</div>
<br>
<table class="myOtherTable" style="width:300px;">
  <tr>
    <th>Order Number</th>
    <th>Order Items</th>
    <th>Order Date</th>
<?php

//get the order information.
$orders=get_order($user_id);

foreach ($orders as $ordereach){
?><tr><td><?php	
echo $ordersid = $ordereach['orderID']; ?>
</td><?php
$orderitems=get_orderitems($ordersid);
?><td><?php
    foreach ($orderitems as $orderitemeach){
       $orderproducts = $orderitemeach['productID'];
	   $orderproduct = get_product($orderproducts);
	   echo $outputop = $orderproduct['productName'];
	}
?></td><td><?php 
  echo $ordersdate = $ordereach['orderDate'];
 ?></td></tr><?php
}
?>
</table>

</div>



