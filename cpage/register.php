<?php
session_start();

//to connect to the database 
$resource = mysql_connect("127.0.0.1", "bakeuser", "bake") or die("Unable to connect" . mysql_error());

mysql_select_db("Bakeshop", $resource) or die("Unable to connect to patient database");

error_reporting(E_ALL ^ E_NOTICE);
require_once('../util/main.php');
require_once('../util/tags.php');
require_once('../model/database.php');

// get the username and password

$name = $_POST['user'];
$ps=$_POST['password'];
//encrypte the password
$ps=md5($ps);
//insert to Customer table new row
//add cart table row
function add_customer($id,$customername, $password) {
    global $db;
	
	
    $query = "INSERT INTO customers
                 (customerID,emailAddress, password)
              VALUES
                 (?,?, ?)";
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $id);
        $statement->bindValue(2, $customername);
		$statement->bindValue(3, $password);
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
//add addressid for new customer
function add_customer_add($customername){
global $db;
 $query = "Update customers
                set shipAddressID=customerID
               where emailAddress=?
			   ";
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $customername);
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

//add new username and password to the database.
add_customer('',$name,$ps);
add_customer_add($name);


$users = mysql_query("select count(1) numuser, customerID from customers where emailAddress = '$name' and password = '$ps'", $resource);

$row = mysql_fetch_assoc($users);  


if ( $row['numuser'] == 1 ) {
	
	$_SESSION['userId'] = $row['customerID'];
	
    $_SESSION['msg'] = "Welcome to Cherry's Bakery !";
	
} else {
    $_SESSION['msg'] = "Login Failed";
}
 
 
 //create new address records
function add_address($userid){
	 global $db;
    $query = "INSERT INTO addresses
                 (customerID,addressID)
              VALUES
                 (?,?)";
 //use try-throw-catch model to handle PDO exceptions
   try {
        $statement = $db->prepare($query);
        $statement->bindValue(1, $userid);
        $statement->bindValue(2, $userid);
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
$userid=$_SESSION['userId'];
add_address($userid);

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

















