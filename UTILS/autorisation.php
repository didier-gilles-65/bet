<?php
session_start();
include_once('../UTILS/log.php');
include_once('../UTILS/gestion_erreur.php');
include_once('../MODELE/get_connexion.php');
//	ecrireLog('APP','INFO','verifie_login.php : login:'.$login);
date_default_timezone_set('Europe/Paris');

$_SESSION['connect']=0;

$login = $_POST['connect_login'];
$mdp = $_POST['connect_password'] ;
if(isset($_POST['login_persistent']) && (($_POST['login_persistent'])== 'true')) { $persistent_flag = 1; } else { $persistent_flag = 0; }

if (isset($_GET['page'])) { $cible = $_GET['page']; } else { $cible = '/index.php'; }

$query = "SELECT * FROM comptes where LOGIN = '$login'";
$req = $bdd->prepare($query);
$req->execute();

while ($line = $req->fetch())
{
	if ($login == $line['LOGIN']) // Si le nom d'utilisateur est trouvé, on vérifie le mdp 
	{
		$s=$line['SALT'];
		$hash = hash('sha256', $mdp);
		$password = hash('sha256', $s . $hash);
		if ($password == $line['PASSWORD'])
		{
			$_SESSION['connect']=1; 
			$_SESSION['login']=$line['LOGIN']; 
			$_SESSION['email']=$line['EMAIL']; 
			$_SESSION['gravatar_flag']=$line['GRAVATAR_FLAG']; 
			$_SESSION['utilisateur']=$line['PRENOM'];
			$_SESSION['profile']=$line['PROFILE'];
			$req->closeCursor();
			if ($persistent_flag == 1)
			{
				$now = date("Y-m-d H:i:s");
				$new_key = hash('sha256', $password.$now);
				$query = "UPDATE comptes set persistent_key = '$new_key', persistent_date = CURRENT_TIMESTAMP where LOGIN = '$login'";
				$req = $bdd->prepare($query);
				$req->execute();
				$return = setcookie('persistent_key', $new_key, time() + 6*24*3600, '/', null, false, true);
				$return = setcookie('login', $login, time() + 365*24*3600, '/', null, false, true);
			}
			header('Location: '.$cible);
			exit();
		}
		else
		{
			unset($_SESSION['connect']); 
			unset($_SESSION['utilisateur']); 
			unset($_SESSION['login']); 
			unset($_SESSION['profile']); 
			$req->closeCursor();
			header('Location: /login.php?err=100');   
			exit();
		}
	}
}
unset($_SESSION['connect']); 
unset($_SESSION['utilisateur']); 
unset($_SESSION['login']); 
unset($_SESSION['profile']); 
$req->closeCursor();
header('Location: /login.php?err=101');   
?>