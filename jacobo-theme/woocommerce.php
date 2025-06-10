<?php
/**
 * The WooCommerce template file.
 *
 * This is the most generic template file in a WooCommerce theme
 * and one of the two required files for WooCommerce theme support.
 * It is used to display all pages WooCommerce-related.
 *
 * @package Jacobo_AI_Theme
 */

get_header(); ?>

<main id="primary" class="site-main py-16 md:py-24 bg-azulNoche">
    <div class="container mx-auto px-6">
        <?php woocommerce_content(); ?>
    </div>
</main>

<?php get_footer(); ?>
```
