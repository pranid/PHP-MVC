<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:59 PM
 */
class Model
{
    public $db;
    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }
}