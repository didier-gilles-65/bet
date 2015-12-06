<?php
error_reporting(E_ALL);
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');

if (isset($_GET['upload_id_bmc']))
{
	$id_mbc = $_GET['upload_id_bmc'];
}
else 
{
	retournerErreur( 403 , 02, 'GET_JSON_PHOTO.PHP| Erreur sur la requète : ID manquant');
}
global $bdd;
$requete = 'SELECT nom_fichier, id_photos_sac, type, id_marque_billes_conditionnement, index_photo 
FROM photos_sac
WHERE
photos_sac.id_marque_billes_conditionnement = '.$id_mbc.' ORDER BY index_photo ASC, type DESC';
$req = $bdd->prepare($requete);
if (!$req->execute()) { retournerErreur( 403 , 03, 'GET_JSON_PHOTO.PHP| Erreur sur l\exécution de la requète : '.$requete); }

$json = array();

while ($row = $req->fetch()) {
	$json[]=$row;
}
echo json_encode($json); 
exit();
?> 
