<?php 
    $this_dir = scandir('./core');

    foreach ($this_dir as $key => $file) {
        if (!in_array($file,array(".","..","Autoload.php"))) {
            include './core/'.$file;
        }
    }
    
    // Parser::route();
    $parser = new Parser;
?>