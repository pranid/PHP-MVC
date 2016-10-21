<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:59 PM
 */
class Parser
{
    protected $config;
    public $base_url;
    public $base_uri;
    private $def_controller;
    private $request_uri;

    public function __construct($_config)
    {
        try {
            $this->config = $_config;
            $this->base_uri = $_config['base_uri'];
            $this->base_url = $_config['base_url'];
            $this->request_uri = $_SERVER['REQUEST_URI'];
            $this->def_controller = $_config['def_controller'];

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

        $this->route();

    }


    public function route()
    {
        try {
            function __autoload($class_name)
            {
                if (!include("./application/controller/$class_name.php")) {
                    die("Class $class_name not Found");
                }
            }

            $url_segmant = explode('index.php/', $this->request_uri);
            $controller = $this->def_controller;
            $method = 'index';
            if (isset($url_segmant[1]))
                $controller = ucfirst(strtolower($url_segmant[1]));

            if (isset($url_segmant[2]))
                $method = $url_segmant[2];

            $new_obj = new $controller();
            $new_obj->$method();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }

    }
}

?>