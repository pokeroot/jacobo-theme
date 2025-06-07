<?php
/**
 * Template Name: Generador de Campañas
 * Template Post Type: page
 */
get_header();
?>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-10 text-center">Generador de Campañas IA</h1>

    <div class="max-w-3xl mx-auto">
        <form id="campaignForm" class="space-y-8 bg-white p-8 rounded-xl shadow-2xl">

            <section class="border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">1. Define tu Campaña</h2>
                <div>
                    <label for="campaign_name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Campaña (interno)</label>
                    <input type="text" name="campaign_name" id="campaign_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3" placeholder="Ej: Lanzamiento Verano Mascotas 2024">
                </div>
                <div class="mt-4">
                    <label for="campaign_objective" class="block text-sm font-medium text-gray-700 mb-1">¿Cuál es el objetivo principal de tu campaña?</label>
                    <input type="text" name="campaign_objective" id="campaign_objective" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3" placeholder="Ej: Incrementar ventas de nueva colección de collares para perros en un 20%">
                </div>
            </section>

            <section class="border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">2. Selección de Productos</h2>
                <div>
                    <label for="product_urls" class="block text-sm font-medium text-gray-700 mb-1">URLs de Productos de tu Tienda (uno por línea)</label>
                    <textarea name="product_urls" id="product_urls" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3" placeholder="https://mitienda.com/producto-a\nhttps://mitienda.com/producto-b"></textarea>
                    <button type="button" id="loadProductsBtn" class="mt-3 bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 text-sm font-medium transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Cargar Productos
                    </button>
                </div>
                <div id="productPreviewArea" class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Las previsualizaciones de productos aparecerán aquí -->
                </div>
            </section>

            <section class="border-b pb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">3. Tono y Estilo</h2>
                <div>
                    <label for="voice_tone" class="block text-sm font-medium text-gray-700 mb-1">Tono de Voz Deseado</label>
                    <select name="voice_tone" id="voice_tone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3">
                        <option>Amigable y Cercano</option>
                        <option>Profesional y Corporativo</option>
                        <option>Persuasivo y Directo</option>
                        <option>Creativo y Original</option>
                        <option>Divertido y Entretenido</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="additional_details" class="block text-sm font-medium text-gray-700 mb-1">Palabras Clave o Detalles Adicionales (opcional)</label>
                    <textarea name="additional_details" id="additional_details" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-3" placeholder="Ej: enfocar en sostenibilidad, materiales reciclados, cruelty-free"></textarea>
                </div>
            </section>

            <div class="text-center pt-6">
                <button type="submit" id="generateMagicBtn" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 px-10 rounded-lg text-xl transition duration-150 ease-in-out shadow-lg hover:shadow-xl transform hover:scale-105">
                    ✨ Generar Magia ✨
                </button>
            </div>
        </form>

        <div id="loadingAnimation" class="hidden text-center py-12">
            <p class="text-2xl font-semibold text-indigo-700 mb-4">Generando Magia para tu Campaña...</p>
            <svg class="animate-spin h-16 w-16 text-indigo-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-500 mt-4">Esto puede tardar unos segundos...</p>
        </div>

        <div id="resultsArea" class="hidden mt-12 bg-gray-50 p-8 rounded-xl shadow-xl">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">🚀 ¡Tu Campaña está Lista! 🚀</h2>
            <div id="generatedContent" class="space-y-6">
                <!-- El contenido generado (texto e imágenes) se mostrará aquí -->
                <p class="text-gray-600 text-center">El contenido de tu campaña aparecerá aquí. Prepara tu varita para copiar y pegar.</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
