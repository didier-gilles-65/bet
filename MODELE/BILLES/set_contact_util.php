<?php

function set_contact($email, $corps_message, $theme, $data, $file_name, $typepiecejointe)
{
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
	return false;
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt= PHP_EOL.'Nouveau contact poste depuis le site Billes En Tête :'.$email.PHP_EOL.PHP_EOL;
$message_txt.= PHP_EOL.'Envoyé par : '.$email.PHP_EOL.PHP_EOL;
$message_txt.= PHP_EOL.'Thème : '.$theme.PHP_EOL.PHP_EOL;
$message_txt.= PHP_EOL.$corps_message.PHP_EOL.PHP_EOL;

$message_html= '<html><head><meta charset="utf-8"></head><body><h1>Nouveau contact poste depuis le site Billes En Tête :</h1><p/><p/>';
$message_html.= '<h2>Envoyé par : </h2>'.$email.'<p/><p/>';
$message_html.= '<h2>Thème : </h2>'.$theme.'<p/><p/>';
$message_html.= '<h3>'.$corps_message.'</h2><p/><p/></body></html>';
//==========

$email_site='billes.en.tete@numericable.fr';
 
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = $theme.' - from : '.$email;
//=========


//=====Création du header de l'e-mail
$header= 'From: "Site Billes En Tête" <'.$email_site.'>'.PHP_EOL;
$header.= 'To: "Site Billes En Tête" <'.$email_site.'>'.PHP_EOL;
$header.= 'Reply-to: "Site Billes En Tête" <'.$email_site.'>'.PHP_EOL;
$header.= 'Delivered-to: "Site Billes En Tête" <'.$email_site.'>'.PHP_EOL;
$header.= 'Cc: "Site Billes En Tête" <'.$email_site.'>'.PHP_EOL;
$header.= 'X-Priority: 1 '.PHP_EOL;
$header.= 'MIME-Version: 1.0'.PHP_EOL;
$header.= 'Content-Type: multipart/mixed;'.PHP_EOL.' boundary="'.$boundary.'"'.PHP_EOL;
//==========
 
//=====Création du message.
$message = PHP_EOL.'--'.$boundary.PHP_EOL;
//=====Ajout du message au format texte.
$message.= 'Content-Type: text/plain; charset="utf-8"'.PHP_EOL;
$message.= 'Content-Transfer-Encoding: 8bit'.PHP_EOL;
$message.= PHP_EOL.$message_txt.PHP_EOL;
//==========
$message.= PHP_EOL.'--'.$boundary.PHP_EOL;
//=====Ajout du message au format HTML
$message.= 'Content-Type: text/html; charset="utf-8"'.PHP_EOL;
$message.= 'Content-Transfer-Encoding: 8bit'.PHP_EOL;
$message.= PHP_EOL.$message_html.PHP_EOL;
if ($data != '') {
//==========
	$message.= PHP_EOL.'--'.$boundary.PHP_EOL;
//=====Ajout de la PJ s'il y en a
	$message.= 'Content-Type: '.$typepiecejointe.'; name="'.$file_name.'"'.PHP_EOL;
	$message.= 'Content-Transfer-Encoding: base64'.PHP_EOL;  
	$message.= 'Content-Disposition: attachment; filename="'.$file_name.'"'.PHP_EOL;  
	$message.= PHP_EOL;  
	$message.= $data.PHP_EOL;  
	$message.= PHP_EOL;  
//==========
}
$message.= PHP_EOL.'--'.$boundary.'--'.PHP_EOL;
$message.= PHP_EOL.'--'.$boundary.'--'.PHP_EOL;
//==========
 
//=====Envoi de l'e-mail.
//ini_set(SMTP,"smtp.numericable.fr");
//ini_set(smtp_port,25);
//ini_set(sendmail_from,"billes.en.tete@numericable.fr");
//ecrireLog('APP', 'TRACE', 'ADD_JSON_SACHET.PHP| Erreur mbc absent'); 
//ecrireLog('APP', 'TRACE', 'SUJET=======================================================');
//ecrireLog('APP', 'TRACE', $sujet);
//ecrireLog('APP', 'TRACE', 'HEADER=======================================================');
//ecrireLog('APP', 'TRACE', $header);
//ecrireLog('APP', 'TRACE', 'MESSAGE=======================================================');
//ecrireLog('APP', 'TRACE', $message);
//ecrireLog('APP', 'TRACE', '=======================================================');

return mail($email_site,$sujet,$message,$header); // Envoi du message
}
