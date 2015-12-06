<?php
try
{
	$bdd = new PDO('mysql:host=db509238048.db.1and1.com;dbname=db509238048', 'dbo509238048', 'vinc1006');
	$bdd->query("SET NAMES 'utf8'");
	if (isset($_SESSION['MENUMARQUES'])) 
		{$MENUMARQUES=$_SESSION['MENUMARQUES'];}
	else {
	    $req = $bdd->prepare('SELECT DISTINCT MARQUE FROM marques, marque_billes WHERE marque_billes.ID_MARQUE = marques.ID_MARQUE');
		$req->execute();
		$MENUMARQUES = $req->fetchAll();
		$req->closeCursor();
		$SESSION['MENUMARQUES'] = $MENUMARQUES;
	}
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

