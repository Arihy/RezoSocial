<?php
	define('WEBROOT', dirname(__FILE__));
	define('ROOT', dirname(WEBROOT));
	define('DS', DIRECTORY_SEPARATOR);
	define('CORE', ROOT.DS.'core');
	define('RACINE', dirname(dirname($_SERVER['SCRIPT_NAME'])));

	define('CSS_FOLDER', RACINE.DS.'css');
	define('JS_FOLDER', RACINE.DS.'js');

	require CORE.DS.'includes.php';

	new Dispatcher();
?>