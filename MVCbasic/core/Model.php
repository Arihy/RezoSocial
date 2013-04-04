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

		public function __construct()
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


		public function save($req)
		{
			$sql = 'INSERT INTO '.$this->table.' (login, password, email)';
			$sql .= ' values ("'.$req['login'].'", "'.$req['password'].'", "'.$req['email'].'")';
			
			$prepare =$this->db->prepare($sql);
			return $prepare->execute();
		}
	}
?>