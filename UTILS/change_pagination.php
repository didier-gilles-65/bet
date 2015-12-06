<?php
session_start();
global $pagination;
if (isset($_GET['page'])) { $cible = $_GET['page']; } else { $cible = 'liste_billes'; }
if (isset($_GET['pagination'])) { $pagination = $_GET['pagination']; } else { $pagination = 0; }
switch ($pagination) {
	case 10:
		$_SESSION['pagination']=10;
		break;
	case 50:
		$_SESSION['pagination']=50;
		break;
	case 80:
		$_SESSION['pagination']=80;
		break;
	case 0:
		$_SESSION['pagination']=1000;
		$pagination=1000;
		break;
	default:
		$_SESSION['pagination']=12;
		$pagination=12;
}
$_SESSION['pagination']=$pagination;
header('Location: ../'.$cible.'.php');
?>