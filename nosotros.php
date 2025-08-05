<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>


    <main class="contenedor seccion">
        <h2>Conoce sobre nosotros</h2>
        <div class="contenido-nosotros">
            <div class="img">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen sobre nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <h3>25 Años de Experiencia</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Qui, ut, pariatur aliquid sint fugiat corrupti deserunt minus ipsa nam sed tempora repellat laboriosam libero maiores accusantium distinctio consequuntur expedita in voluptate. At voluptatem, autem natus vitae neque veritatis praesentium veniam est accusamus dicta animi optio maxime, fugiat aperiam reiciendis suscipit? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus quos quasi provident impedit tenetur distinctio nostrum doloribus dignissimos ad officiis libero neque excepturi ducimus, ab in cumque illum fugit velit?</p>
            </div>

        </div>
    </main>

    <section class="contenedor seccion">
        <h2>Más Sobre Nosotros</h2>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, culpa? Impedit molestias maxime ullam, iure illo mollitia eligendi perferendis dicta voluptatum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, culpa? Impedit molestias maxime ullam, iure illo mollitia eligendi perferendis dicta voluptatum.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam, culpa? Impedit molestias maxime ullam, iure illo mollitia eligendi perferendis dicta voluptatum.</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>