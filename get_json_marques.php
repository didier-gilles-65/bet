<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else 
{
	$id = 0;
}
include_once('MODELE/get_connexion.php');

global $bdd;
$requete = 'SELECT marques.ID_MARQUE, marques.MARQUE, marque_billes.ID_MARQUE_BILLES, marque_billes.ANNEE_APPARITION, marque_billes.ANNEE_DISPARITION, marque_billes.COMMENTAIRE_MARQUE_BILLE
FROM billes, marque_billes, marques
WHERE billes.ID_BILLES = marque_billes.ID_BILLES AND marque_billes.ID_MARQUE = marques.ID_MARQUE AND billes.ID_BILLES='.$id;
$req = $bdd->prepare($requete);
if (!$req->execute()) { retournerErreur( 403 , 03, 'GET_JSON_MARQUES.PHP| Erreur sur l\exécution de la requète : '.$requete); }

$json = array();

while ($row = $req->fetch()) {
	$json[]=$row;
}

echo json_encode($json,JSON_UNESCAPED_SLASHES); 
exit();
?> 