<?php

    function conectarDB() :mysqli{
        $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');
        
        if(!$db){
            echo "no se conecto";
            exit;
        }
        return $db;
    }
?>