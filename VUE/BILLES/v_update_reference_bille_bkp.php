<?php if (!isset($id)) { header('Location: /index.php?err=2000'); exit(); }; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_update_reference_bille_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
	<link rel="stylesheet" href="dist/css/chosen.css">
</head>
<body>
<?php
	$breadcrumb = '<ul><li><a href="index.php">'.$crumb_home.'</a></li><li><a href="liste_billes.php">'.$crumb_liste.'</a></li><li><a href="detail.php?id='.$id.'">'.$crumb_detail.'</a></li><li>'.$crumb_update_marble.' ('.$bille['NOM'].')</li></ul>';
	include('VUE/BILLES/modal-apropos.php');
	include('VUE/BILLES/nav-bar-template.php');
?>
<?php
function in_array_column($text, $column, $array)
{
    if (!empty($array) && is_array($array))
    {
        for ($i=0; $i < count($array); $i++)
        {
            if ($array[$i][$column]==$text || strcmp($array[$i][$column],$text)==0) return true;
        }
    }
    return false;
}
?>
<div class="container">
	<!-- Texte haut de page -->
	<form method="post" action="set_update_reference_bille.php"> 
		<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-condensed table-striped table-hover" style="font-size:80%;"name="tableau_marques">
					<tr class="success"><td  WIDTH=3% align="center"><strong><?php echo $lib_div_1010 ?></strong></td><td align="center"><strong><?php echo $lib_update_reference_bille_90; ?></strong></td><td align="center"><strong><?php echo $lib_update_reference_bille_30; ?></strong></td><td align="center"><strong><?php echo $lib_update_reference_bille_50; ?></strong></td><td align="center"><strong><?php echo $lib_div_1040; ?></strong></td><td align="center"><strong><?php echo $lib_div_1020; ?></strong></td><td/></tr>
<?php
$i=0;
$ListeConditionnements = get_conditionnements($sql_get_conditionnements);

					foreach($liste_complete_marque as $mymarque)
					{
						echo '<input type="hidden" id="marques['.$i.'][marque]" name="marques['.$i.'][marque]" value="'.$mymarque['MARQUE'].'">';
						echo '<input type="hidden" id="marques['.$i.'][id_marque]" name="marques['.$i.'][id_marque]" value="'.$mymarque['ID_MARQUE'].'">';
						echo '<input type="hidden" id="marques['.$i.'][id_marque_bille]" name="marques['.$i.'][id_marque_bille]" value="'.$mymarque['ID_MARQUE_BILLES'].'">';
						echo '<tr>';
						echo '<td align="center"><input class="checkbox_inline" type="checkbox" id="marques['.$i.'][EXISTE]" name="marques['.$i.'][EXISTE]" value="true" ';
						if ($mymarque['ID_MARQUE_BILLES'] > 0) { echo 'checked = "checked"><input type="hidden" id="marques['.$i.'][initial]" name="marques['.$i.'][initial]" value="true">';} else {echo '><input type="hidden" id="marques['.$i.'][initial]" name="marques['.$i.'][initial]" value="false">';}
						echo '</td><td align="center">'.$mymarque['MARQUE'].'</td>'; // Marque
						echo '<td align="center"><input type="text" id="marques['.$i.'][apparition]" name="marques['.$i.'][apparition]" value="'.$mymarque['ANNEE_APPARITION'].'"></td>'; //année apparition
						echo '<td align="center"><input type="text" id="marques['.$i.'][disparition]" name="marques['.$i.'][disparition]" value="'.$mymarque['ANNEE_DISPARITION'].'"></td>'; //annéee disparition
						echo '<td align="center"><input type="text" id="marques['.$i.'][commentaire]" name="marques['.$i.'][commentaire]" value="'.$mymarque['COMMENTAIRE_MARQUE_BILLE'].'"></td>'; //commentaire
						echo '<td align="center">';
//ecrireLog('SQL', 'INFO', 'V_UPDATE_REFERENCE_BILLES.PHP| $mymarque = '.print_r($mymarque,true));
						$MesConditionnements = get_conditionnements_by_marque_id($sql_get_conditionnements_marque_id, $mymarque['ID_MARQUE_BILLES'] );
						echo '<select multiple data-placeholder="'.$lib_div_1030.$mymarque['MARQUE'].'..." class="MyList" name="marques['.$i.'][conditionnement][]" id="marques['.$i.'][conditionnement][]" >';
							foreach($ListeConditionnements as $conditionnement) { 
								echo '<option value="'.$conditionnement['ID_CONDITIONNEMENT'].'"';
								if (in_array_column($conditionnement['NOM'], 'NOM',$MesConditionnements)) { echo ' selected '; } echo '>'.$conditionnement['NOM'].'</option>';
							}
						echo '</select>';
						echo '</td>'; // conditionnements
						echo '<td align="center"><a href="add_marque_bille.php?id_bille='.$id.'&id_marque='.$mymarque['ID_MARQUE'].'"><img src="IMAGES/add-marque.png" class="add-marque" style="height:22px;"/></a></td>'; //bouton d'ajout d'un nouvel enregistrement marque_bille
						echo '</tr>';
						$i++;
					}
?>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_70; ?></h3>
					</div>
					<div class="panel-body">
						<input type="text" class="form-control" name="input_nom" id="input_nom" placeholder="<?php echo $lib_update_reference_bille_80; ?>" value="<?php echo $bille['NOM']; ?>">
					</div>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_145; ?></h3>
					</div>
					<div class="panel-body">
					<?php $mesSynonymes = get_billes_apparentees_by_id($sql_get_billes_apparentees, $id);?>
								<select multiple data-placeholder="<?php echo $lib_div_1000 ?>" class="MyList" name="input_synonyme[]" id="input_synonyme" style="width:100%">
									<?php $mesbilles = get_option_billes(); ?>
									<?php foreach($mesbilles as $mabille) { echo '<option';
										if (in_array_column($mabille['val'], 'NOM',$mesSynonymes)) { echo ' selected '; } echo '>'.$mabille['val'].'</option>'; } ?>
								</select>
					</div>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_390; ?></h3>
					</div>
					<div class="panel-body">
							<label class="inline" style="padding-right:40px"><?php echo $lib_update_reference_bille_400; ?>
								<input type="checkbox" id="input_base_frittee" name="input_base_frittee" value="true" <?php if ($bille['BASE_FRITTEE'] == '1') { echo 'checked = "checked"';} else {echo '';} ?>>
							</label>
							<label class="inline" style="padding-right:40px"><?php echo $lib_update_reference_bille_410; ?>
								<input type="checkbox" id="input_base_irisee" name="input_base_irisee" value="true" <?php if ($bille['BASE_IRISEE'] == '1') { echo 'checked = "checked"';} else {echo '';} ?>>
							</label>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_420; ?></h3>
					</div>
					<div class="panel-body">
						<div class="control-group">
							<label class="control-label" for="input_base_couleur"><?php echo $lib_update_reference_bille_360; ?></label>
							<div class="controls">
								<input type="text" class="form-control" name="input_base_couleur" id="input_base_couleur" placeholder="<?php echo $lib_update_reference_bille_370; ?>" value="<?php echo $bille['BASE_COULEUR']; ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_base_type"><?php echo $lib_update_reference_bille_380; ?></label>
							<div class="controls">
								<select class="form-control" name="input_base_type">
									<option value="OPAQUE"<?php if ($bille['BASE_TYPE'] == 'OPAQUE') {echo ' selected';} ?>>OPAQUE</option>
									<option value="TRANSPARENT"<?php if ($bille['BASE_TYPE'] == 'TRANSPARENT') {echo ' selected';} ?>>TRANSPARENT</option>
									<option value="TERRE"<?php if ($bille['BASE_TYPE'] == 'TERRE') {echo ' selected';} ?>>TERRE</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_motif_couleur"><?php echo $lib_update_reference_bille_420; ?></label>
							<div class="controls">
									<input type="text" class="form-control" name="input_motif_couleur" id="input_motif_couleur" placeholder="<?php echo $lib_update_reference_bille_430; ?>" value="<?php echo $bille['MOTIF_COULEUR']; ?>">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_motif_type"><?php echo $lib_update_reference_bille_440; ?></label>
							<div class="controls">
								<select class="form-control" name="input_motif_type">
									<option value="TACHES"<?php if ($bille['MOTIF_TYPE'] == 'TACHES') {echo ' selected';} ?>>TACHES</option>
									<option value="TOURBILLON"<?php if ($bille['MOTIF_TYPE'] == 'TOURBILLON') {echo ' selected';} ?>>TOURBILLON</option>
									<option value="PATCHE"<?php if ($bille['MOTIF_TYPE'] == 'PATCHE') {echo ' selected';} ?>>PATCHE</option>
									<option value="HELICE"<?php if ($bille['MOTIF_TYPE'] == 'HELICE') {echo ' selected';} ?>>HELICE</option>
									<option value="RUBAN"<?php if ($bille['MOTIF_TYPE'] == 'RUBAN') {echo ' selected';} ?>>RUBAN</option>
									<option value="FRITAGE"<?php if ($bille['MOTIF_TYPE'] == 'FRITAGE') {echo ' selected';} ?>>FRITAGE</option>
									<option value="AUTRE"<?php if ($bille['MOTIF_TYPE'] == 'AUTRE') {echo ' selected';} ?>>AUTRE</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_110; ?></h3>
					</div>
					<div class="panel-body">
						<div class="control-group">
							<div class="controls">
								<textarea id="input_description" name="input_description" rows="3" style="width:100%" placeholder="<?php echo $lib_update_reference_bille_120; ?>"><?php echo $bille['DESCRIPTION']; ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-success">
					<div class="panel-heading small-padding">
						<h3 class="panel-title small-heading"><?php echo $lib_update_reference_bille_130; ?></h3>
					</div>
					<div class="panel-body">
						<div class="control-group">
							<div class="controls">
								<textarea id="input_description_anglaise" name="input_description_anglaise" rows="3" style="width:100%" placeholder="<?php echo $lib_update_reference_bille_140; ?>"><?php echo $bille['DESCRIPTION_ANGLAISE']; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div align="center">
					<button class="btn btn-lg btn-warning " type="submit"><?php echo $lib_update_bille_10; /* a mettre à jour */?></button>
					<a class="btn btn-lg btn-warning " href="detail.php?id=<?php echo $id; ?>"><?php echo $lib_update_bille_20; ?></a>
				</div>
			</div>
		</div>
	</form>	
</div>
<?php
    include_once('VUE/BILLES/footer-template.php');
?>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/jquery-1.11.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/chosen.jquery.js"></script>
	<script src="dist/js/jquery.blueimp-gallery.min.js"></script>
	<script src="dist/js/blueimp-gallery.min.js"></script>
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
	$(".MyList").chosen();
});

</script>
</body>
</html>
