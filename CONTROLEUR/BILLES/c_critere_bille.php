<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/BILLES/get_billes.php');

if ( !isset($login) ) { $login=''; }

$marques = get_marques($sql_critere_marque);
$conditionnements = get_conditionnements($sql_get_conditionnements_sac);

// On effectue du traitement sur les données (contrôleur)
// Ici, on doit surtout sécuriser l'affichage

// On affiche la page (vue)
include_once('VUE/BILLES/v_critere_bille.php');

