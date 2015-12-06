<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/BILLES/get_billes.php');
include_once('json_get_billes.php');

if ( !isset($login) ) { $login=''; }

//	$bille = get_reference_bille($sql_reference_bille, $id);
//	$liste_complete_marque = get_marques_id($sql_update_reference_liste_marques_complete, $id);

// On affiche la page (vue)
include_once('VUE/BILLES/v_update_photo_etiquette.php');

