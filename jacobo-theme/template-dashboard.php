<?php
/**
 * Template Name: Dashboard Principal
 * Template Post Type: page
 */

get_header();
?>
<main id="content" class="flex-grow pt-16 md:pt-20">
<div class="container mx-auto px-4 py-8">

    <h1 class="font-sora text-4xl sm:text-5xl font-bold text-blancoPuro mb-10 md:mb-12">Bienvenido a tu Dashboard, [Usuario]!</h1>

    <!-- Sección Sugerencias de Jacobo -->
    <div id="jacoboSuggestionsSection" class="mb-8 bg-gray-800/30 backdrop-blur-md rounded-xl shadow-2xl p-6 border border-gray-700/50">
        <h2 class="font-sora text-2xl font-semibold text-blancoPuro mb-4">Sugerencias de Jacobo</h2>
        <div id="jacoboSuggestionsContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Estado de Carga Inicial -->
            <div id="suggestionsLoadingState" class="col-span-full text-center py-8">
                <svg class="animate-spin h-10 w-10 text-cianElectrico mx-auto mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-lg font-medium text-grisClaro">Buscando nuevas ideas para ti...</p>
                <p class="text-sm text-gray-400">Esto puede tardar unos segundos.</p>
            </div>
            <!-- Las tarjetas de sugerencias se cargarán aquí por JS -->
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Card Estado de Suscripción -->
        <div class="bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 p-6">
            <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-2">Estado de tu Suscripción</h2>
            <p class="text-grisClaro">Plan: <span class="font-bold text-cianElectrico">Pro</span></p>
            <a href="#" class="text-cianElectrico hover:text-violetaNeon mt-4 inline-block text-sm">Administrar Suscripción &rarr;</a>
        </div>

        <!-- Card Estadísticas de Uso -->
        <div class="bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 p-6">
            <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-2">Uso de la Plataforma</h2>
            <p class="text-grisClaro">Publicaciones generadas: <span class="font-bold text-blancoPuro">15/100</span></p>
            <div class="w-full bg-gray-700 rounded-full h-2.5 mt-2">
                <div class="bg-gradient-to-r from-cianElectrico to-violetaNeon h-2.5 rounded-full" style="width: 15%"></div>
            </div>
            <a href="#" class="text-cianElectrico hover:text-violetaNeon mt-4 inline-block text-sm">Ver Estadísticas Detalladas &rarr;</a>
        </div>

        <!-- Placeholder para otra card si se necesita -->
        <div class="bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 p-6">
            <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-2">Próximas Funciones</h2>
            <p class="text-grisClaro">Estamos trabajando en nuevas herramientas para ti.</p>
             <a href="#" class="text-cianElectrico hover:text-violetaNeon mt-4 inline-block text-sm">Sugerir una función &rarr;</a>
        </div>
    </div>

    <div class="bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 p-6">
        <h2 class="font-sora text-2xl font-semibold text-blancoPuro mb-6">Accesos Rápidos</h2>
        <div class="flex flex-wrap gap-4">
            <a href="#"
               class="bg-gradient-to-r from-cianElectrico to-violetaNeon hover:from-violetaNeon hover:to-cianElectrico
                      text-blancoPuro font-inter font-semibold py-3 px-6 rounded-lg text-base transition-all
                      duration-300 ease-in-out transform hover:scale-105 shadow-lg hover:shadow-violetaNeon/30
                      flex items-center">
                <span class="mr-2">🚀</span> Nueva Campaña
            </a>
            <a href="#"
               class="bg-gray-700 hover:bg-gray-600 text-grisClaro font-inter font-semibold py-3 px-6
                      rounded-lg text-base transition-colors duration-150 ease-in-out flex items-center">
                <span class="mr-2">⚡</span> Generador Rápido
            </a>
            <a href="#"
               class="border border-cianElectrico text-cianElectrico hover:bg-cianElectrico hover:text-azulNoche
                      font-inter font-semibold py-3 px-6 rounded-lg text-base transition-colors
                      duration-150 ease-in-out flex items-center">
                <span class="mr-2">💡</span> Ideas de Contenido
            </a>
        </div>
    </div>

</div>
</main>
<?php get_footer(); ?>
