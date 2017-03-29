$('document').ready(function()
{
     /* validation */
	 $("#login-form").validate({
      rules:
	  {
			HashPass: {
			required: true,
			},
			uEmail: {
      required: true,
      email: true
      },
	   },
       messages:
	   {
      HashPass:{
      required: "Please enter your password"
      },
      uEmail: "Please enter your email address",
      },
	   submitHandler: submitForm
       });
	   /* validation */

	   /* login submit */
	   function submitForm()
	   {
			var data = $("#login-form").serialize();

			$.ajax({

			type : 'POST',
			url  : 'PHP/login_process.php',
			data : data,
			beforeSend: function()
			{
				$("#error").fadeOut();
				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
			},
			success :  function(response)
			   {
					if(response=="ok"){

						$("#btn-login").html('<img src="btn-ajax-loader.gif" /> &nbsp; Signing In ...');
						setTimeout(' window.location.href = "/BlueOmen/index.html#SignedInProfile"; ',4000);
            $("#ProfileInfo").html(data);
					}
					else{

						$("#error").fadeIn(1000, function(){
				$("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+response+' !</div>');
											$("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
									});
					}
			  }
			});
				return false;
		}
	   /* login submit */
});
