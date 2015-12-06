<?php
session_start();
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking

    //Données passées en POST : S'il s'agit de l'envoi de formulaire, suite au scan fait par l'IPAD
    if (isset($_POST['code']) ) { $pcode = $_POST['code']; echo $pcode.'/';}
    if (isset($_POST['input_nombre']) ) { $pnombre = $_POST['input_nombre']; echo $pnombre.'/';}
    if (isset($_POST['input_comment']) ) { $pcomment = $bdd->quote($_POST['input_comment']); echo $pcomment.'/';}
    if (isset($_POST['input_nom_bille']) ) { $pbille = $_POST['input_nom_bille']; echo $pbille.'/'; }
    if (isset($_POST['id_conditionnement']) ) { $pconditionnement = $_POST['id_conditionnement'];  echo $pconditionnement.'/'; }
    if (isset($_POST['id_marque']) ) { $pmarque = $_POST['id_marque']; echo $pmarque.'/'; }
    if (isset($_POST['input_existing']) ) { $pexisting = $_POST['input_existing'];  echo $pexisting.'/'; }
	if (isset($_POST['id_conditionnement']) ) { ecrireLog('APP', 'INFO', 'SCAN :'.$pcode.'|'.$pmarque.'|'.$pbille.'|'.$pconditionnement);}

    //Données passées en GET : code et type, si on est sur le scan par l'IPAD
    if (isset($_GET['code']) ) { $code = $_GET['code']; }

	if (!isset($pcode) ) {
		if ($code=='%s')
		{
			$req = $bdd->prepare("SELECT * FROM sac_marque_billes_conditionnement where ID_MARQUE_BILLES_CONDITIONNEMENT = 0 ORDER BY DATE_CREATION DESC"); //Si la requète vient du renvoi depuis le scan vers SAFARI, alors on récupère le code et le type du dernier scan non affecté
			if ($req->execute()) {
				$myarray = $req->fetch();
				if (!$myarray) { echo '<h1 style="color:red">ERREUR</h1> : Pas de scan à affecter'; exit(); }
				$code = $myarray['CODE_BARRE'];
			}
			else { echo '<h1 style="color:red">ERREUR</h1> : Pas de scan à affecter'; exit(); }
		}
		if (!isset($_GET['code']) ) { echo 'Should\'nt be there, man!';	exit(); }
		$sql='SELECT * FROM sac_marque_billes_conditionnement where CODE_BARRE = \''.$code.'\' and ID_MARQUE_BILLES_CONDITIONNEMENT = 0';
		$req = $bdd->prepare($sql); //Vérifie l'existence d'un premier scan pour ce code, cad si on est déjà passé par le scan.php
		if (($req->execute()) and ($req->fetchall())) {
			$req->closeCursor();		
			$sql='SELECT ID_SAC_MARQUE_BILLES_CONDITIONNEMENT,CODE_BARRE,billes.NOM as NOM_BILLE,marques.MARQUE,conditionnement.NOM FROM sac_marque_billes_conditionnement,marque_billes_conditionnement,marque_billes,marques,billes,conditionnement WHERE CODE_BARRE='.$code.'  AND sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT > 0 AND sac_marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT=marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT AND marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND marque_billes_conditionnement.ID_MARQUE_BILLES=marque_billes.ID_MARQUE_BILLES AND marque_billes.ID_BILLES=billes.ID_BILLES AND marque_billes.ID_MARQUE=marques.ID_MARQUE';
			$req = $bdd->prepare($sql); //Vérifie l'existence d'un premier scan pour ce code
			if ($req->execute()) {
				$existing_codes = $req->fetchall();
				if (!$existing_codes) {$flag_existing_codes = false;} else {$flag_existing_codes = true;}
				$req->closeCursor();
			}
			include_once('formulaire_scan.php'); exit();
		} //Le scan est déjà entré, on affiche donc le formulaire d'entrée
		$req->closeCursor();
	
		if (isset($code) ) {
			$sql='INSERT INTO sac_marque_billes_conditionnement ( CODE_BARRE,ID_MARQUE_BILLES_CONDITIONNEMENT  ) VALUES ( \''.$code.'\',0);';
			$req = $bdd->prepare($sql); //S'il s'agit du premier scan IPAD pour ce code, on insère le barcode
			if ($req->execute())
			{
				$req->closeCursor();
				echo 'CODE : '.$code.' créé correctement. Veuillez affecter le conditionnement';
				exit();
			}
			echo 'CODE : '.$code.' non créé. Veuillez recommencer'; // Erreur si on n'a pas pu insérer le barcode
			exit();
		}
	}
	else
	{
		if (isset($pexisting) && ($pexisting > 0)) {
			$req = $bdd->prepare("UPDATE sac_marque_billes_conditionnement set NOMBRE=NOMBRE+1 where ID_MARQUE_BILLES_CONDITIONNEMENT = $pexisting"); //METTRE A JOUR le scan sélectionner en rajoutant 1 si sélection
			if ($req->execute())
			{
				$trace ='CODE : '.$pcode.' mis a jour (sur existant)' ;
				ecrireLog('APP', 'INFO', $trace);
				echo $trace ;
				$req = $bdd->prepare("DELETE FROM sac_marque_billes_conditionnement where CODE_BARRE = '$pcode'  and ID_MARQUE_BILLES_CONDITIONNEMENT = 0"); //EFFACER LE SCAN SI ON A REUTILISE UN SCAN EXISTANT
				if ($req->execute())
				{
					$trace ='SCAN EFFACE : '.$pcode ;
				}
				else
				{
					$trace ='LE SCAN N\' A PAS PU ETRE EFFACE : '.$pcode ;
				}
				echo $trace ;
				exit();
			}
		}
		$sql='SELECT ID_MARQUE_BILLES_CONDITIONNEMENT FROM marque_billes_conditionnement, marque_billes, billes WHERE billes.NOM=\''.$pbille.'\' AND billes.ID_BILLES=marque_billes.ID_BILLES AND marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND marque_billes.ID_MARQUE='.$pmarque.' AND marque_billes_conditionnement.ID_CONDITIONNEMENT='.$pconditionnement;
		$req = $bdd->prepare($sql); //Vérifie l'existence d'un triple bille-marque-conditionnement
		if (!$req->execute()) { echo '<h1 style="color:red">ERREUR</h1> CE CONDITIONNEMENT N EST PAS DISPONIBLE POUR CETTE BILLE SOUS CETTE MARQUE!'; exit(); }
		$myid = $req->fetch();
		if (!$myid) { echo '<h1 style="color:red">ERREUR</h1> CE CONDITIONNEMENT N EST PAS DISPONIBLE POUR CETTE BILLE SOUS CETTE MARQUE!'; exit(); }
		$req->closeCursor();

		$req = $bdd->prepare('SELECT * FROM sac_marque_billes_conditionnement where CODE_BARRE = '.$pcode.' and ID_MARQUE_BILLES_CONDITIONNEMENT = 0'); //Vérifie l'existence d'un premier scan pour ce code
		if ((!$req->execute()) or (!$req->fetchall())) { echo 'ERREUR : PAS DE SCAN A AFFECTER!'; exit(); } //Le scan est déjà affecté : on sort!
		$req->closeCursor();
		$sql='UPDATE sac_marque_billes_conditionnement set LOGIN_COMPTE=\''.'admin'.'\', NOMBRE='.$pnombre.', ID_MARQUE_BILLES_CONDITIONNEMENT='.$myid['ID_MARQUE_BILLES_CONDITIONNEMENT'].', COMMENTAIRE = '.$pcomment.' where CODE_BARRE = \''.$pcode.'\' and ID_MARQUE_BILLES_CONDITIONNEMENT = 0';
		ecrireLog('SQL', 'INFO', 'SCAN.PHP| REQUETE = '.$sql);
		$req = $bdd->prepare($sql); //METTRE A JOUR LE BARCODE AVEC L'ID DE CONDITIONNEMENT SELECTIONNE
		if ($req->execute())
		{
			$trace ='CODE : '.$pcode.' mis a jour avec '.$pbille.' et '.$pconditionnement ;
			ecrireLog('APP', 'INFO', $trace);
			echo $trace ;
		}
		else { echo '<h1 style="color:red">ERREUR</h1> POUR INSERER LA MAJ!'; }
		$req->closeCursor();
	}
?>