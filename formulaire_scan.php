<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>TITRE</title>
		<?php include('MODELE/common_header_include.php'); ?>
		<link rel="stylesheet" href="dist/css/typeahead.css"> <!-- TYPEAHEAD CSS -->
		<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
		<link rel="stylesheet" href="dist/css/examples.css">
	</head>
	<body>
<!-- Texte haut de page -->
		<?php include_once('UTILS/common_sql.php'); ?>
		<?php include_once('MODELE/BILLES/get_billes.php'); ?>
		<?php include_once('MODELE/BILLES/get_bille.php'); ?>
		<?php include('json_get_billes.php'); ?>
		<div class="container">
			<div class="bg-warning" align="center"><p class="bg-primary"><h2><?php echo $code; ?></h2></p></div>
			<form class="form-horizontal brown-style" id="code" name="code_form" method="post" action="/scan.php">
				<input type="hidden" id="code" name="code" value="<?php echo $code; ?>">
				<?php if ($flag_existing_codes) { ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading small-padding">
								<h3 class="panel-title small-heading">SCANS EXISTANT</h3>
							</div>
							<div class="panel-body">
								<div class="control-group">
									<label class="control-label" for="input_existing">LISTE EXISTANT A SELECTIONNER</label>
									<div class="controls">
										<select class="form-control" name="input_existing" id="input_existing" >
											<option value="0" selected>NE PAS UTILISER ANCIEN SCAN</option>
											<?php foreach($existing_codes as $c) { echo '<option value="'.$c['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'].'">'.$c['ID_SAC_MARQUE_BILLES_CONDITIONNEMENT'].'|'.$c['CODE_BARRE'].'|'.$c['NOM_BILLE'].'|'.$c['MARQUE'].'|'.$c['NOM'].'</option>'; } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="panel panel-success">
							<div class="panel-heading small-padding">
								<h3 class="panel-title small-heading">COMMENTAIRE SUR LE SAC</h3>
							</div>
							<div class="panel-body">
								<div class="control-group">
									<div class="controls">
										<input type="text" class="form-control" name="input_comment" id="input_comment" placeholder="Entrez un commentaire..." value="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				<div class="row">
					<div class="col-xs-6">
						<div class="col-xs-12">
							<div class="panel panel-success">
								<div class="panel-heading small-padding">
									<h3 class="panel-title small-heading">TYPE DE BILLE</h3>
								</div>
								<div class="panel-body">
									<div class="control-group">
										<label class="control-label" for="input_nom_bille">NOM DU TYPE DE BILLE</label>
										<div class="controls">
											<input id="input_nom_bille" name="input_nom_bille" class="typeahead" type="text" placeholder="bille..." style="width:100%">
											<!--<input id="hidden_tags" name="input_nom_bille" class="typeahead" type="hidden">-->
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="panel panel-success">
								<div class="panel-heading small-padding">
									<h3 class="panel-title small-heading">NOMBRE</h3>
								</div>
								<div class="panel-body">
									<div class="control-group">
										<label class="control-label" for="input_nombre_bille">NOMBRE DE SACHETS</label>
										<div class="controls">
											<input id="input_nombre" name="input_nombre" type="text" style="width:100%" value="1">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="panel panel-success">
								<div class="panel-heading small-padding">
									<h3 class="panel-title small-heading">MARQUE</h3>
								</div>
								<div class="panel-body">
									<div class="control-group">
										<label class="control-label" for="input_conditionnement">MARQUE</label>
										<div class="controls">
											<?php $mymarques = get_list('SELECT * FROM marques'); foreach($mymarques as $c) {
											echo '<label class="radio"><input type="radio" name="id_marque" id="id_marque" value="'.$c['ID_MARQUE'].'"> '.$c['MARQUE'].'</label>'; } 
											?>
										</div>
										<br/>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="form-actions" align="center">
								<div class="control-group valid" align="center">
									<button class="btn btn-warning " type="submit"><?php echo 'MAJ'; ?></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="panel panel-success">
							<div class="panel-heading small-padding">
								<h3 class="panel-title small-heading">CONDITIONNEMENT</h3>
							</div>
							<div class="panel-body">
								<div class="control-group">
									<label class="control-label" for="input_conditionnement">CONDITIONNEMENT</label>
									<div class="controls">
										<?php $mesconditionnements = get_conditionnements($sql_get_conditionnements); foreach($mesconditionnements as $c) {
										echo '<label class="radio"><input type="radio" name="id_conditionnement" id="id_conditionnement" value="'.$c['ID_CONDITIONNEMENT'].'"> '.$c['NOM'].'</label>'; } 
										?>
									</div>
									<br/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="dist/js/jquery-1.11.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="dist/js/bootstrap.min.js"></script>
		<script src="dist/js/typeahead.bundle.js"></script>
		<script src="dist/js/handlebars.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {
				var billes = new Bloodhound({
					datumTokenizer: function(d) { 
						return Bloodhound.tokenizers.whitespace(d.val); 
					},
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					limit: 20,
					local: <?php echo get_json_billes(); ?>
				});
// kicks off the loading/processing of `local` and `prefetch`
				billes.initialize();
				
				$('#input_nom_bille').typeahead({
					highlight: true
				},
				{
					name: 'billes',
					displayKey: 'val',
					source: billes.ttAdapter(),
					templates: {
						suggestion: Handlebars.compile('<div style="height:25px; vertical-align:middle"><img src="IMAGES/MAIN/THUMBNAIL/{{picture}}.jpg" alt="tags" style="height:25px; margin-right:10px " /><strong>{{val}}</strong></div>')
					}
				}				
				);
			});
		</script>
	</body>
</html>

