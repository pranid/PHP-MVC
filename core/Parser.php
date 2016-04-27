<?php 
	class Parser {
		private $class_name;
		private $method;
		public $base_url;
		public $base_path;

		public function __construct()
		{
			if(!include ('./application/config/Config.php')) {
				die("Configuration file could not be found.");

			}

			$this->base_url  = $config['base_url'];
			$this->base_path = $config['base_path'];

			$this->route();

		}
		
		public function view($view = null,$data = null) {
			die("This is Parser View");
			
			if(is_array($data)) {
				extract($data);
			}
			
			if(!include ($this->base_path.'/application/view/'.$view.'.php')){
				die('Sorry! Page not found');
			}
	    }
	    
	    public function model($model) {
	    	if(!include ($this->base_path.'/application/model/'.$model.'.php')){
				die('Sorry! Page not found');
			}
	    }
	    
	    public function route() {
	    	function __autoload($class_name) {
				if(!include ($this->base_path.'/application/controller/'.$class_name.'.php')) {
					die("Class $class_name not Found");
				}
			}
			
	    	$url = $_SERVER['REQUEST_URI'];

	    	if($url != '/') {
	    		$url_segmant = explode('/',$url);
    	 		
    	 		var_dump($_SERVER['HTTP_HOST']);


    	 		$class_name = isset($url_segmant[2]) ? $url_segmant[2] : null ;
    	 		$method 	= isset($url_segmant[3]) ? $url_segmant[3] : null ;
    	 		
    	 		$class_name = ucfirst(strtolower($class_name));
    	 		
    	 		if($class_name != null) {
    	 			$obj = new $class_name;
    	 		}
    	 		
    	 		if($method != null) {
    	 			$class_name::$method();
    	 		}
	    	}
	    }
	    
	   /* private function __autoload($class_name) {
			if(!include ($this->base_path.'application/controller/'.$class_name.'.php')) {
				die("Class $class_name not Found");
			}
		}*/
	}
?>