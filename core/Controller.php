<?php

class Controller
{
    public $load;
    private $loader;

        public function __construct() {
            $this->loader = new Loader();
            $this->load = new Loader();
        }
    }
?>