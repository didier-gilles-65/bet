<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');
include_once('MODELE/get_connexion.php');
include_once('UTILS/security.php'); // utils for permanent login checking

function imageCreateFromAny($filepath) { 
    list($w, $h, $t, $attr) = getimagesize($filepath); // [] if you don't have exif you could use getImageSize() 
    $allowedTypes = array( 
        IMG_GIF,  // [] gif 
        IMG_JPG,  // [] jpg 
        IMG_PNG,  // [] png 
        IMG_WBMP   // [] bmp 
    ); 
    if (!in_array($t, $allowedTypes)) { 
        return false; 
    } 
    switch ($t) { 
        case IMG_GIF : 
            $im = imageCreateFromGif($filepath); 
			echo 'type image GIF';
        break; 
        case IMG_JPG : 
            $im = imageCreateFromJpeg($filepath); 
			echo 'type image JPG';
        break; 
        case IMG_PNG : 
            $im = imageCreateFromPng($filepath); 
			echo 'type image PNG';
        break; 
        case IMG_WBMP : 
            $im = imageCreateFromwBmp($filepath); 
			echo 'type image BMP';
        break; 
    }    
echo 'source : '.$filepath.' | im : '.$im;
    return $im;  
}

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login();

if(isset($_GET['id'])) { $id_photo_sac = $_GET['id']; } else { $id_photo_sac = 0; }
if(isset($_GET['type'])) { $upload_type = $_GET['type']; } else { $upload_type = ''; }
if(isset($_GET['id_mbc'])) { $id_mbc = $_GET['id_mbc']; } else { $id_mbc = 0; }
if(isset($_GET['update'])) { $update = $_GET['update']; } else { $update = ''; }
if(isset($_GET['index'])) { $index = $_GET['index']; } else { $index = -1; }

$uploaddir = 'IMAGES/ETIQUETTES/';
$requete = '';
$recherche_index = false;

if ($id_photo_sac > 0) {
	$requete='SELECT nom_fichier FROM photos_sac WHERE id_photos_sac = '.$id_photo_sac;
} else {
	$requete="SELECT billes.NOM AS BILLE, conditionnement.NOM AS CONDITIONNEMENT, marques.MARQUE
	FROM billes, marque_billes, marques, marque_billes_conditionnement, conditionnement
	WHERE
	billes.ID_BILLES=marque_billes.ID_BILLES AND 
	marque_billes.ID_MARQUE_BILLES=marque_billes_conditionnement.ID_MARQUE_BILLES AND 
	marque_billes_conditionnement.ID_CONDITIONNEMENT=conditionnement.ID_CONDITIONNEMENT AND 
	marque_billes.ID_MARQUE=marques.ID_MARQUE AND 
	marque_billes_conditionnement.ID_MARQUE_BILLES_CONDITIONNEMENT=$id_mbc";
}
ecrireLog('SQL', 'INFO', 'UPLOAD_ETIQUETTE.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'UPLOAD_ETIQUETTE.PHP| Erreur sur l\'exécution de requète de récupération des libellés pour le nommage du fichier'); 
	$req->closeCursor();
	exit;
}

$ligne_photo = $req->fetch();

if (!$ligne_photo) { 
	ecrireLog('APP', 'WARN', 'UPLOAD_ETIQUETTE.PHP| Erreur sur l\'exécution de requète de récupération des libellés pour le nommage du fichier'); 
	$req->closeCursor();
	exit;
}

if ($id_photo_sac > 0) {
	$uploadfile = $ligne_photo['nom_fichier'];
} else {
	if ($index >= 0) {
		$uploadfile = $id_mbc.' - '.$ligne_photo['BILLE'].' - '.$ligne_photo['MARQUE'].' - '.$ligne_photo['CONDITIONNEMENT'].' - '.$upload_type.' '.$index.'.jpg';
		$new_index = $index;
	} else {
		if ($id_mbc > 0) {
			$recherche_index = true;
			$uploadfile = $id_mbc.' - '.$ligne_photo['BILLE'].' - '.$ligne_photo['MARQUE'].' - '.$ligne_photo['CONDITIONNEMENT'].' - '.$upload_type.'.jpg';
		}
	}
}

if (( $update == 'false' ) && ( $index < 0 )) {

	$requete='SELECT MAX(index_photo) as max_index FROM photos_sac WHERE ID_MARQUE_BILLES_CONDITIONNEMENT='.$id_mbc;
	ecrireLog('SQL', 'INFO', 'UPLOAD_ETIQUETTE.PHP| REQUETE = '.$requete);
	$req = $bdd->prepare($requete);
	if (!$req->execute()){ 
		ecrireLog('APP', 'ERROR', 'UPLOAD_ETIQUETTE.PHP| Erreur sur l\'exécution de requète de récupération de l\'index max'); 
		$req->closeCursor();
		exit();
	}
	$ligne_index = $req->fetch();
	$new_index = $ligne_index['max_index']+1;
	$uploadfile = $id_mbc.' - '.$ligne_photo['BILLE'].' - '.$ligne_photo['MARQUE'].' - '.$ligne_photo['CONDITIONNEMENT'].' - '.$upload_type.' - '.$new_index.'.jpg';
}

ecrireLog('APP', 'INFO', 'UPLOAD_ETIQUETTE.PHP| FICHIER CIBLE = '.$uploaddir.'HIDEF/'.$uploadfile);

if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.'HIDEF/'.$uploadfile)) {
	ecrireLog('APP', 'ERROR', 'UPLOAD_ETIQUETTE.PHP| Problème sur le déplacement du fichier uploadé de '.$_FILES['file']['tmp_name'].' vers '.$uploaddir.'HIDEF/'.$uploadfile); 
	exit;
}

// Calcul des nouvelles dimensions
list($width, $height) = getimagesize($uploaddir.'HIDEF/'.$uploadfile);

$newwidth = $width * 60 / $height;
$newheight = 60;

// Chargement
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imageCreateFromAny($uploaddir.'HIDEF/'.$uploadfile);


// Redimensionnement
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
echo 'cible : '.$uploaddir.'THUMBNAIL/'.$uploadfile;

imagejpeg($thumb, $uploaddir.'THUMBNAIL/'.$uploadfile);
imagedestroy($thumb);
imagedestroy($source);

if ($id_photo_sac > 0) {
	exit();
}

if ($id_photo_sac <= 0) {
	$requete="INSERT INTO photos_sac ( ID_MARQUE_BILLES_CONDITIONNEMENT, NOM_FICHIER, TYPE, DEFINITION, INDEX_PHOTO ) values ( $id_mbc, '$uploadfile', '$upload_type', 'LODEF', $new_index )";
	ecrireLog('SQL', 'INFO', 'UPLOAD_ETIQUETTE.PHP| REQUETE = '.$requete);
	$req = $bdd->prepare($requete);
	if (!$req->execute()){
		ecrireLog('APP', 'ERROR', 'UPLOAD_ETIQUETTE.PHP| Erreur à l\'insertion de l\'enregistrement nouvelle image'); 
		$req->closeCursor();
		exit;
	}
	exit;
}
if ($index >= 0) {
	$requete="INSERT INTO photos_sac ( ID_MARQUE_BILLES_CONDITIONNEMENT, NOM_FICHIER, TYPE, DEFINITION, INDEX_PHOTO ) values ( $id_mbc, '$uploadfile', '$upload_type', 'LODEF', $index )";
	ecrireLog('SQL', 'INFO', 'UPLOAD_ETIQUETTE.PHP| REQUETE = '.$requete);
	$req = $bdd->prepare($requete);
	if (!$req->execute()){
		ecrireLog('APP', 'ERROR', 'UPLOAD_ETIQUETTE.PHP| Erreur à l\'insertion de l\'enregistrement nouvelle image'); 
		$req->closeCursor();
		exit;
	}
}
?>
