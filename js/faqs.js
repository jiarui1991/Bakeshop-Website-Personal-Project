
$(document).ready(function() {
	
	// runs when an h2 heading in faqs is clicked
	$("#faqs h2").toggle(
		function() {

			$(this).toggleClass("minus");
                   //Slidedown animation for headings
                   $(this).next().slideDown(1000,"easeOutBounce");

                   //  $(this).next().fadeIn(3000);//Fadein animation
                     
		 //   $(this).next().show(2000);
	    },
	    function() {
	        $(this).toggleClass("minus");
               //Slidedown animation for headings
               $(this).next().slideUp(1000,"easeOutBounce");

               // $(this).next().fadeOut(1000);//fadeout animation
                
	        //$(this).next().hide(2000);
	    }
    ); // end toggle
    
    // runs when the page is ready, and add JQuery easings to its animation

    $("#faqs h1").animate( { fontSize: "650%", opacity: 1, left: "+=375" }, 1000,"easeInSine" )  
		         .animate( { fontSize: "175%", left: "-=200" }, 1000,"easeOutSine" );
		    
	// runs when the top-level heading is clicked
	$("#faqs h1").click(function() {
		$(this).animate( { fontSize: "650%", opacity: 1, left: "+=375" }, 2000,"easeInExpo" )  
           //Fix the animation, set the left property to zero pixels.
			   .animate( { fontSize: "175%", left: "0" }, 1000,"easeOutExpo" );
	}); // end click
    
}); // end ready
