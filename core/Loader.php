<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/20/2016
 * Time: 12:29 PM
 */
class Loader
{
    private $view_path = "./application/view";
    private $model_path = "./application/model";

    /**
     * Loader constructor.
     */
    public function __construct()
    {

    }

    public function view($view, $data = null)
    {
        if (isset($view)) {
            if (isset($data))
                extract($data);


            if (!(include "$this->view_path/$view.php")) {
                die("View $view not found");
            }


        }
    }

    public function model($model)
    {
        include "$this->model_path/$model";
    }
}