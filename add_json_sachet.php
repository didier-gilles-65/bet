/*
ADD_JSON_SACHET.PHP

*/

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

if(isset($_GET['mbc'])) { $mbc = $_GET['mbc']; } else { 
	ecrireLog('APP', 'ERROR', 'ADD_JSON_SACHET.PHP| Erreur mbc absent'); 
	retournerErreur( 400 , 03, 'ADD_JSON_SACHET.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}
if(isset($_GET['login'])) { $mbc_login = $_GET['login']; } else { 
	ecrireLog('APP', 'ERROR', 'ADD_JSON_SACHET.PHP| Erreur login absent'); 
	retournerErreur( 400 , 03, 'ADD_JSON_SACHET.PHP| Erreur sur les paramètres d\'entrée');
	exit; 
}

$requete='INSERT INTO sac_marque_billes_conditionnement (ID_MARQUE_BILLES_CONDITIONNEMENT, LOGIN_COMPTE) values ('.$mbc.', \''.$mbc_login.'\')';

ecrireLog('SQL', 'INFO', 'ADD_JSON_SACHET.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'ADD_JSON_SACHET.PHP| Erreur sur l\'exécution de requète d\'insertion de sachet'); 
	$req->closeCursor();
	retournerErreur( 409 , 03, 'ADD_JSON_SACHET.PHP| Erreur sur l\'exécution de requète d\'insertion de sachet');
	exit;
}
$req->closeCursor();
$o->return = 'Success';
echo json_encode($o);
exit;
?>
