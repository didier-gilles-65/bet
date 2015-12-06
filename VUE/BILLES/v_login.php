<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_login_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/docs.min.css"> <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->

</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_login.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
<!-- Texte haut de page -->
	<main>
		<div class="container" style="width:400px; padding:10px">
<!-- Affichage message d'erreur si err est setté -->
<?php
if (isset($_GET['register']))
{
?>
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $lib_login_err_10; ?></strong>
			</div>
<?php
}
?>
<?php
if (isset($_GET['err']))
{
?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php if ($_GET['err']==100) { echo $lib_login_err_100; } else { echo $lib_login_err_101; } ?></strong>
			</div>
<?php
}
?>
			<div class="modal-content">
				<div class="bet-sub-nav blog-title" style="padding:10px; border-top-left-radius:6px; border-top-right-radius:6px">
					<h3 class="modal-font-title"><?php echo $lib_login_90;?></h3>
				</div>
				<br/>
				<form id="login_form" name="login_form" method="post" action="/UTILS/autorisation.php?page=<?php echo $cible; ?>">
					<fieldset>
						<div class="control-group" align="center">
							<label class="control-label" for="connect_login"><?php echo $lib_login_30; ?></label>
							<div class="controls">
								<input type="text" style="width:200px" class="form-control" name="connect_login" id="connect_login" placeholder="<?php echo $lib_login_40; ?>">
								<label for="connect_login" class="help-block"></label>
							</div>
						</div>
						<br/>
						<div class="control-group" align="center">
							<label class="control-label" for="connect_password"><?php echo $lib_login_60; ?></label>
							<div class="controls">
								<input type="password" style="width:200px" class="form-control" name="connect_password" id="connect_password" placeholder="<?php echo $lib_login_70; ?>">
								<label for="connect_password" class="help-block"></label>
							</div>
						</div>
						<br/>
						<div class="control-group" align="center">
							<label class="checkbox"  style="width:200px" for="login_persistent"><?php echo $lib_login_85; ?>
								<input class="checkbox_inline" type="checkbox" id="login_persistent" name="login_persistent" value="true">
							</label>
						</div>
						<br/>
						<div class="control-group" align="center" >
							<button class="btn btn-warning " type="submit"><?php echo $lib_login_90; ?></button>
						</div>
						<br/>
						<div class="control-group" align="center">
							<label class="control-label" style="font-size:100%;"><a href="reset_password.php"><?php echo $lib_login_100; ?></a></label>
						<div class="control-group" align="center">
							<label class="control-label" style="font-size:100%;"><a href="register.php"><?php echo $lib_nav_270; ?></a></label>
						</div>
						<br/>
					</fieldset>
				</form>
			</div><!-- /.modal-content -->
		</div>
	</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/jquery-1.11.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.validate.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>

<script>
(function($,W,D,undefined)
{
	$(D).ready(function()
	{
//form validation rules
		$("#login_form").validate({
			rules:
			{
				connect_login: 
				{
					required: true
				},
				connect_password:
				{
					required: true
				}
			},
			messages:
			{
				connect_login: {
					required: "<?php echo $lib_register_err_40; ?>"
				},
				connect_password: {
					required: "<?php echo $lib_register_err_50; ?>"
				},
			},
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.control-group').removeClass('has-error').addClass('has-success');
				$(element).next('.help-block').hide();
			},
			errorClass: 'help-block',
			submitHandler: function(form)
			{
				form.submit();
			}
		});
	});
})(jQuery, window, document);
</script>

</body>
</html>
