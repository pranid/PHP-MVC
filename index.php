<?php 
	/**
	 * Torty | The Gallery V2
	 * @author Praneeth Nidarshan
	 * Development Started on 2016-01-22
	 */

	/**
	 * Setting BASE_URL & BASE_PATH
	 */
	$project_name = explode('/', $_SERVER['REQUEST_URI'])[1];
	$base_url 	= 'http://'.$_SERVER['HTTP_HOST'].'/'.$project_name.'/';
	$system_path = dirname(__FILE__);

	// Path to the system folder
	define('BASE_PATH', str_replace('\\', '/', $system_path));
	define('IMG_GALLERY', BASE_PATH.'/gallery');
	defined('BASE_URL') ? null : define('BASE_URL',$base_url);


	/**
	 * Define autoloader.
	 * @param String $class_name
	 */
	function __autoload($class_name) {
		include 'application/include/'.$class_name.'.php';
	}

	/**
	 * Create class object by URL call
	 */
	// Getting the url exploded
	$ex_uri = explode('/', $_SERVER['REQUEST_URI']);
	$ex_uri_len = sizeof($ex_uri);

	// Create the object for called class
	$class_name = $ex_uri[$ex_uri_len-1];

	// If class not empty
	if($class_name) {
		$class_obj  = new $class_name;
	}else{
		$index = new Welcome; 
	}
?>