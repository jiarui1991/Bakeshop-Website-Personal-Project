<?php require_once('util/main.php');
require_once('util/tags.php');

require_once('model/database.php');
require_once('model/product_db.php');
require_once('model/category_db.php');?>
  <!-- jQuery library (served from Google) --> 
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> 
  <!-- bxSlider Javascript file --> 
  <script src="js/jquery.bxslider.min.js"></script>
   <!-- bxSlider CSS file -->
    <link href="jquery.bxslider.css" rel="stylesheet" />
 
 <!-- list the product in each category-->
       <?php if (count($products) == 0) : ?>
        <p>There are no products in this category.</p>
    <?php else: ?>
      
      
    <div id="carousel" style="margin-top:-10px; ">
        
            <ul class="bxslider">
             <?php foreach ($products as $product) :   
		// Get product data
        $list_price = $product['listPrice'];
        $discount_percent = $product['discountPercent'];
        $description = $product['description'];
        
        // Calculate unit price
        $discount_amount = round($list_price * ($discount_percent / 100.0), 2);
        $unit_price = $list_price - $discount_amount;
		
		 // Get first paragraph of description
        $description = add_tags($description);
        $i = strpos($description, "</p>");
        $description = substr($description, 3, $i-3);?><li>
                 <a href="cindex.php?action=view_product&amp;product_id=<?php
                      echo $product['productID']; ?>">
                <b style="color:blue;"><?php echo $product['productName']; ?></b>
             <img src="images/<?php echo $product['productCode']; ?>_s.jpg"
                     alt="&nbsp;" style="width:350px;height:300px;"></a> 
                  <b>Your price:</b>
                    $<?php echo number_format($unit_price, 2); ?>
                    <p><b>Description:</b><br>
                      <?php echo $description; ?></p></li>
            <?php endforeach; ?>
            </ul>   
    </div>
     <?php endif; ?>
 
 

<script>
$(document).ready(function(){ $('.bxslider').bxSlider();});
</script>