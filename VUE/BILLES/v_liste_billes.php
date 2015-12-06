<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_liste_billes_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/docs.min.css"> <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="dist/css/magnific-popup.css"> <!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>

<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_liste.'</li></ul>';
    include('VUE/BILLES/modal-apropos.php');
    include('VUE/BILLES/nav-bar-template.php');
?>
<main>
	<?php include('VUE/BILLES/vc_index_liste_billes.php'); ?>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery-1.11.1.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup core JS file -->
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
			$('#breadcrumb').jBreadCrumb();
		});
	</script>
	
	<script>
		$(document).ready(function() {
			$('.image-popup-fit-width').magnificPopup({
				type: 'image',
				mainClass: 'mfp-with-zoom', // this class is for CSS animation below
				zoom: {
					enabled: true, // By default it's false, so don't forget to enable it
					duration: 300, // duration of the effect, in milliseconds
					easing: 'ease-in-out', // CSS transition easing function 
					opener: function(openerElement) {
					return openerElement.is('img') ? openerElement : openerElement.find('img');
					}
				},
				closeOnContentClick: true,
				image: {
					verticalFit: false
				}
			});
			$('a').tooltip();
			$('button').tooltip();
		});
	</script>
</body>
</html>
