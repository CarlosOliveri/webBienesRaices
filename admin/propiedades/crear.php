<?php
    //base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";
    $result= mysqli_query($db,$consulta);

    //arreglo para almacenar errores
    $errores = [];

    $titulo = '';
    $precio ='';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamientos ='';
    $vendedor = '';
    $imagen = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $titulo =mysqli_real_escape_string( $db, $_POST['titulo']);
        $precio =mysqli_real_escape_string( $db, $_POST['precio']);
        $descripcion =mysqli_real_escape_string( $db, $_POST['descripcion']);
        $habitaciones =mysqli_real_escape_string( $db, $_POST['habitaciones']);
        $wc =mysqli_real_escape_string( $db, $_POST['wc']);
        $estacionamientos =mysqli_real_escape_string( $db, $_POST['estacionamientos']);
        $vendedor =mysqli_real_escape_string( $db, $_POST['vendedor']);
        $creado = date('Y/m/d');
        $imagen = $_FILES['imagen'];

        //echo "<pre>";
        ///var_dump($imagen);
        //echo "</pre>";

        //validación de errores
        if(!$titulo){
            $errores [] = "Debes añadir un titulo";
        }
        if(!$precio){
            $errores [] = "Debes añadir un precio";
        }
        if(strlen($descripcion) < 40){
            $errores [] = "Debes añadir una descripcion de al menos 40 caracteres";
        }
        if(!$habitaciones){
            $errores [] = "Debes añadir el número de habitaciones";
        }
        if(!$wc){
            $errores [] = "Debes añadir el número de baños";
        }
        if(!$estacionamientos){
            $errores [] = "Debes añadir el número de estacionamientos";
        }
        if(!$vendedor){
            $errores [] = "Debes seleccionar un vendedor";
        }
        if(!$imagen['name'] || $imagen['error']){
            $errores [] = "Debe añadir una imagen";
        }
        if($imagen['size'] > 1000000){
            $errores [] = "La imagen es muy pesada, debe pesar menos de 1 MB";   
        }

        if(empty($errores)){

            //crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }
            //generar nombre único
            $nombreImagen = md5( uniqid(rand(),true)) . ".jpg";

            //Subir imagen
            move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen);
            
            //insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo,precio,imagen,descripcion,habitaciones,wc,estacionamientos,creado,vendedores_id) 
                VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamientos', '$creado', '$vendedor')";
            /* echo $query; */
            $resultado = mysqli_query($db, $query);
            if($resultado){
                //echo "Insertado correctamente";
                header('Location: /admin?resultado=1');
            }

        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Crear</h1>

        <a href="/admin/" class="boton boton-verde">Volver</a>

        <?php
            foreach($errores as $error){?>
                <div class="alerta error">
                    <?php echo $error; ?>
                </div>
        <?php
            }
        ?>

        <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>
                <div class="input">
                    <label for="titulo">Titulo:</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo; ?>">
                </div>

                <div class="input">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?>">
                </div>

                <div class="input">
                    <label for="imagen">Imagen de la propiedad:</label>
                    <input accept="image/jpeg image/png" type="file" name="imagen" id="imagen" >
                </div>

                <div class="input">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
                </div>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>
                <div class="input">
                    <label for="habitaciones">Habitaciones:</label>
                    <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">
                </div>

                <div class="input">
                    <label for="wc">Baños:</label>
                    <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">
                </div>

                <div class="input">
                    <label for="estacionamientos">Estacionamientos:</label>
                    <input type="number" name="estacionamientos" id="estacionamientos" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamientos; ?>">
                </div>
            </fieldset>
            <fieldset>
                <legend>Vendedor</legend>
                <div class="input">
                    <select name="vendedor">
                        <option value="">--Seleccione--</option>
                        <?php
                            while($row = mysqli_fetch_assoc($result)){?>
                                <option <?php echo $vendedor == $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . " " . $row["apellido"]; ?></option>     
                        <?php } ?>
                    </select>
                </div>
            </fieldset>
            <input type="submit" value="Crear propiedad" class="boton boton-verde">
        </form>

    </main>

<?php
    incluirTemplate('footer');
?>