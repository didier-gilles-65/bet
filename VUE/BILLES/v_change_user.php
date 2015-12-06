<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_change_user_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_user.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
<main style="margin-top:50px;">
<div class="container" align="center">
    <div>
		<div class="col-md-12"><?php echo '<h3>'.$lib_change_user_100.'</h3>'; ?></div>
    </div>
</div>

<!-- Texte haut de page -->
	<div class="container">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">

<!-- Affichage message d'erreur si err est setté -->
<?php
if (isset($_GET['err']))
{
?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $lib_register_err_100; ?></strong>
			</div>
<?php } ?>
			<form class="form-horizontal brown-style" method="post" id="update" name="update" action="set_change_user.php">
				<fieldset>
					<legend><?php echo $lib_change_user_110; ?></legend>
					<input type="text" class="hidden" name="hidden_login" id="hidden_login" value="<?php echo $current_user['LOGIN']; ?>">
					<div class="control-group">
						<label class="control-label" for="update_nom"><?php echo $lib_register_60; ?></label>
						<div class="controls">
							<input type="text" class="form-control" name="update_nom" id="update_nom" placeholder="<?php echo $lib_register_50; ?>" value="<?php echo $current_user['NOM']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="update_prenom"><?php echo $lib_register_80; ?></label>
						<div class="controls">
							<input type="text" class="form-control" name="update_prenom" id="update_prenom" placeholder="<?php echo $lib_register_70; ?>" value="<?php echo $current_user['PRENOM']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="update_email"><?php echo $lib_register_40; ?></label>
						<div class="controls">
							<input type="email" class="form-control" name="update_email" id="update_email" placeholder="<?php echo $lib_register_30; ?>" value="<?php echo $current_user['EMAIL']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="update_login"><?php echo $lib_register_100; ?></label>
						<div class="controls">
							<input type="text" class="form-control disabled" name="update_login" id="update_login" disabled placeholder="<?php echo $lib_register_90; ?>" value="<?php echo $current_user['LOGIN']; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="checkbox" for="update_gravatar"><?php echo $lib_register_145; ?>
							<input class="checkbox_inline" type="checkbox" id="update_gravatar" name="update_gravatar" value="true" <?php if ($current_user['GRAVATAR_FLAG'] == 1 ) echo 'checked="checked"'; ?>>
						</label>
					</div>
					<div class="form-actions" align="center">
						<br/>
						<button type="submit" class="btn btn-warning btn-md"><?php echo $lib_change_user_120; ?></button>
					</div>
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
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>

<script type="text/javascript">
$(function(){
//form validation rules
	$("#update").validate({
		rules: {
			update_nom: {
				required: true
			},
			update_prenom: {
				required: true
			},
			update_email: {
				email: true,
				required: true
			}
		},
		messages: {
			update_nom: "<?php echo $lib_register_err_10; ?>",
			update_prenom: "<?php echo $lib_register_err_20; ?>",
			update_email: "<?php echo $lib_register_err_30; ?>"
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
</body>
</html>
