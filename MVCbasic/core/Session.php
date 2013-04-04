<?php
	session_start();

	public function setMessage($msg, $type)
	{
		$_SESSION['message'] = array('msg' => $msg, 'type' => $type);
	}

	public function readMessage()
	{
		if(isset($_SESSION['message']['msg']))
		{
			$html = '<div class="alert-message '.$_SESSION['message']['type'].'">'.$_SESSION['message']['msg'].'</div>';
			$_SESSION['message'] = array();
			return html;
		}
	}
?>