<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

// primitive langue
include('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');

$pagecourante = 'update_inventory';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

include_once('CONTROLEUR/BILLES/c_update_inventory.php');
