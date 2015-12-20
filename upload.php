<!-- UPLOAD.PHP

script PHP pour uploader une image de description de type de bille et inscription dans la table autres_photos.

USES : 

TODO:

-->
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
        break; 
        case IMG_JPG : 
            $im = imageCreateFromJpeg($filepath); 
        break; 
        case IMG_PNG : 
            $im = imageCreateFromPng($filepath); 
        break; 
        case IMG_WBMP : 
            $im = imageCreateFromBmp($filepath); 
        break; 
    }    
    return $im;  
}

if(!isset($_SESSION['connect']) || $_SESSION['connect']!=1) check_permanent_login(); //ACCESS SEULEMENT SI AUTHENTIFIE
//print_r($_FILES);
if(isset($_POST['upload_id_bille'])) { $upload_id_bille = $_POST['upload_id_bille']; } else { 
	ecrireLog('APP', 'ERROR', 'UPLOAD.PHP| Pas de référence de bille dans les données en POST');
	retournerErreur( 400 , 01, 'UPLOAD.PHP| Pas de référence de bille dans les données en POST'); 
}

$requete="SELECT MAX(INDICE)+1 AS NEXT_INDICE FROM autres_photos WHERE ID_BILLE=$upload_id_bille";

$req = $bdd->prepare($requete);
if (!$req->execute()){ 
	ecrireLog('APP', 'ERROR', 'UPLOAD.PHP| Erreur sur l\'exécution de requète de récupération de l\'indice d\'image pour la référence de bille données'); 
	retournerErreur( 403 , 02, 'UPLOAD.PHP| Erreur sur l\'exécution de requète de récupération de l\'indice d\'image pour la référence de bille données');
}
$new_indice = $req->fetch();
$req->closeCursor();
if (!$new_indice) { 
	ecrireLog('APP', 'ERROR', 'UPLOAD.PHP| Erreur sur la lecture de l\'exécution de requète de récupération de l\'indice d\'image pour la référence de bille données'); 
	retournerErreur( 403 , 03, 'UPLOAD.PHP| Erreur sur la lecture de l\'exécution de requète de récupération de l\'indice d\'image pour la référence de bille données');
}

$next_indice = 1;
$next_indice = $new_indice['NEXT_INDICE']; 
if(!isset($next_indice) || !($next_indice > 0)) {$next_indice = 1;}

$uploaddir = 'IMAGES/MAIN/AUTRES/';
$uploadfile = $upload_id_bille.'-'.$next_indice.'-'.basename($_FILES['file']['name']);
ecrireLog('APP', 'INFO', 'UPLOAD_ETIQUETTE.PHP| FICHIER CIBLE = '.$uploaddir.$uploadfile);
if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir.$uploadfile)) {
	ecrireLog('APP', 'ERROR', 'UPLOAD.PHP| Problème sur le déplacement du fichier uploadé'); 
	retournerErreur( 403 , 04, 'UPLOAD.PHP| Problème sur le déplacement du fichier uploadé');
}

// Calcul des nouvelles dimensions
list($width, $height) = getimagesize($uploaddir.$uploadfile);
$newwidth = $width * 60 / $height;
$newheight = 60;

// Chargement
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imageCreateFromAny($uploaddir.$uploadfile);

// Redimensionnement
imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

imagejpeg($thumb, $uploaddir.'SMALL/'.$uploadfile);
imagedestroy($thumb);
imagedestroy($source);


$requete="INSERT INTO autres_photos ( ID_BILLE, INDICE, FICHIER, CHEMIN ) values ( $upload_id_bille, $next_indice, '$uploadfile', '$uploaddir' )";
//ecrireLog('SQL', 'INFO', 'UPLOAD.PHP| REQUETE = '.$requete);
$req = $bdd->prepare($requete);
if (!$req->execute()){
	ecrireLog('APP', 'ERROR', 'UPLOAD.PHP| Erreur à l\insertion de l\'enregistrement nouvelle image'); 
	retournerErreur( 403 , 05, 'UPLOAD.PHP| Erreur à l\insertion de l\'enregistrement nouvelle image');
}
exit();
  
?>
