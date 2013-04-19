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

		function profil()
		{
			$this->render('profil');
		}

		function validationLogin($login)
		{
			$user = new User();
			$req = array('conditions' => 'login="'.$login.'"');
			$res = $user->isLogin($req);
			echo $res;
		}

		function validationEmail($email)
		{
			$user = new User();
			$req = array('conditions' => 'email="'.$email.'"');
			$res = $user->isEmail($req);
			echo $res;
		}


		function validationSignup()
		{
			$login = $_POST['login'];
			$pass = sha1($_POST['password']);
			$email = $_POST['email'];
			$user = new User();
			$req = array(
				'login'		=>	$login,
				'password'	=>	$pass,
				'email'		=>	$email);
			$res = $user->save($req);
			if($res)
			{
				$this->Session->setMessage('Votre inscription est valide !', 'success');
				$this->render('index');
			}
			else
			{
				$this->Session->setMessage('Echec de l\'inscription', 'error');
				$this->render('signup');
			}
		}

		function searchUser()
		{
			if(isset($_GET['user']))
			{
				$login = $_GET['user'];

				$user = new User();

				$res = $user->search($login, 'login');
				
				header('Content-Type: application/json');
				echo json_encode($res);
			}
		}

		function signin()
		{
			$this->render('formSignin');
		}

		function signout()
		{
			$this->Session->logout();
			$this->render('index');
		}

		function validationSignin()
		{
			if(isset($_POST['login']) && isset($_POST['password']))
			{
				$user = new User();
				$res = $user->findByLogin($_POST['login']);
				if($res)
				{
					$pass = $res['password'];
					if($pass == sha1($_POST['password']))
					{
						//connection
						$this->Session->login($_POST['login']);
						$this->render('profil');
					}
					else
					{
						$this->Session->setMessage('Login ou mot de pass incorrect', 'error');
						$this->render('formSignin');
					}
				}
				else
				{
					$this->Session->setMessage('Login ou mot de pass incorrect', 'error');
					$this->render('formSignin');
				}
			}
		}
	}
?>