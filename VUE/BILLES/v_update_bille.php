<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_detail_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li><a href="detail.php?id='.$id.'">'.$crumb_detail.'</a></li><li>'.$crumb_update_collection.' ('.$bille['NOM'].')</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<main>
<div class="container">
	<!-- Texte haut de page -->
	<div class="row h-padding-normal"></div>
	<div class="row h-padding-normal page-head"> <!-- Barre de titre locale à la page -->
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
	</div>
	<div class="row" >
		<form class="h-margin-normal" method="post" action="set_update_bille.php" style="background-color:#FFFCF2">
			<input type="hidden" id="login" name="login" value="<?php echo $login; ?>">
			<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>">
			<div class="row no-margin" style="background-color:#FAF2CC">
				<div class="col-sm-2"><?php echo $lib_update_bille_2_MARQUE; ?></div>
				<div class="col-sm-2"><?php echo $lib_update_bille_2_NOM; ?></div>
				<div class="col-sm-2"><?php echo $lib_update_bille_2_CONDITIONNEMENT; ?></div>
				<div class="col-sm-1" style="text-align:center"><?php echo $lib_update_bille_2_NOMBRE; ?></div>
				<div class="col-sm-2" style="text-align:center"><?php echo $lib_update_bille_2_CODE_BARRE; ?></div>
				<div class="col-sm-2" style="text-align:center"><?php echo $lib_update_bille_2_COMMENTAIRE_PACKAGING; ?></div>
			</div>
			<strong>
				<div id="container_ligne">
	
<?php $i=0; ?>
	
<?php foreach($mbc_existants as $ligne) { ?>
					<input type="hidden" id="mbc[<?php echo $i; ?>][id_mb]" name="mbc[<?php echo $i; ?>][id_mb]" value="<?php echo $ligne['ID_MARQUE_BILLES']; ?>">
					<input type="hidden" id="mbc[<?php echo $i; ?>][id_mbc]" name="mbc[<?php echo $i; ?>][id_mbc]" value="<?php echo $ligne['ID_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
					<input type="hidden" class="mbc" id="mbc[<?php echo $i; ?>][id_smbc]" name="mbc[<?php echo $i; ?>][id_smbc]" value="<?php echo $ligne['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT']; ?>">
					<div class="row no-margin" style="vertical-align:middle">
						<div class="page-list-lining" style="margin: 5px 10px 5px;"></div>
						<div class="col-sm-2 marque"><?php echo $ligne['MARQUE']; ?></div>
						<div class="col-sm-2 marque_bille"><?php echo $ligne['COMMENTAIRE_MARQUE_BILLE']; ?></div>
						<div class="col-sm-2 nom"><?php echo $ligne['NOM']; ?></div>
						<div class="col-sm-1" align="center"><div class="controls"><input type="text" class="form-control nombre" name="mbc[<?php echo $i; ?>][NOMBRE]" id="mbc[<?php echo $i; ?>][NOMBRE]" value="<?php echo $ligne['NOMBRE']; ?>"></div></div>
						<div class="col-sm-2"><div class="controls"><input type="text" class="form-control" name="mbc[<?php echo $i; ?>][CODE_BARRE]" id="mbc[<?php echo $i; ?>][CODE_BARRE]" value="<?php echo $ligne['CODE_BARRE']; ?>"></div></div>
						<div class="col-sm-2"><div class="controls"><input type="text" class="form-control" name="mbc[<?php echo $i; ?>][SAC_COMMENTAIRE]" id="mbc[<?php echo $i; ?>][SAC_COMMENTAIRE]" value="<?php echo $ligne['SAC_COMMENTAIRE']; ?>"></div></div>
						<div class="col-sm-1"><div class="btn btn-md btn-info add_sac" style="height:33px" id="<?php echo $ligne['ID_MARQUE_BILLES_CONDITIONNEMENT'] ?>" ><i class="glyphicon glyphicon-plus" style="vertical-align:middle"></i></div></div>
					</div>
<?php $i++; } ?>
				</div>
			</strong>
			</br>
			<div class="row" style="text-align:center">
				<div class=" h-margin-normal" 	align="center">
					<button class="btn btn-lg btn-warning " type="submit"><?php echo $lib_update_bille_10; /* a mettre à jour */?></button>
					<a class="btn btn-lg btn-warning " href="detail.php?id=<?php echo $bille['ID_BILLES']; ?>"><?php echo $lib_update_bille_20; ?></a>
				</div>
			</div>
		</form>
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

	<script> // REFRESH LISTE SACHETS

		function modifieSachets(){
			var tag_container=document.getElementById('container_ligne');
			var id_bille = document.getElementById('bille').value;
			var login = document.getElementById('login').value;
//			while(tag_container.hasChildNodes()) tag_container.removeChild(tag_container.lastChild); // innerHTML non adapté dans ce cas
			var jqxhr = $.getJSON("get_json_liste_sachets.php?id="+id_bille+"&login="+login, function(json){
			})
			.done(function( json ) {
				var i=0;
				var ligne = '';
				while ( i<json.length ) {
					var marque = ( json[i][1] != null ? json[i][1] : "" );
					var commentaire_marque_bille = ( json[i][6] != null ? json[i][6] : "" );
					var nom = ( json[i][5] != null ? json[i][5] : "" );
					var id_marque_billes = ( json[i][0] != null ? json[i][0] : "" );
					var id_marque_billes_conditionnement = ( json[i][8] != null ? json[i][8] : "" );
					var id_sac_marque_billes_conditionnement = ( json[i][12] != null ? json[i][12] : "" );
					var nombre = ( json[i][9] != null ? json[i][9] : "" );
					var code_barre = ( json[i][10] != null ? json[i][10] : "" );
					var sac_commentaire = ( json[i][11] != null ? json[i][11] : "" );
					ligne += '<div id="container_ligne">';
					ligne += '<div class="row" style="vertical-align:middle"><div class="page-list-lining"></div>';
					
					ligne += '<div class="col-sm-1 marque">'+marque+'</div>';
					ligne += '<div class="col-sm-2 marque_bille">'+commentaire_marque_bille+'</div>';
					ligne += '<div class="col-sm-2 nom">'+nom+'</div>';
					ligne += '<input type="hidden" id="mbc['+i+'][id_mb]" name="mbc['+i+'][id_mb]" value="'+id_marque_billes+'">';
					ligne += '<input type="hidden" id="mbc['+i+'][id_mbc]" name="mbc['+i+'][id_mbc]" value="'+id_marque_billes_conditionnement+'">';
					ligne += '<input type="hidden" class="mbc" id="mbc['+i+'][id_smbc]" name="mbc['+i+'][id_smbc]" value="'+id_sac_marque_billes_conditionnement+'">';
					ligne += '<div class="col-sm-1" align="center"><div class="controls"><input type="text" class="form-control nombre" name="mbc['+i+'][NOMBRE]" id="mbc['+i+'][NOMBRE]" value="'+nombre+'"></div></div>';
					ligne += '<div class="col-sm-2"><div class="controls"><input type="text" class="form-control" name="mbc['+i+'][CODE_BARRE]" id="mbc['+i+'][CODE_BARRE]" value="'+code_barre+'"></div></div>';
					ligne += '<div class="col-sm-3"><div class="controls"><input type="text" class="form-control" name="mbc['+i+'][SAC_COMMENTAIRE]" id="mbc['+i+'][SAC_COMMENTAIRE]" value="'+sac_commentaire+'"></div></div>';
					ligne += '<div class="col-sm-1"><div class="btn btn-md btn-info add_sac" style="height:33px" id="'+id_marque_billes_conditionnement+'" ><i class="glyphicon glyphicon-plus" style="vertical-align:middle"></i></div></div>';

					ligne += '</div>';

					i++;
				}
				$(tag_container).replaceWith(ligne);
				$('#container_ligne').on('click', '.add_sac', function(e) {
					var ligne_nombre = $(this).parent().siblings().children().children('.nombre').filter(":first").val();
					if (ligne_nombre > 0 ) {
						var mbc_to_add = this.id;
						var login = document.getElementById('login').value;
						var jqxhr = $.getJSON('/add_json_sachet.php?mbc='+mbc_to_add+'&login='+login, function(json){
						})
						.done(function( json ) {
								modifieSachets();
						})
						.fail(function( jqxhr, textStatus, error ) {
							var err = textStatus + ", " + error;
							swal({ title: "Erreur lors de l'ajout du sachet", text: err, imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
							console.log( "Request Failed: " + err );
						})
					}
					else {
						swal({
							title: "Inutile !",
							text: "Vous diposez déjà d'une ligne à compléter",
							imageUrl: "IMAGES/MAIN/LODEF/14.jpg",
							confirmButtonColor: "#DD6B55",
							timer: 2000
						});
					}
					e.preventDefault();
				});
			})
			.fail(function( jqxhr, textStatus, error ) {
				var err = textStatus + ", " + error;
				swal({ title: "Erreur lors de l'accès aux sachets", text: err, imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
				console.log( "Request Failed: " + err );
			})
		};
	</script>


	<script> // DROP SUR BOUTON POUBELLE DE AUTRES PHOTOS
		$(function (){
			$('#container_ligne').on('click', '.add_sac', function(e) {
					var ligne_nombre = $(this).parent().siblings().children().children('.nombre').filter(":first").val();
					if (ligne_nombre > 0 ) {
						var mbc_to_add = this.id;
/*						var label_msg = $(this).parent().siblings('.marque').filter(":first").text();
						label_msg += "/";
						label_msg += $(this).parent().siblings('.marque_bille').filter(":first").text();
						label_msg += "/";
						label_msg += $(this).parent().siblings('.nom').filter(":first").text();
*/
						var login = document.getElementById('login').value;
						var jqxhr = $.getJSON('/add_json_sachet.php?mbc='+mbc_to_add+'&login='+login, function(json){
						})
						.done(function( json ) {
								modifieSachets();
/*						swal({
							title: "OK",
							text: "Le sachet est ajouté",
							imageUrl: "IMAGES/MAIN/LODEF/14.jpg",
							confirmButtonColor: "#DD6B55",
							timer: 2000,
							type:"info"
						});*/
						})
						.fail(function( jqxhr, textStatus, error ) {
							var err = textStatus + ", " + error;
							swal({ title: "Erreur lors de l'ajout du sachet", text: err, imageUrl: "IMAGES/MAIN/LODEF/14.jpg" });
							console.log( "Request Failed: " + err );
						})
					}
					else {
						swal({
							title: "Inutile !",
							text: "Vous diposez déjà d'une ligne à compléter",
							imageUrl: "IMAGES/MAIN/LODEF/14.jpg",
							confirmButtonColor: "#DD6B55",
							timer: 2000
						});
					}
					e.preventDefault();
			});
		});
	</script>


</body>
</html>
