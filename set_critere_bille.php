<!-- SET_CRITERE_BILLE.PHP

Script PHP permettant de mettre à jour un mot les critères de recherche pour établir la liste des billes affichées dans la page liste, et browsée depuis l'écran detail.

Les critères sont passés en POST

USES : 

TODO:

-->
<?php
session_start();
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('UTILS/langue.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking
if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

//$debug_chaine = print_r($_POST, true);
//ecrireLog('SQL', 'DEBUG', 'SET_CRITERE_BILLE.PHP| POST = '.$debug_chaine);

if (isset($_SESSION['login'])) {
	$login=$_SESSION['login'];
} else {
	header('Location: VUE/BILLES/v_erreur.php?id=1001');
	exit();
}

$REQUETE=$sql_liste_billes_critere;

//critere pour NOM
if(isset($_POST['critere_nom']))  
{ $REQUETE = $REQUETE.' AND marque_billes.COMMENTAIRE_MARQUE_BILLE LIKE \'%'.$_POST['critere_nom'].'%\''; }
else { $REQUETE = $REQUETE.' AND marque_billes.COMMENTAIRE_MARQUE_BILLE LIKE \'%\''; }

//critere pour DATES
if(isset($_POST['critere_app_avant']) && ($_POST['critere_app_avant'] >0))
{ $REQUETE = $REQUETE.' AND marque_billes.ANNEE_APPARITION IS NOT NULL AND marque_billes.ANNEE_APPARITION <= '.$_POST['critere_app_avant']; }
if(isset($_POST['critere_app_apres']) && ($_POST['critere_app_apres'] >0))
{ $REQUETE = $REQUETE.' AND marque_billes.ANNEE_APPARITION IS NOT NULL AND marque_billes.ANNEE_APPARITION >= '.$_POST['critere_app_apres']; }
if(isset($_POST['critere_disp_avant']) && ($_POST['critere_disp_avant'] >0))
{ $REQUETE = $REQUETE.' AND marque_billes.ANNEE_DISPARITION IS NOT NULL AND marque_billes.ANNEE_DISPARITION <= '.$_POST['critere_disp_avant']; }
if(isset($_POST['critere_disp_apres']) && ($_POST['critere_disp_apres'] >0))
{ $REQUETE = $REQUETE.' AND marque_billes.ANNEE_DISPARITION IS NOT NULL AND marque_billes.ANNEE_DISPARITION >= '.$_POST['critere_disp_apres']; }

//critere pour MARQUE DISPONIBLE
$premiere_valeur = true;
if(isset($_POST['critere_dispo_marque']) && (count($_POST['critere_dispo_marque']) >0)) {
	$REQUETE = $REQUETE.' AND NOM IN (
SELECT 
billes.NOM
FROM billes, marque_billes, marques
WHERE
billes.ID_BILLES=marque_billes.ID_BILLES AND 
marque_billes.ID_MARQUE=marques.ID_MARQUE';
	foreach ( $_POST['critere_dispo_marque'] as $critere_dispo_marque ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( marques.MARQUE = \''.$critere_dispo_marque.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR marques.MARQUE = \''.$critere_dispo_marque.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

//critere pour NON MARQUE DISPONIBLE
$premiere_valeur = true;
if(isset($_POST['critere_non_dispo_marque']) && (count($_POST['critere_non_dispo_marque']) >0)) {
	$REQUETE = $REQUETE.' AND NOM NOT IN (
SELECT 
billes.NOM
FROM billes, marque_billes, marques
WHERE
billes.ID_BILLES=marque_billes.ID_BILLES AND 
marque_billes.ID_MARQUE=marques.ID_MARQUE';
	foreach ( $_POST['critere_non_dispo_marque'] as $critere_non_dispo_marque ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( marques.MARQUE = \''.$critere_non_dispo_marque.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR marques.MARQUE = \''.$critere_non_dispo_marque.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

//critere pour POSSEDE TAILLE
//critere pour NE POSSEDE PAS TAILLE
if ((isset($_POST['critere_possede_taille']) && (count($_POST['critere_possede_taille']) >0)) || (isset($_POST['critere_non_possede_taille']) && (count($_POST['critere_non_possede_taille']) >0)) ) {
	$REQUETE = $REQUETE.' AND NOM IN (
	SELECT DISTINCT NOM FROM
	(SELECT billes.ID_BILLES, billes.NOM, billes.DESCRIPTION, sac_marque_billes_conditionnement.LOGIN_COMPTE, Sum(NOMBRE*NB12) AS POSSEDE_12mm, Sum(NOMBRE*NB14) AS POSSEDE_14mm, Sum(NOMBRE*NB16) AS POSSEDE_16mm, Sum(NOMBRE*NB21) AS POSSEDE_21mm, Sum(NOMBRE*NB25) AS POSSEDE_25mm, Sum(NOMBRE*NB35) AS POSSEDE_35mm, Sum(NOMBRE*NB42) AS POSSEDE_42mm, Sum(NOMBRE*NB50) AS POSSEDE_50mm
	FROM (((billes INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
	LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
	LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT) 
	LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT 
	GROUP BY billes.ID_BILLES, billes.NOM, sac_marque_billes_conditionnement.LOGIN_COMPTE 
	HAVING sac_marque_billes_conditionnement.LOGIN_COMPTE=\''.$login.'\''; 
	if (isset($_POST['critere_possede_taille']) && (count($_POST['critere_possede_taille']) >0)) {
		foreach ( $_POST['critere_possede_taille'] as $critere_possede_taille ) {
			$REQUETE = $REQUETE.' AND POSSEDE_'.$critere_possede_taille.' > 0';
		}
	}
	if (isset($_POST['critere_non_possede_taille']) && (count($_POST['critere_non_possede_taille']) >0)) {
		foreach ( $_POST['critere_non_possede_taille'] as $critere_non_possede_taille ) {
			$REQUETE = $REQUETE.' AND POSSEDE_'.$critere_non_possede_taille.' = 0';
		}
	}
	$REQUETE = $REQUETE.' ) as table_size )';
}

//critere pour EXISTE TAILLE
//critere pour N'EXISTE PAS TAILLE
if ((isset($_POST['critere_dispo_taille']) && (count($_POST['critere_dispo_taille']) >0)) || (isset($_POST['critere_non_dispo_taille']) && (count($_POST['critere_non_dispo_taille']) >0)) ) {
	$REQUETE = $REQUETE.' AND NOM IN (
	SELECT DISTINCT NOM FROM
	(SELECT billes.ID_BILLES,
	billes.NOM,
	billes.DESCRIPTION,
	SUM( ABS( NB12 ) ) AS EXISTE_12mm,
	SUM( ABS( NB14 ) ) AS EXISTE_14mm,
	SUM( ABS( NB16 ) ) AS EXISTE_16mm, 
	SUM( ABS( NB21 ) ) AS EXISTE_21mm, 
	SUM( ABS( NB25 ) ) AS EXISTE_25mm, 
	SUM( ABS( NB35 ) ) AS EXISTE_35mm, 
	SUM( ABS( NB42 ) ) AS EXISTE_42mm, 
	SUM( ABS( NB50 ) ) AS EXISTE_50mm
	FROM ((billes INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
	LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
	LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT 
	GROUP BY billes.ID_BILLES, billes.NOM'; 
$premiere_valeur = true;
	if ((isset($_POST['critere_dispo_taille']) && (count($_POST['critere_dispo_taille']) >0))) {
		foreach ( $_POST['critere_dispo_taille'] as $critere_dispo_taille ) {
			if ( $premiere_valeur ) {
				$REQUETE = $REQUETE.' HAVING EXISTE_'.$critere_dispo_taille.' > 0';
				$premiere_valeur = false;
			}
			else {
				$REQUETE = $REQUETE.' AND EXISTE_'.$critere_dispo_taille.' > 0';
			}
		}
	}
	if(isset($_POST['critere_non_dispo_taille']) && (count($_POST['critere_non_dispo_taille']) >0)) {
		foreach ( $_POST['critere_non_dispo_taille'] as $critere_non_dispo_taille ) {
			if ( $premiere_valeur ) {
				$REQUETE = $REQUETE.' HAVING EXISTE_'.$critere_non_dispo_taille.' = 0';
				$premiere_valeur = false;
			}
			else {
				$REQUETE = $REQUETE.' AND EXISTE_'.$critere_non_dispo_taille.' = 0';
			}
		}
	}
	$REQUETE = $REQUETE.' ) as table_size_existe )';
}

//critere pour CONDITIONNEMENT DISPONIBLE
$premiere_valeur = true;
if(isset($_POST['critere_dispo_conditionnement']) && (count($_POST['critere_dispo_conditionnement']) >0)) {
	$REQUETE = $REQUETE.' AND NOM IN (
SELECT 
billes.NOM
FROM billes, marque_billes, marques, marque_billes_conditionnement, conditionnement
WHERE
conditionnement.FLAG_SAC=true AND
billes.ID_BILLES=marque_billes.ID_BILLES AND 
marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT 
';
	foreach ( $_POST['critere_dispo_conditionnement'] as $critere_dispo_conditionnement ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( conditionnement.NOM  = \''.$critere_dispo_conditionnement.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR conditionnement.NOM = \''.$critere_dispo_conditionnement.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

//critere pour NON CONDITIONNEMENT DISPONIBLE
$premiere_valeur = true;
if(isset($_POST['critere_non_dispo_conditionnement']) && (count($_POST['critere_non_dispo_conditionnement']) >0)) {
	$REQUETE = $REQUETE.' AND NOM NOT IN (
SELECT 
billes.NOM
FROM billes, marque_billes, marques, marque_billes_conditionnement, conditionnement
WHERE
conditionnement.FLAG_SAC=true AND
billes.ID_BILLES=marque_billes.ID_BILLES AND 
marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT 
';
	foreach ( $_POST['critere_non_dispo_conditionnement'] as $critere_non_dispo_conditionnement ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( conditionnement.NOM  = \''.$critere_non_dispo_conditionnement.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR conditionnement.NOM = \''.$critere_non_dispo_conditionnement.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

//critere pour POSSESSION CONDITIONNEMENT
$premiere_valeur = true;
if(isset($_POST['critere_possede_conditionnement']) && (count($_POST['critere_possede_conditionnement']) >0)) {
	$REQUETE = $REQUETE.' AND NOM IN (
SELECT DISTINCT billes.NOM
FROM (((billes INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT) 
LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT 
WHERE sac_marque_billes_conditionnement.LOGIN_COMPTE=\''.$login.'\' AND sac_marque_billes_conditionnement.NOMBRE > 0 ';
	foreach ( $_POST['critere_possede_conditionnement'] as $critere_possede_conditionnement ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( conditionnement.NOM  = \''.$critere_possede_conditionnement.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR conditionnement.NOM = \''.$critere_possede_conditionnement.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

//critere pour NON POSSESSION CONDITIONNEMENT
$premiere_valeur = true;
if(isset($_POST['critere_non_possede_conditionnement']) && (count($_POST['critere_non_possede_conditionnement']) >0)) {
	$REQUETE = $REQUETE.' AND NOM NOT IN (
SELECT DISTINCT billes.NOM
FROM (((billes INNER JOIN marque_billes ON billes.ID_BILLES = marque_billes.ID_BILLES) 
LEFT JOIN marque_billes_conditionnement ON marque_billes.ID_MARQUE_BILLES = marque_billes_conditionnement.ID_MARQUE_BILLES) 
LEFT JOIN conditionnement ON marque_billes_conditionnement.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT) 
LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT 
WHERE sac_marque_billes_conditionnement.LOGIN_COMPTE=\''.$login.'\' AND sac_marque_billes_conditionnement.NOMBRE > 0 ';
	foreach ( $_POST['critere_non_possede_conditionnement'] as $critere_non_possede_conditionnement ) {
		if ( $premiere_valeur ) {
		$REQUETE = $REQUETE.' AND ( conditionnement.NOM  = \''.$critere_non_possede_conditionnement.'\'';
		$premiere_valeur = false;
		}
		else {
		$REQUETE = $REQUETE.' OR conditionnement.NOM = \''.$critere_non_possede_conditionnement.'\'';
		}
	}
	$REQUETE = $REQUETE.' ) )';
}

$REQUETE=$REQUETE.' ORDER BY NOM';

//ecrireLog('SQL', 'DEBUG', 'SET_CRITERE_BILLE.PHP| REQUETE = '.$REQUETE);


$_SESSION['requete_courante']=$REQUETE;
//print_r($_SESSION);
//print_r($_POST);
//exit();
header('Location: /liste_billes.php');
?>
