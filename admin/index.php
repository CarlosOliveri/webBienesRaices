<?php
    require '../includes/app.php';
    estadoAutenticado();

    use App\Propiedad;
    
    //Implementar un metod para obtener todas las propiedades
    $propiedades = Propiedad::all();

    $resultado = $_GET['resultado'] ?? null;


    //Eliminar Propiedades
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //Eliminar archivo
            $query = "SELECT imagen FROM propiedades WHERE id = $id;";
            $resultado = mysqli_query($db,$query);
            $propiedad = mysqli_fetch_assoc($resultado);
            unlink("../imagenes/" . $propiedad["imagen"]);
            echo "<pre>";
            var_dump($archivo);
            echo "</pre>";

            //Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = $id;";
            $resultado = mysqli_query($db,$query);
            if($resultado){
                header("location: /admin?resultado=3");
            } 
        }

    }

    incluirTemplate('header');

?>
    <main class="contenedor">
        <h1>Panel de Administración</h1>

        <?php
            if($resultado == 1){?>
                <p class="alerta exito">La propiedad ha sido Agregada correctamente</p>
            <?php }elseif($resultado == 2){?>
                <p class="alerta exito">La propiedad ha sido Actualizada correctamente</p>
            <?php }elseif($resultado == 3){?>
                <p class="alerta exito">La propiedad ha sido Eliminada correctamente</p>
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
                        foreach($propiedades as $propiedad ){?>
                            <tr>
                            <td><?php echo $propiedad->id ?></td>
                            <td><?php echo $propiedad->titulo ?></td>
                            <td><img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla" alt="Casa en la playa"></td>
                            <td>$ <?php echo $propiedad->precio ?></td>
                            <td>
                                <form method="POST" class="w-100">
                                    <input name="id" type="hidden" value="<?php echo $propiedad->id ?>">
                                    <input type="submit"  class="boton-rojo-block" value="Eliminar">
                                </form>
                                <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Editar</a>
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