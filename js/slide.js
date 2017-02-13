function slideSwitch() {
	//using js to set the pictures slide animation in main page.
    var $active = $('#slides DIV.active');

    if ( $active.length == 0 ) $active = $('#slides DIV:last');

    // use this to pull the divs in the order they appear in the markup
    var $next =  $active.next().length ? $active.next()
        : $('#slides DIV:first');

 
    $active.addClass('last-active');
//set the next slide attribute.
    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}


  $(document).ready(function() {
    setInterval( "slideSwitch()", 3500 );
	//slide text

  
}
);


 
  
 

 