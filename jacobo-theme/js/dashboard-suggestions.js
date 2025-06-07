document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard Suggestions JS Cargado');

    const suggestionsContainer = document.getElementById('jacoboSuggestionsContainer');
    const loadingState = document.getElementById('suggestionsLoadingState');

    // Endpoint para las sugerencias (debe ser pasado desde PHP si es necesario, o hardcodeado si es fijo)
    // const suggestionsEndpoint = '/wp-json/jacobo/v1/sugerencias';
    // Por ahora, usaremos datos de ejemplo ya que el endpoint real no está implementado por nosotros.

    if (suggestionsContainer && loadingState) {
        // Simular carga de datos después de un breve retraso
        setTimeout(() => {
            loadSuggestions();
        }, 1500);
    }

    function loadSuggestions() {
        if (!suggestionsContainer || !loadingState) return;

        // Datos de ejemplo (simulando respuesta de la API GET /jacobo/v1/sugerencias)
        const exampleSuggestions = [
            {
                id: 'sug1',
                title: 'Campaña Flash: ¡Descuentos de Verano!',
                description: 'Promociona tus productos más vendidos del verano con un descuento especial por tiempo limitado.',
                campaignType: 'oferta_flash',
                // productId: null // Opcional, si la oferta no es para un producto específico
            },
            {
                id: 'sug2',
                title: 'Lanzamiento Exclusivo: Nuevo Producto Estrella',
                description: 'Genera expectación y ventas para el nuevo [Nombre Producto Ejemplo].',
                campaignType: 'lanzamiento_producto',
                productId: 'prod_xyz_example', // ID de ejemplo
                productName: 'Producto Estrella Ejemplo' // Nombre para mostrar
            },
            {
                id: 'sug3',
                title: 'Contenido Semanal: Tips para Mascotas Felices',
                description: 'Publica un post individual cada semana con consejos útiles para dueños de mascotas.',
                campaignType: 'post_individual'
            }
        ];

        renderSuggestions(exampleSuggestions);
    }

    function renderSuggestions(suggestions) {
        if (!suggestionsContainer || !loadingState) return;

        loadingState.style.display = 'none'; // Ocultar estado de carga
        suggestionsContainer.innerHTML = ''; // Limpiar cualquier contenido previo (como el loader mismo)

        if (suggestions.length === 0) {
            suggestionsContainer.innerHTML = '<p class="col-span-full text-center text-gray-500">No hay nuevas sugerencias por el momento. ¡Vuelve pronto!</p>';
            return;
        }

        suggestions.forEach(suggestion => {
            const card = document.createElement('div');
            card.className = 'bg-gray-50 p-5 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 ease-in-out flex flex-col justify-between';

            let productInfoHTML = '';
            if (suggestion.campaignType === 'lanzamiento_producto' && suggestion.productName) {
                productInfoHTML = `<p class="text-sm text-indigo-600 font-semibold mt-1">Producto: ${suggestion.productName}</p>`;
            }

            card.innerHTML = `
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">${suggestion.title}</h3>
                    <p class="text-sm text-gray-600 mb-3">${suggestion.description}</p>
                    ${productInfoHTML}
                </div>
                <button data-suggestion-id="${suggestion.id}"
                        data-campaign-type="${suggestion.campaignType}"
                        ${suggestion.productId ? `data-product-id="${suggestion.productId}"` : ''}
                        ${suggestion.productName ? `data-product-name="${suggestion.productName}"` : ''}
                        class="create-campaign-btn mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-md transition-colors duration-150 text-sm w-full">
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
