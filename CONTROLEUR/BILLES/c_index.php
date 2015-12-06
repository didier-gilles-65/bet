<?php

include_once('MODELE/BILLES/get_billes.php');

if ( !isset($from) ) { $from=0; }
if ( !isset($login) ) { $login=''; }

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
// On affiche la page (vue)
$billes = get_billes('select * from billes', 0, 10000);
foreach($billes as $cle => $bille)
{
    $billes[$cle]['ID_BILLES'] = htmlspecialchars($bille['ID_BILLES']);
    $billes[$cle]['NOM'] = htmlspecialchars($bille['NOM']);
    $billes[$cle]['DESCRIPTION'] = htmlspecialchars($bille['DESCRIPTION']);
}

include_once('VUE/BILLES/v_index.php');
