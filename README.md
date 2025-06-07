# Jacobo Theme - Funcionalidades Avanzadas UI (v2.0)

## Visión General
Esta documentación describe las mejoras implementadas en la interfaz de usuario (UI) del tema "Jacobo" como parte de la evolución v2.0. El objetivo principal ha sido transformar la UI para que sea más interactiva, inteligente y capaz de manejar las nuevas funcionalidades "Pro" de la plataforma, haciendo que el usuario sienta que interactúa con un asistente de marketing inteligente.

## Funcionalidades Clave

### 1. Planificador de Campañas
La funcionalidad de generación de contenido ha sido rediseñada y renombrada a "Planificador de Campañas", accesible a través de la plantilla `template-campaign-generator.php`.

*   **Selector de "Tipo de Campaña" (Blueprint):**
    *   El usuario ahora debe seleccionar un "Tipo de Campaña" de una lista desplegable antes de definir los detalles.
    *   Opciones iniciales: "Post Individual", "Lanzamiento de Producto", "Oferta Flash".
*   **Campos Dinámicos:**
    *   La interfaz se adapta según el blueprint seleccionado.
    *   Para "Lanzamiento de Producto", se muestra un **buscador de productos**. Este campo está diseñado para interactuar mediante AJAX con el endpoint `GET /jacobo/v1/productos` del plugin, mostrando resultados del catálogo en tiempo real (actualmente simulado en el frontend).
*   **Visualización de Resultados de Campaña:**
    *   El área de resultados está diseñada para mostrar múltiples piezas de contenido (ej. los diferentes posts de una campaña de lanzamiento) en un formato claro, como tarjetas.
*   **Payload Enriquecido para Generación:**
    *   Al enviar la campaña para generación (endpoint `POST /jacobo/v1/generar-contenido`), el payload JSON ahora incluye `campaignType` y, cuando es aplicable (ej. para "Lanzamiento de Producto"), `productId`.

### 2. Módulo "Sugerencias de Jacobo" en el Dashboard
Se ha introducido un nuevo módulo en el dashboard principal (`template-dashboard.php`) para ofrecer ideas proactivas al usuario.

*   **Obtención de Ideas:**
    *   Al cargar la página del dashboard, esta sección realiza una llamada AJAX (actualmente simulada en el frontend) al endpoint `GET /jacobo/v1/sugerencias` del plugin.
*   **Formato de Tarjetas de Sugerencia:**
    *   Las ideas recibidas se muestran en un formato de "tarjetas de sugerencia".
    *   Cada tarjeta contiene: el título de la idea, una descripción breve y un botón "Crear esta Campaña".
*   **Funcionalidad del Botón "Crear esta Campaña":**
    *   Al hacer clic en este botón, el usuario es redirigido al Planificador de Campañas.
    *   El tipo de campaña (blueprint) y la información relevante de la idea (como `productId` si la sugerencia es sobre un producto) se precargan en el planificador a través de parámetros en la URL.

## Puntos Técnicos Relevantes (Frontend)

*   **Interactividad con JavaScript:**
    *   Se utiliza JavaScript moderno (ES6+) para la lógica de la interfaz, incluyendo la manipulación dinámica del DOM y la simulación de llamadas AJAX a los endpoints del plugin Jacobo.
    *   Scripts principales: `js/campaign-generator.js` (para el Planificador de Campañas) y `js/dashboard-suggestions.js` (para las Sugerencias de Jacobo).
*   **Integración con WordPress:**
    *   Modificación de plantillas de página de WordPress: `template-campaign-generator.php` y `template-dashboard.php`.
    *   Los scripts se encolan y se les pasan datos (como URLs necesarias y nonces para AJAX) de forma segura a través del archivo `functions.php`, utilizando `wp_enqueue_script` y `wp_localize_script`.
*   **Estilos con Tailwind CSS:**
    *   Todos los nuevos componentes de la interfaz y las modificaciones se han estilizado utilizando Tailwind CSS para asegurar un diseño profesional, moderno, responsivo y consistente.

## Próximos Pasos / Consideraciones

*   **Implementación de AJAX Real:** La lógica actual del frontend simula las llamadas AJAX. El siguiente paso crítico es conectar estas llamadas a los endpoints reales del plugin Jacobo (`GET /jacobo/v1/productos`, `GET /jacobo/v1/sugerencias`, `POST /jacobo/v1/generar-contenido`) una vez que estén disponibles y completamente funcionales.
*   **Manejo de Errores y Carga:** Aunque se han implementado estados de carga visuales, se debe robustecer el manejo de errores para las llamadas AJAX (ej. problemas de red, errores del servidor).
*   **Seguridad:** Para las interacciones AJAX con WordPress, es fundamental implementar y verificar nonces para proteger contra ataques CSRF.
*   **Precarga de Datos en Planificador:** El script `js/campaign-generator.js` deberá ser extendido para leer los parámetros de la URL (`campaignType`, `productId`, `productName`) y precargar el formulario correspondientemente cuando se navega desde una sugerencia del dashboard.
