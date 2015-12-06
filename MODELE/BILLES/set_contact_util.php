<?php

function set_contact($email, $corps_message, $theme)
{
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email))
{
	$passage_ligne = "\r\n";
}
else
{
	$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt= $passage_ligne.'Nouveau contact poste depuis le site Billes En Tête :'.$email.$passage_ligne.$passage_ligne;
$message_txt.= $passage_ligne.'Envoyé par : '.$email.$passage_ligne.$passage_ligne;
$message_txt.= $passage_ligne.'Thème : '.$theme.$passage_ligne.$passage_ligne;
$message_txt.= $passage_ligne.$corps_message.$passage_ligne.$passage_ligne;

$message_html= '<html><head><meta charset="utf-8"></head><body><h1>Nouveau contact poste depuis le site Billes En Tête :</h1><p/><p/>';
$message_html.= '<h2>Envoyé par : </h2>'.$email.'<p/><p/>';
$message_html.= '<h2>Thème : </h2>'.$theme.'<p/><p/>';
$message_html.= '<h3>'.$corps_message.'</h2><p/><p/></body></html>';
//==========
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = $theme.' - from : '.$email;
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
 
//=====Envoi de l'e-mail.
return mail('billes.en.tete@numericable.fr',$sujet,$message,$header); // Envoi du message
}
