<?php
// include pour comptage
include_once('MODELE/BILLES/get_billes.php');
include_once('MODELE/USERS/get_users.php');
$users = get_user($sql_user, $login);
foreach($users as $cle => $user)
{
    $users[$cle]['LOGIN'] = htmlspecialchars($user['LOGIN']);
    $users[$cle]['NOM'] = htmlspecialchars($user['NOM']);
    $users[$cle]['EMAIL'] = htmlspecialchars($user['EMAIL']);
    $users[$cle]['PRENOM'] = htmlspecialchars($user['PRENOM']);
    $users[$cle]['GRAVATAR_FLAG'] = htmlspecialchars($user['GRAVATAR_FLAG']);
}
reset($users);
$current_user = current($users);
// On affiche la page (vue)
include_once('VUE/BILLES/v_change_user.php');
