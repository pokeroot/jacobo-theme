<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Jacobo_AI_Theme
 */

?>

    <?php // La etiqueta <main> debe cerrarse en las plantillas de página individuales, no aquí. ?>
</div> <!-- Cierre de <div id="page"> o similar abierto en header.php -->

<footer id="colophon" class="site-footer bg-azulNoche border-t border-gray-700/50 py-12 px-6 md:px-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-8">
            <!-- Columna Logo y Redes -->
            <div class="col-span-2 md:col-span-1 lg:col-span-2 flex flex-col items-center md:items-start text-center md:text-left">
                <div class="footer-logo mb-4">
                    <?php
                    // Muestra el logo personalizado si existe, de lo contrario, muestra el nombre del sitio.
                    if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                        the_custom_logo();
                    } else {
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-2xl font-sora font-bold text-blancoPuro">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <p class="text-sm text-grisClaro mb-4 pr-4">
                    Transformando el marketing digital con inteligencia artificial.
                </p>
                <!-- Aquí puedes añadir los iconos de redes sociales si lo deseas -->
            </div>

            <!-- Columna Producto -->
            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Producto</h5>
                <ul class="space-y-2">
                    <li><a href="<?php echo esc_url(home_url('/#funcionalidades')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Funcionalidades</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pricing')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Precios</a></li>
                    <li><a href="/como-empezar/" class="text-grisClaro hover:text-blancoPuro text-sm">Cómo Empezar</a></li>
                    <li><a href="/casos-de-exito/" class="text-grisClaro hover:text-blancoPuro text-sm">Casos de Éxito</a></li>
                </ul>
            </div>

            <!-- Columna Recursos -->
            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Recursos</h5>
                <ul class="space-y-2">
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Blog</a></li>
                    <li><a href="/documentacion/" class="text-grisClaro hover:text-blancoPuro text-sm">Documentación</a></li>
                    <li><a href="/soporte/" class="text-grisClaro hover:text-blancoPuro text-sm">Soporte</a></li>
                    <li><a href="/glosario-ia/" class="text-grisClaro hover:text-blancoPuro text-sm">Glosario IA</a></li>
                </ul>
            </div>

            <!-- Columna Empresa -->
            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Empresa</h5>
                <ul class="space-y-2">
                    <li><a href="/sobre-nosotros/" class="text-grisClaro hover:text-blancoPuro text-sm">Sobre Nosotros</a></li>
                    <li><a href="/carreras/" class="text-grisClaro hover:text-blancoPuro text-sm">Carreras</a></li>
                    <li><a href="/contacto/" class="text-grisClaro hover:text-blancoPuro text-sm">Contacto</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700/50 pt-8 text-center">
            <p class="text-sm text-grisClaro">&copy; <?php echo date('Y'); ?> Jacobo AI. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<style>
    /* Estilos para forzar el tamaño del logo en el footer */
    .footer-logo a.custom-logo-link, /* Aplicar a la etiqueta <a> para transparencia */
    .footer-logo img.custom-logo {   /* Aplicar a la etiqueta <img> para transparencia y estilos base */
        background-color: transparent !important;
        background: none !important; /* Para mayor seguridad */
    }

    .footer-logo img.custom-logo { /* Estilos específicos para la imagen */
        width: 150px !important;
        height: 150px !important;
        object-fit: contain; /* Evita que la imagen se deforme */
        border-radius: 1.5rem; /* Bordes redondeados para un look moderno */
        transition: all 0.3s ease-in-out;

        /* --- EFECTO 1: RESPLANDOR PULSANTE (DE LA RAMA ENTRANTE) --- */
        box-shadow: 0 0 20px rgba(79, 70, 229, 0.4), 0 0 40px rgba(56, 189, 248, 0.2);
        animation: pulse-glow 4s infinite alternate;

        /* --- EFECTO 2: BORDE CON GRADIENTE ESTÁTICO (DESACTIVADO - DE LA RAMA ENTRANTE) --- */
        /* Para usar este, comenta las líneas de 'box-shadow' y 'animation' de arriba */
        /* y descomenta las siguientes 3 líneas. */
        /*
        border: 2px solid transparent;
        background: linear-gradient(#0f172a, #0f172a) padding-box, linear-gradient(135deg, #6366f1, #06b6d4) border-box;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        */
    }

    /* Aplicar el hover al enlace para que afecte a la imagen */
    .footer-logo a.custom-logo-link:hover img.custom-logo {
        transform: scale(1.05); /* Efecto de zoom al pasar el ratón */
    }

    @keyframes pulse-glow {
        from {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.3), 0 0 35px rgba(56, 189, 248, 0.1);
        }
        to {
            box-shadow: 0 0 30px rgba(79, 70, 229, 0.6), 0 0 50px rgba(56, 189, 248, 0.3);
        }
    }
</style>

<?php wp_footer(); ?>
</body>
</html>
