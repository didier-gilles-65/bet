<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$o = new stdClass();
header('content-type: application/json');

if(isset($_GET['id'])) { $id_to_delete = $_GET['id']; } else { exit; }

$requete='DELETE from photos_sac WHERE id_photos_sac = '.$id_to_delete;
ecrireLog('SQL', 'INFO', 'DELETE_JSON_ETIQUETTE.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'DELETE_JSON_ETIQUETTE.PHP| Erreur sur l\'exécution de requète de suppression de photo'); 
	$req->closeCursor();
	retournerErreur( 403 , 03, 'DELETE_JSON_ETIQUETTE.PHP| Erreur sur l\'exécution de requète de suppression de photo');
	exit;
}
$req->closeCursor();
$o->return = 'Success';
echo json_encode($o);
exit;
?>
