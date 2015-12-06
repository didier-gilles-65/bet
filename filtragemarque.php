<?php
session_start();
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
// primitive langue
include_once('UTILS/langue.php');
include_once('UTILS/log.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if (!isset($_GET['marque'])) {
	$marque = '%';
	if(!isset($_SESSION['LISTE_CONTEXT'])) unset($_SESSION['LISTE_CONTEXT']);
}
else {
	$marque = $_GET['marque'];
	$_SESSION['LISTE_CONTEXT']=$marque;
}
$requete_courante=$sql_list_billes_marque_head.$marque.$sql_list_billes_marque_tail;
$_SESSION['requete_courante']=$requete_courante;
header('Location: /liste_billes.php');
?>