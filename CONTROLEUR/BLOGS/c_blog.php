<?php
// include des fonctions d'access à la base de données BLOG
include_once('MODELE/BLOGS/get_blogs.php');

	if (isset($post_id))
	{
		$blog = get_most_recent_blog($post_id); // On récupère les posts relatifs au post_id, cad 1 seul en théorie
	}
	else
	{
		$blog = array(); 
	}
	
include_once('VUE/BLOGS/v_blog.php');
