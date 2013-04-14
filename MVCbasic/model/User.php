<?php  
	/**
	* 
	**/
	class User extends Model
	{
		private $id;
		private $login;
		private $password;
		private $email;
		private $created;
		private $friendsList;

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

		function __construct3($login, $password, $email)
		{
			$this->login = $login;
			$this->password = $password;
			$this->email = $email;
		}

		/**
		* Test si le login est utilise
		* @param $login login a tester
		* @return retourne un boolean
		*/
		public function isLogin($req)
		{
			$sql = 'SELECT * FROM '.$this->table.' ';
			if(isset($req['conditions']))
			{
				$sql .= 'WHERE '.$req['conditions'];
			}
			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			$count = $prepare->rowCount($sql);
			if($count)
				return true;
			else
				return false;
			
		}

		/**
		* Test si le mail est utilise
		* @param $email mail a tester
		* @return retourne un boolean
		*/
		public function isEmail($req)
		{
			$sql = 'SELECT * FROM '.$this->table.' ';
			if(isset($req['conditions']))
			{
				$sql .= 'WHERE '.$req['conditions'];
			}
			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			$count = $prepare->rowCount($sql);
			if($count)
				return true;
			else
				return false;
			
		}

		public function save($req)
		{
			$sql = 'INSERT INTO '.$this->table.' (login, password, email)';
			$sql .= ' values ("'.$req['login'].'", "'.$req['password'].'", "'.$req['email'].'")';
			
			$prepare = $this->db->prepare($sql);
			return $prepare->execute();
		}

		public function search($req, $champ)
		{
			$sql = 'SELECT '.$champ.' FROM '.$this->table.' WHERE '.$champ.' like "%'.$req.'%"';

			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			$count = $prepare->rowCount($sql);
			
			$res = array();
			$i = 0;
			if($count)
			{
				while ($table = $prepare->fetch(PDO::FETCH_OBJ))
				{
					$res[$i] = $table->login;
					$i = $i + 1;
				}
			}

			return $res;
		}
	}
?>