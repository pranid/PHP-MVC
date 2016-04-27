<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:59 PM
 */
class Session
{

    public function __construct()
    {
        if (session_status() === 0) {
            $this->init();
        }
    }

    public function init()
    {
        return session_start();
    }

    public function set($param1, $param2)
    {
        if (is_array($param1)) {
            foreach ($param1 as $key => $value) {
                $_SESSION["$key"] = $value;
            }
        } else {
            $_SESSION["$param1"] = $param2;
        }
    }

    public function kill()
    {
        return session_destroy();
    }

    public function remove($param)
    {
        return session_unset("$param");
    }

}

?>