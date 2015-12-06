<!-- UPDATE_REFERENCE_BILLE.PHP

Page HTML permettant de mettre à jour les données générique de référence d'une bille.

Affiche les informations sur le type de bille concerné.
Affiche la liste des marquess associées (marque sous laquelle le type de bille est distribué)
Affiche pour chaque marque les conditionnements associés (conditionnements disponibles pour cette marque)
Il est possible de rajouter une marque en sélectionnant dans un dropbox (la ligne pour la marque est ajoutée dynamiquement aà la liste des marques)
Il est possible de mettre à jour la liste des conditionnements pour la marque via une select box.
Le retrait d'un conditionnement n'est possible que s'il n'y a pas de billes en possession pour cette marque et ce conditionnement
Le retrait d'une marque n'est possible que s'il n'y a plus de conditionnement associé

USES : C_UPDATE_REFERENCE_BILLE.PHP, V_UPDATE_REFERENCE_BILLE.PHP, SET_UPDATE_REFERENCE_BILLE.PHP

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

$pagecourante = 'update_reference_bille';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}

if (!isset($_SESSION['profile']) || ($_SESSION['profile'] != 'ADMIN' )) { header('Location: /index.php?err=2130'); exit(); };

$login=$_SESSION['login'];

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	include_once('CONTROLEUR/BILLES/c_update_reference_bille.php');
}
else
{
    header('Location: /index.php?err=2000');
	exit();
}
