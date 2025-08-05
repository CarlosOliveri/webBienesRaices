<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>
        <div class="img">
            <picture>
                <source srcset="build/img/destacada3.webp" type="image/webp">
                <source srcset="build/img/destacada3.jpg" type="image/jpeg">
                <img src="build/img/destacada3.jpg" alt="Imagen de contacto">
            </picture>
        </div>
        <h2>Llena el formulario de Contacto</h2>
        
        <form action="" class="formulario">
            <fieldset class="">
                <legend>Información Personal</legend>
                <div class="input">
                    <label for="nombre">Nombre:</label>
                    <input id="nombre" type="text" placeholder="Tu Nombre">
                </div>

                <div class="input">
                    <label for="email">E-mail:</label>
                    <input id="email" type="email" placeholder="Tu correo electrónico">
                </div>

                <div class="input">
                    <label for="telefono">Teléfono:</label>
                    <input id="telefono" type="tel" placeholder="Tu numero de teléfono">
                </div>

                <div class="input">
                    <label for="mensaje">Mensaje:</label>
                    <textarea name="mensaje" id="mensaje"></textarea>
                </div>
            </fieldset>

            <fieldset class="">
                <legend>información Propiedad</legend>
                <div class="input">
                    <label for="select">Vende o Compra:</label>
                    <select name="select" id="select">
                        <option value="" disabled selected>--seleccione--</option>
                        <option value="Vender">Vender</option>
                        <option value="comprar">Comprar</option>
                    </select>
                </div>

                <div class="input">
                    <label for="presupuesto">Precio o Presupuesto:</label>
                    <input id="presupuesto" type="number" placeholder="Tu Precio o Presupuesto">
                </div>
            </fieldset>

            <fieldset class="">
                <legend>Contacto</legend>
                <p>Como desea ser contactado</p>
                <div class="options">
                    <div class="opcion">
                        <label for="cell">Teléfono</label>
                        <input name="contacto" class="radio" id="contactar-telefono" type="radio" value="telefono">
                    </div>
                    <div class="opcion">
                        <label for="mail">E-mail</label>
                        <input name="contacto" class="radio" id="contactar-email" type="radio" value="email">
                    </div>
                </div>

                <p>Si eligió Teléfono, elija la fecha y la hora</p>
                <div class="input">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="" id="fecha">
                </div>
                <div class="input">
                    <label for="hora">Hora:</label>
                    <input type="time" name="" id="hora" min="09:00" max="18:00">
                </div>
            </fieldset>

            <button class="boton-verde" type="submit">Enviar</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>