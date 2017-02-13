$(document).ready(function() {
    
    // runs when the page is ready, and add JQuery easings to its animation.
	//set the title animation by jquery
 //$("#title ").addClass("yellow");
    $("#title ").animate( {fontSize:"400%",letterSpacing:"+=15px", width:"+=300px",left:"-=400"}, 1000,"easeInOutQuint" )  
                       
		         .animate( { fontSize: "55px", width:"+=100px",letterSpacing:"-=15px",left:"+=400" }, 1000,"easeOutQuint" );
    // $("#title ").removeClass("yellow");
		   
	
    
}); // end ready
