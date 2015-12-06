<?php
if (isset($_GET['id']))
{
	$id = $_GET['id'];
}
else 
{
	retournerErreur( 400 , 01, 'GET_JSON_LISTE_SACHETS.PHP| Erreur sur les paramètres d\'entrée');
}
if (isset($_GET['login']))
{
	$login = $_GET['login'];
}
else 
{
	retournerErreur( 400 , 01, 'GET_JSON_LISTE_SACHETS.PHP| Erreur sur les paramètres d\'entrée');
}
include_once('MODELE/get_connexion.php');
include_once('UTILS/common_sql.php');
include_once('UTILS/log.php');

global $bdd;
$requete=$sql_liste_marque_bille_conditionnement_pour_bille;

$req = $bdd->prepare($requete);
$req->bindParam(':login', $login, PDO::PARAM_STR);
$req->bindParam(':id', $id, PDO::PARAM_INT);
ecrireLog('SQL', 'INFO', 'GET_JSON_LISTE_SACHETS.PHP| REQUETE = '.$requete);

if (!$req->execute()) {retournerErreur( 403 , 03, 'GET_JSON_LISTE_SACHETS.PHP| Erreur lors de l\'exécution de la requète de récupération des sachets'); }
$json = array();

while ($row = $req->fetch()) {
	$json[]=$row;
}

$req->closeCursor();

echo json_encode($json,JSON_UNESCAPED_SLASHES); 

?> 