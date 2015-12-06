<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/BILLES/get_billes.php');

if ( !isset($login) ) { $login=''; }

$bille = get_bille($sql_detail_bille, $id);
$photos_sac = get_photos_sac($sql_photos_sac, $id);
$photos = get_photos_conditionnement($sql_list_labels_conditionnement, $id, $conditionnement);
$mbc_existants = get_liste_sachets_pour_bille($sql_liste_sachets_marque_bille_conditionnement_pour_bille, $login, $id, $conditionnement);
//$return = ecrireLog('APP','INFO',$login); 

foreach($bille as $cle => $mabille)
{
    $bille['ID_BILLES'] = htmlspecialchars($bille['ID_BILLES']);
    $bille['NOM'] = htmlspecialchars($bille['NOM']);
}
// On affiche la page (vue)
include_once('VUE/BILLES/v_liste_sachets.php');

