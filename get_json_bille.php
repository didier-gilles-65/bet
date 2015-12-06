<?php
include_once('MODELE/get_connexion.php');
include_once('UTILS/langue.php'); // primitive langue
include_once('MODELE/BILLES/get_bille.php');

	if (isset($_GET['id_bille']))
	{
		$id_bille = $_GET['id_bille'];
	}
	else 
	{
		$id_bille = 0;
	}

	$bille = get_bille($sql_detail_bille, $id_bille);
	$json[]=$bille;
	echo json_encode($json,JSON_UNESCAPED_SLASHES); 
	exit();
?> 

