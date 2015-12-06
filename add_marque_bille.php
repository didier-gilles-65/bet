<?php

error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

    //retrieve our data from POST
if (isset($_GET['id_bille']) && (is_numeric($_GET['id_bille']))){ $id_bille = $_GET['id_bille']; } else { header('Location: index.php?err=2000'); exit(); };
if (isset($_GET['id_marque']) && (is_numeric($_GET['id_marque']))){ $id_marque = $_GET['id_marque']; } else { header('Location: index.php?err=2010'); exit(); };
if (!isset($_SESSION['login'])) { header('Location: index.php?err=9000'); exit(); };
if (!isset($_SESSION['profile']) || ($_SESSION['profile'] != 'ADMIN' )) { header('Location: index.php?err=2030'); exit(); };

//print_r($_POST['mbc']);
//exit();

$requete='INSERT INTO marque_billes (ID_BILLES, ID_MARQUE) values ('.$id_bille.','.$id_marque.')';
ecrireLog('SQL', 'INFO', 'ADD_MARQUE_BILLE.PHP| REQUETE = '.$requete);

$req = $bdd->prepare($requete);
if (!$req->execute()){ header('Location: index.php?err=2040'); exit(); }

header('Location: update_reference_bille.php?id='.$id_bille);
exit();

?>
