<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $lib_liste_scans_05; ?></title>
		<?php include('MODELE/common_header_include.php'); ?>
		<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
	</head>
	<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li>'.$crumb_scans.'</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<!-- Texte haut de page -->
		
		<div class="container brown-style" style="margin-top:70px;">
			<div class="container brown-style visible-print" align="center">LISTE DES SCANS</div>
			<table class="table table-condensed table-striped table-hover">
				<tr class="warning"><td class="hidden-print" align="right"><a href="liste_scans.php?ORDER=ID<?php echo '&SENS='.$sens; ?>"><strong>ID</strong></a></td><td class="hidden-print" align="center"><a href="liste_scans.php?ORDER=CODE<?php echo '&SENS='.$sens; ?>"><strong>CODE</strong></a></td><td align="center"><a href="liste_scans.php?ORDER=CODE<?php echo '&SENS='.$sens; ?>"><strong>CODE BARRE</strong></td><td><a href="liste_scans.php?ORDER=ID_BILLE<?php echo '&SENS='.$sens; ?>"><strong>BILLE</strong></a></td><td><a href="liste_scans.php?ORDER=ID_CONDITIONNEMENT<?php echo '&SENS='.$sens; ?>"><strong>CONDITIONNEMENT</strong></a></td><td class="hidden-print align="center"><a href="liste_scans.php?ORDER=NOMBRE<?php echo '&SENS='.$sens; ?>"><strong>NOMBRE</strong></a></td><td class="visible-print">NB</td><td class="hidden-print"><a href="liste_scans.php?ORDER=DATE_CREATION<?php echo '&SENS='.$sens; ?>"><strong>DATE CREATION</strong></a></td><td class="hidden-print"><a href="liste_scans.php?ORDER=COMMENTAIRE<?php echo '&SENS='.$sens; ?>"><strong>COMMENTAIRE</strong></a></td></tr>
				<?php foreach($myarray as $ligne) { echo '<tr><td class="hidden-print" align="right">'.$ligne['ID'].'</td><td class="hidden-print align="center">'.$ligne['CODE'].'</strong></td><td align="center"><div id="bcTarget'.$ligne['ID'].'" cb="'.$ligne['CODE'].'"></div></td><td>'.$ligne['ID_BILLE'].'</td><td>'.$ligne['ID_CONDITIONNEMENT'].'</td><td align="center">'.$ligne['NOMBRE'].'</td><td class="hidden-print">'.$ligne['DATE_CREATION'].'</td><td class="hidden-print">'.$ligne['COMMENTAIRE'].'</td></tr>'; } ?>
			</table>
		</div>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="dist/js/jquery-1.11.1.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="dist/js/jquery-barcode.js"></script>      <!-- plugin pour l'affichage du code barre -->
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>
		<script>
			$(function (){
				$('a').tooltip();
			});
		</script>
		<script>
			$( "div[cb!='0']" ).each(function () {
				var code=$(this).attr('cb');
				console.log(code);
				$(this).barcode(code, "ean13",{barWidth:1, barHeight:20});
			});
		</script>
	</body>
</html>
