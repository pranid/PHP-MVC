<?php

class Controller
{
    public $load;
    public $session;
    public $db;
    public $base_uri;
    public $base_url;
    public $file;

    public function __construct()
    {
        global $_config;
        $this->base_uri = $_config['base_uri'];
        $this->base_url = $_config['base_url'];
        $this->load = new Loader();
        $this->session = new Session();
        $this->db = new Database();
        $this->file = new File();

    }

    public function dd($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }


}

?>