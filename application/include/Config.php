<?php 
	/**
	 * Configurations of the application
	 */

	/**
	 * Setting BASE_URL & BASE_PATH
	 */
	$project_name = explode('/', $_SERVER['REQUEST_URI'])[1];
	$base_url 	= 'http://'.$_SERVER['HTTP_HOST'].'/'.$project_name.'/';
	$system_path = dirname(__FILE__);

	// Path to the system folder
	define('BASE_PATH', str_replace('\\', '/', $system_path));
	defined('BASE_URL') ? null : define('BASE_URL',$base_url);
	

	/**
	 * Database Configurations
	 * Only Postgresql Database
	 */
	defined('DB_HOST') ? null : define('DB_HOST','localhost');
	defined('DB_NAME') ? null : define('DB_NAME','photo_lib_v2');
	defined('DB_USER') ? null : define('DB_USER','postgres');
	defined('DB_PASSWORD') ? null : define('DB_PASSWORD','root');

?>