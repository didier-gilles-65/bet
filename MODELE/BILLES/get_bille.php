<?php
function get_reference_bille($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':num', $num, PDO::PARAM_INT);
    $req->execute();
    $bille = $req->fetch();
	$req->closeCursor();
    return $bille;
}

function get_bille($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
//	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':num', $num, PDO::PARAM_INT);
    $req->execute();
    $bille = $req->fetch();
	$req->closeCursor();
    return $bille;
}

function get_owned_bille($requete, $login, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':id_billes', $num, PDO::PARAM_INT);
    $req->execute();
    $owned_billes = $req->fetch();
	$req->closeCursor();
    return $owned_billes;
}

function get_liste_inventaire_pour_bille($requete, $login, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':id', $num, PDO::PARAM_INT);
    $req->execute();
    $mbc = $req->fetchall();
	$req->closeCursor();
    return $mbc;
}

function get_liste_sachets_pour_bille($requete, $login, $num, $mbc)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':id', $num, PDO::PARAM_INT);
    $req->bindParam(':mbc', $mbc, PDO::PARAM_INT);
    $req->execute();
    $mbc = $req->fetchall();
	$req->closeCursor();
    return $mbc;
}


function get_marques_id($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':num', $num, PDO::PARAM_INT);
    $req->execute();
    $marques = $req->fetchall();
	$req->closeCursor();
    return $marques;
}

function get_list_by_id($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id', $num, PDO::PARAM_INT);
    $req->execute();
    $liste = $req->fetchall();
	$req->closeCursor();
    return $liste;
}

function get_list($requete)
{
    global $bdd;
    $req = $bdd->prepare($requete);
    $req->execute();
    $liste = $req->fetchall();
	$req->closeCursor();
    return $liste;
}

function is_conditionnement_for_marque($liste, $conditionnement)
{
	foreach($liste as $cond)
	{
		if (in_array($conditionnement, $cond))
		{
			if ($cond['MARQUE'] != '') 
				return true;
			else
				return false;
		}
	}
	return false;
}

function get_id_bille_suivante($requete, $nom, $id)
{
    global $bdd;
	$offset=0;
	$limit=1000;
    $req = $bdd->prepare($requete);
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billes_locales = $req->fetchall();
	$req->closeCursor();
	$next=false;
	foreach($billes_locales as $bille_locale)
	{
		if ($next==true) {
			if (isset($bille_locale['ID_BILLES'])) { return($bille_locale['ID_BILLES']); }
			else return($bille_active['ID_BILLES']); }
		$bille_active = $bille_locale;
		if ($bille_locale['NOM'] == $nom) { $next = true; }
	}
    return $id;
}

function get_id_bille_precedente($requete, $nom, $id)
{
    global $bdd;
	$offset=0;
	$limit=1000;
    $req = $bdd->prepare($requete);
    $req->bindParam(':offset', $offset, PDO::PARAM_INT);
    $req->bindParam(':limit', $limit, PDO::PARAM_INT);
    $req->execute();
    $billes_locales = $req->fetchall();
	$req->closeCursor();
	$next=false;
	foreach($billes_locales as $bille_locale)
	{
		if ($bille_locale['NOM'] == $nom) {
			if (isset($bille_active['ID_BILLES'])) { return($bille_active['ID_BILLES']); }
			else return($id);
		}
		$bille_active = $bille_locale;
	}
    return $id;
}

function get_id_bille_by_nom($requete, $nom)
{
    global $bdd;
    $req = $bdd->prepare($requete);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
    $req->execute();
    $bille = $req->fetch();
	$req->closeCursor();
	if(!isset($bille['ID_BILLES'])) { return 0; } else { return $bille['ID_BILLES']; };
}

function get_photos($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id', $num, PDO::PARAM_INT);
    $req->execute();
    $photos = $req->fetchall();
	$req->closeCursor();
    return $photos;
}

function get_photos_conditionnement($requete, $num, $mbc)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id', $num, PDO::PARAM_INT);
    $req->bindParam(':mbc', $mbc, PDO::PARAM_INT);
    $req->execute();
    $photos = $req->fetchall();
	$req->closeCursor();
    return $photos;
}
function get_synonyms($requete, $num)
{
    global $bdd;
    $num = (int) $num;
    $req = $bdd->prepare($requete);
    $req->bindParam(':num', $num, PDO::PARAM_INT);
    $req->execute();
    $synonyms = $req->fetchall();
	$req->closeCursor();
    return $synonyms;
}

function set_sac($requete, $nombre, $code_barre, $commentaire, $id_smbc, $login)
{
    global $bdd;
    $nombre = (int) $nombre;
    $id_smbc = (int) $id_smbc;
    $req = $bdd->prepare($requete);
    if (!$req->bindParam(':nombre', $nombre, PDO::PARAM_INT)) ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur binding paramètre nombre:'.$nombre);
    if (!$req->bindParam(':code_barre', $code_barre, PDO::PARAM_STR)) ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur binding paramètre code_barre:'.$code_barre);
    if (!$req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR)) ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur binding paramètre commentaire:'.$commentaire);
    if (!$req->bindParam(':id_smbc', $id_smbc, PDO::PARAM_INT)) ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur binding paramètre id_smbc:'.$id_smbc);
    if (!$req->bindParam(':login', $login, PDO::PARAM_STR)) ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur binding paramètre login:'.$login);
    $ret = $req->execute();
    if (!$ret) {
		$dbErr = $req->errorInfo();
		if ( $dbErr[0] != '00000' ) {
			$trace = print_r($dbErr, true);
			ecrireLog('APP', 'ERROR', 'SET_UPDATE_BILLES : Erreur sur requète:'.$trace);
		}
	}

	$req->closeCursor();
    return $ret;
}
function remove_sac($requete, $id_smbc, $login)
{
    global $bdd;
    $id_smbc = (int) $id_smbc;
    $req = $bdd->prepare($requete);
    $req->bindParam(':id_smbc', $id_smbc, PDO::PARAM_INT);
    $req->bindParam(':login', $login, PDO::PARAM_STR);
    $ret = $req->execute();
	$req->closeCursor();
    return $ret;
}
function get_photos_sac($requete, $id_bille)
{
    global $bdd;
    $id_bille = (int) $id_bille;
    $req = $bdd->prepare($requete);
//	$req->bindParam(':login', $login, PDO::PARAM_STR);
    $req->bindParam(':id', $id_bille, PDO::PARAM_INT);
    $req->execute();
    $photos = $req->fetchall();
	$req->closeCursor();
    return $photos;
}


