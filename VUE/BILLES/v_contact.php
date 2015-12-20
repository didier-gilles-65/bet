<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_contact_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_contact.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
<main>
	<div class="container">
		<div class="row page-head"> <!-- Barre de titre locale à la page -->
			<div class="col-xs-12 col-md-4 vcenter" style="font-size:100%;" align="center">
				<strong><?php echo $lib_contact_20; ?></strong>
			</div>
		</div>
		<div class="row row-liste-billes">

		<form method="post" name="contact_form" id="contact_form" action="set_contact.php" enctype="multipart/form-data">
			<fieldset>
				<div class="row">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2">
						<div class="control-group">
							<label class="control-label" for="contact_email"><?php echo $lib_contact_30; ?></label>
							<div class="controls">
								<input type="text" class="form-control" name="contact_email" id="contact_email" placeholder="<?php echo $lib_contact_40; ?>">
								<span class="help-inline"><?php echo $lib_contact_50; ?></span>
							</div>
						</div>
						<br>
						<div class="control-group">
							<label class="control-label" for="contact_theme"><?php echo $lib_contact_60; ?></label>
							<div class="controls">
								<select class="form-control input-xlarge" name="contact_theme">
									<option>...</option>
									<option><?php echo $lib_contact_70; ?></option>
									<option><?php echo $lib_contact_80; ?></option>
									<option><?php echo $lib_contact_90; ?></option>
									<option><?php echo $lib_contact_95; ?></option>
								</select>
								<span class="help-inline"><?php echo $lib_contact_100; ?></span>
							</div>
						</div>
						<br>
						<div class="control-group">
							<label class="control-label" for="contact_message"><?php echo $lib_contact_130; ?></label>
							<div class="controls">
								<textarea class="form-control" id="contact_message" name="contact_message" rows="5" placeholder="<?php echo $lib_contact_140; ?>"></textarea>
								<span class="help-inline"><?php echo $lib_contact_150; ?></span>
							</div>
						</div>
						<br>
						<div class="control-group" align="center">
							<div style="position:relative;">
								<input type="hidden" name="MAX_FILE_SIZE" value="9000000" />
								<div class='btn btn-primary' style="position: relative; overflow: hidden; margin: 10px;" ><span><?php echo $lib_contact_151; ?></span>
									<input type="file" style='position: absolute; top: 0; right: 0; margin: 0; padding: 0; font-size: 20px; cursor: pointer; opacity: 0; filter: alpha(opacity=0);' name="nomfichier" size="40" onchange='$("#upload-file-info").html($(this).val());'>
								</div>
								<span class='label label-info' id="upload-file-info"></span>
							</div>
						</div>
					</div>
				</div>
				<br><br>
				<div class="row" align="center">
<?php if ( isset($retour_post_contact) ) { ?>
					<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="alert alert-<?php if ( $retour_post_contact == 1 ) { echo 'success'; } else {echo 'warning';} ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong><?php if ( $retour_post_contact == 1) { echo $lib_contact_170; } else {echo $lib_contact_180;} ?></strong>
						<?php switch ($retour_post_contact) {
							case 2:
								$error_message = $lib_contact_err_102;
								break;
							case 3:
								$error_message = $lib_contact_err_103;
								break;
							case 4:
								$error_message = $lib_contact_err_104;
								break;
							case 5:
								$error_message = $lib_contact_err_105;
								break;
							default:
								$error_message = $lib_contact_err_100;
						}
						if ( $retour_post_contact == 1 ) { echo $lib_contact_190; } else {echo $error_message;} ?> <br/><a href="/index.php" class="btn btn-small btn-warning">Home</a>
					</div>
<?php } else { ?>					
					<div class="col-sm-2 col-sm-offset-5" align="center">
						<p><button class="btn btn-small btn-warning " type="submit"><?php echo $lib_contact_160; ?></button></p>
					</div>
<?php } ?>
				</div>
			</fieldset>
		</form>
	</div>
	</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>

	<script src="dist/js/jquery-1.11.1.min.js"></script> <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/bootstrap.min.js"></script> <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="dist/js/jquery.validate.min.js"></script> <!-- jQuery validate, pour valider les champs du formulaire -->
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
$(function(){
//form validation rules
	$("#contact_form").validate({
		rules: {
			contact_theme: {
				required: true
			},
			contact_email: {
				email: true,
				required: true
			},
			contact_message: {
				required: true,
				maxlength: 5000
			}
		},
		messages: {
			contact_theme: "<?php echo $lib_contact_110; ?>",
			contact_message: {
				required: "<?php echo $lib_contact_120; ?>",
				maxlength: "<?php echo $lib_contact_120; ?>",
			},
			contact_email: {
				required: "<?php echo $lib_contact_err_10; ?>",
				email: "<?php echo $lib_register_err_30; ?>"
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
$(function (){
   $('a').tooltip();
});
</script>
</body>
</html>
