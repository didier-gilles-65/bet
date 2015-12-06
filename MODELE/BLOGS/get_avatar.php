<?php

function get_avatar_link($user_id, $email, $gravatar_flag)
{
	if ($gravatar_flag)
	{
		$hash = md5( strtolower( trim( $email ) ) );
		$url_avatar = 'http://www.gravatar.com/avatar/'.$hash;
	}
	else
	{
		if (file_exists('IMAGES/'.$user_id.'.png'))
		{
			$url_avatar = 'IMAGES/'.$user_id.'.png';
		}
		else
		{
			$url_avatar = 'IMAGES/user_sans_avatar.png'; 
		}
	}
	return $url_avatar;
}
