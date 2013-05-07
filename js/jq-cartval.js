/*
	jq-cartval.js
*/

/*This is the validation.js file re-written in jQuery*/

/*When document is ready do this*/
$(document).ready(function(){
	/*Set focus to the name field on page load*/
	$('#quantity').focus();
	
	/*Define variables and assign IDs to them for easier readability*/
	var form = $('#productAdd');
	var quantity = $('#quantity');

	
	/*More IDs for messages*/
	var quantityMsg = $('#quantityMsg');
	
	/*Flags to determine if a field is invalid*/
	var quantityFlag = false;

	/*This will run validation when field loses focus*/
	quantity.change(validateQuantity);
	
	/*When user submits the form run validation on all fields*/
	form.submit(function(){
		if(validateQuantity())
		{
			return true;
		}
		else
		{
			if(quantityFlag){quantity.focus().select();}
			return false;
		}
	});


/*Validation functions for each field*/	
	function validateQuantity(){
		/*Invalid field if name is > 30 characters*/
		if (parseInt(quantity.val()) > 100)
		{
			quantity.removeClass("valid");
			quantity.addClass("error");
			quantityMsg.removeClass("valid");
			quantityMsg.addClass("error");
			quantityMsg.text("Order limit 100!");
			quantityFlag = true;
			return false;
		}
		/*Invalid field if left blank*/
		else if (parseInt(quantity.val()) < 1 || quantity.val().length < 1)
		{
			quantity.removeClass("valid");
			quantity.addClass("error");
			quantityMsg.removeClass("valid");
			quantityMsg.addClass("error");
			quantityMsg.text("Can't order nothing!");
			quantityFlag = true;
			return false;
		}
		else
		{
			quantity.removeClass("error");
			quantity.addClass("valid");
			quantityMsg.removeClass("error");
			quantityMsg.addClass("valid");
			quantityMsg.text("Okay!");
			quantityFlag = false;
			return true;
		}
	}
	
});

