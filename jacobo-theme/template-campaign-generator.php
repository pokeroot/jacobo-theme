<?php
/**
 * Template Name: Generador de Campañas
 * Template Post Type: page
 */
get_header();
?>
<main id="content" class="flex-grow pt-16 md:pt-20 bg-azulNoche"> <?php // Added bg-azulNoche to main for full page dark ?>
<div class="container mx-auto px-4 py-8">
    <h1 class="font-sora text-4xl sm:text-5xl font-bold text-blancoPuro mb-10 md:mb-12 text-center">
        Generador de Campañas <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">IA</span>
    </h1>

    <div class="max-w-3xl mx-auto">
        <form id="campaignForm" class="space-y-8 bg-gray-800/30 backdrop-blur-md rounded-xl shadow-2xl p-8 border border-gray-700/50">

            <section class="border-b border-gray-700/50 pb-6">
                <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-6">1. Define tu Campaña</h2>
                <div>
                    <label for="campaign_name" class="block text-sm font-medium text-grisClaro mb-1">Nombre de la Campaña (interno)</label>
                    <input type="text" name="campaign_name" id="campaign_name" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3 placeholder-gray-400" placeholder="Ej: Lanzamiento Verano Mascotas 2024">
                </div>
                <div class="mt-4">
                    <label for="campaign_type" class="block text-sm font-medium text-grisClaro mb-1">Tipo de Campaña</label>
                    <select name="campaign_type" id="campaign_type" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3">
                        <option value="post_individual">Post Individual</option>
                        <option value="lanzamiento_producto">Lanzamiento de Producto</option>
                        <option value="oferta_flash">Oferta Flash</option>
                    </select>
                </div>
            </section>

            <section id="originalProductSelection" style="display: none;" class="border-b border-gray-700/50 pb-6">
                <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-6">2. Selección de Productos</h2>
                <div>
                    <label for="product_urls" class="block text-sm font-medium text-grisClaro mb-1">URLs de Productos de tu Tienda (uno por línea)</label>
                    <textarea name="product_urls" id="product_urls" rows="4" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3 placeholder-gray-400" placeholder="https://mitienda.com/producto-a\nhttps://mitienda.com/producto-b"></textarea>
                    <button type="button" id="loadProductsBtn" class="mt-3 bg-gray-700 hover:bg-gray-600 text-grisClaro font-semibold px-6 py-2 rounded-md text-sm transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                        Cargar Productos
                    </button>
                </div>
                <div id="productPreviewArea" class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Las previsualizaciones de productos aparecerán aquí -->
                </div>
            </section>

            <section id="productSearchSection" style="display: none;" class="border-b border-gray-700/50 pb-6">
                <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-6">2. Búsqueda de Producto (para Lanzamiento)</h2>
                <div>
                    <label for="product_search_input" class="block text-sm font-medium text-grisClaro mb-1">Buscar Producto por Nombre o SKU</label>
                    <input type="text" name="product_search_input" id="product_search_input" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3 placeholder-gray-400" placeholder="Escribe para buscar tu producto...">
                </div>
                <div id="productSearchResults" class="mt-4 space-y-2">
                    <p class="text-sm text-gray-400">Los resultados de la búsqueda aparecerán aquí.</p>
                </div>
                <input type="hidden" id="selected_product_id" name="selected_product_id">
            </section>

            <section class="border-b border-gray-700/50 pb-6">
                <h2 class="font-sora text-xl font-semibold text-blancoPuro mb-6">3. Tono y Estilo</h2>
                <div>
                    <label for="voice_tone" class="block text-sm font-medium text-grisClaro mb-1">Tono de Voz Deseado</label>
                    <select name="voice_tone" id="voice_tone" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3">
                        <option class="bg-gray-700 text-blancoPuro">Amigable y Cercano</option>
                        <option class="bg-gray-700 text-blancoPuro">Profesional y Corporativo</option>
                        <option class="bg-gray-700 text-blancoPuro">Persuasivo y Directo</option>
                        <option class="bg-gray-700 text-blancoPuro">Creativo y Original</option>
                        <option class="bg-gray-700 text-blancoPuro">Divertido y Entretenido</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="additional_details" class="block text-sm font-medium text-grisClaro mb-1">Palabras Clave o Detalles Adicionales (opcional)</label>
                    <textarea name="additional_details" id="additional_details" rows="3" class="mt-1 block w-full rounded-md bg-gray-700/50 text-blancoPuro border-gray-600 focus:border-cianElectrico focus:ring-cianElectrico focus:ring-1 outline-none shadow-sm sm:text-sm p-3 placeholder-gray-400" placeholder="Ej: enfocar en sostenibilidad, materiales reciclados, cruelty-free"></textarea>
                </div>
            </section>

            <div class="text-center pt-6">
                <button type="submit" id="generateMagicBtn"
                        class="bg-gradient-to-r from-cianElectrico to-violetaNeon hover:from-violetaNeon hover:to-cianElectrico
                               text-blancoPuro font-sora font-bold py-4 px-10 rounded-lg text-xl
                               transition-all duration-300 ease-in-out transform hover:scale-105
                               shadow-lg hover:shadow-violetaNeon/30">
                    ✨ Generar Magia ✨
                </button>
            </div>
        </form>

        <div id="loadingAnimation" class="hidden text-center py-12">
            <p class="text-2xl font-sora font-semibold text-cianElectrico mb-4">Generando Magia para tu Campaña...</p>
            <svg class="animate-spin h-16 w-16 text-cianElectrico mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="text-gray-400 mt-4">Esto puede tardar unos segundos...</p>
        </div>

        <div id="resultsArea" class="hidden mt-12 bg-gray-800/20 rounded-xl shadow-xl border border-gray-700/50 p-8">
            <h2 class="font-sora text-3xl font-bold text-blancoPuro mb-6 text-center">
                🚀 ¡Tu Campaña está
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-cianElectrico to-violetaNeon">Lista</span>! 🚀
            </h2>
            <div id="generatedContent" class="space-y-6">
                <div class="text-center text-gray-400"><p>Aquí se mostrarán las piezas de contenido de tu campaña.</p><p>Podrían ser tarjetas individuales, elementos de un acordeón, etc.</p></div>
            </div>
        </div>
    </div>
</div>
</main>
<?php get_footer(); ?>
