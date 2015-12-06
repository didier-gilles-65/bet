<?php

function get_option_billes() // Renvoie la liste des noms de billes
{
	global $bdd;
    $req = $bdd->prepare('SELECT DISTINCT NOM AS "val",ID_BILLES AS "picture" FROM billes ORDER BY NOM');
    if ($req->execute()) {// Si la requète échoue, on renvoie false
		$billes = $req->fetchall();
		$req->closeCursor();
		return $billes;
	}
	return false;
}

function get_marques($requete)
{
    global $bdd;

    $req = $bdd->prepare($requete);
    $req->execute();
    $marques = $req->fetchAll();
	$req->closeCursor();

    return $marques;
}

function get_billes($requete, $offset, $limit)
{
    global $bdd;
    $offset = (int) $offset;
    $limit = (int) $limit;

    $req = $bdd->prepare($requete);
//	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billes = $req->fetchAll();
	$req->closeCursor();

    return $billes;
}
function get_inventory_billes($requete)
{
    global $bdd;

    $req = $bdd->prepare($requete);
    $req->execute();
    $billes = $req->fetchAll();
	$req->closeCursor();

    return $billes;
}
function get_inventory_billes_for_login($requete,$login)
{
    global $bdd;

    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->execute();
    $billes = $req->fetchAll();
	$req->closeCursor();

    return $billes;
}
function get_nb_billes($requete)
{
    global $bdd;
        
    $req = $bdd->prepare($requete);
    $req->execute();
    $resultat = $req->fetchAll();
    $valeur = count($resultat);
	$req->closeCursor();
	return $valeur;
}
function get_billes_apparentees_by_id($requete, $id)
{
    global $bdd;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $resultat = $req->fetchAll();
	$req->closeCursor();
	return $resultat;
}
function get_conditionnements($requete)
{
    global $bdd;
    $req = $bdd->prepare($requete);
    $req->execute();
    $resultat = $req->fetchAll();
	$req->closeCursor();
	return $resultat;
}

function get_conditionnements_by_marque_id($requete, $id_marque_billes)
{
    global $bdd;
    $id_marque_billes = (int) $id_marque_billes;

    $req = $bdd->prepare($requete);
    $req->bindParam(':id_marque_billes', $id_marque_billes, PDO::PARAM_INT);
    $req->execute();
    $Conditionnements = $req->fetchAll();
	$req->closeCursor();

    return $Conditionnements;
}

function get_sizes_for_id($requete, $id)
{
    global $bdd;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id_billes', $id, PDO::PARAM_INT);
    $req->execute();
    $resultat = $req->fetch();
	$req->closeCursor();
	return $resultat;
}
