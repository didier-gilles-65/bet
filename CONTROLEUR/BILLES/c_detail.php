<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/BILLES/get_billes.php');

if ( !isset($login) ) { $login=''; }

$bille = get_bille($sql_detail_bille, $id);
$photos = get_photos($sql_list_labels, $id);
$autres_photos = get_photos($sql_list_autres_photos, $id);
// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
$owned_bille = get_owned_bille($sql_owned_bille_for_login, $login, $id);
// $conditionnements = get_list_by_id($sql_conditionnements_bille, $id);
$liste_conditionnements = get_liste_inventaire_pour_bille($sql_liste_marque_conditionnement_bille, $login, $id);
$sizes = get_sizes_for_id($sql_get_sizes_for_id, $id);
foreach($bille as $cle => $mabille)
{
    $bille['ID_BILLES'] = htmlspecialchars($bille['ID_BILLES']);
    $bille['NOM'] = htmlspecialchars($bille['NOM']);
//    $bille['MARQUE'] = htmlspecialchars($bille['MARQUE']);
//	$bille['ANNEE APPARITION'] = htmlspecialchars($bille['ANNEE APPARITION']);
//	$bille['ANNEE DISPARITION'] = htmlspecialchars($bille['ANNEE DISPARITION']);
//	$bille['POSSEDE'] = htmlspecialchars($bille['POSSEDE']);
}
// On affiche la page (vue)
include_once('VUE/BILLES/v_detail.php');

