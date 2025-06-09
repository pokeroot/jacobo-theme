<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Jacobo_AI_Theme
 */

get_header();

// Array de consejos de marketing de Jacobo AI. Cada uno tiene una longitud diferente.
$jacobo_tips = [
    "Tip de Jacobo: Una buena campaña de video puede aumentar la conversión en un 80%.",
    "Dato de IA: El 72% de los especialistas en marketing dicen que el contenido relevante es el factor más importante para el SEO.",
    "Consejo Pro: Utiliza pruebas A/B en tus titulares de correo electrónico para optimizar las tasas de apertura.",
    "Idea de Jacobo: Analiza los datos de tus campañas pasadas para encontrar patrones de éxito y replicarlos.",
    "Recordatorio: La consistencia en la publicación es clave para mantener a tu audiencia comprometida.",
    "Sugerencia de IA: Personaliza tus ofertas basándote en el comportamiento del usuario para aumentar las ventas.",
    "Tip rápido: Asegúrate de que tu sitio web sea rápido y totalmente responsive para móviles."
];

// Seleccionar un consejo al azar en cada carga de la página.
// Esto cambiará el Content-Length del HTML en cada petición.
$random_tip = $jacobo_tips[array_rand($jacobo_tips)];

?>

<main id="primary" class="site-main bg-gray-900 text-white">
    <section class="error-404 not-found flex items-center justify-center min-h-screen text-center px-4 py-16">
        <div class="max-w-2xl w-full">
            
            <!-- Icono/Gráfico -->
            <div class="mb-8">
                <svg class="mx-auto h-24 w-24 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
            </div>

            <!-- Título y Mensaje Principal -->
            <header class="page-header mb-6">
                <h1 class="text-5xl md:text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-300 mb-4">Error 404</h1>
                <p class="text-xl md:text-2xl text-gray-300">Parece que esta página se perdió en el multiverso digital.</p>
            </header>

            <div class="page-content">
                <p class="text-gray-400 mb-8">No te preocupes, no estás solo. Jacobo está aquí para ayudarte a volver al camino correcto.</p>

                <!-- Botones de Acción -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
                       class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                        Volver al Inicio
                    </a>
                    <a href="/dashboard/" <!-- Asumiendo que tu dashboard está en /dashboard/ -->
                       class="w-full sm:w-auto bg-gray-700 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300">
                        Ir a mi Dashboard
                    </a>
                </div>

                <!-- Consejo Dinámico para variar el Content-Length -->
                <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700">
                    <p class="text-sm text-gray-400">
                        <?php echo esc_html($random_tip); ?>
                    </p>
                </div>
            </div><!-- .page-content -->
        </div><!-- .max-w-2xl -->
    </section><!-- .error-404 -->
</main><!-- #main -->

<?php
get_footer();
?>
