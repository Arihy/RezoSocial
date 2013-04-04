<?php 
	/**
	* 
	*/
	class Controller
	{
		public $request;
		private $vars = array();
		public $layout = 'default';

		function __construct($req)
		{
			$this->request = $req;
			//$this->loadModel('User');
		}
		

		/**
		* permet d'afficher la vue passer en parametre
		* c'est ici qu'on se charge d'afficher le contenu d'une vue dans la vue global
		* pour avoir une header et un footer commun, et un contenu qui change selon la page
		* @param $filename vue qu'on souhaite afficher
		**/
		public function render($view)
		{
			extract($this->vars);

			//si la vue commence par un / cela veut dire qu'on essaye d'afficher une vue error
			if(strpos($view, '/') === 0)
			{
				$view = ROOT.DS.'view'.$view.'.php';
			}
			else
			{
				$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
			}
			ob_start();
			require($view);
			$content = ob_get_clean();
			require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
		}


		/**
		* permet de pousser des variables dans une vue
		* @param $d variable pouvant etre un tableau ou une cle associe a une valeur
		* @param $val varible null si $d est un tableau sinon correspond a la valeur qu'on souhaite pousser
		**/
		public function set($key, $val=null)
		{
			if(is_array($key))
			{
				$this->vars += $key;
			}
			else
			{
				$this->vars[$key] = $val;
			}
		}

		/**
		* permet de charger un model
		* @param $name nom du model a charger
		**/
		function loadModel($name)
		{
			$file = ROOT.DS.'model'.DS.$name.'.php';
			require_once($file);
			if(!isset($this->name))
			{
				$this->$name = new $name();
			}
		}
	}
?>