<?php
	/**
	* 
	*/
	class MessagesController extends Controller
	{
		function saveMessage()
		{
			$login = $this->Session->isLogged();
			$user = new User();
			$tmp = $user->findByLogin($login);
			$id = $tmp['id'];
			$content = $_GET['content'];
			$message = new Message();
			$req = array(
				'owner_id'		=>	$id,
				'content'		=>	$content);
			$res = $message->save($req);
			if(!$res)
			{
				$this->Session->setMessage('Echec de l\'enregistrement du message', 'error');
			}
		}

		function lastMessage()
		{
			$msg = new Message();
			$user = new User();

			$id = $user->findByLogin($this->Session->isLogged());
			$res = $msg->allMessage($id['id']);

			header('Content-Type: application/json');
			echo json_encode($res);
		}

		function editMessage()
		{
			
		}
	}
?>