/*
js contenant le code commun à toutes les pages pour la validation du formulaire de login
*/
		$(function(){
			$("#menu_login_form").validate({
				rules:	{connect_login:{required: true},
						connect_password:{required: true}},
				messages:{connect_login:{required: "<?php echo $lib_register_err_40; ?>"},
						connect_password:{required: "<?php echo $lib_register_err_50; ?>"}},
				highlight: function(element) {$(element).closest('.control-group').removeClass('has-success').addClass('has-error');},
				success: function(element) {$(element).closest('.control-group').removeClass('has-error').addClass('has-success');},
				errorClass: 'help-block',
				submitHandler: function(form) {	form.submit(); }
			});
		});
