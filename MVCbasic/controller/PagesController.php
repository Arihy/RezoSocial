<?php
	/**
	* 
	*/
	class PagesController extends Controller
	{
		function view($name)
		{
			$this->set(array(
				'msg'	=>	'coucou',
				'msg2'	=>	'recoucou'));
			$this->render('index');
		}
	}
?>