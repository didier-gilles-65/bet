<?php

function get_user($requete, $login)
{
    global $bdd;
    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->execute();
    $users = $req->fetchAll();
	$req->closeCursor();
    return $users;
}

function get_single_user($requete, $login)
{
    global $bdd;
    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();
	$req->closeCursor();
    return $user;
}