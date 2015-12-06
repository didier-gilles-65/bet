<!-- SET_UPDATE_BILLE.PHP

script PHP de mise à jour des données de référence d'un type de billes.

USES : 

TODO:

-->
<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('MODELE/BILLES/get_bille.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();


    //retrieve our data from POST
    $id = $_POST['bille'];
    $login = $_POST['login'];

//print_r($_POST['mbc']);
//exit();
foreach($_POST['mbc'] as $bille)
{
	if(isset($bille['id_mb']) && (is_numeric($bille['id_mb']))){ $idmb = $bille['id_mb']; } else $idmb = 0;
	if(isset($bille['id_mbc']) && (is_numeric($bille['id_mbc']))){ $idmbc = $bille['id_mbc']; } else $idmbc = 0;
	if(isset($bille['id_smbc']) && (is_numeric($bille['id_smbc']))){ $idsmbc = $bille['id_smbc']; } else $idsmbc = 0;
	if(isset($bille['NOMBRE']) && (is_numeric($bille['NOMBRE']))){ $nombre = $bille['NOMBRE']; } else $nombre = 0;
    $code_barre = $bille['CODE_BARRE'];
	if( isset($bille['SAC_COMMENTAIRE']) ){ $sac_commentaire = htmlspecialchars($bille['SAC_COMMENTAIRE']); } else $sac_commentaire = '';

	$requete='SELECT * from sac_marque_billes_conditionnement where ID_SAC_MARQUE_BILLES_CONDITIONNEMENT='.$idsmbc;
    $req = $bdd->prepare($requete);
	$req->execute();
	$toto=$req->fetchall();

	$retour=true;
	if (count($toto) > 0) {
		if (($nombre>0)||($nombre<0)) {
			$retour=set_sac($sql_update_sac, $nombre, $code_barre, $sac_commentaire, $idsmbc, $login);
		} else {
			$retour=remove_sac($sql_delete_sac, $idsmbc, $login);
		}
	} else {
		if (($nombre>0)||($nombre<0)) {
			$retour=set_sac($sql_insert_sac, $nombre, $code_barre, $sac_commentaire, $idmbc, $login);
		}
		else { 
	 		continue;
		}
	}
	
    if (!$retour){
		header('Location: index.php?err=6320');
		exit();
	}
}
header('Location: detail.php?id='.$id);
exit();
  
?>
