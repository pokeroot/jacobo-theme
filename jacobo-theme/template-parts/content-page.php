<?php
/**
 * Plantilla parcial para mostrar el contenido de las páginas.
 * Usado por page.php.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-sm md:prose-base lg:prose-lg xl:prose-xl max-w-none prose-invert'); ?>> <?php // Añadido prose y prose-invert ?>
    <header class="entry-header mb-8"> <?php // Añadido mb-8 ?>
        <?php the_title( '<h1 class="entry-title font-sora text-4xl sm:text-5xl font-bold text-blancoPuro">', '</h1>' ); // Clases añadidas ?>
         <?php // Opcional: línea decorativa con gradiente debajo del título
            // echo '<hr class="mt-4 mb-8 border-0 h-1 bg-gradient-to-r from-cianElectrico to-violetaNeon w-1/4 mx-auto sm:mx-0">';
         ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links mt-8 text-grisClaro">' . esc_html__( 'Pages:', 'jacobo-theme' ), // Clases añadidas
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer mt-8"> <?php // Añadido mt-8 ?>
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'jacobo-theme' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link text-cianElectrico hover:text-violetaNeon">', // Clases añadidas
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
