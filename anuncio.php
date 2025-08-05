<?php
    require 'includes/app.php';

    incluirTemplate('header');

    $db = conectarDB();

    $id = $_GET['id'] ?? null;
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header("location: /");
    }

    $query = "SELECT * FROM propiedades WHERE id = $id";
    $respuesta = mysqli_query($db,$query);
    $propiedad = mysqli_fetch_assoc($respuesta);

    if($respuesta->num_rows === 0){
        header("location: /");
    }

?>

    <main class="contenedor seccion contenido-centrado">
        <h2><?php echo $propiedad['titulo'] ?></h2>
        <div class="img">
            <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen'] ?>" alt="Casa con piscina frente al bosque">
        </div>
        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio'] ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamientos'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                    <p><?php echo $propiedad['habitaciones'] ?></p>
                </li>
            </ul>
            <p><?php echo $propiedad['descripcion'] ?></p>
        </div>
    </main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>