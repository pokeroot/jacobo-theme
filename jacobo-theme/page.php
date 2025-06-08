<?php
/**
 * La plantilla para mostrar todas las páginas.
 */

get_header();
?>

<main id="primary" class="site-main flex-grow pt-16 md:pt-20 bg-azulNoche text-grisClaro">
    <div class="container mx-auto px-6 md:px-10 py-12 md:py-16"> <?php // Contenedor para centrar y limitar ancho ?>
        <?php
        while ( have_posts() ) :
            the_post();
            get_template_part( 'template-parts/content', 'page' );
        endwhile; // Fin del Loop.
        ?>
    </div> <?php // Fin .container ?>
</main><!-- #primary -->

<?php
get_footer();
?>
