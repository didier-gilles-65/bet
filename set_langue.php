<?php
/* SET_LANGUE.PHP

Script PHP permettant de changer la langue d'affichage en remplaçant le cookie lang en fonction de ce qui est passé en requestParam

USES : 

TODO:

*/
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$default_lang = 'fr'; //langue par défaut

// Si la variable session de requete courante existe, on la supprime (la langue ne correspond plus).
if (isset($_SESSION["requete_courante"])) { unset($_SESSION["requete_courante"]); }

/*
 * liste des fichiers langue disponibles
 * s'assurer que chacun de ces fichiers existe bien dans
 * le répertoire
*/
$langues = array('en', 'fr');
$lang = '';
$pages = array('index', 'detail', 'contact', 'liens');
$page = 'index.php';

/*
 * si le paramètre "lang" est défini dans l'url et s'il existe dans la liste
 * $lang prend la valeur de $_GET['lang']
 */
if (isset($_GET['lang']) && in_array($_GET['lang'], $langues)) {
	$lang = $_GET['lang'];
}
/*
 * sinon vérifier prendre la valeur du cookie $_COOKIE['lang']
 * (s'il est défini)
 */
else if (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $langues)) {
	$lang = $_COOKIE['lang'];
}

if (isset($_GET['page']) ) {
	$page = $_GET['page'];
}
/*
 * sauver la valeur de $lang dans le cookie $_COOKIE['lang']
 */
if (!empty($lang)) {
	setcookie('lang', $lang);
}

header('Location: '.$page);      

?>
