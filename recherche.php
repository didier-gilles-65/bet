<?php
session_start();
error_reporting(E_ALL);
// primitive langue
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include('UTILS/langue.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$requete_courante=$sql_list_billes_recherche_head.$_POST['critere'].$sql_list_billes_recherche_tail;
$_SESSION['requete_courante']=$requete_courante;
if (!isset($_POST['critere']) || ($_POST['critere'] == '') ) {
	unset( $_SESSION['LISTE_CONTEXT'] );
}
else {
	$_SESSION['LISTE_CONTEXT']=$_POST['critere'];
}
$_SESSION['requete_courante']=$requete_courante;
header('Location: liste_billes.php');
?>