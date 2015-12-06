<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_critere_bille_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
	<link rel="stylesheet" href="dist/css/chosen.css">
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li>'.$crumb_criteria.'</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<main>
<div class="container">
	<!-- Texte haut de page -->
	<div class="row" align="center">
		<h3><?php echo $lib_critere_bille_90 ?></h3>
	</div>
		
	<form class="well" method="post" action="set_critere_bille.php">
		<input type="hidden" class="form-control" name="login" id="login" placeholder="<?php echo $login; ?>" >
		<div class="row">
		<div class="col-sm-2">
			<div class="col-sm-12"> <!-- CRITERE NOM -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_300; ?></h3>
					</div>
					<div class="panel-body">
						<div class="control-group">
							<label class="control-label" for="critere_nom"><?php echo $lib_critere_bille_310; ?></label>
							<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1020; ?>" >
								<input type="text" class="form-control" name="critere_nom" id="critere_nom" placeholder="<?php echo $lib_critere_bille_311; ?>" >
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12"> <!-- CRITERE MARQUES -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_500; ?></h3>
					</div>
					<div class="panel-body">
						<label class="control-label" for="critere_dispo_marque"><?php echo $lib_critere_bille_880; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1000; ?>" >
							<select multiple data-placeholder="Marques..." class="combo_chosen" name="critere_dispo_marque[]" id="critere_dispo_marque" style="width:100%; height:300px;" >
								<?php foreach($marques as $marque) { echo '<option>'.$marque['MARQUE'].'</option>'; } ?>
							</select>
						</div>
						<br/>
						<label class="control-label" for="critere_non_dispo_marque"><?php echo $lib_critere_bille_890; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1010; ?>" >
							<select multiple data-placeholder="Marques..." class="combo_chosen" name="critere_non_dispo_marque[]" id="critere_non_dispo_marque" style="width:100%; height:300px;" >
								<?php foreach($marques as $marque) { echo '<option>'.$marque['MARQUE'].'</option>'; } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<div class="col-sm-12"> <!-- CRITERE ANNEES -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_400; ?></h3>
					</div>
					<div class="panel-body">
						<div class="control-group">
							<label class="control-label" for="critere_app_avant"><?php echo $lib_critere_bille_410; ?></label>
							<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1030; ?>" >
								<input type="text" class="form-control" name="critere_app_avant" id="critere_app_avant" placeholder="<?php echo $lib_critere_bille_411; ?>" >
							</div>
						</div>
						<br/>
						<div class="control-group">
							<label class="control-label" for="critere_app_apres"><?php echo $lib_critere_bille_420; ?></label>
							<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1040; ?>" >
								<input type="text" class="form-control" name="critere_app_apres" id="critere_app_apres" placeholder="<?php echo $lib_critere_bille_421; ?>" >
							</div>
						</div>
						<br/>
						<div class="control-group">
							<label class="control-label" for="critere_disp_avant"><?php echo $lib_critere_bille_430; ?></label>
							<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1050; ?>" >
								<input type="text" class="form-control" name="critere_disp_avant" id="critere_disp_avant" placeholder="<?php echo $lib_critere_bille_431; ?>" >
							</div>
						</div>
						<br/>
						<div class="control-group">
							<label class="control-label" for="critere_disp_apres"><?php echo $lib_critere_bille_440; ?></label>
							<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1060; ?>" >
								<input type="text" class="form-control" name="critere_disp_apres" id="critere_disp_apres" placeholder="<?php echo $lib_critere_bille_441; ?>" >
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="col-sm-12"> <!-- CRITERE EXISTE TAILLE -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_10; ?></h3>
					</div>
					<div class="panel-body">
						<label class="control-label" for="critere_dispo_taille"><?php echo $lib_critere_bille_900; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1070; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_980; ?>" class="combo_chosen" name="critere_dispo_taille[]" id="critere_dispo_taille" style="width:100%; height:300px;" >
								<option>14mm</option>
								<option>16mm</option>
								<option>21mm</option>
								<option>25mm</option>
								<option>35mm</option>
								<option>42mm</option>
								<option>50mm</option>
							</select>
						</div>
						<br/>
						<label class="control-label" for="critere_non_dispo_taille"><?php echo $lib_critere_bille_910; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1080; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_980; ?>" class="combo_chosen" name="critere_non_dispo_taille[]" id="critere_non_dispo_taille" style="width:100%; height:300px;" >
								<option>14mm</option>
								<option>16mm</option>
								<option>21mm</option>
								<option>25mm</option>
								<option>35mm</option>
								<option>42mm</option>
								<option>50mm</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12"> <!-- CRITERE EXISTE HEADER -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_110; ?></h3>
					</div>
					<div class="panel-body">
						<label class="control-label" for="critere_dispo_conditionnement"><?php echo $lib_critere_bille_920; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1090; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_990; ?>" class="combo_chosen" name="critere_dispo_conditionnement[]" id="critere_dispo_conditionnement" style="width:100%; height:500px;" >
								<?php foreach($conditionnements as $conditionnement) { echo '<option>'.$conditionnement['NOM'].'</option>'; } ?>
							</select>
						</div>
						<br/>
						<label class="control-label" for="critere_non_dispo_conditionnement"><?php echo $lib_critere_bille_930; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1100; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_990; ?>" class="combo_chosen" name="critere_non_dispo_conditionnement[]" id="critere_non_dispo_conditionnement" style="width:100%; height:500px;" >
								<?php foreach($conditionnements as $conditionnement) { echo '<option>'.$conditionnement['NOM'].'</option>'; } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="col-sm-12"> <!-- CRITERE POSSEDE TAILLE -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_600; ?></h3>
					</div>
					<div class="panel-body">
						<label class="control-label" for="critere_possede_taille"><?php echo $lib_critere_bille_940; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1110; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_980; ?>" class="combo_chosen" name="critere_possede_taille[]" id="critere_possede_taille" style="width:100%; height:300px;" >
								<option>14mm</option>
								<option>16mm</option>
								<option>21mm</option>
								<option>25mm</option>
								<option>35mm</option>
								<option>42mm</option>
								<option>50mm</option>
							</select>
						</div>
						<br/>
						<label class="control-label" for="critere_non_possede_taille"><?php echo $lib_critere_bille_950; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1120; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_980; ?>" class="combo_chosen" name="critere_non_possede_taille[]" id="critere_non_possede_taille" style="width:100%; height:300px;" >
								<option>14mm</option>
								<option>16mm</option>
								<option>21mm</option>
								<option>25mm</option>
								<option>35mm</option>
								<option>42mm</option>
								<option>50mm</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-12"> <!-- CRITERE POSSEDE HEADER -->
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_critere_bille_700; ?></h3>
					</div>
					<div class="panel-body">
						<label class="control-label" for="critere_possede_conditionnement"><?php echo $lib_critere_bille_960; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1130; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_990; ?>" class="combo_chosen" name="critere_possede_conditionnement[]" id="critere_possede_conditionnement" style="width:100%; height:500px;" >
								<?php foreach($conditionnements as $conditionnement) { echo '<option>'.$conditionnement['NOM'].'</option>'; } ?>
							</select>
						</div>
						<br/>
						<label class="control-label" for="critere_non_possede_conditionnement"><?php echo $lib_critere_bille_970; ?></label>
						<div class="controls" rel="tooltip" data-placement="top" title="<?php echo $lib_critere_bille_1140; ?>" >
							<select multiple data-placeholder="<?php echo $lib_critere_bille_990; ?>" class="combo_chosen" name="critere_non_possede_conditionnement[]" id="critere_non_possede_conditionnement" style="width:100%; height:500px;" >
								<?php foreach($conditionnements as $conditionnement) { echo '<option>'.$conditionnement['NOM'].'</option>'; } ?>
							</select>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div align="center">
					<button class="btn btn-lg btn-warning " type="submit"><?php echo $lib_critere_bille_91; /* a mettre à jour */?></button>
					<a class="btn btn-lg btn-warning " href="liste_billes.php"><?php echo $lib_critere_bille_92; ?></a>
				</div>
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
	<script src="dist/js/blueimp-gallery.min.js"></script>
    <script src="dist/js/chosen.jquery.js"></script>
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
	$('.controls').tooltip({delay: { "show": 100, "hide": 300 } });
	$(".combo_chosen").chosen();
});

</script>
</body>
</html>
