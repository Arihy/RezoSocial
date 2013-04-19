<?php
	/**
	* 
	*/
	class Message extends Model
	{
		private $owner_id;
		private $content;
		private $created;

		function __construct2($owner_id, $content)
		{
			$this->owner_id = $owner_id;
			$this->content = $content;
		}

		public function save($req)
		{
			$sql = 'INSERT INTO '.$this->table.' (owner_id, content)';
			$sql .= ' values ("'.$req['owner_id'].'", "'.$req['content'].'")';
			
			$prepare = $this->db->prepare($sql);
			return $prepare->execute();
		}

		public function allMessage($id)
		{
			$sql = 'SELECT * FROM '.$this->table.' WHERE owner_id='.$id;

			$prepare = $this->db->prepare($sql);
			$prepare->execute();

			return $prepare->fetch(PDO::FETCH_ASSOC);
		}

		public function firstMessage($id)
		{
			current($this->allMessage($id));
		}
	}
?>