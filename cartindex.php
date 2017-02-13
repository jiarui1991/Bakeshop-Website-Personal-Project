<style type="text/css">
/* set cart bar css*/
#cart{
	margin-top:10px;
	margin-left:10px;
	margin-right:10px;
}

#cartbar{
background-color:#660000;
height:22px;
font-size:18px;
color:white;
padding:15px;
margin-top:-5px;
}

.cartbarr{
float:right;
width:130px;
font-size:22px;
font-weight:300;
}
.cartbarrr{
float:right;
width:120px;
font-size:22px;
font-weight:300;
}

.cartbarl{
float:left;
width:400px;
font-size:22px;
font-weight:300;
}
.cartbarll{
float:left;
width:400px;
font-size:18px;
font-weight:300;
}
.cartp{
	height:100px;
	padding:10px;
	border:solid #660000 2px;
	width:1043px;
	margin-top: 8px;
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

include'head.php';

//retrieve prodcut and user id
  $product_id = $_POST['product_id']; 
 $user_id=$_SESSION['userId'];
  $product_num=$_POST['quantity'];
 $cartrowid=add_cartrow('',$user_id,$product_id, $product_num);

//add cart table row
function add_cartrow($cartitem, $customerid, $productid,$productnum) {
    global $db;
    $query = "INSERT INTO cartproduct
                 (cartitemID, customerID, productID, productNum)
              VALUES
                 (?, ?, ?, ?)";
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $catetrow_id);
        $statement->bindValue(2, $customerid);
        $statement->bindValue(3, $productid);
		$statement->bindValue(4, $productnum);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $cartrow_id = $db->lastInsertId();
        return $cartrow_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}


?>

<div class="middle">

<!--shopping carts html-->
<div id="cart">
<h2>Shopping Carts</h2>

<div id="cartbar">
<div class="cartbarl">
Products Name
</div>

<div class="cartbarr">
Remove
</div>
<div class="cartbarr">
Subtotal
</div>
<div class="cartbarr">
Quantity
</div>
<div class="cartbarr">
Your Price</div>
</div>


<?php  
//get the cart product id from the customer cart.
function get_cart_productid($customer_id) {
    global $db;
    $query =   'SELECT *
			                      FROM  cartproduct
								  WHERE customerID =?
								   ORDER BY productID';
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
 //calculate total amount of products.
 $_SESSION['totalamount'] = 0;

$rs=get_cart_productid($user_id);
foreach ($rs as $seleproduct) :

 $cartproductid = $seleproduct['productID']; 
  $cartproduct = get_product($cartproductid);
?>
<div class="cartp">
<div class="cartbarll">
 <b><?php
 echo $cartproduct['productName'];
?></b><br>
 <img src="images/<?php echo $cartproduct['productCode']; ?>_s.jpg"
                     alt="&nbsp;" width="80px" height="80px">
 </div>
 
 <div class="cartbarrr">
 <form action="<?php echo 'cartdelete.php'?>" method="post">
 <input type="hidden" name="cartitemid"
               value="<?php echo $seleproduct['cartitemID']; ?>" />
 
 <input type="image" value="submit" src="images/delete.jpg" style="width:40px;height:40px;" alt="submit Button" />
    </form>
    </div>
 <div class="cartbarrr">
 <?php
//get the information of product in cart
 $discount=$cartproduct['discountPercent'];
 $price=$cartproduct['listPrice'];
  $discount_amount = round($price * ($discount/ 100), 2);
    $unit_price = $price - $discount_amount;
	$cost=$seleproduct['productNum']*$unit_price;
 echo '$'.$cost;
 $_SESSION['totalamount'] = $_SESSION['totalamount']+$cost;

 ?>
 </div>
 <div class="cartbarrr">
 <?php
 
 echo $seleproduct['productNum'];
 ?>
 </div>
  <div class="cartbarrr">
 <?php
 echo '$'.$unit_price;
 ?>
 </div>
 </div>
<?php 
endforeach;
?>
</div>
<div style="float:left;margin-top:20px;margin-left:20px;">
<a href="menu.php"><img src="images/conshop.gif" alt="continue shopping" width="180px" height="50px"></a>
</div>
<div style="float:right;margin-top:20px;margin-right:20px;">
<?php
$rss=get_cart_productid($user_id);
$_SESSION['orderitems'] = $rss;
?>
<a href="addorder.php"><img src="images/checkout.gif" alt="checkout" width="160px" height="40px"></a>
</div>


</div>
<?php include'footer.php' ?>

