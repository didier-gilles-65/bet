<?php
if (isset($_GET['id_marque_bille']))
{
	$id_marque_bille = $_GET['id_marque_bille'];
}
else 
{
	$id_marque_bille = 0;
}
include_once('MODELE/get_connexion.php');

global $bdd;
$requete = 'SELECT marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, conditionnement.NOM, marque_billes.COMMENTAIRE_MARQUE_BILLE 
FROM marque_billes, marque_billes_conditionnement, conditionnement
WHERE
conditionnement.FLAG_SAC=true AND
marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND 
marque_billes.ID_MARQUE_BILLES='.$id_marque_bille.' ORDER BY conditionnement.NOM';
$req = $bdd->prepare($requete);
if (!$req->execute()) {retournerErreur( 403 , 03, 'GET_JSON_CONDITIONNEMENTS.PHP| Erreur lors de l\'exécution de la requète de récupération des adresses des photos'); }
$json = array();

while ($row = $req->fetch()) {
	$json[]=$row;
}

$req->closeCursor();

echo json_encode($json,JSON_UNESCAPED_SLASHES); 
exit();
?> 
