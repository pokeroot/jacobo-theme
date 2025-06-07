<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-azulNoche text-grisClaro font-inter'); // Updated body classes as per new design ?>>
<?php wp_body_open(); ?>

<header id="siteHeader" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out py-4 px-6 md:px-10">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-sora font-bold text-blancoPuro">
            Jacobo
            <?php /* Si hubiera un SVG logo: <img src="path/to/logo.svg" alt="Jacobo Logo" class="h-8 w-auto"> */ ?>
        </a>

        <!-- Navegación Central -->
        <nav class="hidden md:flex space-x-6" aria-label="Navegación Principal">
            <a href="#" class="font-inter text-grisClaro hover:text-blancoPuro transition-colors">Funcionalidades</a>
            <a href="/precios" class="font-inter text-grisClaro hover:text-blancoPuro transition-colors">Precios</a>
            <a href="#" class="font-inter text-grisClaro hover:text-blancoPuro transition-colors">Blog</a>
        </nav>

        <!-- Botones Derecha -->
        <div class="flex items-center space-x-4">
            <a href="#" class="font-inter text-grisClaro hover:text-blancoPuro transition-colors text-sm">Iniciar Sesión</a>
            <a href="/precios"
               class="font-inter text-blancoPuro text-sm font-semibold px-6 py-2 rounded-md
                      bg-gradient-to-r from-cianElectrico to-violetaNeon
                      hover:from-violetaNeon hover:to-cianElectrico
                      transition-all duration-300 ease-in-out transform hover:scale-105">
                Registrarse Gratis
            </a>
            <button id="mobileMenuToggle" class="md:hidden text-blancoPuro" aria-label="Abrir menú móvil" aria-expanded="false" aria-controls="mobileMenu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>
    <!-- Menú Móvil (oculto por defecto) -->
    <div id="mobileMenu" class="md:hidden hidden bg-azulNoche/95 backdrop-blur-md mt-0 shadow-xl absolute top-full left-0 right-0">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium font-inter text-grisClaro hover:text-blancoPuro hover:bg-gray-700/50">Funcionalidades</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium font-inter text-grisClaro hover:text-blancoPuro hover:bg-gray-700/50">Precios</a>
            <a href="#" class="block px-3 py-2 rounded-md text-base font-medium font-inter text-grisClaro hover:text-blancoPuro hover:bg-gray-700/50">Blog</a>
        </div>
    </div>
</header>

<?php // El tag <main> usualmente se abre en el template de la página (ej. front-page.php, index.php, page.php) ?>
<?php // Es importante que el template que use este header.php añada un padding-top a su contenido principal para compensar el header fijo. ?>
<?php // Por ejemplo, en front-page.php: <main id="content" class="pt-16 md:pt-20"> donde pt-16 o pt-20 es la altura aproximada del header. ?>

<div id="page" class="min-h-screen flex flex-col">
    <?php // La etiqueta <main> debe abrirse en las plantillas de página individuales, no aquí. ?>
    <?php // Ejemplo: page.php, single.php, front-page.php deberían tener <main id="content" class="flex-grow pt-20"> (ajustar pt según altura del header) ?>
