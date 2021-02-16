
$(document).ready(function(){

	// $('input[type=checkbox],input[type=radio],input[type=file]').uniform();

	// $('select').select2();

	// Form Validation
    $("#userForm").validate({
		rules:{
			fullname:{
				required:true
			},
			email:{
				required:true,
				email: true
			},
			password:{
				required: true,
				minlength:5,
				maxlength:15
			},
		},
		messages:{
			fullname:{
				required:"Username is required"
			},
		  email:{
				required:"Email is required"
			},
			password:{
				required:"Password is required"

			},
		}
		,
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});


});
