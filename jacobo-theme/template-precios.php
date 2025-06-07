<?php
/**
 * Template Name: Página de Precios
 *
 * Esta es la plantilla para mostrar los planes de precios de Jacobo.
 */

// Por ahora, solo la estructura básica. El contenido se añadirá en el siguiente paso.

get_header();
?>

<main id="content" class="pt-16 md:pt-20 bg-azulNoche text-blancoPuro">
    <div class="container mx-auto px-6 md:px-10 py-12 md:py-16">

        <h1 class="font-sora text-4xl sm:text-5xl font-bold text-center mb-12"> <?php // Aumentado el mb aquí ?>
            Elige el Plan Perfecto para
            <span class="block sm:inline-block bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">
                Impulsar tu Crecimiento
            </span>
        </h1>

        <!-- Toggle Mensual/Anual -->
        <div class="flex justify-center items-center space-x-3 mb-12 md:mb-16">
            <span class="font-inter text-grisClaro">Mensual</span>
            <label for="billingToggle" class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" value="" id="billingToggle" class="sr-only peer">
                <div class="w-14 h-7 bg-gray-700 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-blancoPuro after:content-[''] after:absolute after:top-1 after:left-1 after:bg-blancoPuro after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-gradient-to-r peer-checked:from-cianElectrico peer-checked:to-violetaNeon"></div>
            </label>
            <span class="font-inter text-grisClaro">
                Anual <span class="text-xs text-cianElectrico font-semibold">(Ahorra!)</span> <?php // El texto de ahorro específico se mostrará por plan ?>
            </span>
        </div>

        <!-- Contenedor de Planes -->
        <div id="pricingPlansContainer" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10 items-stretch">
            <?php
            $args = array(
                'post_type' => 'plan',
                'posts_per_page' => -1,
                'orderby' => 'menu_order', // Usar el campo 'Orden' de Atributos de Página
                'order' => 'ASC'
            );
            $planes_query = new WP_Query( $args );

            if ( $planes_query->have_posts() ) :
                while ( $planes_query->have_posts() ) : $planes_query->the_post();
                    // Obtener campos personalizados (ejemplos, el JS se encargará de la lógica del toggle)
                    $plan_id = get_the_ID();
                    $titulo_plan = get_the_title();
                    $precio_mensual = get_post_meta( $plan_id, 'plan_precio_mensual', true );
                    $id_producto_mensual = get_post_meta( $plan_id, 'plan_id_producto_woo_mensual', true );
                    $precio_anual = get_post_meta( $plan_id, 'plan_precio_anual', true );
                    $id_producto_anual = get_post_meta( $plan_id, 'plan_id_producto_woo_anual', true );
                    $texto_ahorro_anual = get_post_meta( $plan_id, 'plan_texto_ahorro_anual', true );
                    $es_destacado = get_post_meta( $plan_id, 'plan_destacado', true ); // 'si' o 'no'
                    $funcionalidades_raw = get_post_meta( $plan_id, 'plan_funcionalidades', true );
                    $texto_boton = get_post_meta( $plan_id, 'plan_texto_boton', true ) ?: 'Suscribirme Ahora'; // Fallback

                    $funcionalidades = explode("\n", $funcionalidades_raw); // Asume una funcionalidad por línea

                    $checkout_url_base = home_url('/checkout/?add-to-cart=');

                    $destacado_class = ($es_destacado === 'si') ? 'border-2 border-violetaNeon shadow-2xl shadow-violetaNeon/30 relative transform scale-105' : 'border border-gray-700/80';
                    $destacado_badge = ($es_destacado === 'si') ? '<span class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-gradient-to-r from-cianElectrico to-violetaNeon text-blancoPuro text-xs font-semibold px-4 py-1 rounded-full shadow-md">Más Popular</span>' : '';
            ?>
            <div class="pricing-plan-column flex flex-col bg-gray-800/30 backdrop-blur-md rounded-xl p-6 md:p-8 <?php echo esc_attr($destacado_class); ?>">
                <?php echo $destacado_badge; ?>
                <h3 class="font-sora text-2xl font-bold text-blancoPuro text-center mb-2"><?php echo esc_html($titulo_plan); ?></h3>

                <div class="text-center mb-6 min-h-[80px]"> <?php // min-h para alinear botones si los precios/ahorro cambian altura ?>
                    <span class="plan-price font-sora text-4xl md:text-5xl font-bold text-blancoPuro"
                          data-precio-mensual="<?php echo esc_attr($precio_mensual); ?>"
                          data-precio-anual="<?php echo esc_attr($precio_anual); ?>"
                          data-texto-ahorro-anual="<?php echo esc_attr($texto_ahorro_anual); // Añadido esto ?>">
                        $<?php echo esc_html(number_format((float)$precio_mensual, 0, ',', '.')); ?>
                    </span>
                    <span class="plan-period font-inter text-grisClaro text-sm">/mes</span>
                    <p class="plan-ahorro-anual text-xs text-cianElectrico font-semibold mt-1 h-4">
                        <?php // El JS llenará esto si es anual, ej: esc_html($texto_ahorro_anual) ?>
                    </p>
                </div>

                <ul class="space-y-3 mb-8 flex-grow">
                    <?php foreach ($funcionalidades as $funcionalidad) : if (trim($funcionalidad)) : ?>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-cianElectrico mr-2 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-inter text-sm text-grisClaro"><?php echo esc_html(trim($funcionalidad)); ?></span>
                    </li>
                    <?php endif; endforeach; ?>
                </ul>

                <a href="<?php echo esc_url($checkout_url_base . $id_producto_mensual); ?>"
                   class="plan-cta-button mt-auto block w-full text-center font-inter text-blancoPuro text-base font-semibold px-8 py-3 rounded-lg
                          bg-gradient-to-r from-cianElectrico to-violetaNeon
                          hover:from-violetaNeon hover:to-cianElectrico
                          transition-all duration-300 ease-in-out transform hover:scale-105"
                   data-id-producto-mensual="<?php echo esc_attr($id_producto_mensual); ?>"
                   data-id-producto-anual="<?php echo esc_attr($id_producto_anual); ?>">
                    <?php echo esc_html($texto_boton); ?>
                </a>
            </div>
            <?php
                endwhile;
                wp_reset_postdata(); // Importante después de un loop WP_Query personalizado
            else :
            ?>
                <p class="text-center col-span-full text-grisClaro">No hay planes disponibles en este momento. Por favor, vuelve más tarde.</p>
            <?php
            endif;
            ?>
        </div> <!-- /#pricingPlansContainer -->

    </div>
</main>

<?php
get_footer();
?>
