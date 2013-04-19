<?php
	/**
	* 
	*/
	class Session
	{
		
		function __construct()
		{
			if(!isset($_SESSION))
			{
				session_start();
			}
		}

		public function setMessage($msg, $type)
		{
			$_SESSION['message'] = array('msg' => $msg, 'type' => $type);
		}

		public function readMessage()
		{
			if(isset($_SESSION['message']['msg']))
			{
				$html = '<div class="alert alert-'.$_SESSION['message']['type'].'">';
				$html .= '<button type="button" class="close" data-dismiss="alert">x</button>';
				$html .= $_SESSION['message']['msg'].'</div>';
				$_SESSION['message'] = array();
				return $html;
			}
		}

		public function login($login)
		{
			$_SESSION['user'] = $login;
		}

		public function logout()
		{
			if(isset($_SESSION['user']))
			{
				unset($_SESSION['user']);
			}
		}

		public function isLogged()
		{
			if(isset($_SESSION['user']))
			{
				return $_SESSION['user'];
			}
			else
			{
				return false;
			}
		}
	}
?>