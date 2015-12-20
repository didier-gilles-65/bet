<?php
/* SET_UPDATE_REFERENCE_BILLE.PHP

script PHP de mise à jour des données de référence d'un type de billes.

USES : 

TODO:

*/
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/langue.php');
include_once('MODELE/BILLES/get_bille.php');
include_once('UTILS/security.php'); // utils for permanent login checking

	if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

	$error = 0;
    //retrieve our data from POST
	if (isset($_POST['input_nom'])) { $nom = $bdd->quote($_POST['input_nom']); } else { $error = 1; }
	if (isset($_POST['input_description'])) { $description = $_POST['input_description']; } else { $error = 1; }
	if (isset($_POST['input_description_anglaise'])) { $description_anglaise = $_POST['input_description_anglaise']; } else { $error = 1; }
	if (isset($_POST['input_base_frittee']) && (($_POST['input_base_frittee'])== 'true')) { $base_frittee = 1; } else { $base_frittee = 0; }
	if (isset($_POST['input_base_irisee']) && (($_POST['input_base_irisee'])== 'true')) { $base_irisee = 1; } else { $base_irisee = 0; }
	if (isset($_POST['input_base_givree']) && (($_POST['input_base_givree'])== 'true')) { $base_givree = 1; } else { $base_givree = 0; }
	if (isset($_POST['input_base_couleur'])) { $base_couleur = $bdd->quote($_POST['input_base_couleur']); } else { $error = 1; }
	if (isset($_POST['input_base_type'])) { $base_type = $bdd->quote($_POST['input_base_type']); } else { $error = 1; }
	if (isset($_POST['input_motif_couleur'])) { $motif_couleur = $bdd->quote($_POST['input_motif_couleur']); } else { $error = 1; }
	if (isset($_POST['input_motif_type'])) { $motif_type = $bdd->quote($_POST['input_motif_type']); } else { $error = 1; }

    $id = $_POST['bille'];
	if ($error)
	{
		header('Location: detail.php?id='.$id.'&err=true');
		exit();
	}
	$requete="DELETE FROM SYNONYMES WHERE SYNONYME_A=$id or SYNONYME_B=$id ";
	ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
	$req = $bdd->prepare($requete);
	$req->execute();
	if (isset($_POST['input_synonyme'])) { 
		foreach ($_POST['input_synonyme'] as $synonyme)
		{
			$id_synonym = get_id_bille_by_nom($sql_bille_by_id, $synonyme);
			if ($id_synonym == 0) { continue; }
			$requete="INSERT INTO SYNONYMES ( SYNONYME_A, SYNONYME_B ) values ( $id, $id_synonym )";
			ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
			$req = $bdd->prepare($requete);
			if (!$req->execute()){
				continue;
			}
		}
	}
	$description = $bdd->quote($description);
	$description_anglaise = $bdd->quote($description_anglaise);	

	$requete="UPDATE billes set nom = $nom, description = $description, description_anglaise = $description_anglaise, base_frittee = $base_frittee, base_irisee = $base_irisee, base_givree = $base_givree, base_couleur = $base_couleur, base_type = $base_type, motif_couleur = $motif_couleur, motif_type = $motif_type where ID_BILLES=$id";
	ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
    $req = $bdd->prepare($requete);

    if (!$req->execute()){
		header('Location: index.php?err=6410');
		exit();
	}
	if (isset($_POST['marques'])) { 
		foreach ($_POST['marques'] as $ListeMarque)
		{
			$id_marque=$ListeMarque['id_marque'];
			if ($ListeMarque['apparition'] > 0) { $apparition = $ListeMarque['apparition']; } else { $apparition = 'NULL'; }
			if ($ListeMarque['disparition'] >0) { $disparition = $ListeMarque['disparition']; } else { $disparition = 'NULL'; }
			if (isset($ListeMarque['commentaire'])) { $commentaire = $bdd->quote($ListeMarque['commentaire']); }  else { $commentaire = ''; }
			if (isset($ListeMarque['id_marque_bille'])) { $id_marque_billes = $ListeMarque['id_marque_bille']; }  else { $id_marque_billes = ''; }
			if ($ListeMarque['initial']== 'false') {
				if (isset($ListeMarque['EXISTE'])  && (($ListeMarque['EXISTE'])== 'true')) {
// MARQUE A RAJOUTER POUR CETTE BILLE : ajouter les enregistrements dans marque_billes et dans marque_billes_conditionnement sans vérification
					$requete="INSERT INTO marque_billes(ID_BILLES, ID_MARQUE, ANNEE_APPARITION, ANNEE_DISPARITION,COMMENTAIRE_MARQUE_BILLE) VALUES ($id,$id_marque,$apparition,$disparition,$commentaire)";
					ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
					$req = $bdd->prepare($requete);
					if (!$req->execute()){ continue; }
					$req->closeCursor();
					
				// récupérer id_marque_billes
					$sql="SELECT ID_MARQUE_BILLES FROM marque_billes WHERE ID_BILLES=$id AND ID_MARQUE=$id_marque";
					$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
					if (!$req->execute()) { continue; }
					$NewMarqueBille = $req->fetch();
					if (!$NewMarqueBille) { continue; }
					$id_marque_billes=$NewMarqueBille['ID_MARQUE_BILLES'];
					$req->closeCursor();

					if (!isset($ListeMarque['conditionnement'])) { continue; }

					foreach ($ListeMarque['conditionnement'] as $id_conditionnement)
					{
						if ($id_conditionnement < 0) { continue; }
						$requete='INSERT INTO marque_billes_conditionnement(ID_MARQUE_BILLES, ID_CONDITIONNEMENT) VALUES ('.$id_marque_billes.', '.$id_conditionnement.')';
						ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
						$req = $bdd->prepare($requete);
						if (!$req->execute()){ continue; }
						$req->closeCursor();
					}
					continue;
				}
				else
				{
// MARQUE -NON- DISPONIBLE POUR CETTE BILLE : ne rien faire
					continue;
				}
			}
			else
			{
				if (isset($ListeMarque['EXISTE'])  && (($ListeMarque['EXISTE'])== 'true')) {
// MARQUE DEMANDEE POUR CETTE BILLE : Traiter uniquement les modifications sur marque_billes et les CONDITIONNEMENTS, en vérifiant si certains sont enlevés alors qu'ils sont encore référencés
/*
				// récupérer id_marque_billes ATTENTION : PAS NECESSAIRE Si EXISTE : true : dans ce cas id_marque_billes doit déjà être renseigné
					$sql="SELECT ID_MARQUE_BILLES FROM marque_billes WHERE ID_BILLES=$id AND ID_MARQUE=$id_marque";
					$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
					if (!$req->execute()) { continue; }
					$NewMarqueBille = $req->fetch();
					if (!$NewMarqueBille) { continue; }
					$id_marque_billes=$NewMarqueBille['ID_MARQUE_BILLES'];
					$req->closeCursor();
*/
				// mettre à jour le marque_billes récupéré
					$requete="UPDATE marque_billes SET ANNEE_APPARITION=$apparition, ANNEE_DISPARITION=$disparition, COMMENTAIRE_MARQUE_BILLE=$commentaire WHERE ID_MARQUE_BILLES = $id_marque_billes";
					ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
					$req = $bdd->prepare($requete);
					if (!$req->execute()){ continue; }
					$req->closeCursor();

				// Si pas de conditionnement demandé, on initialise une liste vide
					if (!isset($ListeMarque['conditionnement'])) { $ListeMarque['conditionnement']=array(); }

				// récupérer la liste des conditionnements, avec pour chacun le comptage des instances de sacs, lorsque le conditionnement est disponible pour la marque_bille
					$sql="SELECT conditionnement.ID_CONDITIONNEMENT, conditionnement.NOM, table1.ID_MARQUE_BILLES_CONDITIONNEMENT, table1.ID_MARQUE_BILLES, table1.COMPTE FROM conditionnement LEFT JOIN ( SELECT marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES, COUNT( ID_SAC_MARQUE_BILLES_CONDITIONNEMENT ) AS COMPTE FROM marque_billes_conditionnement LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT WHERE marque_billes_conditionnement.ID_MARQUE_BILLES =$id_marque_billes GROUP BY marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES ) AS table1 ON table1.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT";
					ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$sql);
					$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
					if (!$req->execute()) { continue; }
					$liste_comptage_sac_conditionnements_marque_id = $req->fetchall();
					if (!$liste_comptage_sac_conditionnements_marque_id) { continue; }
					$req->closeCursor();
					
				/* pour chaque conditionnement,
					lorsque celui-ci est déjà instancié, on vérifie s'il est toujours dans la liste cibles
						si oui, on ne fait rien,
						si non, on regarde le nombre de sac : s'il est différent de 0, on NE SUPPRIME PAS le MBC
					sinon, lorsque celui-ci n'est pas instancié, on vérifie s'il est dans la liste cible:
						si oui on crée le mbc
						si non, on ne fait rien
				*/
					foreach ($liste_comptage_sac_conditionnements_marque_id as $check_conditionnement) // on parcourt la liste des conditionnements définis
					{
						if (isset($check_conditionnement['ID_MARQUE_BILLES'])) // si id_marque_bille est initialisé, alors celui-ci existe pour le conditionnement courant...
						{
							if ((!in_array($check_conditionnement['ID_CONDITIONNEMENT'], $ListeMarque['conditionnement'])) && ($check_conditionnement['COMPTE']==0)) 
							{ //si le conditionnement courant est ABSENT de la liste demandée et qu'il n'y a pas de "sac" sur ce conditionnement, alors on retire le conditionnement
//ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| $check_conditionnement = '.print_r($check_conditionnement,true));
								$var=$check_conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'];
								$requete="DELETE FROM marque_billes_conditionnement where ID_MARQUE_BILLES_CONDITIONNEMENT = $var";
								ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
								$req = $bdd->prepare($requete);
								if (!$req->execute()){ continue; }
								$req->closeCursor();
							}
						}
						else // si id_marque_bille N'est PAS initialisé, alors celui-ci n'existe PAS ENCORE pour le conditionnement courant...
						{
							if (in_array($check_conditionnement['ID_CONDITIONNEMENT'],$ListeMarque['conditionnement']))
							{ //si le conditionnement courant est PRESENT dans la liste demandée, alors on ajoute le conditionnement
								$requete='INSERT INTO marque_billes_conditionnement(ID_MARQUE_BILLES, ID_CONDITIONNEMENT) VALUES ('.$id_marque_billes.', '.$check_conditionnement['ID_CONDITIONNEMENT'].')';
								ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
								$req = $bdd->prepare($requete);
								if (!$req->execute()){ continue; }
								$req->closeCursor();
							}
						}
					}
					continue;
				}
				else
				{
// MARQUE -NON- DISPONIBLE POUR CETTE BILLE : Vérifier si les conditionnements ne sont plus référencés, et ensuite supprimer tous les conditionnements et marques associées pour cette bille.


				// récupérer id_marque_billes
					if ( $id_marque_billes == '' ) {
						continue;
					}
					else {
						$sql="SELECT ID_MARQUE_BILLES FROM marque_billes WHERE ID_MARQUE_BILLES=$id_marque_billes";
					}
					ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$sql);
					$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
					if (!$req->execute()) { continue; }
					$NewMarqueBille = $req->fetch();
					if (!$NewMarqueBille) { continue; }
					$id_marque_billes=$NewMarqueBille['ID_MARQUE_BILLES'];
					$req->closeCursor();
					
				// récupérer la liste des conditionnements, avec pour chacun le comptage des instances de sacs, lorsque le conditionnement est disponible pour la marque_bille
					$sql="SELECT conditionnement.ID_CONDITIONNEMENT, conditionnement.NOM, table1.ID_MARQUE_BILLES_CONDITIONNEMENT, table1.ID_MARQUE_BILLES, table1.COMPTE FROM conditionnement LEFT JOIN ( SELECT marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES, COUNT( ID_SAC_MARQUE_BILLES_CONDITIONNEMENT ) AS COMPTE FROM marque_billes_conditionnement LEFT JOIN sac_marque_billes_conditionnement ON marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT = sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT WHERE marque_billes_conditionnement.ID_MARQUE_BILLES =$id_marque_billes GROUP BY marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT, marque_billes_conditionnement.ID_MARQUE_BILLES ) AS table1 ON table1.ID_CONDITIONNEMENT = conditionnement.ID_CONDITIONNEMENT";
					ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$sql);
					$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
					if (!$req->execute()) { continue; }
					$liste_comptage_sac_conditionnements_marque_id = $req->fetchall();
					if (!$liste_comptage_sac_conditionnements_marque_id) { continue; }
					$req->closeCursor();
					
				/* pour chaque conditionnement, si un sac existe, on arrête le traitement de ce conditionnement
				*/
					$flag_suppression_mb=true;
					foreach ($liste_comptage_sac_conditionnements_marque_id as $check_conditionnement) // on parcourt la liste des conditionnements définis
					{
						if (isset($check_conditionnement['ID_MARQUE_BILLES'])) // si id_marque_bille est initialisé, alors celui-ci existe pour le conditionnement courant...
						{
							if ($check_conditionnement['COMPTE']==0)
							{ //si le conditionnement courant est ABSENT de la liste demandée et qu'il n'y a pas de "sac" sur ce conditionnement, alors on retire le conditionnement
								$var=$check_conditionnement['ID_MARQUE_BILLES_CONDITIONNEMENT'];
								$requete="DELETE FROM marque_billes_conditionnement where ID_MARQUE_BILLES_CONDITIONNEMENT = $var";
								ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
								$req = $bdd->prepare($requete);
								if (!$req->execute()){ continue; }
								$req->closeCursor();
							}
							if ($check_conditionnement['COMPTE']>0) { $flag_suppression_mb=false; }
						}
					}
				// supprimer le marque_billes récupéré SI IL N'Y A AUCUN SAC SUR CONDITIONNEMENT RATTACHE A CETTE MARQUE
					if ( $flag_suppression_mb )
					{
						$requete="DELETE from marque_billes WHERE ID_MARQUE_BILLES = $id_marque_billes";
						ecrireLog('SQL', 'INFO', 'SET_UPDATE_REFERENCE_BILLES.PHP| REQUETE = '.$requete);
						$req = $bdd->prepare($requete);
						if (!$req->execute()){ continue; }
						$req->closeCursor();
					}
					continue;
				}
			}
		}
	}

//exit();
	header('Location: detail.php?id='.$id);
	exit();
     
?>
