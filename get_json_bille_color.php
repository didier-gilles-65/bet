<?php
error_reporting(E_ALL);
include_once('UTILS/log.php');
include_once('UTILS/gestion_erreur.php');

function dominant_color($url){
	$json = array();
	$json["image"] = $url;

    $i = imagecreatefromjpeg($url);
    $rTotal  = '';
    $bTotal  = '';
    $gTotal  = '';
    $total = '';
    for ($x=0;$x<imagesx($i);$x++) {
        for ($y=0;$y<imagesy($i);$y++) {
            $rgb = imagecolorat($i, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            $rTotal += $r;
            $gTotal += $g;
            $bTotal += $b;
            $total++;
    }

}

$r = round($rTotal/$total);
$g = round($gTotal/$total);
$b = round($bTotal/$total);

$json["r"] = $r;
$json["g"] = $g;
$json["b"] = $b;

return $json;
}

/**
 * Copyright (C) 2011 Damien SOREL (Mistic)
 * http://www.strangeplanet.fr
 * 
 * This function is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.


// conversion RGB -> HSV
function rgb2hsv ($RGB)
{
  $var_R = $RGB[0]/255;
  $var_G = $RGB[1]/255;
  $var_B = $RGB[2]/255;
  $var_Min = min($var_R, $var_G, $var_B);
  $var_Max = max($var_R, $var_G, $var_B);
  $del_Max = $var_Max - $var_Min;
  
  $V = $var_Max;

  if ($del_Max == 0)
  {
    $H = 0;
    $S = 0;  
  }
  else
  {
    $S = $del_Max / $var_Max;
    $del_R = ((($var_Max - $var_R)/6) + ($del_Max/2)) / $del_Max;
    $del_G = ((($var_Max - $var_G)/6) + ($del_Max/2)) / $del_Max;
    $del_B = ((($var_Max - $var_B)/6) + ($del_Max/2)) / $del_Max;
    
    if      ($var_R == $var_Max) $H = $del_B - $del_G;
    else if ($var_G == $var_Max) $H = (1/3) + $del_R - $del_B;
    else if ($var_B == $var_Max) $H = (2/3) + $del_G - $del_R;
    
    if      ($H<0) $H++;
    else if ($H>1) $H--;
  }
  
  return array($H*255, $S*255, $V*255);
}

// norme euclidienne
function distance($col1, $col2)
{
  $distance = 0;
  for($i=0 ; $i<3 ; $i++)
  {
    $diff[$i] = $col1[$i]/255-$col2[$i]/255;
    $distance += $diff[$i]*$diff[$i];
  }
  if ($distance == 0) $distance = 0.01; // pour ne pas avoir l'inverse de 0
  return sqrt($distance);
}

// fonctionne mère
function get_main_color($img, $points, $colors)
{
  $width = imagesx($img);
  $height = imagesy($img);
  $scale = intval(max($width,$height)/$points);
  
  // Pour chaque base on convertir en HSV et on initialise le compteur
  foreach ($colors as $name => $base)
  {
    $results[$name] = 0;
    $colors[$name] = rgb2hsv($base);
  }
  
  $colors_grey = 0; // Compteur pour les pixels gris (R=G=B)
  $pixel_count = 0; // Compteur du nombre total de pixels analysés
      
  for ($j=0; $j<$height; $j+=$scale)
  {
    for ($i=0; $i<$width; $i+=$scale)
    {
      // Couleur du pixel
      $color = imagecolorat($img, $i, $j);
      $r = ($color >> 16) &0xFF;
      $g = ($color >> 8) &0xFF;
      $b = $color &0xFF;
      
      if ($r==$g and $g==$b)
      {
        $colors_grey++;
      }
      else
      {
        // On incrémente le compteur de chaque base 
        // de l'inverse de la distance à la couleur du pixel
        foreach ($colors as $name => $base)
        {
          $color = rgb2hsv(array($r, $g, $b));
          $results[$name] += 1 / distance($color, $base);
        }
      }
      
      $pixel_count++;
    }
  }

  if ($colors_grey == $pixel_count)
  {
    return 'grey';
  }
  else
  {
    asort($results);
    $results = array_keys($results);
    return $results[count($results)-1];
  }
}
$colors = array(
  'red' => array(255,0,0),
  'orange' => array(255,127,0),
  'yellow' => array(255,255,0),
  'green' => array(0,255,0),
  'blue' => array(0,0,255),
  'purple' => array(127,0,255),
  'pink' => array(255,0,255),
  );
 */

if (isset($_GET['id_bille']))
{
	$id_bille = $_GET['id_bille'];
	$nom_image = 'IMAGES/MAIN/THUMBNAIL/'.$id_bille.'.jpg';
}
else 
{
	$id_bille = 0;
	retournerErreur( 400 , 01, 'GET_JSON_BILLE_COLOR.PHP| Pas de référence de bille dans les données'); 
}


$r_json=dominant_color($nom_image);

echo json_encode($r_json,JSON_UNESCAPED_SLASHES); 
exit();
?> 

