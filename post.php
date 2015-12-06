<?php
session_start();
// primitive langue
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if ( isset($_SESSION['profile']) && ($_SESSION['profile'] == 'ADMIN') ) { $critere_statut = '%'; } else  { $critere_statut = 'PUBLIC'; };

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1){
	header('Location: login.php'.'?page='.$_SERVER['REQUEST_URI']);
	exit();
}
$login=$_SESSION['login'];

$pagecourante = 'post';

if (isset($_GET['post_id']) and ($_GET['post_id'] > 0)) $blog_id = $_GET['post_id']; else $blog_id = 0;

//include_once('TEST_EDITOR.php');
include_once('CONTROLEUR/BLOGS/c_post.php');
