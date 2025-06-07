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
                // 'nonce' => wp_create_nonce('wp_rest') // Example if you need a REST API nonce
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
