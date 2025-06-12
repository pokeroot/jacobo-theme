<?php
/**
 * Jacobo Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Jacobo_Theme
 */

if ( ! function_exists( 'jacobo_theme_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function jacobo_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Jacobo Theme, use a find and replace
         * to change 'jacobo-theme' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'jacobo-theme', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'jacobo-theme' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'jacobo_theme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'jacobo_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function jacobo_theme_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'jacobo_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'jacobo_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function jacobo_theme_scripts() {
    wp_enqueue_style( 'jacobo-theme-style', get_stylesheet_uri() );

    wp_enqueue_script( 'jacobo-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'jacobo-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
// Remove old action, will be replaced by jacobo_theme_enqueue_theme_assets
// add_action( 'wp_enqueue_scripts', 'jacobo_theme_scripts' ); // Original theme scripts hook, now handled by below
// add_action( 'wp_enqueue_scripts', 'jacobo_theme_enqueue_styles' ); // Original Tailwind CSS hook, now handled by below


/**
 * Enqueue theme scripts and styles.
 */
function jacobo_theme_enqueue_theme_assets() {
    // Enqueue theme stylesheet (style.css - for theme metadata, not typically for all theme styles if using Tailwind)
    // wp_enqueue_style( 'jacobo-theme-style', get_stylesheet_uri() ); // Decide if this is needed alongside Tailwind output

    // Enqueue Tailwind CSS output file
    wp_enqueue_style(
        'jacobo-theme-tailwind',
        get_template_directory_uri() . '/dist/output.css',
        array(), // Dependencies
        '1.0.1', // Version. Increment to help with cache busting if needed.
        'all'    // Media
    );

    // Enqueue global scripts for header interactivity and other site-wide functions
    wp_enqueue_script(
        'jacobo-global-scripts',
        get_template_directory_uri() . '/js/global-scripts.js',
        array(), // No specific dependencies for this script
        filemtime(get_template_directory() . '/js/global-scripts.js'), // Version based on file modification time
        true // Load in footer
    );

    // Enqueue notifications script globally
    wp_enqueue_script(
        'jacobo-notifications',
        get_template_directory_uri() . '/js/notifications.js',
        array(),
        filemtime(get_template_directory() . '/js/notifications.js'),
        true
    );

    // Enqueue general theme scripts if they exist and are needed on all pages
    // Example: navigation.js (ensure this file exists or remove this line)
    // wp_enqueue_script( 'jacobo-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0.0', true );
    // Example: skip-link-focus-fix.js (ensure this file exists or remove this line)
    // wp_enqueue_script( 'jacobo-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.0.0', true );


    // Enqueue script for campaign generator only on its specific template page
    if ( is_page_template('template-campaign-generator.php') ) {
        wp_enqueue_script(
            'jacobo-campaign-generator',
            get_template_directory_uri() . '/js/campaign-generator.js',
            array('jquery'), // Asumiendo jQuery como dependencia si se usa para AJAX
            '1.0.2', // Script version incrementada
            true     // Load in footer
        );
        // Localizar script para pasar datos de PHP
        wp_localize_script(
            'jacobo-campaign-generator', // Handle del script al que se adjuntan los datos
            'jacoboCampaignGenerator',   // Nombre del objeto JavaScript que contendrá los datos
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('jacobo_campaign_ajax_nonce'),
                'load_products_action' => 'jacobo_load_products',
                'generate_content_action' => 'jacobo_generate_content'
            )
        );
    }

    // Enqueue script for dashboard suggestions only on the dashboard page
    if (is_page_template('template-dashboard.php')) {
        wp_enqueue_script(
            'jacobo-dashboard-suggestions',
            get_template_directory_uri() . '/js/dashboard-suggestions.js',
            array(), // No dependencies for this simple script
            filemtime(get_template_directory() . '/js/dashboard-suggestions.js'), // Versioning
            true // Load in footer
        );

        // Localize script to pass data like the campaign planner URL
        $planner_page = get_page_by_path('generador-de-campanas'); // Slug of your campaign planner page
        $planner_url = $planner_page ? get_permalink($planner_page->ID) : home_url('/'); // Fallback to home_url

        wp_localize_script(
            'jacobo-dashboard-suggestions', // Script handle
            'jacoboPluginData',             // JavaScript object name
            array(
                'campaign_planner_url' => $planner_url,
                'nonce' => wp_create_nonce('wp_rest') // Nonce para la API REST
            )
        );
    }

    // Enqueue script for pricing page only on its specific template page
    if ( is_page_template('template-precios.php') ) {
        wp_enqueue_script(
            'jacobo-page-precios',
            get_template_directory_uri() . '/js/page-precios.js',
            array(), // No dependencies for this simple script
            filemtime(get_template_directory() . '/js/page-precios.js'), // Versioning
            true // Load in footer
        );
        wp_localize_script(
            'jacobo-page-precios',      // El handle del script que acabas de encolar
            'jacoboPreciosData',        // El nombre del objeto JavaScript que contendrá los datos
            array(
                'checkout_base_url' => home_url('/checkout/?add-to-cart='),
                // Aquí podrías añadir otros datos si fueran necesarios en el futuro,
                // por ejemplo, nonces si hicieras llamadas AJAX desde esta página.
            )
        );
    }

    // Enqueue script for content calendar only on its specific template page
    if ( is_page_template('template-content-calendar.php') ) {
        wp_enqueue_script(
            'jacobo-content-calendar',
            get_template_directory_uri() . '/js/content-calendar.js',
            array(), // Add dependencies here if any
            '1.0.1', // Script version incrementada
            true     // Load in footer
        );
        // Localizar script para pasar datos de PHP
        wp_localize_script(
            'jacobo-content-calendar',   // Handle del script
            'jacoboCalendar',            // Nombre del objeto JavaScript
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('jacobo_calendar_ajax_nonce'),
                'load_events_action' => 'jacobo_load_calendar_events',
                'save_event_action' => 'jacobo_save_calendar_event'
            )
        );
    }

    // Handle threaded comments script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'jacobo_theme_enqueue_theme_assets' );


/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) { // Comentado temporalmente si no existe o no es necesario aún
// require get_template_directory() . '/inc/jetpack.php'; // Comentado temporalmente si no existe o no es necesario aún
// }

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php'; // Comentado temporalmente si no existe o no es necesario aún

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) { // Comentado temporalmente si no existe o no es necesario aún
//    require get_template_directory() . '/inc/jetpack.php';
// }


/**
 * Enqueue custom styles for the WordPress login page.
 */
function jacobo_login_styles() {
    wp_enqueue_style(
        'jacobo-login-styles',
        get_template_directory_uri() . '/dist/login-output.css',
        array(),
        '1.0.0', // O usa filemtime
        'all'
    );
}
add_action( 'login_enqueue_scripts', 'jacobo_login_styles' );

/**
 * Change the logo link on the login page to the site URL.
 */
function jacobo_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'jacobo_login_logo_url' );

/**
 * Change the logo title on the login page.
 */
function jacobo_login_logo_url_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'jacobo_login_logo_url_title' );

// Registrar Custom Post Type para Planes de Precios
function jacobo_register_plan_cpt() {

    $labels = array(
        'name'                  => _x( 'Planes', 'Post Type General Name', 'jacobo-theme' ),
        'singular_name'         => _x( 'Plan', 'Post Type Singular Name', 'jacobo-theme' ),
        'menu_name'             => __( 'Planes de Precios', 'jacobo-theme' ),
        'name_admin_bar'        => __( 'Plan', 'jacobo-theme' ),
        'archives'              => __( 'Archivo de Planes', 'jacobo-theme' ),
        'attributes'            => __( 'Atributos del Plan', 'jacobo-theme' ),
        'parent_item_colon'     => __( 'Plan Padre:', 'jacobo-theme' ),
        'all_items'             => __( 'Todos los Planes', 'jacobo-theme' ),
        'add_new_item'          => __( 'Añadir Nuevo Plan', 'jacobo-theme' ),
        'add_new'               => __( 'Añadir Nuevo', 'jacobo-theme' ),
        'new_item'              => __( 'Nuevo Plan', 'jacobo-theme' ),
        'edit_item'             => __( 'Editar Plan', 'jacobo-theme' ),
        'update_item'           => __( 'Actualizar Plan', 'jacobo-theme' ),
        'view_item'             => __( 'Ver Plan', 'jacobo-theme' ),
        'view_items'            => __( 'Ver Planes', 'jacobo-theme' ),
        'search_items'          => __( 'Buscar Plan', 'jacobo-theme' ),
        'not_found'             => __( 'No encontrado', 'jacobo-theme' ),
        'not_found_in_trash'    => __( 'No encontrado en la papelera', 'jacobo-theme' ),
        'featured_image'        => __( 'Imagen Destacada', 'jacobo-theme' ), // Aunque no la usemos ahora
        'set_featured_image'    => __( 'Establecer imagen destacada', 'jacobo-theme' ),
        'remove_featured_image' => __( 'Eliminar imagen destacada', 'jacobo-theme' ),
        'use_featured_image'    => __( 'Usar como imagen destacada', 'jacobo-theme' ),
        'insert_into_item'      => __( 'Insertar en el plan', 'jacobo-theme' ),
        'uploaded_to_this_item' => __( 'Subido a este plan', 'jacobo-theme' ),
        'items_list'            => __( 'Lista de planes', 'jacobo-theme' ),
        'items_list_navigation' => __( 'Navegación de lista de planes', 'jacobo-theme' ),
        'filter_items_list'     => __( 'Filtrar lista de planes', 'jacobo-theme' ),
    );
    $args = array(
        'label'                 => __( 'Plan', 'jacobo-theme' ),
        'description'           => __( 'Planes de suscripción para Jacobo', 'jacobo-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'custom-fields', 'page-attributes' ), // 'editor' para descripción, 'page-attributes' para 'plan_orden'
        'hierarchical'          => false,
        'public'                => true, // Hacerlo true para poder consultarlo con WP_Query y verlo individualmente si se desea
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5, // Debajo de "Entradas" o "Posts"
        'menu_icon'             => 'dashicons-cart', // Icono de carrito
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false, // No necesitamos una página de archivo para los planes por ahora
        'exclude_from_search'   => true, // No incluir en búsquedas del sitio por defecto
        'publicly_queryable'    => true, // Permitir consultas directas si es necesario
        'capability_type'       => 'post', // O 'page' si se prefiere, 'post' es común para CPTs
        'rewrite'               => array( 'slug' => 'planes-jacobo', 'with_front' => false ), // Slug para URLs amigables si se accede individualmente
        'show_in_rest'          => true, // Habilitar para la API REST de WordPress
    );
    register_post_type( 'plan', $args );

}
add_action( 'init', 'jacobo_register_plan_cPT', 0 );

// Flush rewrite rules on theme activation/deactivation or CPT registration for CPTs to work correctly
// Esto es importante para que los permalinks del CPT funcionen inmediatamente después de la activación del tema.
// Sin embargo, para desarrollo, a veces es más fácil ir a Ajustes > Enlaces Permanentes y guardar sin cambiar nada.
function jacobo_theme_rewrite_flush() {
    jacobo_register_plan_cpt(); // Asegurarse de que el CPT esté registrado
    flush_rewrite_rules();
}
// Descomentar estas líneas temporalmente si los permalinks no funcionan tras añadir el CPT:
// add_action( 'after_switch_theme', 'jacobo_theme_rewrite_flush' );
// register_deactivation_hook( __FILE__, 'flush_rewrite_rules' ); // No usar __FILE__ aquí si el código está en functions.php, sino el path del plugin principal si fuera un plugin

// Nota: Para `flush_rewrite_rules()` en un tema, es mejor hacerlo una vez.
// Una forma común es guardando los Enlaces Permanentes en el admin de WP.
// O en un hook de activación del tema. Para este ejercicio, el usuario puede simplemente
// visitar Ajustes > Enlaces Permanentes en el admin de WP y hacer clic en "Guardar Cambios"
// después de que este código se añada, para asegurar que los nuevos slugs de CPT funcionen.

// Registrar Meta Box para los Detalles del Plan en el CPT "plan"
function jacobo_add_plan_details_meta_box() {
    add_meta_box(
        'jacobo_plan_details', // ID único de la meta box
        __( 'Detalles del Plan Jacobo', 'jacobo-theme' ), // Título de la meta box
        'jacobo_render_plan_details_meta_box_callback', // Función callback para renderizar el contenido
        'plan', // Custom Post Type donde se mostrará ('plan')
        'normal', // Contexto donde se mostrará ('normal', 'side', 'advanced')
        'high' // Prioridad ('high', 'core', 'default', 'low')
    );
}
add_action( 'add_meta_boxes_plan', 'jacobo_add_plan_details_meta_box' ); // Usar add_meta_boxes_{post_type} para CPTs

/**
 * Callback para renderizar el contenido de la Meta Box "Detalles del Plan Jacobo".
 * Esta función se desarrollará en el siguiente paso del plan.
 * Por ahora, solo incluirá un placeholder.
 */
function jacobo_render_plan_details_meta_box_callback( $post ) {
    // Añadir un nonce field para verificación al guardar
    wp_nonce_field( 'jacobo_save_plan_details_nonce', 'jacobo_plan_details_nonce_field' );

    // Estilos inline para la tabla y los campos para mejor organización visual en el admin
    echo '<style>
        .jacobo-meta-box-table th { text-align: left; padding-right: 10px; vertical-align: top; width: 200px; }
        .jacobo-meta-box-table td { vertical-align: top; }
        .jacobo-meta-box-table .description { font-size: 0.85em; color: #666; }
    </style>';

    echo '<table class="form-table jacobo-meta-box-table"><tbody>';

    // --- Campo: Subtítulo del Plan ---
    $subtitulo = get_post_meta( $post->ID, 'plan_subtitulo', true );
    echo '<tr>';
    echo '<th><label for="plan_subtitulo">' . __( 'Subtítulo del Plan', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="text" id="plan_subtitulo" name="plan_subtitulo" value="' . esc_attr( $subtitulo ) . '" class="widefat" />';
    echo '<p class="description">' . __( 'Ej: "Ideal para empezar" o "Todas las funciones Pro". Se muestra debajo del título del plan.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: ID Producto WooCommerce Mensual ---
    $id_mensual = get_post_meta( $post->ID, 'plan_id_producto_woo_mensual', true );
    echo '<tr>';
    echo '<th><label for="plan_id_producto_woo_mensual">' . __( 'ID Producto Woo (Mensual)', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="number" id="plan_id_producto_woo_mensual" name="plan_id_producto_woo_mensual" value="' . esc_attr( $id_mensual ) . '" class="small-text" />';
    echo '<p class="description">' . __( 'ID numérico del producto de suscripción mensual en WooCommerce.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: Precio Mensual (Valor Numérico) ---
    $precio_mensual = get_post_meta( $post->ID, 'plan_precio_mensual', true );
    echo '<tr>';
    echo '<th><label for="plan_precio_mensual">' . __( 'Precio Mensual (Valor Numérico)', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="number" step="any" id="plan_precio_mensual" name="plan_precio_mensual" value="' . esc_attr( $precio_mensual ) . '" class="small-text" />';
    echo '<p class="description">' . __( 'Ej: 19990. Usado para cálculos y por el toggle. Se formatea en el frontend.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: ID Producto WooCommerce Anual ---
    $id_anual = get_post_meta( $post->ID, 'plan_id_producto_woo_anual', true );
    echo '<tr>';
    echo '<th><label for="plan_id_producto_woo_anual">' . __( 'ID Producto Woo (Anual)', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="number" id="plan_id_producto_woo_anual" name="plan_id_producto_woo_anual" value="' . esc_attr( $id_anual ) . '" class="small-text" />';
    echo '<p class="description">' . __( 'ID numérico del producto de suscripción anual en WooCommerce.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: Precio Anual (Valor Numérico) ---
    $precio_anual = get_post_meta( $post->ID, 'plan_precio_anual', true );
    echo '<tr>';
    echo '<th><label for="plan_precio_anual">' . __( 'Precio Anual (Valor Numérico)', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="number" step="any" id="plan_precio_anual" name="plan_precio_anual" value="' . esc_attr( $precio_anual ) . '" class="small-text" />';
    echo '<p class="description">' . __( 'Ej: 199900. Usado para cálculos y por el toggle. Se formatea en el frontend.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: Texto de Ahorro Anual ---
    $texto_ahorro = get_post_meta( $post->ID, 'plan_texto_ahorro_anual', true );
    echo '<tr>';
    echo '<th><label for="plan_texto_ahorro_anual">' . __( 'Texto de Ahorro Anual', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="text" id="plan_texto_ahorro_anual" name="plan_texto_ahorro_anual" value="' . esc_attr( $texto_ahorro ) . '" class="widefat" />';
    echo '<p class="description">' . __( 'Ej: "Ahorra 20%" o "2 meses gratis". Se muestra con el precio anual.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: Destacar este plan ---
    $destacado = get_post_meta( $post->ID, 'plan_destacado', true );
    echo '<tr>';
    echo '<th><label for="plan_destacado">' . __( '¿Destacar este plan?', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="checkbox" id="plan_destacado" name="plan_destacado" value="si" ' . checked( $destacado, 'si', false ) . ' />';
    echo '<span class="description">' . __( ' Marcar para destacar este plan (ej. "Más Popular").', 'jacobo-theme' ) . '</span></td>';
    echo '</tr>';

    // --- Campo: Lista de Funcionalidades ---
    $funcionalidades = get_post_meta( $post->ID, 'plan_funcionalidades', true );
    echo '<tr>';
    echo '<th><label for="plan_funcionalidades">' . __( 'Lista de Funcionalidades', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><textarea id="plan_funcionalidades" name="plan_funcionalidades" class="widefat" rows="6">' . esc_textarea( $funcionalidades ) . '</textarea>';
    echo '<p class="description">' . __( 'Una funcionalidad por línea. Se mostrarán como una lista en la página de precios.', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    // --- Campo: Texto del Botón CTA ---
    $texto_boton = get_post_meta( $post->ID, 'plan_texto_boton', true );
    echo '<tr>';
    echo '<th><label for="plan_texto_boton">' . __( 'Texto del Botón CTA', 'jacobo-theme' ) . ':</label></th>';
    echo '<td><input type="text" id="plan_texto_boton" name="plan_texto_boton" value="' . esc_attr( $texto_boton ) . '" class="widefat" />';
    echo '<p class="description">' . __( 'Ej: "Suscribirme Ahora" o "Empezar con Pro". Si se deja vacío, se usará "Suscribirme Ahora".', 'jacobo-theme' ) . '</p></td>';
    echo '</tr>';

    echo '</tbody></table>';

    // Ejemplo de cómo se recuperaría un valor (se usará en el siguiente paso)
    // $subtitulo = get_post_meta( $post->ID, 'plan_subtitulo', true );
    // echo '<label for="plan_subtitulo">Subtítulo:</label>';
    // echo '<input type="text" id="plan_subtitulo" name="plan_subtitulo" value="' . esc_attr( $subtitulo ) . '" class="widefat" />';
}

/**
 * Guarda los datos de la Meta Box "Detalles del Plan Jacobo" cuando se guarda el CPT "plan".
 *
 * @param int $post_id El ID del post que se está guardando.
 */
function jacobo_save_plan_details_meta_data( $post_id ) {

    // 1. Verificar si nuestro nonce está presente.
    if ( ! isset( $_POST['jacobo_plan_details_nonce_field'] ) ) {
        return;
    }

    // 2. Verificar que el nonce sea válido.
    if ( ! wp_verify_nonce( $_POST['jacobo_plan_details_nonce_field'], 'jacobo_save_plan_details_nonce' ) ) {
        return;
    }

    // 3. Si es un autoguardado, no hacemos nada.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // 4. Verificar los permisos del usuario.
    // Asumimos que el CPT 'plan' usa las capabilities de 'post'. Si se cambió a 'page', ajustar aquí.
    if ( isset( $_POST['post_type'] ) && 'plan' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    } else {
        // Si no es nuestro CPT, no hacemos nada (aunque el hook save_post_plan ya debería filtrar esto)
        return;
    }

    // 5. Todo bien, ahora guardamos los datos. Sanitizar cada campo.

    // --- Campo: Subtítulo del Plan ---
    if ( isset( $_POST['plan_subtitulo'] ) ) {
        update_post_meta( $post_id, 'plan_subtitulo', sanitize_text_field( $_POST['plan_subtitulo'] ) );
    }

    // --- Campo: ID Producto WooCommerce Mensual ---
    if ( isset( $_POST['plan_id_producto_woo_mensual'] ) ) {
        update_post_meta( $post_id, 'plan_id_producto_woo_mensual', absint( $_POST['plan_id_producto_woo_mensual'] ) );
    }

    // --- Campo: Precio Mensual (Valor Numérico) ---
    if ( isset( $_POST['plan_precio_mensual'] ) ) {
        // Guardar como string después de sanitizar, para permitir decimales si es necesario.
        // El input es type="number" step="any"
        update_post_meta( $post_id, 'plan_precio_mensual', sanitize_text_field( wp_unslash( $_POST['plan_precio_mensual'] ) ) );
    }

    // --- Campo: ID Producto WooCommerce Anual ---
    if ( isset( $_POST['plan_id_producto_woo_anual'] ) ) {
        update_post_meta( $post_id, 'plan_id_producto_woo_anual', absint( $_POST['plan_id_producto_woo_anual'] ) );
    }

    // --- Campo: Precio Anual (Valor Numérico) ---
    if ( isset( $_POST['plan_precio_anual'] ) ) {
        update_post_meta( $post_id, 'plan_precio_anual', sanitize_text_field( wp_unslash( $_POST['plan_precio_anual'] ) ) );
    }

    // --- Campo: Texto de Ahorro Anual ---
    if ( isset( $_POST['plan_texto_ahorro_anual'] ) ) {
        update_post_meta( $post_id, 'plan_texto_ahorro_anual', sanitize_text_field( $_POST['plan_texto_ahorro_anual'] ) );
    }

    // --- Campo: Destacar este plan (Checkbox) ---
    // Si el checkbox está marcado, $_POST['plan_destacado'] será 'si'. Si no, no estará en $_POST.
    if ( isset( $_POST['plan_destacado'] ) && $_POST['plan_destacado'] === 'si' ) {
        update_post_meta( $post_id, 'plan_destacado', 'si' );
    } else {
        update_post_meta( $post_id, 'plan_destacado', 'no' ); // O delete_post_meta($post_id, 'plan_destacado'); si prefieres
    }

    // --- Campo: Lista de Funcionalidades (Textarea) ---
    if ( isset( $_POST['plan_funcionalidades'] ) ) {
        // Usar sanitize_textarea_field para textareas que pueden tener saltos de línea.
        // wp_kses_post podría ser una opción si se quiere permitir algo de HTML seguro, pero para una lista simple, textarea es mejor.
        update_post_meta( $post_id, 'plan_funcionalidades', sanitize_textarea_field( $_POST['plan_funcionalidades'] ) );
    }

    // --- Campo: Texto del Botón CTA ---
    if ( isset( $_POST['plan_texto_boton'] ) ) {
        update_post_meta( $post_id, 'plan_texto_boton', sanitize_text_field( $_POST['plan_texto_boton'] ) );
    }
}
// Activar el hook para el CPT 'plan'
add_action( 'save_post_plan', 'jacobo_save_plan_details_meta_data' );

// --- Personalización de Emails ---

/**
 * Devuelve el HTML de la plantilla base para los emails de Jacobo.
 * @param string $content El contenido principal del email.
 * @param string $title El título opcional para el header del email.
 * @return string El HTML completo del email.
 */
function jacobo_get_email_template_html( $content, $title = '' ) {
    $site_url = home_url();
    $theme_name = get_bloginfo( 'name' ); // O 'Jacobo' directamente
    $current_year = date( 'Y' );

    // Estilos inline básicos (la compatibilidad varía mucho entre clientes de email)
    $body_style = "margin:0; padding:0; background-color:#0A0C1F; font-family: Inter, Arial, sans-serif; color:#E0E0E0; line-height: 1.6;";
    $container_style = "width:100%; max-width:600px; margin:0 auto; padding:20px; background-color:#1E293B; border-radius: 8px;"; // Un gris azulado oscuro para el contenedor
    $header_style = "padding-bottom:20px; border-bottom:1px solid #334155; text-align:center;";
    $logo_style = "font-family: Sora, Arial, sans-serif; color:#FFFFFF; font-size:28px; font-weight:bold; text-decoration:none;";
    $content_style = "padding:20px 0;";
    $footer_style = "padding-top:20px; border-top:1px solid #334155; text-align:center; font-size:12px; color:#94A3B8;"; // Un gris más claro para el footer
    $button_style = "background-color:#00F6FF; border-radius:5px; color:#0A0C1F; display:inline-block; padding:10px 20px; text-decoration:none; font-weight:bold; font-family: Inter, Arial, sans-serif;";
    // El gradiente en botones es muy difícil de lograr consistentemente en emails, se usa color sólido de acento.

    $email_title_html = $title ? '<h1 style="font-family: Sora, Arial, sans-serif; color:#FFFFFF; font-size:24px; margin-bottom:15px;">' . esc_html($title) . '</h1>' : '';

    $html = <<<EOD
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-B">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>__EMAIL_TITLE_PLACEHOLDER__</title> <?php // El título real lo pone el cliente de email ?>
    <style type="text/css">
        /* Estilos adicionales que algunos clientes podrían respetar (Gmail los usa) */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        /* Estilos para modo oscuro en clientes que lo soportan (beta) */
        @media (prefers-color-scheme: dark) {
            body { background-color: #0A0C1F !important; }
            .email-container { background-color: #1E293B !important; }
            .email-header h1, .email-content h1, .email-content h2, .email-content h3, .email-content p, .email-content li, .email-content span, .email-content a:not(.button) { color: #E0E0E0 !important; }
            .email-footer p, .email-footer a { color: #94A3B8 !important; }
        }
    </style>
</head>
<body style="{$body_style}">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table border="0" cellpadding="0" cellspacing="0" style="{$container_style}" class="email-container">
                    <tr>
                        <td align="center" style="{$header_style}" class="email-header">
                            <a href="{$site_url}" style="{$logo_style}">Jacobo</a>
                            {$email_title_html}
                        </td>
                    </tr>
                    <tr>
                        <td style="{$content_style}" class="email-content">
                            {$content}
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="{$footer_style}" class="email-footer">
                            <p>&copy; {$current_year} {$theme_name}. Todos los derechos reservados.</p>
                            <p>
                                <a href="{$site_url}/link-a-red-social-1" style="color:#94A3B8; text-decoration:underline;">Facebook</a> |
                                <a href="{$site_url}/link-a-red-social-2" style="color:#94A3B8; text-decoration:underline;">Twitter</a> |
                                <a href="{$site_url}/link-a-red-social-3" style="color:#94A3B8; text-decoration:underline;">LinkedIn</a>
                            </p>
                            <?php // El enlace para darse de baja es más relevante para emails de marketing, no transaccionales de WP/Woo por defecto ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
EOD;
    // Reemplazar placeholder de botón si existe en el contenido (ejemplo)
    // Esto es una forma simple, se podrían usar funciones más robustas para placeholders
    $html = str_replace(
        '[jacobo_email_button text="',
        '<p style="text-align:center; margin-top:20px; margin-bottom:20px;"><a href="#" class="button" style="' . $button_style . '">',
        $html
    );
    $html = str_replace('"]', '</a></p>', $html);

    return $html;
}

// Cambiar nombre del remitente para emails de WP
add_filter( 'wp_mail_from_name', function( $original_email_from ) {
    return 'Jacobo'; // Nombre de tu plataforma
});

// Cambiar email del remitente para emails de WP
add_filter( 'wp_mail_from', function( $original_email_address ) {
    $domain = wp_parse_url( home_url(), PHP_URL_HOST );
    return 'noreply@' . $domain; // Ej: noreply@tudominio.com
});

// Personalizar el mensaje de email de recuperación de contraseña de WP
if ( !function_exists('jacobo_retrieve_password_message') ) {
    function jacobo_retrieve_password_message( $message, $key, $user_login, $user_data ) {
        $site_name = get_bloginfo( 'name' );
        $reset_link = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user_login ), 'login' );

        $email_content = "<p style='margin-bottom:15px;'>Alguien ha solicitado un reseteo de contraseña para la siguiente cuenta en {$site_name}:</p>";
        $email_content .= "<p style='margin-bottom:15px;'>Nombre de usuario: <strong>" . esc_html( $user_login ) . "</strong></p>";
        $email_content .= "<p style='margin-bottom:15px;'>Si esto fue un error, simplemente ignora este correo y no pasará nada.</p>";
        $email_content .= "<p style='margin-bottom:25px;'>Para resetear tu contraseña, visita la siguiente dirección:</p>";
        $email_content .= '[jacobo_email_button text="Resetear Contraseña" href="' . esc_url( $reset_link ) . '"]'; // Placeholder para botón
        $email_content .= "<p style='font-size:12px; color:#94A3B8; margin-top:25px;'>Si no puedes hacer clic en el enlace, cópialo y pégalo en tu navegador.</p>";

        // Reemplazar el placeholder del botón con el HTML real del botón
        $button_html = '<p style="text-align:center; margin-top:20px; margin-bottom:20px;"><a href="' . esc_url( $reset_link ) . '" class="button" style="background-color:#00F6FF; border-radius:5px; color:#0A0C1F; display:inline-block; padding:10px 20px; text-decoration:none; font-weight:bold; font-family: Inter, Arial, sans-serif;">Resetear Contraseña</a></p>';
        $email_content = str_replace('[jacobo_email_button text="Resetear Contraseña" href="' . esc_url( $reset_link ) . '"]', $button_html, $email_content);

        return jacobo_get_email_template_html( $email_content, 'Reseteo de Contraseña' );
    }
}
add_filter( 'retrieve_password_message', 'jacobo_retrieve_password_message', 10, 4 );

// Asegurar que los emails de WP se envíen como HTML
add_filter( 'wp_mail_content_type', function() {
    return 'text/html';
});

// --- Fin Personalización de Emails ---

// Hook para registrar los endpoints de la API REST
add_action( 'rest_api_init', 'jacobo_register_sugerencias_endpoint' );

/**
 * Registra el endpoint para obtener sugerencias de Jacobo.
 */
function jacobo_register_sugerencias_endpoint() {
    register_rest_route( 'jacobo/v1', '/sugerencias', array(
        'methods'             => WP_REST_Server::READABLE, // Equivalente a 'GET'
        'callback'            => 'jacobo_get_sugerencias_callback',
        'permission_callback' => 'jacobo_sugerencias_permission_callback', // Quién puede acceder
    ) );
}

/**
 * Función callback para manejar la petición al endpoint /sugerencias.
 *
 * @param WP_REST_Request $request Datos de la petición.
 * @return WP_REST_Response|WP_Error Respuesta con los datos de las sugerencias o un error.
 */
function jacobo_get_sugerencias_callback( WP_REST_Request $request ) {
    // IMPORTANTE: Reemplaza esta lógica con la forma real de obtener tus sugerencias.
    // Esto es solo un ejemplo con datos estáticos.
    $sugerencias = array(
        array(
            'id' => 1,
            'titulo' => 'Crea una campaña para el Día de la Madre',
            'descripcion' => 'Aprovecha esta fecha especial para conectar con tus clientes.',
            'cta_texto' => 'Empezar campaña',
            'cta_url' => '#campana-dia-madre-placeholder', // Reemplazar con URL real o lógica
            'icono' => '💐' // Ejemplo de icono
        ),
        array(
            'id' => 2,
            'titulo' => 'Optimiza tu SEO con IA',
            'descripcion' => 'Descubre palabras clave y estrategias de contenido para mejorar tu ranking.',
            'cta_texto' => 'Ver estrategias SEO',
            'cta_url' => '#seo-estrategias-placeholder',
            'icono' => '🔍'
        ),
        array(
            'id' => 3,
            'titulo' => 'Lanza un webinar interactivo',
            'descripcion' => 'Conecta con tu audiencia en tiempo real y muestra el valor de Jacobo.',
            'cta_texto' => 'Planificar webinar',
            'cta_url' => '#webinar-plan-placeholder',
            'icono' => '🎙️'
        )
    );

    if ( empty( $sugerencias ) ) {
        return new WP_REST_Response( array(), 200 );
    }

    return new WP_REST_Response( $sugerencias, 200 );
}

/**
 * Callback para verificar los permisos de acceso al endpoint /sugerencias.
 *
 * @param WP_REST_Request $request Datos de la petición.
 * @return bool|WP_Error True si el usuario tiene permiso, WP_Error si no.
 */
function jacobo_sugerencias_permission_callback( WP_REST_Request $request ) {
    // Por ahora, solo los usuarios logueados pueden acceder.
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_forbidden', esc_html__( 'Necesitas iniciar sesión para ver las sugerencias.', 'jacobo-theme' ), array( 'status' => 401 ) );
    }
    return true;
}

/**
 * Oculta la Barra de Administración de WordPress para todos los usuarios
 * excepto para los que tienen la capacidad de 'manage_options' (administradores).
 */
function jacobo_hide_admin_bar_for_non_admins() {
    // Comprueba si el usuario actual NO tiene la capacidad de gestionar opciones.
    if ( ! current_user_can( 'manage_options' ) ) {
        // Si no es un administrador, oculta la barra.
        add_filter( 'show_admin_bar', '__return_false' );
    }
}
add_action( 'after_setup_theme', 'jacobo_hide_admin_bar_for_non_admins' );

/**
 * Oculta la pestaña "Descargas" del menú de la página "Mi Cuenta" de WooCommerce.
 */
function jacobo_remove_my_account_downloads_tab( $items ) {
    // 'downloads' es el "slug" o "key" del endpoint que queremos eliminar.
    unset( $items['downloads'] );
    return $items;
}
// Usar una prioridad alta como 99 para asegurar que se ejecute después de que otros plugins/temas añadan items.
add_filter( 'woocommerce_account_menu_items', 'jacobo_remove_my_account_downloads_tab', 99, 1 );

/*
function jacobo_update_user_role_on_order_status_change( $order_id, $old_status, $new_status ) {
    $order = wc_get_order( $order_id );

    // Salir si no es un objeto de pedido válido
    if ( ! $order ) {
        return;
    }

    $user_id = $order->get_user_id();

    // Salir si no hay un usuario asociado al pedido o si el ID es 0.
    if ( ! $user_id || $user_id == 0) {
        return;
    }

    $user = get_user_by( 'id', $user_id );

    // Salir si no se puede obtener el objeto de usuario.
    if ( ! $user ) {
        return;
    }

    // ESCENARIO 1: PAGO EXITOSO (Se activa la suscripción o se completa un pedido)
    // 'processing' y 'completed' son los estados típicos de un pago exitoso.
    // Podrías añadir 'active' si YITH usa este estado para pedidos de activación de suscripción.
    if ( in_array( $new_status, ['processing', 'completed'] ) ) {
        // Asigna el rol personalizado si el usuario tiene un rol de 'customer' o 'subscriber' (roles por defecto de WooCommerce/WordPress)
        // Esto evita cambiar el rol si un admin u otro rol con capacidades hace una compra.
        if ( array_intersect( ['customer', 'subscriber'], $user->roles ) ) {
            $user->set_role( 'cliente_jacobo' );
        }
    }

    // ESCENARIO 2: PAGO FALLIDO O CANCELADO
    // Podrías añadir 'pending' o 'on-hold' si quieres ser más estricto con pagos no completados.
    if ( in_array( $new_status, ['failed', 'cancelled'] ) ) {
        // Comprobar si el usuario NO tiene otras suscripciones activas antes de degradarlo.
        $has_active_subscription = false;
        if ( function_exists('yith_wcs_get_user_subscriptions') ) {
            // Asegurarse de que el array de consulta para yith_wcs_get_user_subscriptions sea correcto.
            // A veces es ['status' => 'active'] o similar. Consultar documentación de YITH.
            // El ejemplo original usaba ['subscription_status' => 'active']
            $subscriptions = yith_wcs_get_user_subscriptions( $user_id, ['status' => 'active'] ); // Ajustado 'status' según uso común.
            if ( ! empty( $subscriptions ) ) {
                $has_active_subscription = true;
            }
        } else {
            // Si la función de YITH no existe, no podemos verificar suscripciones.
            // Podríamos loggear un error aquí o decidir un comportamiento por defecto.
            // Por seguridad, no degradaremos el rol si no podemos verificar.
            return;
        }

        // Si no tiene otras suscripciones activas Y el rol actual es 'cliente_jacobo' (para no afectar a nuevos registros fallidos que ya son 'subscriber')
        // o si el rol actual es 'customer' (caso de un primer registro fallido donde WooCommerce lo puso como customer)
        if ( ! $has_active_subscription && ( in_array('cliente_jacobo', $user->roles) || in_array('customer', $user->roles) ) ) {
            $user->set_role( 'subscriber' );
        }
    }
}
add_action( 'woocommerce_order_status_changed', 'jacobo_update_user_role_on_order_status_change', 10, 4 );
*/

/**
 * Redirige a los usuarios al dashboard principal después de una compra
 * e inicia sesión manualmente al usuario.
 */
function jacobo_custom_thankyou_redirect( $order_id ){
    $dashboard_url = home_url('/dashboard-principal/');
    if ( ! $order_id ){
        return;
    }

    $order = wc_get_order($order_id);
    // Salir si no se puede obtener el objeto de pedido
    if ( ! $order ) {
        return;
    }

    $user_id = $order->get_user_id();

    // Iniciar sesión al usuario manualmente si hay un user_id válido y el usuario no está ya logueado.
    if ( $user_id && $user_id > 0 ) {
        if ( !is_user_logged_in() ) {
             wp_set_current_user($user_id);
             wp_set_auth_cookie($user_id, true); // true para 'remember me'
        }
    }

    wp_safe_redirect( $dashboard_url );
    exit;
}
add_action( 'woocommerce_thankyou', 'jacobo_custom_thankyou_redirect', 10, 1 );

// --- INICIO BLOQUE DE CÓDIGO CONSOLIDADO ---

/**
 * TAREA 1: Previene el inicio de sesión automático después del registro en el checkout.
 */
add_filter( 'woocommerce_registration_auth_new_user', '__return_false' );

/**
 * TAREA 2: Desactiva el email de bienvenida estándar de WooCommerce durante el checkout.
 */
function jacobo_disable_welcome_email_on_checkout( $enabled, $user ) {
    if ( is_checkout() ) {
        return false;
    }
    return $enabled;
}
add_filter( 'woocommerce_email_enabled_new_account', 'jacobo_disable_welcome_email_on_checkout', 10, 2 );

/**
 * TAREA 3: Asigna el rol 'cliente_jacobo' y envía el email de bienvenida
 * SÓLO cuando una suscripción de YITH se activa con éxito.
 */
function jacobo_assign_role_and_send_welcome_email( $subscription ) {
    // Asegurarse de que $subscription es un objeto y tiene el método get_user_id
    if ( is_object($subscription) && method_exists($subscription, 'get_user_id') ) {
        $user_id = $subscription->get_user_id();
        if ( $user_id ) { // Asegurarse de que user_id no sea 0 o nulo
            $user = get_user_by( 'id', $user_id );

            if ( $user ) {
                // Asignar el rol personalizado
                $user->set_role( 'cliente_jacobo' );

                // Enviar el email de bienvenida de WooCommerce manualmente
                // Comprobar si WC y Mailer están disponibles
                if ( function_exists('WC') && WC()->mailer() ) {
                    $mailer = WC()->mailer();
                    $emails = $mailer->get_emails(); // Obtener todos los emails
                    // Comprobar si el email específico existe antes de intentar acceder a él
                    if ( isset( $emails['WC_Email_Customer_New_Account'] ) ) {
                        $email = $emails['WC_Email_Customer_New_Account'];
                        $email->trigger( $user_id, '', array() ); // Pasar contraseña vacía y argumentos de email si es necesario
                    }
                }
            }
        }
    }
}
add_action( 'yith_wcs_subscription_activated', 'jacobo_assign_role_and_send_welcome_email' );

/**
 * TAREA 4: Elimina la cuenta de un usuario si su pedido falla y cumple condiciones.
 * (Anteriormente referida como jacobo_delete_user_on_failed_order en el issue)
 */
function jacobo_delete_user_on_failed_order( $order_id, $old_status, $new_status ) {
    // Solo nos interesa actuar cuando un pedido cambia a 'failed' o 'cancelled'.
    if ( ! in_array( $new_status, ['failed', 'cancelled'] ) ) { return; }

    $order = wc_get_order( $order_id );
    // Salir si no podemos obtener el pedido o si no hay un ID de usuario asociado (o es 0 para invitados).
    if ( ! $order || ! ( $user_id = $order->get_user_id() ) || $user_id == 0 ) {
        return;
    }

    $user = get_user_by( 'id', $user_id );
    // Solo eliminar si el usuario es un 'customer' recién creado y no tiene otras suscripciones activas
    // (la comprobación de otras suscripciones es una capa extra de seguridad, aunque la lógica
    // de asignación de 'cliente_jacobo' debería prevenir que un cliente legítimo sea 'customer').
    if ( $user && in_array( 'customer', $user->roles ) ) {

        $has_active_subscription = false;
        if ( function_exists('yith_wcs_get_user_subscriptions') ) {
            $subscriptions = yith_wcs_get_user_subscriptions( $user_id, ['subscription_status' => 'active'] );
            if ( ! empty( $subscriptions ) ) {
                $has_active_subscription = true;
            }
        }

        if ( ! $has_active_subscription ) {
            if ( ! function_exists('wp_delete_user') ) {
                require_once( ABSPATH . 'wp-admin/includes/user.php' );
            }
            wp_delete_user( $user_id );
        }
    }
}
add_action( 'woocommerce_order_status_changed', 'jacobo_delete_user_on_failed_order', 10, 3 );

// --- FIN DEL BLOQUE DE CÓDIGO CONSOLIDADO ---
