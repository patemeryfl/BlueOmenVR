// JavaScript Document

$('document').ready(function()
{
     /* validation */
	 $("#register-form").validate({
      rules:
	  {
  			uFName: {
  		  required: true,
  			minlength: 1
  			},
        uLName: {
        required: true,
        minlength: 1
        },
  			HashPass: {
  			required: true,
  			minlength: 8,
  			maxlength: 15
  			},
  			cpassword: {
  			required: true,
  			equalTo: '#HashPass'
  			},
  			uEmail: {
        required: true,
        email: true
        },
	   },
       messages:
	   {
            uFName: "Please enter a first name",
            uLName: "Please enter a last name",
            HashPass:{
            required: "Please provide a password",
            minlength: "Password at least have 8 characters"
            },
            uEmail: "Please enter a valid email address",
			      cpassword:{
						required: "Please retype your password",
						equalTo: "Password does not match you idiot!"
					  }
       },
	   submitHandler: submitForm
       });
	   /* validation */

	   /* form submit */
	   function submitForm()
	   {
				var data = $("#register-form").serialize();

				$.ajax({

				type : 'POST',
				url  : 'PHP/register.php',
				data : data,
				beforeSend: function()
				{
					$("#error").fadeOut();
					$("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
				},
				success :  function(data)
						   {
								if(data==1){

									$("#error").fadeIn(1000, function(){


											$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Sorry email already taken !</div>');

											$("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

									});

								}
								else if(data=="registered")
								{

									$("#btn-submit").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing Up ...');
									setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("PHP/success.php"); }); ',5000);

								}
								else{

									$("#error").fadeIn(1000, function(){

						$("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');

									$("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account');

									});

								}
						   }
				});
				return false;
		}
	   /* form submit */




});
