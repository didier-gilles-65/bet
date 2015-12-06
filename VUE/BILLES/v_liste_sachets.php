<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_liste_sachets_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
	<link rel="stylesheet" href="dist/css/magnific-popup.css"> <!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="dist/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li><a href="detail.php?id='.$id.'">'.$crumb_detail.'</a></li><li>'.$crumb_list_nets.' ('.$bille['NOM'].')</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<main>
<div class="container">
	<!-- Texte haut de page -->
	<div class="row h-padding-normal"></div>
	<div class="row h-padding-normal page-head"> <!-- Barre de titre locale à la page -->
		<div class="col-xs-2">
				<a class="image-popup-fit-width" href="IMAGES/MAIN/HIDEF/<?php if (file_exists('IMAGES/MAIN/HIDEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" title="" data-gallery="#blueimp-gallery-2">
					<img class="img-thumbnail" src="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" alt='<?php echo $bille['NOM']; ?>' style="height:5em;"/>
				</a>
		</div>
		<div class="col-xs-10">
			<div class="row" class="vcenter" align="center" style="font-size:160%;">
<?php if (count($mbc_existants) > 0 ) {?>
				<span><?php echo $mbc_existants[0]['MARQUE']; ?> /</span>
				<span><?php echo $mbc_existants[0]['COMMENTAIRE_MARQUE_BILLE']; ?> /</span>
				<span><?php echo $mbc_existants[0]['NOM']; ?></span>
<?php } else { ?>
				<span style="font-size:140%;"><strong>PAS DE SACHETS</strong></span>
<?php } ?>
			</div>
<?php if (count($mbc_existants) > 0 ) {?>
			<div class="row">
				<div class="page-list-lining" style="margin: 5px 10px 5px;"></div>
				<span style="font-size:120%;"><?php echo $mbc_existants[0]['DESCRIPTION']; ?></span>
			</div>
<?php } ?>
		</div>
	</div>

	<div class="row" >
		<form class="h-margin-normal" method="post" action="set_update_bille.php" style="background-color:#FFFCF2">
			<input type="hidden" id="login" name="login" value="<?php echo $login; ?>">
			<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>">
			<div class="row no-margin" style="font-size:140%;background-color:#FAF2CC">
				<div class="col-sm-1" style="text-align:center"><?php echo $lib_liste_sachets_10; ?></div>
				<div class="col-sm-1" style="text-align:center"><?php echo $lib_liste_sachets_20; ?></div>
				<div class="col-sm-6" style="text-align:center"><?php echo $lib_liste_sachets_30; ?></div>
				<div class="col-sm-4" style="text-align:center"><?php echo $lib_liste_sachets_08; ?></div>
			</div>
			<strong>
				<div id="container_ligne">
	
<?php $i=0; ?>
					<div class="page-list-lining" style="margin: 5px 10px 5px;"></div>
	
<?php foreach($mbc_existants as $ligne) { ?>
					<input type="hidden" id="mbc[<?php echo $i; ?>][id_mb]" name="mbc[<?php echo $i; ?>][id_mb]" value="<?php echo $ligne['ID_MARQUE_BILLES']; ?>">
					<input type="hidden" id="mbc[<?php echo $i; ?>][id_mbc]" name="mbc[<?php echo $i; ?>][id_mbc]" value="<?php echo $ligne['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
					<input type="hidden" class="mbc" id="mbc[<?php echo $i; ?>][id_smbc]" name="mbc[<?php echo $i; ?>][id_smbc]" value="<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
					<div class="row no-margin" style="font-size:140%;vertical-align:middle">
						<div class="col-sm-1 marque" style="text-align:center"><?php echo $ligne['NOMBRE']; ?></div>
						<div class="col-sm-1 marque_bille" style="text-align:center"><?php echo $ligne['CODE_BARRE']; ?></div>
						<div class="col-sm-6 nom" style="text-align:center"><?php echo $ligne['SAC_COMMENTAIRE']; ?></div>
						<div class="col-sm-4 marque" style="text-align:center">
<?php
						if ( count($photos_sac) > 0 )
							{ 
								$picture=false;
								$title='';
								foreach($photos_sac as $photo)
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
										<?php foreach($photos_sac as $photo) {											
											if ( $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'] == $photo['ID_SAC'] ) { $title=$photo['FICHIER']; ?>
										<a class="image-popup-fit-width" href="IMAGES/MAIN/AUTRES/<?php echo $photo['FICHIER']; ?>" title="" data-gallery="#blueimp-gallery-<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
											<img class="img-thumbnail" src="IMAGES/MAIN/AUTRES/SMALL/<?php echo $photo['FICHIER']; ?>" alt="<?php echo $photo['FICHIER']; ?>"/>
										</a>
										<?php } } ?>
									</div>
<?php 
								}
							}
?>
					
						</div>
					</div>
					<div class="page-list-lining" style="margin: 5px 10px 5px;"></div>
<?php $i++; } ?>
				</div>
			</strong>
			
<?php if (count($photos) > 0 ) {?>
			<div class="row" >
				<div class="col-sm-1 col-sm-offset-1">
					<div class="links" id="links" class="vcenter" align="center" >
						<?php foreach($photos as $photo) { ?>
						<div class="row" >
							<a href="IMAGES/ETIQUETTES/HIDEF/<?php echo $photo['NOM_FICHIER']; ?>" title="" data-gallery="#blueimp-gallery">
								<img class="img-thumbnail" src="IMAGES/ETIQUETTES/THUMBNAIL/<?php echo $photo['NOM_FICHIER']; ?>" alt="<?php echo $photo['NOM'].' - '.$photo['MARQUE'].' - '.$photo['ID_CONDITIONNEMENT'].' ('.$photo['TYPE'].')'; ?>"/>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="col-sm-8">
					<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-carousel">
						<div class="slides"></div>
						<a class="prev">‹</a>
						<a class="next">›</a>
						<a class="play-pause"></a>
						<ol class="indicator"></ol>
					</div>
				</div>
			</div>			
<?php } ?>
			</br>
			<div class="row" style="text-align:center">
				<div class=" h-margin-normal" align="center">
					<a class="btn btn-lg btn-warning" href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>"><?php echo $lib_liste_sachets_40; ?></a>
				</div>
			</div>
		</form>
	</div>
</main>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/blueimp-gallery.min.js"></script>
	<script src="dist/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup core JS file -->
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/dropzone.js"></script>
	<script src="dist/js/sweet-alert.min.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>
	<script>
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
<script>
document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {
			index: link,
			container: '#blueimp-gallery',
			carousel: true,
			hidePageScrollbars: false,
			toggleControlsOnReturn: false,
			toggleSlideshowOnSpace: false,
			enableKeyboardNavigation: false,
			closeOnEscape: false,
			closeOnSlideClick: false,
			closeOnSwipeUpOrDown: false,
			disableScroll: false,
			startSlideshow: true,
			event: event
		},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script>	<script>
	blueimp.Gallery(
		document.getElementById('links').getElementsByTagName('a'),
		{
			container: '#blueimp-gallery',
			carousel: true,
    hidePageScrollbars: false,
    toggleControlsOnReturn: false,
    toggleSlideshowOnSpace: false,
    enableKeyboardNavigation: false,
    closeOnEscape: false,
    closeOnSlideClick: false,
    closeOnSwipeUpOrDown: false,
    disableScroll: false,
    startSlideshow: true
		}
		);
	</script>	

</body>
</html>
