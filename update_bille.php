<?php
/* UPDATE_BILLE.PHP

Page HTML permettant de mettre à jour les sachets ou conditionnement possédés par l'utilisateur logué pour un type de bille donné.

Affiche la liste des sachets/conditionnements possédés, affiche également une ligne vide là où un conditionnement existe, sans être détenu.
Il est possible de saisir un nombre et une description sur une ligne vide pour créer une instance de conditionnement possédé
Il est possible de modifier le nombre et la description du conditionnement possédé en modifiant les valeurs affichées
Il est possible de supprimer un sachet possédé en passant le nombre à 0

USES : C_UPDATE_BILLE.PHP, V_UPDATE_BILLE.PHP

TODO:

*/
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
// primitive langue
include('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$pagecourante = 'update_bille';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	include_once('CONTROLEUR/BILLES/c_update_bille.php');
}
else
{
    header('Location: VUE/BILLES/v_erreur.php?id=1010');
}
