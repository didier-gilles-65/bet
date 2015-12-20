<?php
/* SET_POST.PHP

Script PHP permettant de mettre à jour un POST ou d'en créer un nouveau.

USES : 

TODO:

*/
session_start();
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('MODELE/BILLES/get_bille.php');
include_once('MODELE/USERS/get_users.php');
include_once('MODELE/BLOGS/get_blogs.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();
if ( isset($_SESSION['profile']) && ($_SESSION['profile'] == 'ADMIN') ) { $critere_statut = '%'; } else  { $critere_statut = 'PUBLIC'; };

    //retrieve our data from POST
	if(isset($_POST['post_title']) && (($_POST['post_title']) != '')) { $post_title = $_POST['post_title']; } else { header('Location: VUE/BILLES/v_erreur.php?id=1006'); exit();}
	if(isset($_POST['post_text']) && (($_POST['post_text']) != '')) { $post_text = $_POST['post_text']; } else { header('Location: VUE/BILLES/v_erreur.php?id=1007'); exit();}
	if(isset($_POST['hidden_tags']) && (($_POST['hidden_tags']) != '')) { $hidden_tags = $_POST['hidden_tags']; } else { $hidden_tags = ''; }
	if(isset($_POST['post_id']) && (($_POST['post_id']) != '')) { $blog_id = $_POST['post_id']; } else { $blog_id = 0; }
	if(isset($_POST['post_statut']) && (($_POST['post_statut']) != '')) { $blog_status = $_POST['post_statut']; } else { $blog_status = 'INIT'; }
   // $blog_id = $_POST['manage_blog_blog_id'];
	$hidden_tags = preg_replace("/(%+)/", "%", $hidden_tags);
	$tags = explode("%", $hidden_tags, 10);
	if (isset($_SESSION['login'])) {
		$login=$_SESSION['login'];
	} else {
		header('Location: VUE/BILLES/v_erreur.php?id=1001');
		exit();
	}
	$user = get_single_user($sql_user, $login);
	$login_id = $user['ID'];
	if ($blog_id != 0) {
		$blog = get_blogs_by_id($blog_id);
		if (($blog['b_post_user_id'] != $login_id) && ($user['profile'] <> 'ADMIN')) { header('Location: VUE/BILLES/v_erreur.php?id=1008'); exit();}
		$requete = 'UPDATE b_post set b_post_text = '.$bdd->quote($post_text).', b_post_title = '.$bdd->quote($post_title).', b_statut = \''.$blog_status.'\' where b_post_id = '.$blog_id;
	}
	else {
		$requete='INSERT INTO b_post (  b_post_text, b_post_title, b_post_user_id, b_statut ) values ('.$bdd->quote($post_text).','.$bdd->quote($post_title).','.$login_id.',\''.$blog_status.'\');';
	}
//ecrireLog('SQL', 'INFO', 'SET_POST| REQUETE = '.$requete);
    $req = $bdd->prepare($requete);
    if (!$req->execute()){
		header('Location: VUE/BILLES/v_erreur.php?id=1002');
		exit();
	}
// Reprise du post juste créé ou modifié
	if ($blog_id != 0) {
		$requete = "SELECT * FROM b_post WHERE b_post_id = $blog_id limit 0,1";
	}
	else {
		$requete = "SELECT * FROM b_post WHERE b_post_user_id = '$login_id' ORDER BY b_post_date DESC limit 0,1";
	}

	$req = $bdd->prepare($requete);
    if (!$req->execute()){
		header('Location: VUE/BILLES/v_erreur.php?id=1003');
		exit();
	}
	$line = $req->fetch();
	if ($post_title != $line['b_post_title']) {// -- Si le titre n'est pas le même que celui fourni en entrée : erreur!
		$req->closeCursor();
		header('Location: VUE/BILLES/v_erreur.php?id=1004');
		exit();
	}
	$req->closeCursor();
	$post_id = $line['b_post_id'];
	if ($blog_id != 0) {
		$requete = 'DELETE from b_post_billes where b_post_billes_post_id = '.$blog_id;
		$req = $bdd->prepare($requete);
//echo $requete.'</p>';
		if (!$req->execute()){
			$req->closeCursor();
			header('Location: VUE/BILLES/v_erreur.php?id=1009');
			exit();
		}
		$req->closeCursor();
	}
	foreach ($tags as $tag)	{
		if ($tag == '') {break;};
		$tag_bille_num = get_id_bille_by_nom($sql_bille_by_id, $tag);
		$requete = "INSERT INTO b_post_billes(b_post_billes_billes_num, b_post_billes_post_id, b_post_billes_tag_text) VALUES ($tag_bille_num, $post_id, '$tag')";
		$req = $bdd->prepare($requete);
		if (!$req->execute()){
			$req->closeCursor();
			header('Location: VUE/BILLES/v_erreur.php?id=1005');
			exit();
		}
		$req->closeCursor();
	}
	header('Location: blogs.php');
?>
