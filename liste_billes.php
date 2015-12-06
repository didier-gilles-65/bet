<?php
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');

include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php'); // primitive langue
include_once('MODELE/get_connexion.php'); // include de la connexion Mysql
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'liste_billes';

if (isset($_SESSION['login'])) $login=$_SESSION['login']; else unset($login);

if (isset($_SESSION['pagination'])) $pagination=$_SESSION['pagination']; else { $pagination = 10; $_SESSION['pagination']=10; }

if (isset($_SESSION['style_liste'])) $style_liste=$_SESSION['style_liste']; else { $style_liste = 'liste longue'; $_SESSION['style_liste']='liste longue'; }

if (isset($_SESSION['requete_courante']) ) $requete_courante = $_SESSION['requete_courante']; else {
	$requete_courante = $sql_defaut_liste_billes;
	if(!isset($_SESSION['LISTE_CONTEXT'])) unset($SESSION['LISTE_CONTEXT']);
}

if (isset($_GET['reset']) and ($_GET['reset'])) {
	$requete_courante = $sql_defaut_liste_billes;
	if(!isset($_SESSION['LISTE_CONTEXT'])) unset($SESSION['LISTE_CONTEXT']);
}

if (isset($_GET['from']) and (is_numeric($_GET['from']))) $from = $_GET['from']; else $from=0;

include_once('CONTROLEUR/BILLES/c_liste_billes.php');

