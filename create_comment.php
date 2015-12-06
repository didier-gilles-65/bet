<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1)
{
	header('Location: index.php');
	exit();
}

    //Données passées en POST
    if (isset($_POST['from']) and ($_POST['from'] >= 0)) { $from = $_POST['from']; } else { $from = 0; }
    if (isset($_POST['page'])) { $page_courante = $_POST['page']; } else { $page_courante = 'index'; }

    if (isset($_POST['post_id']) and ($_POST['post_id'] > 0)) $post_id = $_POST['post_id']; else { header('Location: index.php?from='.$from.'&err=4010'); exit(); }
    if (isset($_POST['new_comment']) and (strlen($_POST['new_comment']) > 0)) $new_comment = $_POST['new_comment']; else { header('Location: index.php?from='.$from.'&err=4020'); exit(); }
	if (isset($_SESSION['login'])) $login=$_SESSION['login']; else { header('Location: index.php?from='.$from.'&err=2020'); exit(); }
	
    $req = $bdd->prepare('SELECT b_post_id from b_post where b_post_id='.$post_id );
    if ((!$req->execute()) or (!$req->fetchall())) { header('Location: index.php?from='.$from.'&err=4040'); exit(); } //Vérifie si le post existe
	$req->closeCursor();

    $req = $bdd->prepare('SELECT ID from comptes where LOGIN=\''.$login.'\'');
    if (!$req->execute()) { header('Location: index.php?from='.$from.'&err=4050'); exit(); } //Vérifie si le login est correct
	$user = $req->fetch();
	if (!count($user)>0) { header('Location: index.php?from='.$from.'&err=4030'); exit(); } //Vérifie si le login est correct
	$req->closeCursor();
	$user_id = $user['ID'];
    $req = $bdd->prepare("INSERT INTO b_comment ( b_comment_post_id, b_comment_text, b_comment_user_id ) VALUES ( '$post_id', '$new_comment', '$user_id');"); //INSERE LE COMMENTAIRE
	
    if ($req->execute())
	{
		$req->closeCursor();
		header('Location: '.$page_courante.'.php?from='.$from);
		exit();
	}
	header('Location: '.$page_courante.'.php?from='.$from);
	exit();
	
?>