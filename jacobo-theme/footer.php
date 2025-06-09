    <?php // La etiqueta <main> debe cerrarse en las plantillas de página individuales, no aquí. ?>
</div> <!-- Cierre de <div id="page" class="min-h-screen flex flex-col"> o similar abierto en header.php -->

<footer class="bg-azulNoche border-t border-gray-700/50 py-12 px-6 md:px-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-8">
            <!-- Columna Logo y Redes (ocupa más en mobile) -->
            <div class="col-span-2 md:col-span-1 lg:col-span-2">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-2xl font-sora font-bold text-blancoPuro mb-4 inline-block">
                    Jacobo
                </a>
                <p class="text-sm text-grisClaro mb-4 pr-4">
                    Transformando el marketing digital con inteligencia artificial.
                </p>
                <div class="flex space-x-4">
                    <a href="#" aria-label="Facebook" class="text-grisClaro hover:text-cianElectrico transition-colors social-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0011.667 0l3.181-3.183m-4.991-2.696V7.557a2.25 2.25 0 00-2.25-2.25H9.345a2.25 2.25 0 00-2.25 2.25v5.106" />
                        </svg>
                    </a>
                    <a href="#" aria-label="Twitter / X" class="text-grisClaro hover:text-cianElectrico transition-colors social-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.03.072v3.091l-3.076-3.091c-.935-.041-1.86-.164-2.713-.362a48.454 48.454 0 01-4.496-2.236c-.914-.533-1.631-1.29-2.077-2.182a48.344 48.344 0 01-2.233-4.496c-.198-.853-.322-1.778-.362-2.713v-2.258c0-.97.616-1.813 1.5-2.097M16.5 9.75h-9" />
                        </svg>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="text-grisClaro hover:text-cianElectrico transition-colors social-icon">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-5.478A.75.75 0 0012.26 10H4.5v8.25h2.25V15h.75l2.25 3.75h3.75zM4.5 18.25V10m6.75 1.5l.75 1.667M12 10h3.75m-3.75 0H8.25m0 0H4.5m3.75 0V6.75A2.25 2.25 0 0110.5 4.5h3A2.25 2.25 0 0115.75 6.75v3.75m0 0v1.5A2.25 2.25 0 0113.5 18.25h-3a2.25 2.25 0 01-2.25-2.25V15m1.5-1.5H9" />
                        </svg>
                    </a>
                </div>
            </div>

            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Producto</h5>
                <ul class="space-y-2">
                    <li><a href="<?php echo esc_url(home_url('/#funcionalidades')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Funcionalidades</a></li>
                    <li><a href="<?php echo esc_url(home_url('/precios')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Precios</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Cómo Empezar</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Casos de Éxito</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Recursos</h5>
                <ul class="space-y-2">
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>" class="text-grisClaro hover:text-blancoPuro text-sm">Blog</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Documentación</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Soporte</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Glosario IA</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-sora text-blancoPuro font-semibold mb-4">Empresa</h5>
                <ul class="space-y-2">
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Sobre Nosotros</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Carreras</a></li>
                    <li><a href="#" class="text-grisClaro hover:text-blancoPuro text-sm">Contacto</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-700/50 pt-8 text-center">
            <p class="text-sm text-grisClaro">&copy; <?php echo date('Y'); ?> Jacobo AI. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
