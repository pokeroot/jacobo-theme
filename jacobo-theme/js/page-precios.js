document.addEventListener('DOMContentLoaded', function () {
    const billingToggle = document.getElementById('billingToggle');
    const pricingPlansContainer = document.getElementById('pricingPlansContainer');

    if (!billingToggle || !pricingPlansContainer) {
        // console.warn('Toggle de facturación o contenedor de planes no encontrado.');
        return;
    }

    // Función para formatear el precio (simple ejemplo, puedes hacerlo más robusto si necesitas)
    function formatPrice(price) {
        const priceNum = parseFloat(price);
        if (isNaN(priceNum)) return price; // Devuelve original si no es número
        return '$' + priceNum.toLocaleString('es-CL'); // Formato chileno
    }

    // Función para obtener el texto de ahorro (esto podría venir de un data-attribute también si varía por plan)
    // Por ahora, usaremos el data-attribute 'plan_texto_ahorro_anual' que está en los metadatos del CPT
    // y que debería ser pasado a un data-attribute en el HTML del plan si se quiere mostrar por plan.
    // En el HTML actual, 'plan_texto_ahorro_anual' se obtiene pero no se imprime directamente en un data-attr visible
    // para el ahorro global, sino que el span 'plan-ahorro-anual' está vacío.
    // Vamos a asumir que queremos un texto de ahorro general o que el JS lo construye.
    // Para esta versión, el span.plan-ahorro-anual es individual por plan.

    function updatePricing() {
        const isAnnual = billingToggle.checked;
        const planColumns = pricingPlansContainer.querySelectorAll('.pricing-plan-column');

        planColumns.forEach(plan => {
            const priceElement = plan.querySelector('.plan-price');
            const periodElement = plan.querySelector('.plan-period');
            const ctaButton = plan.querySelector('.plan-cta-button');
            const ahorroAnualElement = plan.querySelector('.plan-ahorro-anual');

            if (!priceElement || !periodElement || !ctaButton || !ahorroAnualElement) {
                // console.warn('Elementos del plan no encontrados en una columna:', plan);
                return;
            }

            const precioMensual = priceElement.dataset.precioMensual;
            const precioAnual = priceElement.dataset.precioAnual;
            const idProductoMensual = ctaButton.dataset.idProductoMensual;
            const idProductoAnual = ctaButton.dataset.idProductoAnual;

            // Obtener el texto de ahorro específico del plan si existe (necesitarías añadirlo en template-precios.php)
            // Ejemplo: <p class="plan-ahorro-anual" data-texto-ahorro="<?php echo esc_attr($texto_ahorro_anual); ?>"></p>
            // Por ahora, si $texto_ahorro_anual se obtuvo en PHP, lo usaremos directamente desde allí
            // pero no está en un data-attribute. El PHP lo tendría que imprimir en el span.
            // Para que JS lo controle, el HTML debería tener el $texto_ahorro_anual en un data-attribute
            // o el JS lo escribe directamente si el texto es fijo o se puede calcular.
            // El span.plan-ahorro-anual está vacío en el PHP, lo que es bueno para que JS lo llene.
            const textoAhorroAnual = priceElement.dataset.textoAhorroAnual || ''; // Asumimos que lo podríamos añadir aquí

            const checkoutBaseUrl = jacoboPreciosData.checkout_base_url;


            if (isAnnual) {
                priceElement.textContent = formatPrice(precioAnual);
                periodElement.textContent = '/año';
                ctaButton.href = checkoutBaseUrl + idProductoAnual;
                // Para el texto de ahorro, necesitaríamos el valor. Asumamos que lo tenemos en un data-attribute del plan
                // o que el $texto_ahorro_anual del PHP se puede acceder/inferir.
                // Si $texto_ahorro_anual se obtiene en el loop de PHP, lo ideal es pasarlo a un data-attribute:
                // <p class="plan-ahorro-anual" data-ahorro-texto="<?php echo esc_attr($texto_ahorro_anual); ?>"></p>
                // Y luego aquí: const textoAhorro = ahorroAnualElement.dataset.ahorroTexto || '';
                // Por ahora, vamos a simular que si es anual, muestra el texto que se obtuvo del CPT
                // (El PHP debería imprimir $texto_ahorro_anual en el span si no hay toggle, pero como hay toggle, JS lo controla)
                // Para el ejemplo, si $texto_ahorro_anual está en un data-attribute del span:
                ahorroAnualElement.textContent = priceElement.dataset.textoAhorroAnual || ''; // Si se añade data-texto-ahorro-anual al span del precio.
                                                                                              // O si se crea un data-attribute específico en el elemento plan-ahorro-anual
                                                                                              // ej. <p class="plan-ahorro-anual" data-texto-ahorro-propio="<?php echo esc_attr($texto_ahorro_anual); ?>"></p>
                                                                                              // y leerlo con ahorroAnualElement.dataset.textoAhorroPropio
                // Dado que el $texto_ahorro_anual ya se obtiene en el loop PHP, la forma más simple sería añadirlo
                // al data-attribute del priceElement, como se hizo con los precios.
                // En template-precios.php, en el span.plan-price, añadir:
                // data-texto-ahorro-anual="<?php echo esc_attr($texto_ahorro_anual); ?>"
                // Y aquí leerlo:
                const textoAhorro = priceElement.dataset.textoAhorroAnual;
                if(textoAhorro) {
                    ahorroAnualElement.textContent = textoAhorro;
                } else {
                     // Calcular un ahorro genérico si no hay texto específico
                    const ahorroCalculado = parseFloat(precioMensual) * 12 - parseFloat(precioAnual);
                    if (ahorroCalculado > 0) {
                        ahorroAnualElement.textContent = 'Ahorras ' + formatPrice(ahorroCalculado);
                    } else {
                        ahorroAnualElement.textContent = ''; // Sin ahorro o texto por defecto
                    }
                }


            } else {
                priceElement.textContent = formatPrice(precioMensual);
                periodElement.textContent = '/mes';
                ctaButton.href = checkoutBaseUrl + idProductoMensual;
                ahorroAnualElement.textContent = ''; // Limpiar texto de ahorro
            }
        });
    }

    billingToggle.addEventListener('change', updatePricing);

    // Inicializar precios al cargar la página
    updatePricing();

    // Pequeña mejora para el texto de ahorro general junto al toggle
    const toggleAhorroHint = document.querySelector("label[for='billingToggle'] + span .text-cianElectrico");
    if (toggleAhorroHint && pricingPlansContainer.querySelector('.pricing-plan-column')) {
        // Tomar el primer plan para un ejemplo de ahorro
        const primerPlanPriceElement = pricingPlansContainer.querySelector('.pricing-plan-column .plan-price');
        if (primerPlanPriceElement) {
            const precioMensual = parseFloat(primerPlanPriceElement.dataset.precioMensual);
            const precioAnual = parseFloat(primerPlanPriceElement.dataset.precioAnual);
            if (precioMensual && precioAnual && (precioMensual * 12 > precioAnual) ) {
                const porcentajeAhorro = Math.round(((precioMensual * 12 - precioAnual) / (precioMensual * 12)) * 100);
                if (porcentajeAhorro > 0) {
                     toggleAhorroHint.textContent = `(Ahorra hasta ${porcentajeAhorro}%)`;
                } else {
                    toggleAhorroHint.textContent = '(Planes Anuales Disponibles)';
                }
            } else {
                 toggleAhorroHint.textContent = '(Planes Anuales Disponibles)';
            }
        }
    }

});
