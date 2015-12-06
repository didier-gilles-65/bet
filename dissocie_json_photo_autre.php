<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();
$o = new stdClass();
header('content-type: application/json');

if(isset($_GET['id_mbc'])) { $id_mbc = $_GET['id_mbc']; } else { 
	retournerErreur( 400 , 03, 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}
if(isset($_GET['id_bille'])) { $id_bille = $_GET['id_bille']; } else { 
	retournerErreur( 400 , 03, 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}
if(isset($_GET['chemin'])) { $chemin = $_GET['chemin']; } else { 
	retournerErreur( 400 , 03, 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}

$requete='DELETE FROM autres_photos_sac WHERE ID_BILLE='.$id_bille.' AND ID_SAC='.$id_mbc.' AND FICHIER=\''.$chemin.'\'';
ecrireLog('SQL', 'INFO', 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| Erreur sur l\'exécution de requète d\'association de photo'); 
	$req->closeCursor();
	retournerErreur( 409 , 03, 'DISSOCIE_JSON_PHOTO_AUTRE.PHP| Erreur sur l\'exécution de requète d\'association de photo');
	exit;
}
$req->closeCursor();

$o->return = 'Success';
echo json_encode($o);
exit;
?>
