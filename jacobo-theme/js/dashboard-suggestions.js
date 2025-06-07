document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard Suggestions JS Cargado');

    const suggestionsContainer = document.getElementById('jacoboSuggestionsContainer');
    const loadingState = document.getElementById('suggestionsLoadingState');

    function escapeHTML(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    if (suggestionsContainer && loadingState) {
        loadSuggestions(); // Cargar directamente
    }

    function loadSuggestions() {
        if (!suggestionsContainer || !loadingState) return;

        // Asegurarse que el loader esté visible antes de la llamada.
        // Si el loader está visible por defecto en HTML, esta línea no es estrictamente necesaria aquí.
        loadingState.style.display = 'block';

        const endpointUrl = '/wp-json/jacobo/v1/sugerencias';

        let headers = {
            'Content-Type': 'application/json',
        };
        // Incluir Nonce si está disponible y es necesario para el endpoint
        // if (typeof jacoboPluginData !== 'undefined' && jacoboPluginData.nonce) {
        //     headers['X-WP-Nonce'] = jacoboPluginData.nonce;
        // }

        fetch(endpointUrl, {
            method: 'GET',
            headers: headers
        })
        .then(response => {
            if (!response.ok) {
                return response.json().catch(() => {
                    throw new Error('Error de red o del servidor: ' + response.status + ' ' + response.statusText);
                }).then(errorData => {
                    throw new Error(errorData.message || 'Error al cargar sugerencias. Código: ' + response.status);
                });
            }
            return response.json();
        })
        .then(suggestions => {
            renderSuggestions(suggestions);
        })
        .catch(error => {
            console.error('Error al cargar las sugerencias:', error);
            if (loadingState) loadingState.style.display = 'none';
            if (suggestionsContainer) {
                suggestionsContainer.innerHTML = `<div class="col-span-full bg-red-800/30 p-6 rounded-xl border border-red-700/50 text-center"><p class="font-sora text-xl text-red-300 mb-3">¡Oops! No se pudieron cargar las sugerencias</p><p class="text-red-400">${escapeHTML(error.message) || 'Inténtalo de nuevo más tarde.'}</p></div>`;
            }
        });
    }

    function renderSuggestions(suggestions) {
        if (!suggestionsContainer || !loadingState) return;

        loadingState.style.display = 'none';
        suggestionsContainer.innerHTML = '';

        if (!suggestions || suggestions.length === 0) {
            suggestionsContainer.innerHTML = '<p class="col-span-full text-center text-grisClaro">No hay nuevas sugerencias por el momento. ¡Vuelve pronto!</p>';
            return;
        }

        suggestions.forEach(suggestion => {
            const card = document.createElement('div');
            card.className = 'bg-gray-800/30 backdrop-blur-md rounded-xl p-6 shadow-xl border border-gray-700/50 hover:border-cianElectrico/50 transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between';

            let productInfoHTML = '';
            if (suggestion.campaignType === 'lanzamiento_producto' && suggestion.productName) {
                productInfoHTML = `<p class="text-xs text-cianElectrico font-medium mt-2">Producto: ${escapeHTML(suggestion.productName)}</p>`;
            }

            card.innerHTML = `
                <div>
                    <h3 class="text-lg font-sora font-bold text-blancoPuro mb-2">${escapeHTML(suggestion.title)}</h3>
                    <p class="text-sm text-grisClaro mb-4">${escapeHTML(suggestion.description)}</p>
                    ${productInfoHTML}
                </div>
                <button data-suggestion-id="${suggestion.id}"
                        data-campaign-type="${suggestion.campaignType}"
                        ${suggestion.productId ? `data-product-id="${suggestion.productId}"` : ''}
                        ${suggestion.productName ? `data-product-name="${escapeHTML(suggestion.productName)}"` : ''}
                        class="create-campaign-btn mt-6 w-full text-center font-inter text-blancoPuro text-sm font-semibold px-6 py-2.5 rounded-lg bg-gradient-to-r from-cianElectrico to-violetaNeon hover:from-violetaNeon hover:to-cianElectrico transition-all duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-violetaNeon/30">
                    Crear esta Campaña
                </button>
            `;
            suggestionsContainer.appendChild(card);
        });

        addEventListenersToButtons();
    }

    function addEventListenersToButtons() {
        const buttons = document.querySelectorAll('.create-campaign-btn');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const campaignType = this.dataset.campaignType;
                const productId = this.dataset.productId;
                const productName = this.dataset.productName; // Podría ser útil para el planificador

                // Redirigir al Planificador de Campañas con parámetros
                // La URL base del planificador debe ser obtenida de forma segura (ej. localizada por PHP)
                // const plannerUrl = '/ruta-a-tu-planificador-de-campanas/'; // Ejemplo
                // Por ahora, asumiremos que jacoboPluginData.campaign_planner_url está disponible globalmente
                if (typeof jacoboPluginData === 'undefined' || !jacoboPluginData.campaign_planner_url) {
                    console.error('URL del planificador de campañas no definida.');
                    alert('Error: No se pudo determinar la página del planificador de campañas.');
                    return;
                }

                let redirectUrl = jacoboPluginData.campaign_planner_url;

                const params = new URLSearchParams();
                if (campaignType) {
                    params.append('campaignType', campaignType);
                }
                if (productId) {
                    params.append('productId', productId);
                }
                if (productName){ // Opcional: pasar el nombre para prellenar el buscador si es necesario
                    params.append('productName', productName);
                }

                if (params.toString()) {
                    redirectUrl += '?' + params.toString();
                }

                console.log('Redirigiendo a:', redirectUrl);
                window.location.href = redirectUrl;
            });
        });
    }
});
