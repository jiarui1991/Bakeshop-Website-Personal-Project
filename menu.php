
<?php
require_once('util/main.php');
require_once('util/tags.php');

require_once('model/database.php');
require_once('model/product_db.php');
require_once('model/category_db.php');

//get the category row
$categories = get_categories();


 include'head.php' ;
 
 ?>
 <div class="middle">
<?php include 'sidebar.php'; ?>
<div  style="float:right;  width:450px; height:600px;">
<div class="dot">
</div>
<!-- set the right side for showing the menu-->
<h2>Retail Menu</h2>
<p>Cake types and flavors:<br>
<ul>
  <li>Black Forest Torte - chocolate cake, whipped cream, cherries and chocolate, cherry liquor</li> 
  <li>Strawberry-Peach Torte - gold cake, white chocolate mousse, strawberries and peaches</li>
  <li>Chocolate Torte - Chocolate or gold cake, chocolate mousse or white chocolate mousse</li>
  <li>Raspberry Chambord Torte - Chocolate or gold cake, raspberry chambord mousse 
</li>
   <li>Chocolate-Mocha Torte - Chocolate or gold cake, chocolate mocha mousse </li>
   <li>Lemon Raspberry - Gold cake, one layer lemon and one raspberry mousse 
Cheesecakes: $28.00
</li>
</ul>
</p>
<img src="images/chef.jpg" alt="" width="130px" height="250px" style="float:right" >
<p>Cake size and Price:<br>
<ul style="float:left">
  <li>8" serves up to 12 people $28.00 </li>
  <li>9" serves up to 15 people $32.00 </li>
  <li>10" serves up to 20 people $38.00 </li>
  <li>12" serves up to 40 people $55.00 </li>
  <li>14" serves up to 50 people $90.00 </li>
  <li>18" serves up to 100 people $170.00 </li>
 
  </ul>
 
</p>
</div>
</div>

<?php include'footer.php' ?>