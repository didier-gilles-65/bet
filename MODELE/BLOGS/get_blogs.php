<?php
function get_most_recent_blog($id_blog) // Renvoie le premier blog de la requète passée. Possibilité d'utiliser un accès par id_blog
{
	global $bdd;
	global $sql_blogs_by_blog;
	global $sql_blog;
	global $critere_statut;
	
	if ($id_blog != 0) 
	{
		$req = $bdd->prepare($sql_blogs_by_blog);
		$req->bindParam(':blog_id', $id_blog, PDO::PARAM_INT);
		$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
	}
	else
	{
		$req = $bdd->prepare($sql_blog);
	}	
    $req->execute();
    if (!$blog = $req->fetch()) ecrireLog('SQL','ERROR','Message non trouve :'.$id_blog);
	$req->closeCursor();
    return $blog;
}
function get_blogs_by_tag_id($tag_id) // Renvoie la liste des blogs pour un tag donné
{
	global $bdd;
	global $sql_blogs_by_tag_id;
	global $sql_blog;
	global $critere_statut;

	if ($tag_id != 0) 
	{
		$req = $bdd->prepare($sql_blogs_by_tag_id);
		$req->bindParam(':tag_id', $tag_id, PDO::PARAM_INT);
		$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
	}
	else
	{
		$req = $bdd->prepare($sql_blog);
	}	
    $req->execute();
    if (!$blog = $req->fetchAll()) ecrireLog('SQL','ERROR','Message non trouve $sql_blogs_by_tag_id:'.$tag_id);
	$req->closeCursor();
    return $blog;
}
function get_blogs_by_tag_name($tag_name) // Renvoie la liste des blogs pour un tag donné
{
	global $bdd;
	global $sql_blogs_by_tag_name;
	global $sql_blog;
	global $critere_statut;

	if ($tag_name != "") 
	{
		$req = $bdd->prepare($sql_blogs_by_tag_name);
		$req->bindParam(':tag_name', $tag_name, PDO::PARAM_INT);
		$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
	}
	else
	{
		$req = $bdd->prepare($sql_blog);
	}	
    $req->execute();
    if (!$blog = $req->fetchAll()) ecrireLog('SQL','ERROR','Message non trouve $sql_blogs_by_tag_name:'.$tag_name);
	$req->closeCursor();
    return $blog;
}
function get_blogs_by_user($user_id) // Renvoie la liste des blogs pour un user donné
{
	global $bdd;
	global $sql_blogs_by_user;
	global $sql_blogs;
	global $critere_statut;

	if ($user_id != 0) 
	{
		$req = $bdd->prepare($sql_blogs_by_user);
		$req->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
	}
	else
	{
		$req = $bdd->prepare($sql_blogs);
	}	
    $req->execute();
    if (!$blogs = $req->fetchAll()) ecrireLog('SQL','ERROR','Message non trouve $sql_blogs_by_user:'.$sql_blogs_by_user.$user_id);
	$req->closeCursor();
    return $blogs;
}
function get_blogs_by_id($blog_id) // Renvoie le blog correspondant à l'id entré (a priori un seul !!!)
{
	global $bdd;
	global $sql_blogs_by_blog;
	global $sql_blogs;
	global $critere_statut;

	if ($blog_id != 0) 
	{
		$req = $bdd->prepare($sql_blogs_by_blog);
		$req->bindParam(':blog_id', $blog_id, PDO::PARAM_INT);
		$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
	}
	else
	{
		$req = $bdd->prepare($sql_blogs);
	}	
    $req->execute();
    if (!$blog = $req->fetch()) ecrireLog('SQL','ERROR','Message non trouve $get_blogs_by_id:'.$blog_id);
	$req->closeCursor();
    return $blog;
}
function get_blogs() // Renvoie tous les blogs
{
	global $bdd;
	global $sql_blogs;
	global $critere_statut;

	$req = $bdd->prepare($sql_blogs);
	$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
    $req->execute();
    if (!$blog = $req->fetchall()) ecrireLog('SQL','ERROR','Message non trouve $sql_blogs');
	$req->closeCursor();
    return $blog;
}
function get_comments($id_blog) // Renvoie les commentaires attachés à un blog.
{
    global $bdd;
	global $sql_comments_by_blog_id;
	
    $req = $bdd->prepare($sql_comments_by_blog_id);
	$req->bindParam(':blog_id', $id_blog, PDO::PARAM_INT);
    $req->execute();
    $blog = $req->fetchAll();
	$req->closeCursor();
    return $blog;
}
function get_tags($id_blog) // Renvoie les tags billes attachés à un blog.
{
    global $bdd;
	global $sql_tags_by_blog_id;
	
    $req = $bdd->prepare($sql_tags_by_blog_id);
	$req->bindParam(':blog_id', $id_blog, PDO::PARAM_INT);
    $req->execute();
    $tags = $req->fetchAll();
	$req->closeCursor();
    return $tags;
}
function get_top_users() // Renvoie les users ayant le plus posté
{
    global $bdd;
	global $sql_top_users;
	global $critere_statut;
	
    $req = $bdd->prepare($sql_top_users);
	$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
    $req->execute();
    $users = $req->fetchAll();
	$req->closeCursor();
    return $users;
}
function get_top_tags() // Renvoie les tags ayant fait l'objet du plus de post
{
    global $bdd;
	global $sql_top_tags;
	global $critere_statut;
	
    $req = $bdd->prepare($sql_top_tags);
	$req->bindParam(':critere_statut', $critere_statut, PDO::PARAM_STR);
    $req->execute();
    $tags = $req->fetchAll();
	$req->closeCursor();
    return $tags;
}