<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_reset_password_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_resetmotdepasse.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>

<!-- Texte haut de page -->
<main style="margin-top:50px;">
<div class="container" align="center">
    <div>
		<div class="col-md-12"><?php echo '<h3>'.$lib_reset_password_10.'</h3>'; ?></div>
    </div>
</div>



<div class="container">
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
<!-- Affichage message d'erreur si err est setté -->
<?php
if (isset($_GET['reset']))
{
?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?php echo $lib_reset_password_err_0; ?></strong>
		</div>
<?php
}
?>
<?php
if (isset($_GET['err']))
{
    switch($_GET['err']){
        case 100:
            $error_message = $lib_reset_password_err_100;
            break;
        case 101:
            $error_message = $lib_reset_password_err_101;
            break;
        case 102:
            $error_message = $lib_reset_password_err_102;
            break;
        default:
            $error_message = $lib_reset_password_err_100;
            break;
    }
?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><?php echo $error_message; ?></strong>
		</div>
<?php
}
?>
			<form class="form-horizontal brown-style" method="post" name="reset_form" id="reset_form" action="send_password_link.php?page=<?php echo $cible; ?>">
				<fieldset>
					<legend><?php echo $lib_reset_password_20; ?></legend>
					<div class="control-group">
						<label class="control-label" for="reset_login"><?php echo $lib_reset_password_30; ?></label>
						<div class="controls">
							<input type="text" class="form-control" name="reset_login" id="reset_login" placeholder="<?php echo $lib_reset_password_40; ?>">
						</div>
					</div>
					<br/>
					<div class="form-actions" align="center">
						<div class="control-group valid">
								<button class="btn btn-warning " type="submit"><?php echo $lib_reset_password_50; ?></button>
						</div>
					</div>
					<br/>
					<div class="control-group valid" align="center">
						<span><?php echo $lib_reset_password_60; ?></span>
					</div>
				</fieldset>
			</form>
	</div>
</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/jquery-1.11.1.min.js"></script>
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
         $("#reset_form").validate({
             rules:
             {
                reset_login:
                {
                    required: true,
                }
             },
             messages:
             {
                 reset_login:
                 {
                    required: "<?php echo $lib_register_err_40; ?>"
                 }
             },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.control-group').removeClass('has-error').addClass('has-success');
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
