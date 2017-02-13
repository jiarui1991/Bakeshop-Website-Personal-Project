$(document).ready(function() {
	//to check the content in form is filled or not.
	$("#update_address").click(
	function() {
			var Address1 = $("#address_address1").val();
			var Address2 = $("#address_address2").val();
			var isValid = true;
			
			// validate the firt address
			if (Address1 == "") { 
				$("#address_address1_error").text("Field required.");
				isValid = false;
			} else {
				$("#address_address1_error").text("");
			} 
			
			// validate the second address
			if (Address2 == "") { 
				$("#address_address2_error").text("Field required.");
				isValid = false; 
			} else {
				$("#address_address2_error").text("");
			}
			
			// validate the city name entry  
			if ($("#city").val() == "") {
				$("#city_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#city_error").text("");
			}
			
// validate the state name entry  
			if ($("#state").val() == "") {
				$("#state_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#state_error").text("");
			}

// validate the zipcode entry  
			if ($("#zipcode").val() == "") {
				$("#zipcode_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#zipcode_error").text("");
			}

// validate the phone entry  
			if ($("#phone").val() == "") {
				$("#phone_error").text("Field required.");
				isValid = false;
			} 
			else {
				$("#phone_error").text("");
			}

			// submit the form if all entries are valid
			if (isValid) {
				$("#address_form").submit();
                           
			}
             $("#address_address1").focus();
		} // end function
	);	// end click


// check the validation of payment form
$("#input_payment").click(
	function() {
		var isValid2 = true;
// validate the cardtype entry  
			if ($("#cardtype").val() == "") {
				$("#cardtype_error").text("Field required.");
				isValid2 = false;
			} 
			else {
				$("#cardtype_error").text("");
			}
			
// validate the cardnum entry  
			if ($("#cardnum").val() == "") {
				$("#cardnum_error").text("Field required.");
				isValid2 = false;
			} 
			else {
				$("#cardnum_error").text("");
			}
if (isValid2) {
                 $("#payment_form").submit(); 
			}
             $("#cardtype").focus();
		} // end function
	);	// end click





//add clear funtion for address form
$("#clear_entries").click(
function() {
       $("#state").val("");
       $("#address_address1").val("");
       $("#address_address2").val("");
       $("#zipcode").val("");
       $("#city").val("");
       $("#phone").val("");
       $(":text").next().text("*");
       $("#address_address1").focus();

} //end function
); //end click
   
//add clear funtion for payment form
$("#clear_entries2").click(
function() {
       $("#cardtype").val("");
       $("#cardnum").val("");
       $("#datepicker").val("");
       
       $(":text").next().text("*");
       $("#cardtype").focus();

} //end function
); //end click
 
 //add clear funtion
$("#clear_entries3").click(
function() {
       $("#cardtype2").val("");
       $("#cardnum2").val("");
       $("#datepicker2").val("");
       
       $(":text").next().text("*");
       $("#cardtype2").focus();

} //end function
); //end click
			

       $(":text").dblclick(function() {
         $(this).val("");
});       

	$("#address_address1").focus();
}); // end ready  
 


