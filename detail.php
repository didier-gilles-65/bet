<?php
session_start();
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
// primitive langue
include_once('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'detail';

if (isset($_SESSION['login']))
{
	$login=$_SESSION['login'];
}
else
{
	unset($login);
}

if (isset($_SESSION['requete_courante']) ) 
{
	$requete_courante = $_SESSION['requete_courante'];
}
else
{
	$requete_courante = $sql_defaut_liste_billes;
}

if (!isset($_GET['id']))
{
	$id = 1;
}
else
{
	$id = $_GET['id'];
}
include_once('CONTROLEUR/BILLES/c_detail.php');
