<?php 
    class Controller{
        private $load = "as";
        // private $view;
        public function __construct() {
            // $this->$load = "Praneeth";
            echo "Praneeth";
        }
        
        public function load() {
            var_dump("Hello");
            
            $view = function() {
                 return Parser::view();
            };
            
            var_dump($view);
        }
      
        
    }
?>