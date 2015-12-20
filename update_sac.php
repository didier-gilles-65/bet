<?php
/* UPDATE_SAC.PHP

Page HTML permettant d'associer des photos à un sachet répertorié.

Affiche la liste des images génériques associées à la bille, et la liste des sachets possédés pour cette bille.
Pour chacun des sachets, la page affiche la photo associées si elle existe
Deux zones de drop permettent soit d'associer une image (+), soit de désassocier l'image courante (-).

USES : C_UPDATE_SAC.PHP, V_UPDATE_SAC.PHP

TODO:
- rafraichissement dynamique après traitement du drop

*/
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

// primitive langue
include('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');

$pagecourante = 'update_sac';

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	include_once('CONTROLEUR/BILLES/c_update_sac.php');
}
else
{
    header('Location: VUE/BILLES/v_erreur.php?id=1010');
}
