<?php
/**
 * Template Name: Dashboard Principal
 * Template Post Type: page
 */

get_header();
?>

<div class="container mx-auto px-4 py-8">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Bienvenido a tu Dashboard, [Usuario]!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Card Estado de Suscripción -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Estado de tu Suscripción</h2>
            <p class="text-gray-600">Plan: <span class="font-bold text-indigo-600">Pro</span></p>
            <a href="#" class="text-indigo-500 hover:text-indigo-700 mt-4 inline-block">Administrar Suscripción &rarr;</a>
        </div>

        <!-- Card Estadísticas de Uso -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Uso de la Plataforma</h2>
            <p class="text-gray-600">Publicaciones generadas: <span class="font-bold">15/100</span></p>
            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                <div class="bg-green-500 h-2.5 rounded-full" style="width: 15%"></div>
            </div>
            <a href="#" class="text-indigo-500 hover:text-indigo-700 mt-4 inline-block">Ver Estadísticas Detalladas &rarr;</a>
        </div>

        <!-- Placeholder para otra card si se necesita -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold text-gray-700 mb-2">Próximas Funciones</h2>
            <p class="text-gray-600">Estamos trabajando en nuevas herramientas para ti.</p>
             <a href="#" class="text-indigo-500 hover:text-indigo-700 mt-4 inline-block">Sugerir una función &rarr;</a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Accesos Rápidos</h2>
        <div class="flex flex-wrap gap-4">
            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out flex items-center">
                <span class="mr-2">🚀</span> Nueva Campaña
            </a>
            <a href="#" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out flex items-center">
                <span class="mr-2">⚡</span> Generador Rápido
            </a>
            <a href="#" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg text-lg transition duration-150 ease-in-out flex items-center">
                <span class="mr-2">💡</span> Ideas de Contenido
            </a>
        </div>
    </div>

</div>

<?php get_footer(); ?>
