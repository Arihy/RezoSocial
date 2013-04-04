<?php
	/**
	* 
	*/
	class UsersController extends Controller
	{
		function index()
		{
			$this->render('index');
		}

		function signup()
		{
			$this->render('formSignup');
		}

		function validationLogin($login)
		{
			$this->loadModel('User');
			$req = array('conditions' => 'login="'.$login.'"');
			$res = $this->User->isLogin($req);
			echo $res;
		}

		function validationEmail($email)
		{
			$this->loadModel('User');
			$req = array('conditions' => 'email="'.$email.'"');
			$res = $this->User->isEmail($req);
			echo $res;
		}
	}
?>