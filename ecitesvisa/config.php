<?php
session_start();
	$autoload = function($class)
	{
		if ($class == 'Email') {
			require_once ('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		include 'classes/'.$class.'.php';
	};

	spl_autoload_register($autoload);
	define('INCLUDE_PATH', 'http://localhost:8888/ecitesvisa/');
	define('INCLUDE_PATH_PAINEL', INCLUDE_PATH.'painel/');
	//CONECÇÃO DA BASE DE DADOS 
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASSWORD', 'root');
	define('DATABASE', 'cities_db');

	function pegaCargo($cargo){
		$arr = ['0' => 'Administrador','1' => 'Sub Administrador','2' => 'Tecnico','4' => 'Usuario Normal'];
		return $arr[$cargo];
	}

?>