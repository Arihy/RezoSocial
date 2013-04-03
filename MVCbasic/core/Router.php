<?php
	/**
	* 
	*/
	class Router
	{
		/**
		* parse permet de parse une url et mettre les valeurs dans l'objet $req
		* @param $url url a parser
		* @param $req objet Request dans le quel on va stocker les valeurs
		*/
		static function parse($url, $req)
		{
			//on enleve les / de debut (voir si de fin aussi)
			$url = trim($url, '/');

			//splite selon le premier parametre
			$params = explode('/', $url);

			$req->controller = $params[0];
			$req->action = isset($params[1]) ? $params[1] : 'index';

			//on enleve le controller et l'action de $params
			//afin de recuperer les parametres a passer dans les actions
			$req->params = array_slice($params, 2);
			//return true;
		}
	}
?>