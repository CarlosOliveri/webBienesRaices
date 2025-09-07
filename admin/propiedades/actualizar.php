<?php

    use App\Propiedad;
    use App\Vendedor;

    require '../../includes/app.php';
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as image;
    estadoAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }
    
    $propiedad = Propiedad::find($id);
    $vendedores = Vendedor::all();
    
    //arreglo para almacenar errores
    $errores = Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        //validacion
        $errores = $propiedad->validar();

        //subida de archivos
        $nombreImagen = md5( uniqid(rand(),true)) . ".jpg";
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){
                //Actualizar imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $resutado = $propiedad->guardar();
        }
    }

    
    incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error){?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php
            }
        ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>