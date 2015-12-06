<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $lib_detail_05; ?></title>
<?php include('MODELE/common_header_include.php'); ?>
		<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
		<link rel="stylesheet" href="dist/css/magnific-popup.css"> <!-- Magnific Popup core CSS file -->
		<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
		<link rel="stylesheet" href="dist/css/bootstrap-image-gallery.min.css">	
		<link rel="stylesheet" href="dist/css/blueimp-gallery.min.css">
		<link rel="stylesheet" type="text/css" href="dist/css/animate.css">
	</head>
	<body>
<?php
$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li><a href="detail.php?id='.$id.'">'.$crumb_detail.'</a></li><li>'.$crumb_update_collection.' ('.$bille['NOM'].')</li></ul>';
include('VUE/BILLES/modal-apropos.php');
include('VUE/BILLES/nav-bar-template.php');
?>
		<main>
			<div class="container">
				<input type="hidden" id="id_bille" name="id_bille" value="<?php echo $bille['ID_BILLES']; ?>">
				<div class="row h-padding-normal page-head" style="margin-top:10px"> <!-- Barre de titre locale à la page -->
					<div class="col-xs-1">
						<a href="IMAGES/MAIN/HIDEF/<?php if (file_exists('IMAGES/MAIN/HIDEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" >
							<img src="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" alt='<?php echo $bille['NOM']; ?>' style="height:2em;"/>
						</a>
					</div>
					<div class="col-xs-2" align="center" class="vcenter">
						<span style="font-size:140%;"><strong><?php echo $bille['NOM']; ?></strong></span>
					</div>
					<div class="col-xs-9">
						<strong><?php echo $bille['DESCRIPTION']; ?></strong>
					</div>
				</div>  <!-- Barre de titre locale à la page -->
				<div class="row h-padding-normal" style="background-color:#FFFCF2"> <!-- BARRE IMAGES AUTRES -->
					<div class="col-xs-12">
						<div id="blueimp-gallery-2" class="blueimp-gallery">
							<div class="slides"></div>
							<h3 class="title"></h3>
							<a class="prev">‹</a>
							<a class="next">›</a>
							<a class="close">×</a>
							<a class="play-pause"></a>
							<ol class="indicator"></ol>
						</div>
						<div id="links" >
<?php foreach($autres_photos as $autre_photo) { ?>
							<a href="<?php echo $autre_photo['CHEMIN'].$autre_photo['FICHIER'].'?id='.$autre_photo['ID_BILLE'].'&indice='.$autre_photo['INDICE']; ?>" data-gallery="#blueimp-gallery-2">
								<img height="60px" class="img-thumbnail" src="<?php echo $autre_photo['CHEMIN'].'SMALL/'.$autre_photo['FICHIER'].'?id='.$autre_photo['ID_BILLE'].'&indice='.$autre_photo['INDICE']; ?>" alt="<?php echo $autre_photo['FICHIER']; ?>"/>
							</a>
<?php } ?>
						</div>
					</div>
				</div> <!-- /BARRE IMAGES AUTRES -->

				<div class="row" > <!-- TABLEAU DES SACHETS -->
					<form class="h-margin-normal" method="post" action="set_update_bille.php" style="background-color:#FFFCF2">
						<input type="hidden" id="login" name="login" value="<?php echo $login; ?>">
						<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>">
						<div class="row no-margin" style="background-color:#FAF2CC">
							<div class="col-sm-1"><?php echo $lib_update_bille_2_PHOTO; ?></div>
							<div class="col-sm-2"><?php echo $lib_update_bille_2_MARQUE; ?></div>
							<div class="col-sm-1"><?php echo $lib_update_bille_2_NOM; ?></div>
							<div class="col-sm-2"><?php echo $lib_update_bille_2_CONDITIONNEMENT; ?></div>
							<div class="col-sm-1" style="text-align:center"><?php echo $lib_update_bille_2_NOMBRE; ?></div>
							<div class="col-sm-2" style="text-align:center"><?php echo $lib_update_bille_2_CODE_BARRE; ?></div>
							<div class="col-sm-2" style="text-align:center"><?php echo $lib_update_bille_2_COMMENTAIRE_PACKAGING; ?></div>
						</div>
						<strong>
							<div id="container_ligne">
<?php
$i=0; 
	foreach($mbc_existants as $ligne) { 
		if ($ligne['NOMBRE']>0) {
?>
								<input type="hidden" id="mbc[<?php echo $i; ?>][id_mb]" name="mbc[<?php echo $i; ?>][id_mb]" value="<?php echo $ligne['ID_MARQUE_BILLES']; ?>">
								<input type="hidden" id="mbc[<?php echo $i; ?>][id_mbc]" name="mbc[<?php echo $i; ?>][id_mbc]" value="<?php echo $ligne['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
								<input type="hidden" class="mbc" id="mbc[<?php echo $i; ?>][id_smbc]" name="mbc[<?php echo $i; ?>][id_smbc]" value="<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
								<div class="row no-margin" style="vertical-align:middle">
									<div class="page-list-lining" style="margin: 5px 10px 5px;"></div>
									<div class="col-sm-1 marque">
<?php
			if ( count($photos) > 0 ) { 
				$picture=false;
				$title='';
				foreach($photos as $photo)
				{											
					if ( $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'] == $photo['ID_SAC'] )
					{ 
						$picture=true;
					}
				}
				if ( $picture )
				{ 
?>
										<div id="blueimp-gallery-<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>" class="blueimp-gallery">
											<div class="slides"></div>
											<h3 class="title"></h3>
											<a class="prev">‹</a>
											<a class="next">›</a>
											<a class="close">×</a>
											<a class="play-pause"></a>
											<ol class="indicator"></ol>
										</div>
										<div class="links" id="links-<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>" >
<?php foreach($photos as $photo) {											
	if ( $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'] == $photo['ID_SAC'] ) { $title=$photo['FICHIER']; ?>
											<a href="IMAGES/MAIN/AUTRES/<?php echo $photo['FICHIER']; ?>" title="" data-gallery="#blueimp-gallery-<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
												<img class="img-thumbnail" src="IMAGES/MAIN/AUTRES/SMALL/<?php echo $photo['FICHIER']; ?>" alt="<?php echo $photo['FICHIER']; ?>"/>
											</a>
<?php } } ?>
										</div>
<?php 
	}
}
?>
									</div>
									<div class="col-sm-2 marque"><?php echo $ligne['MARQUE']; ?></div>
									<div class="col-sm-1 marque_bille"><?php echo $ligne['COMMENTAIRE_MARQUE_BILLE']; ?></div>
									<div class="col-sm-2 nom"><?php echo $ligne['NOM']; ?></div>
									<div class="col-sm-1" align="center"><?php echo $ligne['NOMBRE']; ?></div>
									<div class="col-sm-2"><?php echo $ligne['CODE_BARRE']; ?></div>
									<div class="col-sm-2"><?php echo $ligne['SAC_COMMENTAIRE']; ?></div>
									<div class="col-sm-1">
										<div class="row">
											<div class="col-sm-6">
												<div class="btn btn-md btn-info add_sac" style="padding:6px" id="<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'] ?>" ><i class="glyphicon glyphicon-plus" style="vertical-align:middle"></i></div>
											</div>
											<div class="col-sm-6">
												<div class="btn btn-md btn-warning remove_sac" style="padding:6px" id="<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'] ?>" ><i class="glyphicon glyphicon-minus" style="vertical-align:middle"></i></div>
											</div>
										</div>
									</div>
								</div>
<?php $i++; } ?>
<?php } ?>
							</div>
						</strong>
						</br>
						<div class="row" style="text-align:center">
							<div class=" h-margin-normal" 	align="center">
								<a class="btn btn-lg btn-warning " href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>">RETOUR</a>
							</div>
						</div>
					</form>
				</div> <!-- /TABLEAU DES SACHETS -->
			</div>
		</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.blueimp-gallery.min.js"></script>
	<script src="dist/js/blueimp-gallery.min.js"></script>
	<script src="dist/js/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	
	<script src="dist/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup core JS file -->
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/dropzone.js"></script>
	<script src="dist/js/notify.min.js"></script>
	<script src="dist/js/bootstrap-notify.min.js"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	
	<script> // BREADCRUMB
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>
	<script> // TOOLTIP SUR TAG <a>
		$(function (){
			$('a').tooltip();
		});
	</script>
	<script> // MAGNIFIC POPUP
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
		});
	</script>
	<script> // DROP FICHIER IMAGE SUR LIGNE SACHET
		$(function (){
			$.event.props.push('dataTransfer'); // ajoute la propriété pour le drop et le transfert de données
			$('.add_sac').on({
				dragenter: function(e) {
					e.preventDefault();
				},
				dragleave: function(e) {
					e.preventDefault();
				},
				dragover: function(e) {
					e.preventDefault();
				},
				drop: function(e) {
					var id_bille = document.getElementById('id_bille').value;
					var data = e.dataTransfer.getData('text');
					chemin = data.substring(0, data.lastIndexOf('/')+1);
					fichier = data.substring(data.lastIndexOf('/')+1, data.indexOf('id=',0)-1);
					fichier_chemin = data.substring(0, data.indexOf('id=',0)-1);
					var debut = data.indexOf('id=',0);
					var id_mbc = $(this).attr('id');
					
					var jqxhr = $.getJSON('/associe_json_photo_autre.php'+'?'+'id_bille='+id_bille+'&id_mbc='+id_mbc+'&chemin='+fichier, function(json){
					})
					.done(function( json ) {
						$.notify({
							title: '<strong>Succès!</strong>',
							message: 'L\'image a été associée à '+id_mbc
						},{
							type: 'success'
						},{
							animate: {
								enter: 'animated fadeInRight',
								exit: 'animated fadeOutRight'
							}
						});
					})
					.fail(function( jqxhr, textStatus, error ) {
						var err = textStatus + ", " + error;
						$.notify({
							title: '<strong>Erreur!</strong>',
							message: 'Erreur : '.err
						},{
							type: 'error'
						});
						console.log( "Request Failed: " + err );
					});
					e.preventDefault();
				}
			});

			$('.remove_sac').on({
				dragenter: function(e) {
					e.preventDefault();
				},
				dragleave: function(e) {
					e.preventDefault();
				},
				dragover: function(e) {
					e.preventDefault();
				},
				drop: function(e) {
					var id_bille = document.getElementById('id_bille').value;
					var data = e.dataTransfer.getData('text');
					chemin = data.substring(0, data.lastIndexOf('/')+1);
					fichier = data.substring(data.lastIndexOf('/')+1, data.length);
					fichier_chemin = data.substring(0, data.indexOf('id=',0)-1);
					var debut = data.indexOf('id=',0);
					var id_mbc = $(this).attr('id');
					
					var jqxhr = $.getJSON('/dissocie_json_photo_autre.php'+'?'+'id_bille='+id_bille+'&id_mbc='+id_mbc+'&chemin='+fichier, function(json){
					})
					.done(function( json ) {
						$.notify({
							title: '<strong>Succès!</strong>',
							message: 'L\'image a été dissociée de '+id_mbc
						},{
							type: 'success'
						},{
							animate: {
								enter: 'animated fadeInRight',
								exit: 'animated fadeOutRight'
							}
						});
					})
					.fail(function( jqxhr, textStatus, error ) {
						var err = textStatus + ", " + error;
						$.notify({
							title: '<strong>Erreur!</strong>',
							message: 'Erreur : '.err
						},{
							type: 'danger'
						});
						console.log( "Request Failed: " + err );
					})
					e.preventDefault();
				}
			});
			
			});
	</script>

</body>
</html>
