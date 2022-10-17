/*-------------------------------------------------------+
| Login PHP MYSQL
| https://github.com/elyonox/login-php-mysql
+--------------------------------------------------------+
| Author: Ionut Manole (Yonox)
| Email: yonutyonox@gmail.com
| Author URL: https://github.com/elyonox
+--------------------------------------------------------+*/
(function ($) {
	'use strict'
	
	$("#lpmLoginForm").on("submit",function(event)
	{
		event.preventDefault();
		
		var lpmLoginForm = $(this);
		
		if ( !lpmLoginForm.get(0).checkValidity() )
		{
			event.stopPropagation();
		} else {
			var lpmUserField = $("input#lpmuser").val();
			var lpmPassField = $("input#lpmpassword").val();
			
			$("#lpmCardLoginBody").addClass("d-none");
			$("#lpmLoginSpinner").removeClass("d-none");
			$("#textLoginStatus").html("Login in progress. Please wait...");
			
			setTimeout(function()
			{
				$.ajax({
					method:		"POST",
					url:		$("input#lpmAjaxUri").val(),
					cache:		false,
					dataType:	"json",
					data:		{ lpmaction: "lpmLogIn", lpmuser: lpmUserField, lpmpass: lpmPassField }
				})
				.done(function( msg ) {
					if ( msg.userLoggedIn )
					{
						$("#textLoginStatus").addClass("text-success");
						$("#textLoginStatus").html("Correct Login. Redirect...");
						setTimeout(function()
						{
							var siteRedirect = $("input#lpmsiteUri").val();
							window.location.replace(siteRedirect);
						}, 1000);
					} else {
						$("#textLoginStatus").html("Incorrect user or password!");
						$("#alertLoginStatus").removeClass("d-none");
						setTimeout(function()
						{
							$("#lpmCardLoginBody").removeClass("d-none");
							$("#lpmLoginSpinner").addClass("d-none");
							$("input#lpmuser").focus();
						}, 1000);
					}
				});
			}, 1000);
		}
		lpmLoginForm.addClass('was-validated');
	});
	
	
	$("#instLpmForm").on("submit",function(event)
	{
		event.preventDefault();
		
		var lpmInstallForm = $(this);
		
		if ( !lpmInstallForm.get(0).checkValidity() )
		{
			event.stopPropagation();
		} else {
			
			lpmInstallForm.addClass("d-none");
			$("#instLpmSpinner").removeClass("d-none");
			
			$.ajax({
				method:		"POST",
				url:		$("#ajaxUri").val(),
				cache:		false,
				data:		{
					action: "createConfig",
					dbhostname: $("#dbhostname").val(),
					dbusername: $("#dbusername").val(),
					dbpassword: $("#dbpassword").val(),
					dbname: $("#dbname").val()
				}
			});
			
			setTimeout(function()
			{
				$.ajax({
					method:		"POST",
					url:		$("#ajaxUri").val(),
					cache:		false,
					data:		{
						action: "dbExampleInstall"
					}
				})
				.done(function( msg )
				{
					window.location.replace("../");
				});
			}, 1000);
			
		}
		
		lpmInstallForm.addClass('was-validated');
	});

})(jQuery)