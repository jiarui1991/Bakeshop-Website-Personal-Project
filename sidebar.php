<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  //set the jquery menu bar
  $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
  </script>
  <style>
  /* set the left menu bar css*/
  .ui-tabs-vertical { width: 36em;  }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; }
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: left; width: 20em;}
  </style>
  
  
  <div id="tabs" style="float:left;height:580px; ">
  <ul>
     <h2>Categories</h2>
     <!-- display links for all categories -->
        <!--<li><a href="#yourcakes">Your Cakes</a></li>-->
        <?php foreach ($categories as $category) : ?>
        <li>
            <a href="<?php echo 
                'cindex.php?action=list_products' .
                '&amp;category_id=' . $category['categoryID']; ?>">
                <?php echo $category['categoryName']; ?>
            </a>
        </li>
             <?php endforeach; ?>
   
  </ul>
  
</div>



       
        
        
       
 
