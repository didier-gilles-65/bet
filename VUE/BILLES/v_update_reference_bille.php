<?php if (!isset($id)) { header('Location: /index.php?err=2000'); exit(); }; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $lib_update_reference_bille_05; ?></title>
	<?php include('MODELE/common_header_include.php'); ?>
	<link rel="stylesheet" href="VUE/BILLES/style.css"> <!-- Feuille de style perso -->
	<link rel="stylesheet" href="dist/css/chosen.css">
	<link rel="stylesheet" type="text/css" href="dist/css/sweet-alert.css">
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
	<div class="row h-padding-normal"></div>
	<form method="post" action="set_update_reference_bille.php"> <!-- BARRE IMAGE PRINCIPALE -->
		<input type="hidden" id="bille" name="bille" value="<?php echo $id; ?>">
		<table id="table_marque" class="table table-condensed table-striped" style="font-size:100%;" name="tableau_marques">
			<colgroup>
				<col width=10%>
				<col width=5%>
				<col width=5%>
				<col width=10%>
				<col width=70%>
			</colgroup>
			<tbody>
				<tr><td align="center"><strong><?php echo $lib_update_reference_bille_90; ?></strong></td><td align="center"><strong><?php echo $lib_update_reference_bille_30; ?></strong></td><td align="center"><strong><?php echo $lib_update_reference_bille_50; ?></strong></td><td align="center"><strong><?php echo $lib_div_1040; ?></strong></td><td align="center"><strong><?php echo $lib_div_1020; ?></strong></td><td/></tr>
<?php
$i=0;
$ListeConditionnements = get_conditionnements($sql_get_conditionnements);
					foreach($liste_complete_marque as $mymarque)
					{
					if ($mymarque['ID_MARQUE_BILLES'] > 0) {
						echo '<tr>';
						echo '<td align="center">';
						echo '<input type="hidden" class="i_existe" id="marques['.$i.'][EXISTE]" name="marques['.$i.'][EXISTE]" value="true">';
						echo '<input type="hidden" class="i_initial" id="marques['.$i.'][initial]" name="marques['.$i.'][initial]" value="true">';
						echo '<input type="hidden" id="marques['.$i.'][marque]" name="marques['.$i.'][marque]" value="'.$mymarque['MARQUE'].'">';
						echo '<input type="hidden" id="marques['.$i.'][id_marque]" name="marques['.$i.'][id_marque]" value="'.$mymarque['ID_MARQUE'].'">';
						echo '<input type="hidden" id="marques['.$i.'][id_marque_bille]" name="marques['.$i.'][id_marque_bille]" value="'.$mymarque['ID_MARQUE_BILLES'].'">';
						echo $mymarque['MARQUE'].'</td>'; // Marque
						echo '<td align="center"><input size="4" type="text" id="marques['.$i.'][apparition]" name="marques['.$i.'][apparition]" value="'.$mymarque['ANNEE_APPARITION'].'"></td>'; //année apparition
						echo '<td align="center"><input size="4" type="text" id="marques['.$i.'][disparition]" name="marques['.$i.'][disparition]" value="'.$mymarque['ANNEE_DISPARITION'].'"></td>'; //annéee disparition
						echo '<td align="center"><input type="text" id="marques['.$i.'][commentaire]" name="marques['.$i.'][commentaire]" value="'.$mymarque['COMMENTAIRE_MARQUE_BILLE'].'"></td>'; //commentaire
						echo '<td align="center">';
						$select_conditionnements = false;
						$MesConditionnements = get_conditionnements_by_marque_id($sql_get_conditionnements_marque_id, $mymarque['ID_MARQUE_BILLES'] );
						echo '<select multiple style="width:100%" data-placeholder="'.$lib_div_1030.$mymarque['MARQUE'].'..." class="MyList" name="marques['.$i.'][conditionnement][]" id="marques['.$i.'][conditionnement][]" >';
							foreach($ListeConditionnements as $conditionnement) { 
								echo '<option value="'.$conditionnement['ID_CONDITIONNEMENT'].'"';
								if (in_array_column($conditionnement['NOM'], 'NOM',$MesConditionnements)) { echo ' selected '; $select_conditionnements = true;} echo '>'.$conditionnement['NOM'].'</option>';
							}
						echo '</select>';
						echo '</td>'; // conditionnements
						echo '<td align="center">';
						if (($mymarque['ID_MARQUE_BILLES'] > 0) && !$select_conditionnements) { echo '<ul class="pagination pagination-sm" style="margin-bottom:5px;margin-top:5px;"><li><a id="'.$mymarque['ID_MARQUE_BILLES'].'" name="REMOVE_MARQUE_BILLE"><i class="glyphicon glyphicon-trash" style="height:16px"></i>Supprimer</a></li></ul>';}
						echo '</td>'; // boutons de suppression
						echo '</tr>';
						$i++;
					}
					}
?>
			</tbody>
		</table>
		<input type="hidden" id="indice_derniere_ligne_tableau" value="<?php echo $i ;?>">
		<div class="h-padding-normal" align="center">
			<select id="input_marque" style="height:100px; width:80px">
				<option value="0" >Ajouter une marque...</option>
<?php
		foreach($marques as $marque) { 
			echo '<option value="'.$marque['ID_MARQUE'].'" >'.$marque['MARQUE'].'</option>';
		}
?>
			</select>
		</div>
			<div class="col-sm-2">
				<label class="full-line"><?php echo $lib_update_reference_bille_70; ?>
					<input type="text" class="form-control" name="input_nom" id="input_nom" placeholder="<?php echo $lib_update_reference_bille_80; ?>" value="<?php echo $bille['NOM']; ?>">
				</label>
				<label class="full-line"><?php echo $lib_update_reference_bille_145; ?>
					<?php $mesSynonymes = get_billes_apparentees_by_id($sql_get_billes_apparentees, $id);?>
								<select multiple data-placeholder="<?php echo $lib_div_1000 ?>" class="MyList" name="input_synonyme[]" id="input_synonyme" style="width:100%">
									<?php $mesbilles = get_option_billes(); ?>
									<?php foreach($mesbilles as $mabille) { echo '<option';
										if (in_array_column($mabille['val'], 'NOM',$mesSynonymes)) { echo ' selected '; } echo '>'.$mabille['val'].'</option>'; } ?>
								</select>
				</label>
				<label class="full-line"><?php echo $lib_update_reference_bille_400; ?>
					<input type="checkbox" id="input_base_frittee" name="input_base_frittee" value="true" <?php if ($bille['BASE_FRITTEE'] == '1') { echo 'checked = "checked"';} else {echo '';} ?>>
				</label>
				<label class="full-line"><?php echo $lib_update_reference_bille_410; ?>
					<input type="checkbox" id="input_base_irisee" name="input_base_irisee" value="true" <?php if ($bille['BASE_IRISEE'] == '1') { echo 'checked = "checked"';} else {echo '';} ?>>
				</label>
				<label class="full-line"><?php echo $lib_update_reference_bille_415; ?>
					<input type="checkbox" id="input_base_givree" name="input_base_givree" value="true" <?php if ($bille['BASE_GIVREE'] == '1') { echo 'checked = "checked"';} else {echo '';} ?>>
				</label>
			</div>
			<div class="col-sm-5">
				<label class="full-line"><?php echo $lib_update_reference_bille_110; ?>
					<textarea id="input_description" name="input_description" rows="3" style="width:100%; resize:vertical" placeholder="<?php echo $lib_update_reference_bille_120; ?>"><?php echo $bille['DESCRIPTION']; ?></textarea>
				</label>
			</div>
			<div class="col-sm-5">
				<label class="full-line"><?php echo $lib_update_reference_bille_130; ?>
					<textarea id="input_description_anglaise" name="input_description_anglaise" rows="3" style="width:100%; resize:vertical" placeholder="<?php echo $lib_update_reference_bille_140; ?>"><?php echo $bille['DESCRIPTION_ANGLAISE']; ?></textarea>
				</label>
			</div>
			<div class="col-sm-3">
				<label class="full-line"><?php echo $lib_update_reference_bille_360; ?>
					<input type="text" class="form-control" style="width:100%" name="input_base_couleur" id="input_base_couleur" placeholder="<?php echo $lib_update_reference_bille_370; ?>" value="<?php echo $bille['BASE_COULEUR']; ?>">
				</label>
			</div>
			<div class="col-sm-2">
				<label class="full-line"><?php echo $lib_update_reference_bille_380; ?>
					<select class="form-control" name="input_base_type">
						<option value="OPAQUE"<?php if ($bille['BASE_TYPE'] == 'OPAQUE') {echo ' selected';} ?>>OPAQUE</option>
						<option value="TRANSPARENT"<?php if ($bille['BASE_TYPE'] == 'TRANSPARENT') {echo ' selected';} ?>>TRANSPARENT</option>
						<option value="TERRE"<?php if ($bille['BASE_TYPE'] == 'TERRE') {echo ' selected';} ?>>TERRE</option>
					</select>
				</label>
			</div>
			<div class="col-sm-3">
				<label class="full-line"><?php echo $lib_update_reference_bille_420; ?>
					<input type="text" class="form-control" name="input_motif_couleur" id="input_motif_couleur" placeholder="<?php echo $lib_update_reference_bille_430; ?>" value="<?php echo $bille['MOTIF_COULEUR']; ?>">
				</label>
			</div>
			<div class="col-sm-2">
				<label class="full-line"><?php echo $lib_update_reference_bille_440; ?>
					<select class="form-control" name="input_motif_type">
						<option value="TACHES"<?php if ($bille['MOTIF_TYPE'] == 'TACHES') {echo ' selected';} ?>>TACHES</option>
						<option value="TOURBILLON"<?php if ($bille['MOTIF_TYPE'] == 'TOURBILLON') {echo ' selected';} ?>>TOURBILLON</option>
						<option value="PATCHE"<?php if ($bille['MOTIF_TYPE'] == 'PATCHE') {echo ' selected';} ?>>PATCHE</option>
						<option value="HELICE"<?php if ($bille['MOTIF_TYPE'] == 'HELICE') {echo ' selected';} ?>>HELICE</option>
						<option value="RUBAN"<?php if ($bille['MOTIF_TYPE'] == 'RUBAN') {echo ' selected';} ?>>RUBAN</option>
						<option value="FRITAGE"<?php if ($bille['MOTIF_TYPE'] == 'FRITAGE') {echo ' selected';} ?>>FRITAGE</option>
						<option value="MERIDIEN"<?php if ($bille['MOTIF_TYPE'] == 'MERIDIEN') {echo ' selected';} ?>>MERIDIEN</option>
						<option value="SANS"<?php if ($bille['MOTIF_TYPE'] == 'SANS') {echo ' selected';} ?>>SANS</option>
						<option value="AUTRE"<?php if ($bille['MOTIF_TYPE'] == 'AUTRE') {echo ' selected';} ?>>AUTRE</option>
					</select>
				</label>
			</div>
			
		<div class="col-sm-12 h-padding-normal" align="center">
			<button class="btn btn-lg btn-warning " type="submit"><?php echo $lib_update_bille_10; /* a mettre à jour */?></button>
			<a class="btn btn-lg btn-warning " href="detail.php?id=<?php echo $id; ?>"><?php echo $lib_update_bille_20; ?></a>
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
	<script src="dist/js/sweet-alert.min.js"></script>
	<script src="dist/js/jquery.ddslick.js"></script>
	<link rel="stylesheet" href="dist/css/BreadCrumb.css" type="text/css">
	<script src="dist/js/jquery.easing.1.3.js" type="text/javascript" language="JavaScript"></script>
	<script src="dist/js/jquery.jBreadCrumb.1.1.js" type="text/javascript" language="JavaScript"></script>

	<script>
		$(document).ready(function(){
	         $('#breadcrumb').jBreadCrumb();
		});
$(function(){
	$('[name="REMOVE_MARQUE_BILLE"]').on({ // GESTION DE L'EFFACEMENT D'UNE LIGNE DU TABLEAU DES MARQUES DECLAREES POUR LA BILLE COURANTE
		click: function(e) {
			var my_button = this;
			swal({
				title: "CONFIRMATION",
				text: "Confirmer Suppression ?",
				showCancelButton: true,
				imageUrl: "IMAGES/MAIN/LODEF/14.jpg",
				confirmButtonColor: "#DD6B55",
				closeOnCancel: false,							
				cancelButtonText: "Annuler",
				closeOnConfirm: true,
				confirmButtonText: "Continuer"
			},
			function(isConfirm){   
				if (isConfirm) {
					if ($(my_button).closest('tr').children('td').children('input').filter('.i_initial').val() == "false") {
						$(my_button).closest("tr").fadeOut(1000).timeout(1000).remove(); 
					} else { 
						$(my_button).closest('tr').children('td').children('input').filter('.i_existe').val("false");
						$(my_button).closest("tr").fadeOut(1000);
					}
				} 
				else {
					swal("Annulé", "La ligne est conservée", "error");   
				}
			});
			e.preventDefault();
		}
	});
});
	</script>
	
<script>

$(function (){
	$('a').tooltip();
	$(".MyList").chosen();
	$('#input_marque').ddslick({
		selectText: 'ff',
		onSelected: function(data){
			var combo = this;
			var id_marque = data.selectedData.value;
			if ( id_marque > 0 ) {
				var new_indice = $('#indice_derniere_ligne_tableau').val()*1+1;
				$('#indice_derniere_ligne_tableau').val(new_indice);
				
				var ligne_a_ajouter = '<tr>';
				ligne_a_ajouter += '<td align="center">';
				ligne_a_ajouter += '<input type="hidden" class="i_existe" id="marques['+new_indice+'][EXISTE]" name="marques['+new_indice+'][EXISTE]" value="true">';
				ligne_a_ajouter += '<input type="hidden" class="i_initial" id="marques['+new_indice+'][initial]" name="marques['+new_indice+'][initial]" value="false">';
				ligne_a_ajouter += '<input type="hidden" id="marques['+new_indice+'][marque]" name="marques['+new_indice+'][marque]" value="'+data.selectedData.text+'">';
				ligne_a_ajouter += '<input type="hidden" id="marques['+new_indice+'][id_marque]" name="marques['+new_indice+'][id_marque]" value="'+id_marque+'">';
				ligne_a_ajouter += '<input type="hidden" id="marques['+new_indice+'][id_marque_bille]" name="marques['+new_indice+'][id_marque_bille]" value="">';
				ligne_a_ajouter += data.selectedData.text+'</td>';
				ligne_a_ajouter += '<td align="center"><input type="text" id="marques['+new_indice+'][apparition]" name="marques['+new_indice+'][apparition]" value=""></td>'; //année apparition
				ligne_a_ajouter += '<td align="center"><input type="text" id="marques['+new_indice+'][disparition]" name="marques['+new_indice+'][disparition]" value=""></td>'; //annéee disparition
				ligne_a_ajouter += '<td align="center"><input type="text" id="marques['+new_indice+'][commentaire]" name="marques['+new_indice+'][commentaire]" value=""></td>'; //commentaire
				ligne_a_ajouter += '<td align="center">';
				ligne_a_ajouter += '<select multiple data-placeholder="Conditionnements pour '+data.selectedData.text+'..." class="MyList" name="marques['+new_indice+'][conditionnement][]" id="marques'+new_indice+'" >';
				ligne_a_ajouter += '<option value="13">COLLECTOR 2003</option><option value="14">COLLECTOR 2004</option><option value="15">COLLECTOR 2005</option><option value="16">COLLECTOR 2006</option><option value="17">COLLECTOR 2007</option><option value="18">COLLECTOR 2008</option><option value="19">COLLECTOR 2009</option><option value="20">COLLECTOR 2010</option><option value="21">COLLECTOR 2011</option><option value="22">COLLECTOR 2012</option><option value="23">COLLECTOR 2013</option><option value="42">COLLECTOR 2014</option><option value="54">DIVERS</option><option value="2">DON JUAN 20+1</option><option value="31">DON JUAN 2X42mm</option><option value="56">DON JUAN 2X50mm</option><option value="48">DON JUAN 3X35mm</option><option value="34">FABRICAS SELECTAS 20+1</option><option value="35">FABRICAS SELECTAS PATCH JAUNE 20+1</option><option value="46">MEGA CANADA 21+1</option><option value="6">MEGA ESPAGNE 20+1</option><option value="40">MEGA MARBLE JAUNE 2X42mm</option><option value="36">MEGA MARBLE JAUNE 35+1</option><option value="37">MEGA MARBLE JAUNE 6X25mm</option><option value="43">MEGA MARBLES 2013 24+1</option><option value="1">MEGA MARBLES 24+1</option><option value="51">MEGA MARBLES 2X42mm</option><option value="50">MEGA MARBLES 3X35mm</option><option value="52">MEGA MARBLES 6X25mm</option><option value="44">MEGA MARBLES BLASON 24+1</option><option value="12">MEGA MARBLES BLEU 24+1</option><option value="53">MEGA MARBLES BLEU 3X35mm</option><option value="8">MEGA MARBLES JAUNE 24+1</option><option value="11">MEGA MARBLES JAUNE 3X35mm</option><option value="41">MEGA MARBLES MAGENTA 24+1</option><option value="33">MEGA MARBLES OLD 24+1</option><option value="3">POTENTIER 20+1</option><option value="32">POTENTIER 2D 20+1</option><option value="5">POTENTIER 2X42mm</option><option value="47">POTENTIER 2X50mm</option><option value="9">QUALATEX 24+1</option><option value="10">QUALATEX 35+1</option><option value="49">QUALATEX 3X35mm</option><option value="39">SAC RUSTIC 40</option><option value="38">SAC SMILEY 20</option><option value="4">SHARP SHOOTER 20+1</option><option value="55">TOP NOTCH ROUND 24+1</option><option value="7">VACOR ESPAGNE 20+1</option><option value="45">VACOR MEXICO 20</option><option value="29">BILLES MANQUANTE</option><option value="30">CALOT MANQUANT</option><option value="27">DIVERS BILLES</option><option value="28">DIVERS CALOTS</option><option value="24">MEGA BOULDER MOON MARBLES</option><option value="25">TOYPOST SINGLE MARBLE</option><option value="26">TOYPOST SINGLE SHOOTER</option>';
				ligne_a_ajouter += '</select></td><td align="center"><ul class="pagination pagination-sm" style="margin-bottom:5px;margin-top:5px;"><li><a id="MM_'+new_indice+'" name="REMOVE_MARQUE_BILLE"><i class="glyphicon glyphicon-trash" style="height:16px"></i>Supprimer</a></li></ul></td>';
				ligne_a_ajouter += '</tr>';
				
				$('#table_marque > tbody:last').append(ligne_a_ajouter);
				$('#marques'+new_indice).chosen();
				$('#MM_'+new_indice).on({ // GESTION DE L'EFFACEMENT D'UNE LIGNE DU TABLEAU DES MARQUES DECLAREES POUR LA BILLE COURANTE
					click: function(e) {
						var my_button = this;
						swal({
							title: "CONFIRMATION",
							text: "Confirmer Suppression ?",
							showCancelButton: true,
							imageUrl: "IMAGES/MAIN/LODEF/14.jpg",
							confirmButtonColor: "#DD6B55",
							closeOnCancel: false,							
							cancelButtonText: "Annuler",
							closeOnConfirm: true,
							confirmButtonText: "Continuer"
						},
						function(isConfirm){   
							if (isConfirm) {
								if ($(my_button).closest(".i_initial").val() != "true") { $(my_button).closest("tr").fadeOut(1000).remove(); } else { $(my_button).closest(".i_existe").val("false"); $(my_button).closest("tr").fadeOut(1000); }
							} 
							else {
								swal("Annulé", "La ligne est conservée", "error");   
							}
						});
						e.preventDefault();
					}
				});
				$('#input_marque').ddslick('select', {index: 0 });
			}
		}
	});
});


</script>
</body>
</html>
