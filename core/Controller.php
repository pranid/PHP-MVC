<?php

class Controller
{
    public $load;
    public $session;
    public $db;

    public function __construct()
    {
        $this->load = new Loader();
        $this->session = new Session();
        $this->db = new Database();

    }

    public function dd($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}

?>