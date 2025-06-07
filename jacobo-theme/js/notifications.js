/**
 * Jacobo Theme Notifications
 *
 * Sistema de notificaciones toast nativo.
 */
document.addEventListener('DOMContentLoaded', function () {

    // Contenedor global para los toasts (se creará si no existe)
    let toastContainer = document.getElementById('jacobo-toast-container');

    // Helper function to escape HTML (if not already globally available)
    function escapeHTML(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
    }

    function ensureToastContainer() {
        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.id = 'jacobo-toast-container';
            // Los estilos CSS se aplicarán para posicionarlo (ej. esquina superior derecha)
            // y manejar el layout de los toasts individuales.
            document.body.appendChild(toastContainer);
        }
    }

    /**
     * Muestra una notificación toast.
     *
     * @param {string} message El mensaje a mostrar.
     * @param {string} type Tipo de notificación: 'success', 'error', 'warning', 'info'. Por defecto 'info'.
     * @param {number} duration Duración en ms antes de que el toast se oculte automáticamente.
     *                        Si es 0 o negativo, no se oculta automáticamente (requiere cierre manual).
     */
    window.jacoboShowToast = function(message, type = 'info', duration = 7000) {
        ensureToastContainer();

        const toastId = 'toast-' + Date.now() + Math.floor(Math.random() * 1000);
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `jacobo-toast jacobo-toast-${type}`; // Clases para estilado general y específico por tipo

        let iconSVG = '';
        switch (type) {
            case 'success':
                iconSVG = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;
                break;
            case 'error':
                iconSVG = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>`;
                break;
            case 'warning':
                iconSVG = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>`;
                break;
            case 'info':
            default: // 'info' es el tipo por defecto
                iconSVG = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>`;
                break;
        }

        toast.innerHTML = `
            <div class="toast-icon-container">${iconSVG}</div>
            <div class="toast-content">
                <p class="toast-message">${escapeHTML(message)}</p>
            </div>
            <button class="toast-close-btn" aria-label="Cerrar notificación">&times;</button>
        `;

        toastContainer.appendChild(toast);

        // Animación de entrada (se definirá en CSS)
        setTimeout(() => {
            toast.classList.add('jacobo-toast-visible');
        }, 10); // Pequeño delay para asegurar que la transición CSS se aplique

        // Funcionalidad del botón de cierre
        const closeButton = toast.querySelector('.toast-close-btn');
        closeButton.addEventListener('click', () => {
            hideToast(toast);
        });

        // Auto-ocultar si la duración es positiva
        if (duration > 0) {
            setTimeout(() => {
                hideToast(toast);
            }, duration);
        }
    };

    /**
     * Oculta y elimina un toast específico.
     * @param {HTMLElement} toastElement El elemento del toast a ocultar.
     */
    function hideToast(toastElement) {
        if (toastElement) {
            toastElement.classList.remove('jacobo-toast-visible');
            // Esperar a que termine la animación de salida antes de eliminar del DOM
            toastElement.addEventListener('transitionend', () => {
                if (toastElement.parentElement) {
                    toastElement.parentElement.removeChild(toastElement);
                }
            }, { once: true }); // Asegurar que el listener se ejecute solo una vez
        }
    }

    console.log('Sistema de Notificaciones Jacobo Cargado.');

    // Ejemplo de uso (puedes descomentar para probar rápidamente después de añadir CSS):
    // jacoboShowToast('Esto es un mensaje de prueba de éxito.', 'success');
    // jacoboShowToast('Esto es un error, cuidado!', 'error', 0); // No se auto-oculta
    // jacoboShowToast('Advertencia importante.', 'warning', 5000);
    // jacoboShowToast('Solo para tu información.', 'info', 3000);
});
