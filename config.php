<?php
/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:42 PM
 */

/**
 * Application Path Settings
 */
$_config['base_url'] = "http://localhost/PHP-MVC/";
$_config['base_uri'] = __DIR__;

/**
 * Database Configurations
 * Server = localhost or your database server ip
 * Port = MYSQL Default -> 3306
 * Port = POSTGRESQL Default -> 5432
 * Driver = mysqli OR postgres
 *
 */
$_config['db']['server'] = "localhost";
$_config['db']['port'] = 3306;
$_config['db']['database'] = "inndeinc_test";
$_config['db']['username'] = "root";
$_config['db']['password'] = "";
$_config['db']['driver'] = "mysqli";

$_config['def_controller'] = "Welcome";

