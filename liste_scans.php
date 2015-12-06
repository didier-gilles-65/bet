<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
include_once('MODELE/BILLES/get_billes.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'liste_scans';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

include_once('CONTROLEUR/BILLES/c_liste_scans.php');
