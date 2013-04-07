<?php  
	/**
	* 
	**/
	class User extends Model
	{

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

		public function search($req, $champ)
		{
			$sql = 'SELECT '.$champ.' FROM '.$this->table.' WHERE '.$champ.' like "%'.$req.'%"';

			$prepare = $this->db->prepare($sql);
			$prepare->execute($q);
			$count = $prepare->rowCount($sql);
			
			$res = "";
			
			if($count)
			{
				while ($table = $prepare->fetch(PDO::FETCH_OBJ))
				{
					$res .= $table->login.'<br>';
				}
			}
			else
			{
				$res .= 'aucun resultat trouvé';
			}

			return $res;
		}
	}
?>