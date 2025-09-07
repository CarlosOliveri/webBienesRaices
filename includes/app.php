<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__ . '/../vendor/autoload.php';

    //Se establece una conexion a la base de datos
    $db = conectarDB();
    
    use App\ActiveRecord;
    //se guarda la conexion a la base de daros como propiedad en la clase Propiedad
    ActiveRecord::setDB($db);
     