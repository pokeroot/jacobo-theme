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

    // Leer parámetros de URL para prellenar
    const urlParams = new URLSearchParams(window.location.search);
    const prefillCampaignType = urlParams.get('campaignType');
    const prefillProductId = urlParams.get('productId');
    const prefillProductName = urlParams.get('productName');
    // const prefillCampaignName = urlParams.get('campaignName'); // Ejemplo si se necesitara
    // const campaignNameInput = document.getElementById('campaign_name');


    // Lógica de visibilidad de campos dinámicos (se ejecuta primero, luego el prellenado)
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
        // Esto se hará después de intentar prellenar, para que el prellenado tenga efecto primero.
        // campaignTypeSelect.dispatchEvent(new Event('change'));
    }

    // Lógica para prellenar los campos DESPUÉS de configurar el listener de 'change'
    // pero ANTES de disparar el 'change' inicial si no hay prefill.
    if (prefillCampaignType && campaignTypeSelect) {
        campaignTypeSelect.value = prefillCampaignType;
        // Disparar el evento 'change' para que se actualice la visibilidad de las secciones
        const changeEvent = new Event('change', { bubbles: true });
        campaignTypeSelect.dispatchEvent(changeEvent); // Esto es crucial
    } else if (campaignTypeSelect) {
        // Si no hay prefill, disparamos el change inicial aquí para configurar la UI por defecto.
        campaignTypeSelect.dispatchEvent(new Event('change'));
    }

    if (prefillProductId && selectedProductIdInput) {
        selectedProductIdInput.value = prefillProductId;
    }

    if (prefillProductName && productSearchInput) {
        // Solo prellenar el nombre si el tipo de campaña es lanzamiento_producto
        // y la sección de búsqueda de producto está visible (lo cual el 'change' anterior debería haber hecho)
        if (campaignTypeSelect && campaignTypeSelect.value === 'lanzamiento_producto') {
            productSearchInput.value = prefillProductName;
            // Opcional: Si también hay un ID, podrías simular un estado de "producto ya cargado/encontrado"
            // o incluso disparar una búsqueda si fuera necesario para obtener más detalles.
            // Por ahora, solo prellenamos el input.
        }
    }

    // if (prefillCampaignName && campaignNameInput) {
    //    campaignNameInput.value = prefillCampaignName;
    // }
    // Opcional: Limpieza de URL (descomentar y probar si es necesario)
    // if (urlParams.has('campaignType') || urlParams.has('productId') || urlParams.has('productName')) {
    //    history.replaceState(null, '', window.location.pathname);
    // }


    // --- Helper Functions ---
    function formatPrice(price) { // Ya existe, asegurarse que es la misma o consolidar
        const priceNum = parseFloat(price);
        if (isNaN(priceNum)) return price;
        return '$' + priceNum.toLocaleString('es-CL'); // Formato chileno
    }

    function escapeHTML(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    function escapeAttribute(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe.replace(/"/g, "&quot;");
    }

    function addCopyButtonListeners() {
        const copyButtons = document.querySelectorAll('.copy-content-btn');
        copyButtons.forEach(button => {
            button.addEventListener('click', function() {
                const textToCopy = this.dataset.copyText;
                navigator.clipboard.writeText(textToCopy).then(() => {
                    const originalText = this.textContent;
                    this.textContent = '¡Copiado!';
                    this.classList.add('bg-green-500', 'hover:bg-green-600'); // Clases temporales de éxito
                    this.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.remove('bg-green-500', 'hover:bg-green-600');
                        this.classList.add('bg-gray-700', 'hover:bg-gray-600');
                    }, 2000);
                }).catch(err => {
                    console.error('Error al copiar texto: ', err);
                    // Considerar mostrar un mensaje de error al usuario
                });
            });
        });
    }

    // Funcionalidad de Búsqueda de Productos en Tiempo Real
    if (productSearchInput && productSearchResultsDiv && selectedProductIdInput) {
        let searchTimeout;
        productSearchInput.addEventListener('input', function(event) {
            const searchTerm = event.target.value.trim();
            // No limpiar productSearchResultsDiv aquí para evitar parpadeo del placeholder si el usuario borra rápido
            // selectedProductIdInput.value = ''; // Limpiar ID solo cuando se inicia una nueva búsqueda con resultados

            if (searchTerm.length > 2) {
                productSearchResultsDiv.innerHTML = `
                <div class="flex justify-center items-center py-3">
                    <svg class="animate-spin h-5 w-5 text-cianElectrico" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="ml-2 text-xs text-grisClaro">Buscando...</p>
                </div>`;
                selectedProductIdInput.value = ''; // Limpiar ID al iniciar nueva búsqueda

                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const endpointUrl = `/wp-json/jacobo/v1/productos?search=${encodeURIComponent(searchTerm)}`;

                    fetch(endpointUrl, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-WP-Nonce': jacoboCampaignGenerator.nonce
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error de red o del servidor: ' + response.statusText);
                        }
                        return response.json();
                    })
                    .then(products => {
                        productSearchResultsDiv.innerHTML = '';
                        if (products && products.length > 0) {
                            products.forEach(product => {
                                const productDiv = document.createElement('div');
                                productDiv.className = 'p-3 mb-2 rounded-md hover:bg-gray-700 cursor-pointer border border-gray-600 transition-colors';

                                let productHTML = `<h4 class="font-semibold text-blancoPuro">${product.name}</h4>`;
                                if (product.price) {
                                    productHTML += `<p class="text-xs text-grisClaro">${formatPrice(product.price)}</p>`;
                                }
                                // Ejemplo si se quisiera añadir imagen:
                                // if (product.image_url) {
                                //    productHTML = `<img src="${product.image_url}" alt="${product.name}" class="w-10 h-10 mr-3 rounded float-left">${productHTML}`;
                                // }
                                productDiv.innerHTML = productHTML;
                                productDiv.dataset.productId = product.id;
                                productDiv.dataset.productName = product.name;

                                productDiv.addEventListener('click', function() {
                                    selectedProductIdInput.value = this.dataset.productId;
                                    productSearchInput.value = this.dataset.productName;
                                    productSearchResultsDiv.innerHTML = ''; // Limpiar resultados
                                    productSearchInput.classList.add('border-cianElectrico');
                                    setTimeout(() => productSearchInput.classList.remove('border-cianElectrico'), 2000);
                                });
                                productSearchResultsDiv.appendChild(productDiv);
                            });
                        } else {
                            productSearchResultsDiv.innerHTML = '<p class="text-sm text-grisClaro">No se encontraron productos.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error al buscar productos:', error);
                        productSearchResultsDiv.innerHTML = '<p class="text-sm text-red-400">Error al buscar productos. Inténtalo de nuevo.</p>';
                    });
                }, 500); // Debounce para no hacer llamadas en cada tecleo
            } else if (searchTerm.length === 0) {
                 productSearchResultsDiv.innerHTML = defaultProductSearchHTML;
                 selectedProductIdInput.value = ''; // Limpiar ID si el campo está vacío
            } else {
                // Opcional: Mensaje si el término es demasiado corto (menos de 3 caracteres)
                productSearchResultsDiv.innerHTML = '<p class="text-sm text-grisClaro">Escribe al menos 3 caracteres para buscar.</p>';
                selectedProductIdInput.value = '';
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

            const endpointUrl = '/wp-json/jacobo/v1/generar-contenido';

            fetch(endpointUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': jacoboCampaignGenerator.nonce
                },
                body: JSON.stringify(formObject)
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().catch(() => {
                        throw new Error('Error de red o del servidor: ' + response.status + ' ' + response.statusText);
                    }).then(errorData => {
                        throw new Error(errorData.message || 'Error al generar contenido. Código: ' + response.status);
                    });
                }
                return response.json();
            })
            .then(data => {
                loadingAnimation.classList.add('hidden');
                resultsArea.classList.remove('hidden');
                generatedContent.innerHTML = '';

                if (data && data.campaign_pieces && data.campaign_pieces.length > 0) {
                    if (data.campaign_title) {
                        const resultsTitleElement = resultsArea.querySelector('h2');
                        if (resultsTitleElement) {
                            resultsTitleElement.innerHTML = `🚀 ¡Tu Campaña "${escapeHTML(data.campaign_title)}" está Lista! 🚀`;
                        }
                    }

                    data.campaign_pieces.forEach(piece => {
                        const card = document.createElement('div');
                        card.className = 'bg-gray-800/30 backdrop-blur-md rounded-xl p-6 shadow-xl border border-gray-700/50 mb-6';

                        let cardHTML = `<h3 class="font-sora font-bold text-xl text-cianElectrico mb-3">${escapeHTML(piece.title)}</h3>`;
                        // Usamos la clase prose de Tailwind para estilizar HTML generado. Asegúrate que `piece.content` es sanitizado en backend.
                        cardHTML += `<div class="font-inter text-grisClaro leading-relaxed prose prose-sm max-w-none prose-invert">${(piece.content)}</div>`;
                        cardHTML += `<button class="mt-4 text-sm bg-gray-700 hover:bg-gray-600 text-grisClaro font-semibold py-2 px-4 rounded-md transition-colors duration-150 copy-content-btn" data-copy-text="${escapeAttribute(piece.content)}">Copiar Contenido</button>`;

                        card.innerHTML = cardHTML;
                        generatedContent.appendChild(card);
                    });
                    addCopyButtonListeners();
                } else {
                    generatedContent.innerHTML = '<p class="text-lg text-center text-grisClaro">No se generó contenido o la respuesta no tiene el formato esperado.</p>';
                }
            })
            .catch(error => {
                console.error('Error al generar contenido:', error);
                loadingAnimation.classList.add('hidden');
                resultsArea.classList.remove('hidden');
                generatedContent.innerHTML = `<div class="bg-red-800/30 p-6 rounded-xl border border-red-700/50 text-center"><p class="font-sora text-xl text-red-300 mb-3">¡Oops! Algo salió mal</p><p class="text-red-400">${escapeHTML(error.message)}</p></div>`;
            })
            .finally(() => {
                generateMagicBtn.disabled = false;
                generateMagicBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                 // Decidimos si el formulario debe volver a mostrar el botón o todo el formulario.
                 // Por ahora, solo el botón para permitir al usuario ver los resultados o errores.
                document.querySelector('#campaignForm > div:last-child').classList.remove('hidden');
            });
        });
    }
});
