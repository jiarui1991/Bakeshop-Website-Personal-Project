<?php

error_reporting(E_ALL ^ E_NOTICE);
require_once('/util/main.php');
require_once('/model/database.php');

//to delete product

$cartitem_id = $_POST['cartitemid'];

delete_cartitem($cartitem_id);
        
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

include'cart.php';





?>