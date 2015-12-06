<?php
session_start();
global $style_liste;
if (isset($_GET['page'])) { $cible = $_GET['page']; } else { $cible = 'liste_billes'; }
if (isset($_GET['style_liste'])) { $style_liste = $_GET['style_liste']; } else { $style_liste = 'liste longue'; }
switch ($style_liste) {
	case 'liste longue':
		$_SESSION['style_liste']='liste longue';
		break;
	case 'noms':
		$_SESSION['style_liste']='noms';
		break;
	case 'images':
		$_SESSION['style_liste']='images';
		break;
	case 'images_multiples':
		$_SESSION['style_liste']='images_multiples';
		break;
	default:
		$_SESSION['style_liste']='liste longue';
		$style_liste='liste longue';
}
$_SESSION['style_liste']=$style_liste;
header('Location: ../'.$cible.'.php');
?>