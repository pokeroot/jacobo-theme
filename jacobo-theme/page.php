<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Jacobo_AI_Theme
 */

get_header();
?>

<main id="primary" class="site-main py-16 md:py-24">
    <div class="container mx-auto px-6">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header mb-8 text-center">
                    <?php the_title( '<h1 class="entry-title text-4xl font-bold text-white">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content prose prose-invert lg:prose-xl mx-auto">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'jacobo-ai-theme' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
            <?php
        endwhile; // End of the loop.
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
```
