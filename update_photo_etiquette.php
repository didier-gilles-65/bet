<!-- UPDATE_PHOTO_ETIQUETTE.PHP

Page HTML permettant de mettre à jour les photos pour un conditionnement de type de billes.

Affiche pour un type, une marque et un conditionnement donnés les groupe de photos associées (FACE et DOS).
Permet de dissocier une photo en la droppant sur la poubelle
Permet d'associer une photo par drop ou dialogue.

USES : C_UPDATE_PHOTO_ETIQUETTE.PHP, V_UPDATE_PHOTO_ETIQUETTE.PHP

TODO:

-->
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

$pagecourante = 'update_photo_etiquette';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

if (isset($_GET['id']))
{
	$id = $_GET['id'];
}

include_once('CONTROLEUR/BILLES/c_update_photo_etiquette.php');

