<?php
    require 'includes/app.php';
    $db = conectarDB();
    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        /* echo "<pre>";
        var_dump($_POST);
        echo "</pre>"; */

        if(!$email){
            $errores[] = "El email es obligatorio o no es válido";
        }
        if(!$password){
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)){

            $respuesta = mysqli_query($db, "SELECT * FROM usuarios WHERE email = '$email'");
            if($respuesta->num_rows){
                //var_dump($respuesta);
                $usuario = mysqli_fetch_assoc($respuesta);
                $auth = password_verify($password, $usuario['password']);
                if($auth){
                    session_start();
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;
                    header('location: /admin');
                }
                else{
                    $errores[] = "El password es incorrecto"; 
                }
            }else{
                $errores[] = "El Usuario no existe";
            }


        }

    }

    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Inicial Sesión</h1>

    <?php foreach($errores as $error) {?>
            <p class="alerta error"><?php echo $error  ?></p>
    <?php } ?>

    <form action="" method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <div class="input">
                <label for="email">E-mail</label>
                <input id="email" name="email" type="email" placeholder="E-mail">
            </div>

            <div class="input">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Password">
            </div>
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>