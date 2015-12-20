<!-- SET_POST.PHP

Script PHP permettant de mettre à jour un mot de passe

USES : 

TODO:

-->
<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

    function createSalt() {
    $text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
    }

    //Données passées en POST
    $login = $_POST['login'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

//Secure password using salt. This is called password hashing using salt. You can find more info about this at http://php.net/manual/en/faq.passwords.php
    $hash = hash('sha256', $password1);
    $salt = createSalt();
	$password = hash('sha256', $salt . $hash);
//CREE LE COMPTE EN INSERANT DANS COMPTES
	if ($bdd->exec("UPDATE comptes SET PASSWORD='$password', SALT='$salt', PASSWORD_KEY=NULL WHERE LOGIN='$login'") != 1) {
		ecrireLog('SQL','WARN','Pas de ligne mise à jour avec le password dans COMPTES pour le login '.$login); 
		header('Location: index.php?err=6210');
		exit();
	}
	else
//REDIRIGE SUR LA PAGE DE LOGIN EN CAS DE SUCCES	
    {
		header('Location: login.php?change=true');
		exit();
	}
?>