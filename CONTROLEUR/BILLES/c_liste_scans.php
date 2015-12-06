<?php
// On recherche la bille correspondant au NUM passé en paramètre

	if ( !isset($login) ) { $login=''; }

    if (isset($_GET['ORDER']) ) { $order = $_GET['ORDER']; } else {$order = 'CODE';}
    if (isset($_GET['SENS']) ) { $sens = $_GET['SENS']; } else {$sens = 'ASC';}
	$req = $bdd->prepare($sql_get_scans.$order.' '.$sens); //Si la requète vient du renvoi depuis le scan vers SAFARI, alors on récupère le code et le type du dernier scan non affecté
//	ecrireLog('SQL','DEBUG',$sql_get_scans.$order.' '.$sens);
	if ($req->execute()) {
		$myarray = $req->fetchall();
	}
	if ($sens=='ASC') {$sens='DESC';} else {$sens='ASC';}
// On affiche la page (vue)
	include('VUE/BILLES/v_liste_scans.php');

