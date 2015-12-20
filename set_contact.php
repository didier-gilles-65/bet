<?php
/* SET_CONTACT.PHP

Script PHP permettant d'uploader un fichier et en même temps d'envoyer un email avec le contenu passé en post

USES : SET_CONTACT_UTIL.PHP

TODO: Modifier le fonctionnement pour permettre de transmettre le fichier comme une PJ du mail : hint : http://jv-web.blogspot.fr/2013/08/tuto-php-mail-piece-jointe.html

*/
session_start();
include_once('MODELE/BILLES/set_contact_util.php');
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

// primitive langue
include_once('UTILS/langue.php');
// include de la connexion Mysql
include_once('MODELE/get_connexion.php');

$maxsize=9000000;

if (isset($_POST['contact_email']) and ($_POST['contact_email'] !=""))
{
	$contact_email = $_POST['contact_email'];
}
if (isset($_POST['contact_message']) and ($_POST['contact_message'] !=""))
{
	$contact_message = $_POST['contact_message'];
}
if (isset($_POST['contact_theme']))
{
	$contact_theme = $_POST['contact_theme'];
}

if ( !isset($contact_email) OR !isset($contact_theme) OR !isset($contact_message))
{
	header('Location: index.php?err=6010');
	exit();
}	
print_r($_FILES['nomfichier']);
if ($_FILES['nomfichier']['error'] == 4)
{
	$no_fichier = true;
}
else
{
	$no_fichier = false;
}
if (!$no_fichier)
{

	if ($_FILES['nomfichier']['error'] > 0)
	{
		header('Location: index.php?err=6110');
		exit();
	}
	if ($_FILES['nomfichier']['size'] > $maxsize) 
	{
		header('Location: index.php?err=6120');
		exit();
	}
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
	$extension_upload = strtolower(  substr(  strrchr($_FILES['nomfichier']['name'], '.')  ,1)  );
	$file_name = $_FILES['nomfichier']['name'];
	$typepiecejointe = filetype($_FILES['nomfichier']['tmp_name']);
	$data = chunk_split( base64_encode(file_get_contents($_FILES['nomfichier']['tmp_name'])));
}
else
{
	$file_name = "";
	$typepiecejointe = "";
	$data = "";
}
$retour_post_contact = set_contact($contact_email, $contact_message, $contact_theme, $data, $file_name, $typepiecejointe);
if ($retour_post_contact) {
	header('Location: index.php?notif=message_envoye');
	exit();
} else {
	header('Location: index.php?err=6140&retour='.$file_name);
	exit();
}
