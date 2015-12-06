<?php
session_start();
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

//ecrireLog('APP','INFO','fichier:set_compte.php|ligne: 6| info: DEBUT DE FICHIER');
    function createSalt() {
    $text = md5(uniqid(rand(), true));
    return substr($text, 0, 3);
    }

    //Données passées en POST
    $login = $_POST['register_login'];
    $password1 = $_POST['register_password1'];
    $password2 = $_POST['register_password2'];
    $email = $_POST['register_email'];
    $nom = $_POST['register_nom'];
    $prenom = $_POST['register_prenom'];
	if(isset($_POST['register_gravatar']) && (($_POST['register_gravatar'])== 'true')) { $gravatar = 1; } else { $gravatar = 0; }

     
    //VERIFICATION DES DONNEES (A ENLEVER QUAND LE CONTROLE A LA SAISIE EST IMPLEMENTE
	 if($password1 != $password2) {
 	ecrireLog('APP','WARNING','Difference entre mots de passe saisis: '.$password1.'|'.$password2);
		header('Location: register.php?err=true');
		exit();
	}

//Secure password using salt. This is called password hashing using salt. You can find more info about this at http://php.net/manual/en/faq.passwords.php
    $hash = hash('sha256', $password1);
    $salt = createSalt();
	$password = hash('sha256', $salt . $hash);
//CREE LE COMPTE EN INSERANT DANS COMPTES
   // $login = $bdd->quote($login); //sanitize login
	$sql="INSERT INTO comptes ( nom, prenom, login, password, email, salt, gravatar_flag, CREATED_DATE ) VALUES ( '$nom', '$prenom', '$login', '$password', '$email', '$salt', $gravatar, NOW() );";

    $req = $bdd->prepare($sql);
//REDIRIGE SUR LA PAGE DE LOGIN EN CAS DE SUCCES	
    if ($req->execute()) {
		$req->closeCursor();
		header('Location: login.php?register=true');
		exit();
	}
//REDIRIGE SUR LA PAGE DE REGISTER EN CAS D'ECHEC
	else {
 	ecrireLog('APP','ERROR','Erreur sur execution de la requete: '.$sql);
		$req->closeCursor();
		header('Location: index.php?err=5010');
		exit();
	}
?>