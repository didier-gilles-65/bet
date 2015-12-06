<?php
// include des fonctions d'access à la base de données BILLES
include_once('MODELE/BILLES/get_billes.php');
// include des fonctions d'access à la base de données BLOG
//include_once('MODELE/BLOGS/get_blogs.php');

if ( !isset($from) ) { $from=0; }

if ( !isset($login) ) { $login=''; }

$nb_billes = count(get_billes($requete_courante, 0, 1000));
$billes = get_billes($requete_courante, $from, $pagination);
$return = ecrireLog('SQL','INFO',$requete_courante); 
$total_billes = get_nb_billes('select * from billes');

//$blog = get_most_recent_blog(0); // On récupère le post le plus récent
//$comments = get_comments($blog['b_post_id']); // On récupère les comments rattachés au blog le plus récent

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage
foreach($billes as $cle => $bille)
{
    $billes[$cle]['ID_BILLES'] = htmlspecialchars($bille['ID_BILLES']);
    $billes[$cle]['NOM'] = htmlspecialchars($bille['NOM']);
//    $billes[$cle]['MARQUE'] = htmlspecialchars($bille['MARQUE']);
//  //   $billes[$cle]['DESCRIPTION'] = htmlspecialchars($bille['DESCRIPTION']);
//    $billes[$cle]['ANNEE APPARITION'] = htmlspecialchars($bille['ANNEE APPARITION']);
//    $billes[$cle]['ANNEE DISPARITION'] = htmlspecialchars($bille['ANNEE DISPARITION']);
//    $billes[$cle]['POSSEDE'] = htmlspecialchars($bille['POSSEDE']);
}
// On affiche la page (vue)
include_once('VUE/BILLES/v_liste_billes.php');
