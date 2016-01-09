<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_detail_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="dist/css/docs.min.css"> <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="dist/css/magnific-popup.css"> <!-- Magnific Popup core CSS file -->
	<link rel="stylesheet" href="dist/css/validate_style.css"> <!-- Feuille de style : validation saisie formulaire -->
	<link rel="stylesheet" href="dist/css/bootstrap-image-gallery.min.css">	
	<link rel="stylesheet" href="dist/css/blueimp-gallery.min.css">
	<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li>'.$crumb_detail.' ('.$bille['NOM'].')</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>

	<div class="container">
<?php	
if (isset($_GET['err']))
{
?>
		<div class="row">
			<div class="col-xs-12">
				<div class="alert alert-<?php if (!$_GET['err']) { echo 'success'; } else {echo 'error';} ?> alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong><?php if (!$_GET['err']) { echo $lib_register_170; } else {echo $lib_register_190;} ?></strong>
					<?php if (!$_GET['err']) { echo $lib_register_180; } else {echo $lib_register_200;} ?>
				</div>
			</div>
		</div>
<?php
}
?>

		<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>"> <!-- Variable : ID_BILLES -->

		<div class="row pagination-nav hidden-print"> <!-- Barre de navigation locale à la page -->
			<nav>
				<div class="col-xs-12 col-sm-12 col-md-3" align="center" >
					<ul class="pagination pagination-sm">
						<li><a href="detail.php?id=<?php echo get_id_bille_precedente($requete_courante, $bille['NOM'], $bille['ID_BILLES']); ?>"><i class="glyphicon glyphicon-backward"></i><?php echo ' '.$lib_detail_200; ?></a></li>
						<li><a href="detail.php?id=<?php echo get_id_bille_suivante($requete_courante, $bille['NOM'], $bille['ID_BILLES']); ?>"><i class="glyphicon glyphicon-forward"></i><?php echo ' '.$lib_detail_210; ?></a></li>
					</ul>
				</div>
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur']))) { ?>
				<div class="col-xs-12 col-sm-4 col-md-3" align="center" >
					<ul class="pagination pagination-sm">
						<li><?php echo '<a href="update_bille.php?id='.$id.'" role="button" >'.$lib_detail_09.'</a>'; ?></li>
					</ul>
				</div>
<?php } ?>
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && (isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { ?>
				<div class="col-xs-12 col-sm-4 col-md-3" align="center" >
					<ul class="pagination pagination-sm">
						<li><?php echo '<a href="update_reference_bille.php?id='.$id.'" role="button" >'.$lib_detail_07.'</a>'; ?></li>
					</ul>
				</div>
<?php } ?>
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && (isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { ?>
				<div class="col-xs-12 col-sm-4 col-md-3" align="center" >
					<ul class="pagination pagination-sm">
						<li><?php echo '<a href="update_sac.php?id='.$id.'" role="button" >'.$lib_detail_11.'</a>'; ?></li>
					</ul>
				</div>
<?php } ?>
			</nav>
		</div>  <!-- /Barre de navigation locale à la page -->

		<div class="row page-head"> <!-- Barre de titre locale à la page -->
			<div class="detail-font-title" align="center">
				<span style="font-size:200%;"><strong><?php echo $bille['NOM']; ?></strong></span>
<?php
	$i=1;
	$synonyms = get_synonyms($sql_get_synonyms, $bille['ID_BILLES']);
	$max=count($synonyms);
	if ($max != 0) { 
?>
				<span class="pull-right">
					<span><?php echo $lib_detail_220; ?></span>
<?php foreach($synonyms as $synonym) { ?>
					<a href="detail.php?id=<?php echo $synonym['NUM']; ?>" rel="tooltip" data-original-title="<?php echo $lib_index_110; ?> <?php echo $synonym['NOM']; ?>"><em><?php echo $synonym['NOM']; ?></em></a><?php if ($i < $max) echo ' - '; $i++; ?>
<?php } ?>
				</span>
<?php } ?>
			</div>

		</div> <!-- /Barre de titre locale à la page -->

		<div class="row h-padding-normal h-margin-normal"> <!-- Barre de description bille -->
			<div class="col-xs-12 detail-font-content">
				<?php echo $bille['DESCRIPTION']; ?>
			</div>
		</div> <!-- /Barre de description bille -->

		<div class="row h-padding-normal" style="background-color:#FFFCF2"> <!-- BARRE IMAGE PRINCIPALE -->
			<div class="col-xs-12 col-sm-6" align="center">
				<a class="image-popup-fit-width" href="IMAGES/MAIN/HIDEF/<?php if (file_exists('IMAGES/MAIN/HIDEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" >
					<img class="img-thumbnail" style="max-width: 100%;" src="IMAGES/MAIN/LODEF/<?php if (file_exists('IMAGES/MAIN/LODEF/'.$bille['ID_BILLES'].'.jpg')) { echo $bille['ID_BILLES'].'.jpg'; } else { echo 'blank.jpg' ; } ?>" alt='<?php echo $bille['NOM']; ?>' style='width:100%'/>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6" align="center">
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
				</div>  <!-- /BARRE IMAGES AUTRES -->
<?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && (isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { ?>
				<div class="row" style="background-color:#FFFCF2"> <!-- BARRE BOUTONS IMAGES AUTRES -->
					<div class="col-xs-6">
						<div id="drop_remove_autre">
							<ul class="pagination pagination-sm" style="margin-bottom:5px;margin-top:5px;">
								<li>
									<a>
										<i class="glyphicon glyphicon-trash" style="height:16px"></i>Supprimer image
									</a>
								</li>
							</ul>	
						</div>
					</div>
					<div class="col-xs-6">
						<ul class="pagination pagination-sm" style="margin-bottom:5px;margin-top:5px;">
							<li>
								<a  id="drop_add_autre">
									<i class="glyphicon glyphicon-plus" style="pointer-events:none;height:16px;"></i>Ajouter image
								</a>
							</li>
						</ul>
					</div>
				</div>  <!-- /BARRE BOUTONS IMAGES AUTRES -->
				<div class="row" style="background-color:#FFFCF2"> <!-- BARRE PROGRESSION UPLOAD -->
					<div class="col-xs-12">
						<div id="total-progress" class="progress progress-striped active no-margin-padding" style="height:8px" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
						</div>
					</div>
				</div>
<?php } ?>
				<div class="row h-padding-normal" style="background-color:#FFFCF2"> <!-- BARRE FLAG FRITTEE/IRISEE -->
					<div class="col-xs-12">
						<span class="label label-warning"" style="font-size:120%"><?php if ($bille['BASE_FRITTEE'] == true) echo $lib_update_reference_bille_400; ?></span>
						<span class="label label-warning"" style="font-size:120%"><?php if ($bille['BASE_IRISEE'] == true) echo $lib_update_reference_bille_410; ?></span>
						<span class="label label-warning"" style="font-size:120%"><?php if ($bille['BASE_GIVREE'] == true) echo $lib_update_reference_bille_415; ?></span>
					</div>
				</div>
<?php if (strlen($bille['BASE_COULEUR']) > 0 ) { ?>
				<div class="row h-padding-normal" style="background-color:#FFFCF2"> <!-- BARRE FLAG FRITTEE/IRISEE -->
					<div class="col-xs-12">BASE : <span class="badge" style="font-size:120%"><?php echo $bille['BASE_TYPE']; ?> / <?php echo $bille['BASE_COULEUR']; ?></span></div>
				</div>
				<div class="row h-padding-normal" style="background-color:#FFFCF2"> <!-- BARRE FLAG FRITTEE/IRISEE -->
					<div class="col-xs-12">MOTIF : <span class="badge" style="font-size:120%"><?php echo $bille['MOTIF_TYPE']; ?> / <?php echo $bille['MOTIF_COULEUR']; ?></span></div>
				</div>
<?php } ?>
			</div>
		</div> <!-- /BARRE IMAGE PRINCIPALE -->
		
		<div class="row h-padding-normal h-margin-normal" style="background-color:#FAF2CC" align="center"> <!-- BARRE NB BILLES  -->
			<div class="number-detail btn btn-<?php echo (($sizes['NB12']>0)?'info':'default'); ?>"><span>12mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_12mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB14']>0)?'info':'default'); ?>"><span>14mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_14mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB16']>0)?'info':'default'); ?>"><span>16mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_16mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB21']>0)?'info':'default'); ?>"><span>21mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_21mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB25']>0)?'info':'default'); ?>"><span>25mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_25mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB35']>0)?'info':'default'); ?>"><span>35mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_35mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB42']>0)?'info':'default'); ?>"><span>42mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_42mm']; ?></span></strong></span></div>
			<div class="number-detail btn btn-<?php echo (($sizes['NB50']>0)?'info':'default'); ?>"><span>50mm  <strong><span class="badge" style="font-size:120%"><?php echo $owned_bille['POSSEDE_50mm']; ?></span></strong></span></div>
		</div> <!-- /BARRE NB BILLES  -->

		<div class="row">
		<div class="brown-style">
			<div class="row">
				<div class="col-xs-12">
					<div class="table-responsive">
						<table class="table table-condensed table-striped table-hover">
							<tr class="warning"><td align="center"><strong><?php echo $lib_div_1050; ?></strong></td><td align="center"><strong><?php echo $lib_div_1070; ?></strong></td><td align="center"><strong><?php echo $lib_detail_40; ?></strong></td><td align="center"><strong><?php echo $lib_detail_50; ?></strong></td><td align="center"><strong><?php echo $lib_div_1060; ?></strong></td><td align="center"><strong><?php echo $lib_div_1080; ?></strong></td><td align="center"><strong><?php echo $lib_div_1085; ?></strong></td><?php if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && (isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { echo '<td align="center"><strong>'.$lib_div_1105.'</strong></td>'; } ?></tr>
<?php
							foreach($liste_conditionnements as $conditionnement)
							{
								echo '<tr><td  style="vertical-align:middle" align="center">'.$conditionnement['MARQUE'].'</td><td  style="vertical-align:middle" align="center">'.$conditionnement['COMMENTAIRE_CONDITIONNEMENT'].'</td><td  style="vertical-align:middle" align="center">'.$conditionnement['ANNEE_APPARITION'].'</td><td  style="vertical-align:middle" align="center">'.$conditionnement['ANNEE_DISPARITION'].'</td><td  style="vertical-align:middle" align="center">'.$conditionnement['NOM'].'</td>';
								echo '<td align="center" style="vertical-align:middle" >';
								if ((isset($_SESSION['connect'])) && ($_SESSION['connect'] == 1))
								{
								//	echo '<div class="btn-group-vertical" ><button type="button" id="BTN_'.$conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'].'" class="btn btn-xs btn-primary manage_sac" ><a><i class="glyphicon glyphicon-plus" style="height:16px;color:white"></i></a></button></div>';
									if ($conditionnement['NOMBRE'] > 0) {
										echo '  <img src="IMAGES/OK.PNG" style="height:18px;"/> <a href="liste_sachets.php?id='.$bille['ID_BILLES'].'&conditionnement='.$conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'].'" rel="tooltip" data-original-title="'.$lib_detail_230.'"><em>('.$conditionnement['NOMBRE'].')</em></a>';
									}	
									else {echo '  <img src="IMAGES/CANCEL.PNG" style="height:18px;"/> ';}
								}
								else { echo '<img src="IMAGES/HELP.PNG" style="height:18px;"/> '; }
								echo '</td><td align="center" width=180px>';
?>
<?php
								$picture=false;
								$title='';
								foreach($photos as $photo)
								{											
									if ( $conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'] == $photo['ID_MARQUE_BILLES_CONDITIONNEMENT'] )
									{ 
										$picture=true;
									}
								}
								if ( $picture )
								{ 
?>
									<div id="blueimp-gallery-<?php echo $conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>" class="blueimp-gallery">
										<div class="slides"></div>
										<h3 class="title"></h3>
										<a class="prev">‹</a>
										<a class="next">›</a>
										<a class="close">×</a>
										<a class="play-pause"></a>
										<ol class="indicator"></ol>
									</div>
									<div class="links" id="links-<?php echo $conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>" >
										<?php foreach($photos as $photo) {											
											if ( $conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'] == $photo['ID_MARQUE_BILLES_CONDITIONNEMENT'] ) { $title=$photo['NOM'].' - '.$photo['MARQUE'].' - '.$photo['ID_CONDITIONNEMENT']; ?>
										<a href="IMAGES/ETIQUETTES/HIDEF/<?php echo $photo['NOM_FICHIER']; ?>" title="" data-gallery="#blueimp-gallery-<?php echo $conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
											<img class="img-thumbnail" src="IMAGES/ETIQUETTES/THUMBNAIL/<?php echo $photo['NOM_FICHIER']; ?>" alt="<?php echo $photo['NOM'].' - '.$photo['MARQUE'].' - '.$photo['ID_CONDITIONNEMENT'].' ('.$photo['TYPE'].')'; ?>"/>
										</a>
										<?php } } ?>
									</div>
<?php 
								}
?>
<?php
								if ((isset($_SESSION['connect'])) && (isset($_SESSION['utilisateur'])) && (isset($_SESSION['profile'])) && ($_SESSION['profile'] == 'ADMIN')) { 
									echo '<td align="center" style="vertical-align:middle" ><ul class="pagination pagination-sm" style="margin-bottom:5px;margin-top:5px;"><li><a href="update_photo_etiquette.php?id='.$id.'&bmc='.$conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'].'&libelle='.$title.'">Modifier</a></li></ul></td>';
								}
?>
<?php 
								echo '</td></tr>';
							}
?>
						</table>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	
	


<?php
    include_once('VUE/BILLES/footer-template.php');
?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/jquery.blueimp-gallery.min.js"></script>
	<script src="dist/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup core JS file -->
	<script src="dist/js/jquery.validate.min.js"></script>
	<script src="dist/js/dropzone.js"></script>
	<script src="dist/js/sweet-alert.min.js"></script>
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/billesentete-login-validate.js" type="text/javascript" language="JavaScript"></script>

	<script> // Breadcrumb du site
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
	</script>

	<script> // Gestion des flches pour paginer
		function traitement(evenement){
    //on teste si le code correspond au code de la flêche droite
//			alert('vous avez pressé '+evenement.which);
			if ((evenement.which == 39) || (evenement.which == 102)){
				location.href="detail.php?id=<?php echo get_id_bille_suivante($requete_courante, $bille['NOM'], $bille['ID_BILLES']); ?>";
			}
			if ((evenement.which == 37) || (evenement.which == 100)){
				location.href="detail.php?id=<?php echo get_id_bille_precedente($requete_courante, $bille['NOM'], $bille['ID_BILLES']); ?>";
			}
		}
 
		$(function(){
			$(document).keydown(traitement);
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
	<script> // TOOLTIP SUR TAG <a>
		$(document).ready(function() {
			$('a').tooltip();
		});
	</script>
	<script> // DROPZONE SUR BOUTON + DE AUTRES PHOTOS
		function modifieLinks(){
			var tag_links=document.getElementById('links');
			var id_bille = document.getElementById('bille').value;
			while(tag_links.hasChildNodes())tag_links.removeChild(tag_links.lastChild); // innerHTML non adapté dans ce cas
			var jqxhr = $.getJSON("get_json_liste_autres_photos.php?id="+id_bille, function(json){
			})
			.done(function( json ) {
				var i=0;
				var ligne = '';
				while ( i<json.length ) {
					var chemin=json[i][3];
					var fichier=json[i][2];
					var indice=json[i][1];
					var id=json[i][0];
					ligne += '<a href="' + chemin + fichier + '?id=' + id + '&indice=' + indice + '" title="' + fichier + '" data-gallery="#blueimp-gallery-2">';
					ligne += '<img height="60px" class="img-thumbnail" src="' + chemin+ 'SMALL/' + fichier + '?id=' + id + '&indice=' + indice + '" alt="' + fichier + '"/>';
					ligne += '</a>';
					i++;
				}
				tag_links.innerHTML = ligne;
			})
			.fail(function( jqxhr, textStatus, error ) {
				var err = textStatus + ", " + error;
				swal({ title: "Erreur lors de l'accès aux photos", text: err, imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
				console.log( "Request Failed: " + err );
			})
		}
		
		$(function(){
			$("#drop_add_autre").dropzone({
				url: "upload.php",
				thumbnailWidth: 100,
				thumbnailHeight: 100,
				parallelUploads: 1,
				maxFilesize: 2,
				autoQueue: true, // Démarre le téléchargement immédiatement.
				previewsContainer: false, // Definit le conteneur de prévisualisation
				acceptedFiles: ".gif,.png,.jpg,.jpeg,.bmp",
				clickable:'#drop_add_autre',
				init: function() {
					var myDropzone = this;
					myDropzone.on("sending", function(file, xhr, formData) {
						document.querySelector("#total-progress").style.opacity = "1"; // Show the total progress bar when upload starts
						formData.append("upload_id_bille", document.getElementById("bille").value); // Ajoute dans les données POST : upload_id_bille
					});
					myDropzone.on("addedfile", function(file) {
						document.querySelector("#total-progress").style.opacity = "1"; // Show the total progress bar when upload starts
						if (this.files[1]!=null){
							this.removeFile(this.files[0]);
						}
					});
					myDropzone.on("totaluploadprogress", function(progress) {
						document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
					});
					myDropzone.on("queuecomplete", function(progress) {
						document.querySelector("#total-progress").style.opacity = "0"; // Show the total progress bar when upload starts
						myDropzone.removeAllFiles(true);
					});
					myDropzone.on("success", function(progress) {
//						swal({ title: "CONFIRMATION", text: "Ajout effectué", imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
						document.querySelector("#total-progress").style.opacity = "0"; // Show the total progress bar when upload starts
						modifieLinks();
					});
				}
			});
			document.querySelector("#total-progress").style.opacity = "0"; // Show the total progress bar when upload starts
		});
	</script>
	<script> // DROP SUR BOUTON POUBELLE DE AUTRES PHOTOS
		$(function (){
			$.event.props.push('dataTransfer'); // ajoute la propriété pour le drop et le transfert de données
			$('#drop_remove_autre').on({
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
					var data = e.dataTransfer.getData('text');
					chemin = data.substring(0, data.lastIndexOf('/')+1);
					fichier = data.substring(data.lastIndexOf('/')+1, data.indexOf('id=',0)-1);
					var debut = data.indexOf('id=',0)-1;
					id_photo_to_delete = data.substr(debut);
					
					swal({
							title: "CONFIRMATION",
							text: "Confirmer Suppression ?",
							showCancelButton: true,
							imageUrl: chemin+'SMALL/'+fichier,
							confirmButtonColor: "#DD6B55",
							closeOnCancel: false,							
							cancelButtonText: "Annuler",
							closeOnConfirm: false,
							confirmButtonText: "Continuer"
						},
						function(isConfirm){   
							if (isConfirm) {
								var jqxhr = $.getJSON('/delete_json_photo_autre.php'+id_photo_to_delete, function(json){
								})
								.done(function( json ) {
										modifieLinks();
								})
								.fail(function( jqxhr, textStatus, error ) {
									var err = textStatus + ", " + error;
									swal({ title: "Erreur lors de l'accès aux photos", text: err, imageUrl: chemin+'SMALL/'+fichier });
									console.log( "Request Failed: " + err );
								})
								swal("Supprimé", "L'image a été supprimée", "success");   
							} 
							else {
								swal("Annulé", "L'image est conservée", "error");   
							}
					});
					e.preventDefault();
				}
			});
		});
	</script>
</body>
</html>
