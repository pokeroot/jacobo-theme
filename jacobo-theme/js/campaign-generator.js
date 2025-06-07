document.addEventListener('DOMContentLoaded', function() {
    const loadProductsBtn = document.getElementById('loadProductsBtn');
    const productUrlsTextarea = document.getElementById('product_urls');
    const productPreviewArea = document.getElementById('productPreviewArea');
    const campaignForm = document.getElementById('campaignForm');
    const loadingAnimation = document.getElementById('loadingAnimation');
    const resultsArea = document.getElementById('resultsArea');
    const generatedContent = document.getElementById('generatedContent');
    const generateMagicBtn = document.getElementById('generateMagicBtn');

    // Nuevos elementos del DOM
    const campaignTypeSelect = document.getElementById('campaign_type');
    const originalProductSelectionSection = document.getElementById('originalProductSelection');
    const productSearchSection = document.getElementById('productSearchSection');
    const productSearchInput = document.getElementById('product_search_input');
    const productSearchResultsDiv = document.getElementById('productSearchResults');
    const selectedProductIdInput = document.getElementById('selected_product_id');
    const defaultProductSearchHTML = productSearchResultsDiv ? productSearchResultsDiv.innerHTML : '<p class="text-sm text-gray-500">Los resultados de la búsqueda aparecerán aquí.</p>';


    // Lógica de visibilidad de campos dinámicos
    if (campaignTypeSelect && productSearchSection && originalProductSelectionSection) {
        campaignTypeSelect.addEventListener('change', function(event) {
            const selectedValue = event.target.value;

            // Ocultar ambas secciones por defecto y luego mostrar la relevante
            productSearchSection.style.display = 'none';
            originalProductSelectionSection.style.display = 'none';

            if (selectedValue === 'lanzamiento_producto') {
                productSearchSection.style.display = 'block';
            } else if (selectedValue === 'post_individual') {
                // Para post individual, no se necesita selección de producto por ahora
                // originalProductSelectionSection.style.display = 'block'; // Oculto según requerimiento
            } else if (selectedValue === 'oferta_flash') {
                // Para oferta flash, podría usarse la selección original o el buscador.
                // Por ahora, ocultamos ambas según el plan.
                // originalProductSelectionSection.style.display = 'block'; // Ejemplo si se quisiera mostrar la original
            }
            // Limpiar campo de búsqueda y resultados si la sección de búsqueda se oculta
            if (productSearchSection.style.display === 'none' && productSearchInput && productSearchResultsDiv && selectedProductIdInput) {
                productSearchInput.value = '';
                productSearchResultsDiv.innerHTML = defaultProductSearchHTML;
                selectedProductIdInput.value = '';
            }
        });
        // Disparar un evento change inicial para establecer el estado correcto al cargar la página
        campaignTypeSelect.dispatchEvent(new Event('change'));
    }

    // Funcionalidad de Búsqueda de Productos en Tiempo Real (Simulada)
    if (productSearchInput && productSearchResultsDiv && selectedProductIdInput) {
        let searchTimeout;
        productSearchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.trim();
            productSearchResultsDiv.innerHTML = defaultProductSearchHTML; // Resetear a placeholder o limpiar
            selectedProductIdInput.value = ''; // Limpiar ID seleccionado si se cambia la búsqueda

            if (searchTerm.length > 2) {
                productSearchResultsDiv.innerHTML = '<p class="text-sm text-gray-500">Buscando...</p>';

                clearTimeout(searchTimeout); // Cancelar timeout anterior si existe
                searchTimeout = setTimeout(() => {
                    // Simulación de respuesta de API
                    const dummyProducts = [
                        { id: 'prod_123', name: 'Collar Inteligente para Perros GPS Pro' },
                        { id: 'prod_456', name: 'Cama Ortopédica Deluxe para Mascotas Grandes' },
                        { id: 'prod_789', name: 'Fuente de Agua Fresca Silenciosa para Gatos' }
                    ];

                    // Filtrar productos simulados (opcional, para hacer la simulación más real)
                    const filteredProducts = dummyProducts.filter(p => p.name.toLowerCase().includes(searchTerm.toLowerCase()));

                    if (filteredProducts.length > 0) {
                        productSearchResultsDiv.innerHTML = ''; // Limpiar "Buscando..."
                        filteredProducts.forEach(product => {
                            const productDiv = document.createElement('div');
                            productDiv.classList.add('p-3', 'border', 'rounded-md', 'hover:bg-gray-100', 'cursor-pointer', 'text-sm');
                            productDiv.textContent = product.name;
                            productDiv.dataset.productId = product.id; // Guardar ID en dataset

                            productDiv.addEventListener('click', function() {
                                selectedProductIdInput.value = this.dataset.productId;
                                productSearchInput.value = this.textContent; // Poner nombre en input

                                // Resaltar seleccionado (simple)
                                Array.from(productSearchResultsDiv.children).forEach(child => {
                                    child.classList.remove('bg-indigo-100', 'font-semibold');
                                });
                                this.classList.add('bg-indigo-100', 'font-semibold');

                                // Opcional: Limpiar/ocultar otros resultados después de seleccionar
                                // productSearchResultsDiv.innerHTML = ''; // O podría mantenerse la lista
                                console.log('Producto seleccionado:', this.dataset.productId, this.textContent);
                            });
                            productSearchResultsDiv.appendChild(productDiv);
                        });
                    } else {
                        productSearchResultsDiv.innerHTML = '<p class="text-sm text-gray-500">No se encontraron productos para "' + searchTerm + '".</p>';
                    }
                }, 1000); // Simular 1 segundo de retraso de red
            } else if (searchTerm.length === 0) {
                 productSearchResultsDiv.innerHTML = defaultProductSearchHTML; // Mostrar placeholder original
            }
        });
    }


    if (loadProductsBtn && productUrlsTextarea && productPreviewArea) {
        // Considerar si esta lógica de "loadProductsBtn" sigue siendo necesaria
        // o si debe adaptarse/eliminarse si "originalProductSelectionSection" ya no se usa activamente.
        // Por ahora, se mantiene pero originalProductSelectionSection está oculta por defecto.
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

            // Añadir campaignType al formData
            if (campaignTypeSelect) {
                formData.append('campaignType', campaignTypeSelect.value);
            }

            // Añadir productId si es relevante y está seleccionado
            if (campaignTypeSelect && campaignTypeSelect.value === 'lanzamiento_producto' &&
                selectedProductIdInput && selectedProductIdInput.value) {
                formData.append('productId', selectedProductIdInput.value);
            }

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

                // Adaptación de visualización de resultados
                let campaignNameForResult = formObject.campaign_name || 'tu nueva campaña';
                let productInfo = '';
                if (formObject.productId) {
                    productInfo = ` para el producto ID: ${formObject.productId}`;
                }

                generatedContent.innerHTML = `
                    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                        <h3 class="font-bold text-lg text-indigo-600 mb-2">Contenido Parte 1: Post Principal (${campaignNameForResult})</h3>
                        <p class="text-gray-700">Este es el texto para el post principal de tu campaña "${campaignNameForResult}"${productInfo}. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <button class="mt-3 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Copiar Texto</button>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                        <h3 class="font-bold text-lg text-indigo-600 mb-2">Contenido Parte 2: Email Promocional</h3>
                        <p class="text-gray-700">Asunto: ¡No te pierdas ${campaignNameForResult}! <br>Este es el borrador para el email promocional de tu campaña. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button class="mt-3 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Copiar Email</button>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="font-bold text-lg text-indigo-600 mb-2">Contenido Parte 3: Anuncio Corto para Redes</h3>
                        <p class="text-gray-700">Idea para un anuncio corto: "${campaignNameForResult} - ¡Ya disponible!"${productInfo}. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <button class="mt-3 text-sm bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md transition-colors duration-150">Copiar Anuncio</button>
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
