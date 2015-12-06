<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

//print_r($_FILES);
$o = new stdClass();
header('content-type: application/json');

if(isset($_GET['id'])) { $id_to_delete = $_GET['id']; } else { 
	retournerErreur( 400 , 03, 'DELETE_PHOTO_AUTRE.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}
if(isset($_GET['indice'])) { $indice_to_delete = $_GET['indice']; } else { 
	retournerErreur( 400 , 03, 'DELETE_PHOTO_AUTRE.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}

$requete='DELETE from autres_photos WHERE id_bille = '.$id_to_delete.' AND indice = '.$indice_to_delete;
ecrireLog('SQL', 'INFO', 'DELETE_JSON_PHOTO_AUTRE.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'DELETE_JSON_PHOTO_AUTRE.PHP| Erreur sur l\'exécution de requète de suppression de photo'); 
	$req->closeCursor();
	retournerErreur( 409 , 03, 'DELETE_JSON_PHOTO_AUTRE.PHP| Erreur sur l\'exécution de requète de suppression de photo');
	exit;
}
$req->closeCursor();
$o->return = 'Success';
echo json_encode($o);
exit;
?>
