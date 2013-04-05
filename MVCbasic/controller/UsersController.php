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


		function validationSignup()
		{
			$login = $_POST['login'];
			$pass = sha1($_POST['password']);
			$email = $_POST['email'];
			$this->loadModel('User');
			$req = array(
				'login'		=>	$login,
				'password'	=>	$pass,
				'email'		=>	$email);
			$res = $this->User->save($req);
			if($res)
			{
				//echo $res;
				$this->Session->setMessage('Votre inscription est valide !', 'success');
				$this->render('index');
			}
			else
			{
				$this->Session->setMessage('Echec de l\'inscription', 'error');
				$this->render('signup');
			}
		}
	}
?>