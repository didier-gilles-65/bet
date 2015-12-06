<?php
$compte = 0;
if(file_exists('compteur.txt'))
{
	$compteur_f = fopen('compteur.txt', 'r+');
	$compte = fgets($compteur_f);
	fclose($compteur_f);
}
if(!isset($_SESSION['compteur']))
{
	$compteur_f = fopen('compteur.txt', 'w+');
	$_SESSION['compteur'] = 'visite';
	$compte=$compte+1;
	fseek($compteur_f, 0);
	fputs($compteur_f, $compte);
	fputs($compteur_f, "\n");
}
