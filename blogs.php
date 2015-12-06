<?php
session_start();
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');

include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php'); // primitive langue
include_once('MODELE/get_connexion.php'); // include de la connexion Mysql
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if ( isset($_SESSION['profile']) && ($_SESSION['profile'] == 'ADMIN') ) { $critere_statut = '%'; } else  { $critere_statut = 'PUBLIC'; };

$pagecourante = 'blogs';

if (isset($_SESSION['login'])) $login=$_SESSION['login']; else unset($login);

if (isset($_SESSION['requete_courante']) ) $requete_courante = $_SESSION['requete_courante']; else $requete_courante = $sql_defaut_liste_billes;

if (isset($_GET['tag_id']) and (is_numeric($_GET['tag_id']))) $tag_id = $_GET['tag_id']; else unset($tag_id);
if (isset($_GET['tag_name'])) $tag_name = $_GET['tag_name']; else unset($tag_name);
if (isset($_GET['user_id']) and (is_numeric($_GET['user_id']))) $user_id = $_GET['user_id']; else unset($user_id);
if (isset($_GET['post_id']) and (is_numeric($_GET['post_id']))) $post_id = $_GET['post_id']; else unset($post_id);

include_once('CONTROLEUR/BLOGS/c_blogs.php');

