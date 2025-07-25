<?php
    require '../includes/funciones.php';
    require '../includes/config/database.php';

    incluirTemplate('header');

    $resultado = $_GET['resultado'] ?? null;


    //Consultar con base de datos para traer las propiedades
    $db = conectarDB();
    $query = "SELECT * FROM propiedades;";
    $resultadoConsulta = mysqli_query($db, $query);

?>
    <main class="contenedor">
        <h1>Panel de Administración</h1>

        <?php
            if($resultado == 1){?>
                <p class="alerta exito">La propiedad ha sido agregada correctamente</p>
            <?php }elseif($resultado == 2){?>
                <p class="alerta exito">La propiedad ha sido actualizada correctamente</p>
            <?php }?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    
        <table class="propiedades">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Mostrar los resultados
                        while($propiedades = mysqli_fetch_assoc($resultadoConsulta)){?>
                            <tr>
                            <td><?php echo $propiedades['id'] ?></td>
                            <td><?php echo $propiedades['titulo'] ?></td>
                            <td><img src="/imagenes/<?php echo $propiedades['imagen'] ?>" class="imagen-tabla" alt="Casa en la playa"></td>
                            <td>$ <?php echo $propiedades['precio'] ?></td>
                            <td>
                                <a href="/admin/propiedades/eliminar.php?id=<?php echo $propiedades['id'] ?>" class="boton-rojo-block">Eliminar</a>
                                <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedades['id'] ?>" class="boton-amarillo-block">Editar</a>
                            </td>
                            </tr>
                    <?php } ?>    
                </tbody>
        </table>
    
    </main>
<?php
    mysqli_close($db);
    incluirTemplate('footer');
?>