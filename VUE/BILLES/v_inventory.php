<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_inventory_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li>'.$crumb_inventory.'</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<main>
	<div class="container brown-style">

<!-- Entete de la table -->
		<table class="table table-condensed table-striped table-hover" name="tableau_marques">
			<tr class="success" style="font-size:80%;">
			<strong>
				<td align="center"><?php echo $lib_index_60 ?></td>
				<td align="center"><?php echo $lib_index_70 ?></td>
				<td align="center">COND</td>
				<td align="center">NBRE</td>
			</strong>
			</tr>


		<input type="hidden" id="login" name="login" value="<?php echo $login; ?>">
	<!-- Table des billes -->

<?php $i=0; foreach($billes as $bille) { ?>
			<tr class="info">
				<td align="center"><a href="detail.php?id=<?php echo $bille['NUM']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_110; ?> <?php echo $bille['NOM']; ?>"><em><?php echo $bille['NOM']; ?></em></a></td>
				<td align="center"><a class="image-popup-fit-width" href="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['NUM'].'.jpg')) { echo $bille['NUM'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" rel="tooltip" data-original-title="<?php echo $lib_index_120; ?> <?php echo $bille['NOM']; ?>" >
				<img src="IMAGES/MAIN/THUMBNAIL/<?php if (file_exists('IMAGES/MAIN/THUMBNAIL/'.$bille['NUM'].'.jpg')) { echo $bille['NUM'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" style="height:25px" alt='<?php echo $bille['NOM']; ?>' class="img-rounded"/>
				</a></td>
				<td align="center"><?php echo $bille['CONDITIONNEMENT']; ?></td>
				<td align="center"><?php echo $bille['NBRE']; ?></td>
			</tr>
<?php } ?>
		</table>
	</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
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
</body>
</html>
