<?php
//Este archivo debe eliminarse en produccion, solo existira un usuario administrador de la pagina
    require 'includes/app.php';

    $db = conectarDB();

    $email = "correo@corre.com";
    $password = "password";

    $passwordHash = password_hash($password,PASSWORD_DEFAULT);
    //var_dump($passwordHash);
    $query = "INSERT INTO usuarios (email,password) VALUES ('$email', '$passwordHash');";

    //echo $query;
    //exit;
    $respuesta = mysqli_query($db, $query);


?>