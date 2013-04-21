<?php
	/**
	* 
	*/
	class Message extends Model
	{
		private $id;
		private $owner_id;
		private $content;
		private $created;
		public $table = 'messages';

		function __construct2($owner_id, $content)
		{
			$this->owner_id = $owner_id;
			$this->content = $content;
		}

		public function save($req)
		{
			$sql = 'INSERT INTO '.$this->table.' (owner_id, content)';
			$sql .= ' values ('.$req['owner_id'].', "'.$req['content'].'")';

			$prepare = $this->db->prepare($sql);
			return $prepare->execute();
		}

		public function allMessage($id)
		{
			$sql = 'SELECT * FROM '.$this->table.' WHERE owner_id='.$id.' ORDER BY created DESC';

			$prepare = $this->db->prepare($sql);
			$prepare->execute();

			$count = $prepare->rowCount($sql);
			$res = array();
			$i = 0;
			if($count)
			{
				while ($table = $prepare->fetch(PDO::FETCH_OBJ))
				{
					$res[$i] = array(
						'id'	=>	$table->id,
						'date' => $table->created,
						'content'	=> $table->content
						);
					$i = $i + 1;
				}
			}

			return $res;
		}

		public function firstMessage($id)
		{
			current($this->allMessage($id));
		}
	}
?>