<?php
// On recherche la bille correspondant au NUM passé en paramètre
include_once('MODELE/BILLES/get_billes.php');

if ( !isset($login) ) { $login=''; }

$billes = get_inventory_billes_for_login($sql_inventory_bille_for_login, $login);
// On affiche la page (vue)
include_once('VUE/BILLES/v_inventory.php');

