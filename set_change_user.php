<?php
/* SET_CHANGE_USER.PHP

Script PHP permettant de mettre à jour un compte sur le site bille-en-tete.

Les critères sont passés en POST

USES : 

TODO:

*/
include_once('MODELE/get_connexion.php');
error_reporting(E_ALL);
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

//retrieve our data from POST

    $login = $_POST['hidden_login'];
    $email = $_POST['update_email'];
    $nom = $_POST['update_nom'];
    $prenom = $_POST['update_prenom'];
	if (isset($_POST['update_gravatar'])) { $gravatar = $_POST['update_gravatar']; } else { $gravatar = 'false'; };
	if ( $gravatar != 'true') $gravatar = 'false';
	
//Update the value into "member" table.

	$sql = 'UPDATE comptes set NOM=\''.$nom.'\', PRENOM=\''.$prenom.'\', EMAIL=\''.$email.'\', GRAVATAR_FLAG='.$gravatar.' where login = \''.$login.'\';';
    $req = $bdd->prepare($sql);
    $req->execute();
	$req->close();
	header('Location: index.php');
?>