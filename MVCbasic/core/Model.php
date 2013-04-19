<?php 
	/**
	* Permet de faire les interations avec la BDD
	**/
	class Model
	{
		public $conf = 'default';
		static $connections = array();

		public $table = false;
		public $db;


		/**
		* Ce constructeur permet d'initialiser la connection a la bdd
		* Comme il n'y a pas de surcharge en php
		* Le constructeur va aussi se charger d'appeler le bon constructeur
		* Selon le nombre de parametre qu'on lui donne lors de l'appel
		*/

		function __construct()
		{
			$this->connect();

			$params = func_get_args(); 
	        $nbArgs = func_num_args(); 
	        if (method_exists($this,$const='__construct'.$nbArgs)) { 
	            call_user_func_array(array($this,$const),$params); 
	        }
		}

		public function connect()
		{
			$conf = Conf::$databases[$this->conf];

			//on test si la connextion n'exite pas deja
			if(isset(Model::$connections[$this->conf]))
			{
				$this->db = Model::$connections[$this->conf];
				return true;
			}
				

			//on se connecte
			try {
				$pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';', $conf['login'], $conf['password']);
				Model::$connections[$this->conf] = $pdo;
				$this->db = $pdo;
			} catch (PDOException $e) {
				if(Conf::$debug >= 1)
				{
					die($e->getMessage());
				}
				else
				{
					echo 'impossible de se connecter';
				}
				
			}

			//init
			if ($this->table === false) {
				$this->table = strtolower(get_class($this)).'s';
			}
		}

		public function find($req)
		{
			$sql = 'SELECT * FROM '.$this->table.' ';

			//traiter les conditions
			if(isset($req['conditions']))
			{
				$sql .= 'WHERE ';
				if(!is_array($req['conditions']))
				{
					$sql .= $req['conditions'];
				}
				else
				{
					$cond = array();
					foreach ($req['conditions'] as $key => $val) {
						if(!is_numeric($val))
						{
							$v = '"'.mysql_escape_string($v).'"';
						}
						$cond[] = "$key=$val";
					}
					$sql .= implode(" and ", $cond);
				}
			}


			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			return $prepare->fetch(PDO::FETCH_OBJ);
			
		}

		public function findFirst($req)
		{
			current($this->find($req));
		}
	}
?>