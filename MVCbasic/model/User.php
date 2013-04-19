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


		function __construct3($login, $password, $email)
		{
			$this->login = $login;
			$this->password = $password;
			$this->email = $email;
		}

		function getLogin()
		{
			return $this->login;
		}

		function getPassword()
		{
			return $this->password;
		}

		function getEmail()
		{
			return $this->email;
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

		public function findByLogin($login)
		{
			$sql = 'SELECT * FROM '.$this->table.' WHERE login = "'.$login.'" ';

			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			$res = $prepare->fetch(PDO::FETCH_ASSOC);
			
			return $res;
		}

		public function findById($id)
		{
			$sql = 'SELECT * FROM '.$this->table.' WHERE id = '.$id.' ';

			$prepare = $this->db->prepare($sql);
			$prepare->execute();
			$res = $prepare->fetch(PDO::FETCH_ASSOC);

			return $res;
		}
	}
?>