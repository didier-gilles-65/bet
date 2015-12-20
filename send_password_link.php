<?php
/* SEND_PASSWORD_LINK.PHP

Script PHP permettant d'envoyer un mail avec un lien sur la page de modification de mot de passe.

Les critères sont passés en POST

USES : 

TODO:

*/
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

$login = $_POST['reset_login'];
$found=false;

$query = "SELECT * FROM comptes where LOGIN = '$login'";
$req = $bdd->prepare($query);
$req->execute();
while ($line = $req->fetch())
{
	$found=true;
	$s=$line['SALT'];
	$hash = hash('sha256', $line['PASSWORD']);
	$key = hash('sha256', $s.$hash);
	$email = $line['EMAIL'];
	if ($bdd->exec("UPDATE comptes SET PASSWORD_KEY='$key' WHERE LOGIN='$login'") != 1) { ecrireLog('SQL','WARN','Pas de ligne mise à jour avec la key dans COMPTES pour le login '.$login); }
}
$req->closeCursor();

if ($found==false)
{
	header('Location: reset_password.php?err=4030');   
	exit();
}
ecrireLog('SYS','INFO',$email);
ecrireLog('SYS','INFO',$login);
ecrireLog('SYS','INFO',$key);
//=====Déclaration des messages au format texte et au format HTML.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email))
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}

$message_txt= 'Cet email est généré en réponse à votre demande de changement de mot de passe'.$passage_ligne;
$message_txt.= 'Envoyé à : '.$email.$passage_ligne;
$message_txt.= 'Veuillez copier le lien suivant dans votre browser : http://www.billes-en-tete.com/change_password.php?link='.$key;
$message_html= '<html><head><meta charset="utf-8"></head><body><h1>Cet email est généré en réponse à votre demande de changement de mot de passe</h1><p/><p/>';
$message_html.= '<p>Envoyé à : '.$email.'</p><p/><p/>';
$message_html.= '<h2>Veuillez cliquer sur <a href="http://www.billes-en-tete.com/change_password.php?link='.$key.'">ce lien</a><p/><p/>';
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = 'Billes en tête : changement de mot de passe';
//=========


//=====Création du header de l'e-mail
$header = "From: \"Site Billes En Tête\"<billes.en.tete@numericable.fr>".$passage_ligne;
$header .= "Reply-to: \"Site Billes En Tête\"<billes.en.tete@numericable.fr>".$passage_ligne;
$header .= "MIME-Version: 1.0".$passage_ligne;
$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
//ecrireLog('SYS','INFO',$sujet);
//ecrireLog('SYS','INFO',$message);
//ecrireLog('SYS','INFO',$header);


//=====Envoi de l'e-mail.
mail($email,$sujet,$message,$header); // Envoi du message

header('Location: reset_password.php?reset=OK');   
?>