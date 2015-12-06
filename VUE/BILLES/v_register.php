<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<!--	<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" /> -->
	<title><?php echo $lib_register_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_register.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>

<main>

<!-- Texte haut de page -->
	<div class="container modal-dialog" style="width:400px; padding:10px">
<!-- Affichage message d'erreur si err est setté -->
<?php
if (isset($_GET['err']))
{
?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?php echo $lib_register_err_100; ?></strong>
		</div>
<?php
}
?>
		<div class="modal-content">
			<div class="bet-sub-nav blog-title" style="padding:10px; border-top-left-radius:6px; border-top-right-radius:6px">
				<h3 class="modal-font-title"><?php echo $lib_register_10;?></h3>
			</div>
			<form class="form-horizontal" method="post" id="register" name="register" action="set_compte.php">
				<fieldset>
					<div class="control-group" align="center">
						<label class="control-label" for="register_nom"><?php echo $lib_register_60; ?></label>
						<div class="controls">
							<input type="text" class="form-control" style="width:300px" name="register_nom" id="register_nom" placeholder="<?php echo $lib_register_50; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="control-label" for="register_prenom"><?php echo $lib_register_80; ?></label>
						<div class="controls">
							<input type="text" class="form-control" style="width:300px" name="register_prenom" id="register_prenom" placeholder="<?php echo $lib_register_70; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="control-label" for="register_email"><?php echo $lib_register_40; ?></label>
						<div class="controls">
							<input type="email" class="form-control" style="width:300px" name="register_email" id="register_email" placeholder="<?php echo $lib_register_30; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="control-label" for="register_login"><?php echo $lib_register_100; ?></label>
						<div class="controls">
							<input type="text" class="form-control" style="width:300px" name="register_login" id="register_login" placeholder="<?php echo $lib_register_90; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="control-label" for="register_password1"><?php echo $lib_register_120; ?></label>
						<div class="controls">
							<input type="password" class="form-control" style="width:300px" name="register_password1" id="register_password1" placeholder="<?php echo $lib_register_110; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="control-label" for="register_password2"><?php echo $lib_register_140; ?></label>
						<div class="controls">
							<input type="password" class="form-control" style="width:300px" name="register_password2" id="register_password2" placeholder="<?php echo $lib_register_130; ?>">
						</div>
					</div>
					</br>
					<div class="control-group" align="center">
						<label class="checkbox" style="width:300px" for="register_gravatar"><?php echo $lib_register_145; ?>
							<input class="checkbox_inline" type="checkbox" id="register_gravatar" name="register_gravatar" value="true">
						</label>
					</div>
					</br>
					<div class="form-actions" align="center">
						<br/>
						<button type="submit" class="btn btn-warning btn-md"><?php echo $lib_register_150; ?></button>
					</div>
					</br>
				</fieldset>
			</form>
		</div>
	</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>

	<script src="dist/js/jquery-1.11.1.min.js"></script>	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/bootstrap.min.js"></script>	<!-- Include all compiled plugins, or include individual files as needed -->
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

	<script type="text/javascript">
$(function(){
//form validation rules
	$("#register").validate({
		rules: {
			register_login: {
				required: true,
				maxlength: 40/*,
				remote: {
					url: 'verifie_login.php', <DESACTIVE>
					type: "post",
				}*/
			},
			register_nom: {
				required: true,
				maxlength: 40
			},
			register_prenom: {
				required: true,
				maxlength: 40
			},
			register_email: {
				email: true,
				required: true
			},
			register_password1: {
				required: true,
				minlength: 5
			},
			register_password2: {
				required: true,
				minlength: 5
			}
		},
		messages: {
			register_nom: {
				required: "<?php echo $lib_register_err_10; ?>",
				maxlength: "<?php echo $lib_register_err_11; ?>"
			},
			register_prenom: {
				required: "<?php echo $lib_register_err_20; ?>",
				maxlength: "<?php echo $lib_register_err_21; ?>"
			},
			register_email: "<?php echo $lib_register_err_30; ?>",
			register_login: {
				required: "<?php echo $lib_register_err_40; ?>",
				maxlength: "<?php echo $lib_register_err_07; ?>"
				remote: "<?php echo $lib_register_err_45; ?>"
			},
			register_password1: {
				required: "<?php echo $lib_register_err_50; ?>",
				minlength: "<?php echo $lib_register_err_51; ?>"
			},
			register_password2: {
				required: "<?php echo $lib_register_err_60; ?>",
				minlength: "<?php echo $lib_register_err_61; ?>"
			}
		},
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
		},
		success: function(element) {
			$(element).closest('.control-group').removeClass('has-error').addClass('has-success');
		},
		errorClass: 'help-block',
		submitHandler: function(form) {
			form.submit();
		}
	});
});
</script>
<script>
</script>

</body>

</html>
