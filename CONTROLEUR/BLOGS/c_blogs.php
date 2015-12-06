<?php
// include des fonctions d'access à la base de données BLOG
include_once('MODELE/BLOGS/get_blogs.php');

if (isset($tag_id))
{
	$blogs = get_blogs_by_tag_id($tag_id); // On récupère les posts relatifs au tag sélectionné
}
else
{
	if (isset($user_id))
	{
		$blogs = get_blogs_by_user($user_id); // On récupère les posts relatifs au user sélectionné
	}
	else
	{
		if (isset($post_id))
		{
			$blogs = get_blogs_by_id($post_id); // On récupère les posts relatifs au post_id, cad 1 seul en théorie
		}
		else
		{
			if (isset($tag_name))
			{
				$blogs = get_blogs_by_tag_name($tag_name); // On récupère les posts relatifs au post_id, cad 1 seul en théorie
			}
			else
			{
				$blogs = get_blogs(); // On récupère tous les posts (les 10 premiers)
			}
		}
	}
}	

include_once('VUE/BLOGS/v_blogs.php');
