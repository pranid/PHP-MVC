<?php 
    $this_dir = scandir($system_path.'/core/');
    
    foreach ($this_dir as $key => $file) {
        if (!in_array($file,array(".","..","Autoload.php"))) {
            include $system_path.'/core/'.$file;
        }
    }
    
    Parser::route();
?>