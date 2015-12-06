<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_change_password_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="login.php">'.$crumb_login.'</a></li><li>'.$crumb_motdepasse.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>

	<div class="container" align="center">
		<div>
			<div class="col-md-12"><?php echo '<h3>'.$lib_change_password_10.'</h3>'; ?></div>
		</div>
	</div>

<!-- Texte haut de page -->
	<div class="container">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">

<?php		
if (!isset($_GET['link']))
{
	$key = 'UNKNOWN';
}
else
{
	$key = $_GET['link'];
}

$login='';
$found=false;
$sql = "SELECT * FROM comptes where PASSWORD_KEY = '$key'";
//ecrireLog('SQL','INFO','requete:'.$sql); 

foreach  ($bdd->query($sql) as $row) {
	$found=true;
	$login=$row['LOGIN'];
}
if (!$found) 
{
//	$bdd->closeCursor();
	header('Location: reset_password.php?err=100');   
	exit();
}
?>	

<!-- Affichage message d'erreur si err est setté -->
<?php
if (isset($_GET['err']))
{
?>
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?php echo $lib_change_password_err_100; ?></strong>
			</div>
<?php
}
?>
			<form class="form-horizontal brown-style" method="post" id="change_password" name= "change_password" action="set_password.php">
				<fieldset>
					<legend><?php echo $lib_change_password_20; ?></legend>
					<input type="text" class="hidden" name="login" id="login" value="<?php echo $login; ?>">
					<div class="control-group">
						<label class="control-label" for="password1"><?php echo $lib_register_120; ?></label>
						<div class="controls">
							<input type="password" class="form-control" name="password1" id="password1" placeholder="<?php echo $lib_register_110; ?>">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password2"><?php echo $lib_register_140; ?></label>
						<div class="controls">
							<input type="password" class="form-control" name="password2" id="password2" placeholder="<?php echo $lib_register_130; ?>">
						</div>
					</div>
					<div class="form-actions" align="center">
						<br/>
						<button type="submit" class="btn btn-success btn-sm"><?php echo $lib_change_password_30; ?></button>
						<button type="reset" class="btn btn-danger btn-sm"><?php echo $lib_change_password_40; ?></button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

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

<script>
	(function($,W,D)
{
    var JQUERY4U = {};
    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#change_password").validate({
                rules: {
                    password1: {
                        required: true,
                        minlength: 5
                    },
                    password2: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    password1: {
                        required: "<?php echo $lib_register_err_50; ?>",
                        minlength: "<?php echo $lib_register_err_51; ?>"
                    },
                    password2: {
                        required: "<?php echo $lib_register_err_60; ?>",
                        minlength: "<?php echo $lib_register_err_61; ?>"
                    }
                },
                submitHandler: function(form) {
					form.submit();
				}
			});
        }
    }
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });
})(jQuery, window, document);
</script>
	
	<script>
		$(function (){
		$('a').tooltip();
		});
	</script>
</body>
</html>
