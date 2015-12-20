<?php
/* UNSIGN.PHP

script PHP permettant la déconnexion de l'utilisateur par suppression des infos de connexion en session, et par reset des cookies de session.

USES :

TODO:

*/
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
unset($_SESSION['connect']); 
unset($_SESSION['utilisateur']); 
unset($_SESSION['login']); 
unset($_SESSION['profile']);
setcookie ("login", "", time() - 3600);
setcookie ("persistent_key", "", time() - 3600);
if (!isset($_GET['page'])) { $cible = 'index.php'; } else { $cible = $_GET['page']; }
header('Location: '.$cible);
?>