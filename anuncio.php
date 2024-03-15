<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
  <h1>Casa en venta frente al bosque</h1>
  <picture>
    <source srcset="build/img/destacada.webp" type="image/webp" />
    <source srcset="build/img/destacada.jpg" type="image/jpeg" />
    <img src="build/img/destacada.jpg" alt="Imagen del anuncio" loading="lazy" class="icono" />
  </picture>
  <div class="resumen-propiedad">
    <p class="precio">3.000.000 €</p>
    <ul class="iconos-caracteristicas">
      <li>
        <img src="build/img/icono_dormitorio.svg" alt="Icono dormitorio" loading="lazy" class="icono" />
        <p>4</p>
      </li>
      <li>
        <img src="build/img/icono_aparcamiento.svg" alt="Icono aparcamiento" loading="lazy" class="icono" />
        <p>2</p>
      </li>
      <li>
        <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy" class="icono" />
        <p>3</p>
      </li>
    </ul>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati
      dolorum quod fugiat labore autem alias sequi eaque? Doloremque, quasi,
      dolorem corrupti nulla quo amet aliquam laborum impedit doloribus quae
      hic. Lorem ipsum dolor sit amet consectetur adipisicing elit.
      Obcaecati dolorum quod fugiat labore autem alias sequi eaque?
      Doloremque, quasi, dolorem corrupti nulla quo amet aliquam laborum
      impedit doloribus quae hic.
    </p>
  </div>
</main>
<?php
incluirTemplate('footer');
?>