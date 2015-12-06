<?php
include_once('MODELE/BLOGS/get_blogs.php');
include_once('MODELE/USERS/get_users.php');

if ($blog_id > 0) {
	$blog = get_blogs_by_id($blog_id);
}
// On affiche la page (vue)
include_once('VUE/BLOGS/v_post.php');
