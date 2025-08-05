<?php

    use App\Propiedad;

    require '../../includes/app.php';
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as image;
    estadoAutenticado();

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin');
    }
    
    //base de datos
    $db = conectarDB();
    
    $consultaVendedor = "SELECT * FROM vendedores";
    $result= mysqli_query($db,$consultaVendedor);

    
    $propiedad = Propiedad::find($id);
    
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

        
            //Hasta aca llegue

            
            exit;
            
            //insertar en la base de datos
            $query = "UPDATE propiedades SET
            titulo = '$titulo',
            precio = '$precio',
            imagen = '$nombreImagen',
            descripcion = '$descripcion',
            habitaciones = $habitaciones,
            wc = $wc,
            estacionamientos = $estacionamientos,
            creado = '$creado',
            vendedores_id = $vendedor WHERE id = $id";

            //echo $query;

            /* echo $query; */
            $resultado = mysqli_query($db, $query);
            if($resultado){
                //echo "Insertado correctamente";
                header('Location: /admin?resultado=2');
            }

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