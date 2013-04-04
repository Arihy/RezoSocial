<?php
	/**
	* 
	*/
	class Conf
	{
		static $debug = 1; //variable de sécurisation des messages d'erreur, a mettre a sup 0 avec de déplayer
		static $databases = array(
			'default'	=>	array(
				'host'	=>	'localhost',
				'database' 	=> 'rezosocial',
				'login'		=> 'root',
				'password'	=>	'root',
				),
			);
	}
	
?>