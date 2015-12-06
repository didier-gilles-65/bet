<?php
// Fonction de requètage de la liste des liens
include_once('MODELE/BILLES/get_liens.php');
include_once('MODELE/BILLES/get_billes.php');
$liens = get_liens($sql_list_liens, 0, 20);
foreach($liens as $cle => $lien)
{
    $liens[$cle]['URL'] = htmlspecialchars($lien['URL']);
    $liens[$cle]['NOM'] = htmlspecialchars($lien['NOM']);
    $liens[$cle]['DESCRIPTION'] = htmlspecialchars($lien['DESCRIPTION']);
}
include_once('VUE/BILLES/v_liens.php'); // On affiche la page (vue)
 