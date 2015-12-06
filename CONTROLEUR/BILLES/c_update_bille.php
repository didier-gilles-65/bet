<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/BILLES/get_billes.php');

if ( !isset($login) ) { $login=''; }

$bille = get_bille($sql_detail_bille, $id);
$photos = get_photos_sac($sql_photos_sac, $id);
$mbc_existants = get_liste_inventaire_pour_bille($sql_liste_marque_bille_conditionnement_pour_bille, $login, $id);
//$return = ecrireLog('APP','INFO',$login); 

foreach($bille as $cle => $mabille)
{
    $bille['ID_BILLES'] = htmlspecialchars($bille['ID_BILLES']);
    $bille['NOM'] = htmlspecialchars($bille['NOM']);
}
// On affiche la page (vue)
include_once('VUE/BILLES/v_update_bille.php');

