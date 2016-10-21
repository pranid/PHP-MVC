<?php
/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:59 PM
 */

if (isset($_config['base_uri'])) {
    $base_uri = $_config['base_uri'];
    define("BASE_URL", $_config['base_url']);
} else {
    die("Could not find base_url in config.php");
}

/**
 * Load core files
 */
try {
    $core_path = "$base_uri/core";
    $core = scandir($core_path);

    include "$core_path/Parser.php";
    include "$core_path/Loader.php";
    include "$core_path/Database.php";
    include "$core_path/File.php";
    include "$core_path/Session.php";
    include "$core_path/Controller.php";
    include "$core_path/Model.php";

    foreach ($core as $key => $file) {
        if (!in_array($file, array(".", "..", "Autoload.php", "index.html", "Model.php"))) {
//            include "$core_path/$file";
            $class_name = explode('.', $file)[0];

            if ($class_name == "Parser") {
                $$class_name = new $class_name($_config);
            } else {
                $$class_name = new $class_name;
            }

        }
    }
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
