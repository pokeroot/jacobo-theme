document.addEventListener('DOMContentLoaded', function() {
    const loadProductsBtn = document.getElementById('loadProductsBtn');
    const productUrlsTextarea = document.getElementById('product_urls');
    const productPreviewArea = document.getElementById('productPreviewArea');
    const campaignForm = document.getElementById('campaignForm');
    const loadingAnimation = document.getElementById('loadingAnimation');
    const resultsArea = document.getElementById('resultsArea');
    const generatedContent = document.getElementById('generatedContent');
    const generateMagicBtn = document.getElementById('generateMagicBtn');

    if (loadProductsBtn && productUrlsTextarea && productPreviewArea) {
        loadProductsBtn.addEventListener('click', function() {
            const urls = productUrlsTextarea.value.trim().split('\n').filter(url => url.trim() !== '');
            productPreviewArea.innerHTML = ''; // Limpiar previsualizaciones anteriores

            if (urls.length === 0) {
                productPreviewArea.innerHTML = '<p class="text-sm text-gray-500 col-span-full">No se ingresaron URLs válidas. Por favor, ingresa una URL por línea.</p>';
                return;
            }

            // Adaptación para AJAX (Paso 3)
            console.log('Preparado para llamar a AJAX para cargar productos:');
            console.log('URL:', jacoboCampaignGenerator.ajax_url);
            console.log('Nonce:', jacoboCampaignGenerator.nonce);
            console.log('Acción:', jacoboCampaignGenerator.load_products_action);
            console.log('Datos a enviar (ejemplo):', { urls: urls });
            // Aquí iría la llamada fetch() o $.ajax()
            // fetch(jacoboCampaignGenerator.ajax_url, { method: 'POST', ... body: data ... headers ...})

            // Mantener la simulación visual por ahora
            urls.forEach((url, index) => {
                const productName = `Producto Simulado ${index + 1}`;
                const productImage = `https://via.placeholder.com/150/EEEEEE/777777?text=Simulado+${index + 1}`;
                const productCard = `
                    <div class="border rounded-lg p-3 shadow-md bg-white hover:shadow-lg transition-shadow">
                        <img src="${productImage}" alt="${productName}" class="w-full h-32 object-contain rounded mb-2 bg-gray-100">
                        <h4 class="font-semibold text-sm text-gray-800 truncate" title="${productName}">${productName}</h4>
                        <p class="text-xs text-gray-500 truncate" title="${url}">${url}</p>
                    </div>`;
                productPreviewArea.insertAdjacentHTML('beforeend', productCard);
            });
        });
    }

    if (campaignForm && loadingAnimation && resultsArea && generatedContent && generateMagicBtn) {
        campaignForm.addEventListener('submit', function(event) {
            event.preventDefault();

            generateMagicBtn.disabled = true;
            generateMagicBtn.classList.add('opacity-50', 'cursor-not-allowed');
            document.querySelector('#campaignForm > div:last-child').classList.add('hidden');
            loadingAnimation.classList.remove('hidden');
            resultsArea.classList.add('hidden');

            // Adaptación para AJAX (Paso 3)
            const formData = new FormData(campaignForm);
            const formObject = Object.fromEntries(formData.entries());

            console.log('Preparado para llamar a AJAX para generar contenido:');
            console.log('URL:', jacoboCampaignGenerator.ajax_url);
            console.log('Nonce:', jacoboCampaignGenerator.nonce);
            console.log('Acción:', jacoboCampaignGenerator.generate_content_action);
            console.log('Datos del formulario:', formObject);
            // Aquí iría la llamada fetch() o $.ajax()

            // Mantener la simulación visual con setTimeout por ahora
            setTimeout(() => {
                loadingAnimation.classList.add('hidden');
                resultsArea.classList.remove('hidden');
                generatedContent.innerHTML = `
                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h3 class="font-bold text-xl text-indigo-700 mb-2">Título Principal de Campaña</h3>
                        <p class="text-gray-700 leading-relaxed">Descubre la nueva era de productos con nuestra innovadora colección. Diseñada para sorprenderte y superar tus expectativas. ¡No te quedes atrás y sé parte de la revolución!</p>
                        <button class="mt-3 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Copiar Texto</button>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                        <h3 class="font-bold text-xl text-indigo-700 mb-2">Post para Redes Sociales (Ejemplo)</h3>
                        <p class="text-gray-700 leading-relaxed">✨ ¡Atención! ✨ Lo que estabas esperando ha llegado. Nuestros nuevos [Nombre de Producto Ejemplo] están aquí para cambiar tu mundo. Visita el enlace en nuestra bio. #Novedad #[PalabraClaveEjemplo]</p>
                        <button class="mt-3 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Copiar Post</button>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="font-bold text-xl text-indigo-700 mb-2">Sugerencia de Imagen Promocional</h3>
                        <img src="https://via.placeholder.com/600x350/CCCCCC/888888?text=Imagen+Promocional+Generada+AI" alt="Imagen Promocional Generada" class="mt-2 rounded-lg shadow-sm w-full">
                        <button class="mt-3 text-sm bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Descargar Idea de Imagen</button>
                    </div>
                `;

                // Rehabilitar botón y mostrarlo de nuevo
                generateMagicBtn.disabled = false;
                generateMagicBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                document.querySelector('#campaignForm > div:last-child').classList.remove('hidden');
                // campaignForm.classList.remove('hidden'); // Mostrar formulario de nuevo si se ocultó

            }, 3000); // Simular tiempo de carga de 3 segundos
        });
    }
});
