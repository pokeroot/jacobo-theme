document.addEventListener('DOMContentLoaded', function () {
    // --- Interactividad del Header ---
    const siteHeader = document.getElementById('siteHeader');
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    // Cambio de estilo del header en scroll
    if (siteHeader) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                siteHeader.classList.add('bg-azulNoche/90', 'backdrop-blur-md', 'shadow-lg');
                siteHeader.classList.remove('py-4');
                siteHeader.classList.add('py-3');
            } else {
                siteHeader.classList.remove('bg-azulNoche/90', 'backdrop-blur-md', 'shadow-lg');
                siteHeader.classList.remove('py-3');
                siteHeader.classList.add('py-4');
            }
        };
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Ejecutar al cargar por si la página ya está scrolleada
    }

    // Toggle del menú móvil
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function () {
            const isExpanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            // Opcional: Cambiar icono del toggle (hamburguesa a X)
            this.innerHTML = !isExpanded ?
                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>' :
                '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>';
        });
    }

    // --- Efecto hover en iconos de redes sociales (ejemplo de cómo podría hacerse con JS si se quiere el gradiente animado) ---
    // Esto es opcional y puede ser complejo. El CSS hover actual ya cambia el color.
    // Para un gradiente en el stroke o fill del SVG al hacer hover, se necesitarían SVGs más complejos o técnicas avanzadas.
    // Por ahora, nos quedaremos con el cambio de color simple definido en el CSS del footer.
    // const socialIcons = document.querySelectorAll('.social-icon svg');
    // socialIcons.forEach(icon => {
    //     icon.addEventListener('mouseenter', () => {
    //         // Lógica para aplicar gradiente...
    //     });
    //     icon.addEventListener('mouseleave', () => {
    //         // Lógica para remover gradiente...
    //     });
    // });

    console.log('Global scripts cargados y header interactivo configurado.');
});
