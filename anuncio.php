<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Casa en Venta Frente al Bosque</h2>
        <div class="img">
            <picture>
                <source srcset="build/img/destacada.webp" type="image/webp">
                <source srcset="build/img/destacada.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/destacada.jpg" alt="Casa con piscina frente al bosque">
            </picture>
        </div>
        <div class="resumen-propiedad">
            <p class="precio">$3.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa deleniti at, dolore aut fuga illo cumque accusantium odit magnam, hic in, laudantium obcaecati facere. Quibusdam, non quas. Nostrum architecto repellat blanditiis ullam consectetur sunt nam similique illo recusandae praesentium asperiores debitis atque voluptatem nihil fugiat nemo qui explicabo voluptas quae id at ratione minus, laboriosam molestiae! Aspernatur magnam suscipit optio non veritatis dolor ratione voluptates ad incidunt. Odio aut debitis reiciendis ab mollitia officiis rerum consequuntur quod aspernatur autem, deleniti id adipisci inventore veniam voluptates. Repellendus ducimus dolorum, cumque accusantium vero culpa quis reiciendis omnis quaerat, iure commodi fuga rem.</p>
            
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem, aspernatur consequatur quod, qui molestiae soluta quibusdam sequi minus magnam alias ab. Doloribus quos, sapiente quia nesciunt ratione accusamus illo fugiat possimus. Quis rerum corrupti distinctio repudiandae voluptate voluptas voluptatem odit iusto, suscipit, quaerat velit accusantium minus similique recusandae molestias. Dolores placeat perferendis vel voluptate eligendi numquam eveniet animi alias optio consectetur sint corporis molestias, magnam omnis aliquam deserunt excepturi voluptatibus vero odit libero enim ipsam! Expedita natus laboriosam atque, earum doloremque reprehenderit aliquid amet voluptatibus ipsam quis vel laborum dolor quisquam incidunt aut pariatur veniam repudiandae totam asperiores fugiat ipsum.</p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>