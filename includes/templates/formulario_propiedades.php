<fieldset>
    <legend>Información General</legend>
    <div class="input">
        <label for="titulo">Titulo:</label>
        <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo de la Propiedad" value="<?php echo sanitizar($propiedad->titulo); ?>">
    </div>

    <div class="input">
        <label for="precio">Precio:</label>
        <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio de la Propiedad" value="<?php echo sanitizar($propiedad->precio); ?>">
    </div>

    <div class="input">
        <label for="imagen">Imagen de la propiedad:</label>
        <input accept="image/jpeg image/png" type="file" name="propiedad[imagen]" id="imagen" >

        <?php if($propiedad->imagen){ ?>
                <img src=" /imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small" alt="Imagen  Propiedad">
        <?php } ?>

    </div>

    <div class="input">
        <label for="descripcion">Descripción:</label>
        <textarea name="propiedad[descripcion]" id="descripcion"><?php echo sanitizar($propiedad->descripcion); ?></textarea>
    </div>
</fieldset>

<fieldset>
    <legend>Información Propiedad</legend>
    <div class="input">
        <label for="habitaciones">Habitaciones:</label>
        <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->habitaciones); ?>">
    </div>

    <div class="input">
        <label for="wc">Baños:</label>
        <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->wc); ?>">
    </div>

    <div class="input">
        <label for="estacionamientos">Estacionamientos:</label>
        <input type="number" name="propiedad[estacionamientos]" id="estacionamientos" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizar($propiedad->estacionamientos); ?>">
    </div>
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <div class="input">
        <!-- <select name="vendedorId">
            <option value="">--Seleccione--</option>
            <?php
                while($row = mysqli_fetch_assoc($result)){?>
                    <option <?php echo $propiedad->vendedor == $row['id'] ? 'selected' : ''; ?> value="<?php echo sanitizar($propiedad->vendedorId); ?>"><?php echo $row['nombre'] . " " . $row["apellido"]; ?></option>     
            <?php } ?>
        </select> -->
    </div>
</fieldset>