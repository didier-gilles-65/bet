<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else 
{
	retournerErreur( 400 , 01, 'GET_JSON_LISTE_AUTRES_PHOTOS.PHP| Pas de référence de bille dans les données en POST'); 
}
include_once('MODELE/get_connexion.php');

global $bdd;
$requete='SELECT `ID_BILLE`, `INDICE`, `FICHIER`, `CHEMIN`, `DATE_CREATION` FROM `autres_photos` WHERE ID_BILLE = '.$id;
$req = $bdd->prepare($requete);
if (!$req->execute()) {retournerErreur( 403 , 03, 'GET_JSON_LISTE_AUTRES_PHOTOS.PHP| Erreur lors de l\'exécution de la requète de récupération des adresses des photos'); }
$json = array();

while ($row = $req->fetch()) {
	$json[]=$row;
}

$req->closeCursor();

echo json_encode($json,JSON_UNESCAPED_SLASHES); 

?> 