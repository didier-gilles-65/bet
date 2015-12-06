<?php

include_once('MODELE/get_connexion.php');

function get_json_billes() // Renvoie le premier blog de la requète passée. Possibilité d'utiliser un accès par id_blog
{
	global $bdd;
    $req = $bdd->prepare('SELECT DISTINCT NOM AS "val",ID_BILLES AS "picture" FROM billes ORDER BY NOM');
    if ($req->execute()) {// Si la requète échoue, on renvoie un json vide
		$billes = $req->fetchall();
		$req->closeCursor();
		return json_encode($billes);
	}
	return false;
}
