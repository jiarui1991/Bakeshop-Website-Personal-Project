

<?php
session_start();

error_reporting(E_ALL ^ E_NOTICE);
require_once('util/main.php');

require_once('model/database.php');

$customerid = $_SESSION['userId'];
$cost=$_SESSION['totalamount'];
$cardtype = $_POST['cardtype'];
$cardnum = $_POST['cardnum'];
$datepicker = $_POST['datepicker'];


//ship address id equals customer is.
//create order id
function add_order($customerid,$cardtype,$cardnum,$datepicker,$cost) {
    global $db;
    $query = 'INSERT INTO orders
                 (customerID,cardType,cardNumber,shipAddressId,shipDate,productAmount,orderDate)
              VALUES
                 (?, ?,?,?,?,?,NOW())';
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $customerid);
		$statement->bindValue(2,$cardtype);
		$statement->bindValue(3,$cardnum);
		$statement->bindValue(4,$customerid);
		$statement->bindValue(5,$datepicker);
		$statement->bindValue(6,$cost);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $orderl_id = $db->lastInsertId();
        return $orderl_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

//add order information to order table
$user_id = $_SESSION['userId'];
$_SESSION['order_id'] = add_order($user_id,$cardtype,$cardnum,$datepicker,$cost);
$order_id = $_SESSION['order_id'];

//get data from cartitem 
$orderitem=$_SESSION['orderitems'];
   if (empty($orderitem)) {
           echo 'Empty Cart, Fill it';
        }

//create function to insert the new order item data 
function add_orderitem($orderid, $productid) {
    global $db;
    $query = 'INSERT INTO orderitems
                 (orderID, productID)
              VALUES
                 (?, ?)';
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $orderid);
        $statement->bindValue(2, $productid);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $orderitem_id = $db->lastInsertId();
        return $orderitem_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

//call function to delete items from cart table
function delete_cartitem($cartitemid){
    global $db;
    $query = 'DELETE FROM cartproduct WHERE cartitemID = ?';
  //use try-throw-catch model to handle PDO exceptions
  try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $cartitemid);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

?>


 <?php  
  //insert new order item data
 foreach ($orderitem as $carteach) :
 $a=$carteach['productID'];
 $b = $carteach['cartitemID'];
 add_orderitem($order_id,$a);
 delete_cartitem($b);
 
  endforeach;
?>

<?php
include 'order.php';
?>
