<?php
if ( ! is_user_logged_in() ) {
    // Redirigir a la página de login, y que después del login vuelva a esta página de perfil.
    wp_redirect( esc_url( wp_login_url( get_permalink() ) ) );
    exit;
}
$current_user = wp_get_current_user();

/**
 * Template Name: Perfil y Facturación
 * Template Post Type: page
 */
get_header();
?>

<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-gray-800 mb-10 text-center">Mi Perfil y Facturación</h1>

    <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

        <!-- Sección de Perfil -->
        <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 pb-3 border-b border-gray-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                Información de tu Perfil
            </h2>
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-500">Nombre de Usuario:</label>
                    <p class="text-lg text-gray-800 font-semibold"><?php echo esc_html( $current_user->display_name ); ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Correo Electrónico:</label>
                    <p class="text-lg text-gray-800 font-semibold"><?php echo esc_html( $current_user->user_email ); ?></p>
                </div>
                <?php
                $user_id = $current_user->ID; // $current_user ya debería estar definido por el código al inicio del archivo
                $plan_name = 'Sin plan activo'; // Valor por defecto

                // Comprobar si la función de YITH existe para evitar errores fatales.
                if ( function_exists('yith_wcs_get_user_subscriptions') ) {
                    $subscriptions = yith_wcs_get_user_subscriptions( $user_id, ['subscription_status' => 'active'] );

                    if ( ! empty( $subscriptions ) ) {
                        // Obtener la primera suscripción activa
                        // La función yith_wcs_get_user_subscriptions puede devolver un array de objetos de suscripción YITH
                        $first_active_subscription = reset( $subscriptions );
                        if ( is_object($first_active_subscription) && method_exists($first_active_subscription, 'get_product_name') ) {
                            $plan_name = $first_active_subscription->get_product_name();
                        } elseif (is_object($first_active_subscription) && method_exists($first_active_subscription, 'get_name')) {
                            // Fallback por si get_product_name() no existe pero get_name() sí (depende de la versión/objeto de YITH)
                            $plan_name = $first_active_subscription->get_name();
                        }
                        // Si se necesita iterar y verificar productos dentro de la suscripción (más complejo, como en wcs_)
                        // else if (is_object($first_active_subscription) && method_exists($first_active_subscription, 'get_items')) {
                        //    foreach ($first_active_subscription->get_items() as $item) {
                        //        $_product = $item->get_product();
                        //        if ($_product) {
                        //            $plan_name = $_product->get_name();
                        //            break;
                        //        }
                        //    }
                        // }
                    }
                } elseif ( !isset($current_user) ) {
                    $plan_name = 'Usuario no definido.'; // Caso improbable si el chequeo inicial funciona
                } else {
                    $plan_name = 'YITH Subscriptions no está activo.';
                }
                ?>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Plan Actual:</label>
                    <p class="text-lg text-indigo-600 font-bold"><?php echo esc_html( $plan_name ); ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500">Miembro Desde:</label>
                    <p class="text-lg text-gray-800 font-semibold"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $current_user->user_registered ) ) ); ?></p>
                </div>
                <div class="pt-5">
                    <a href="<?php echo esc_url( get_edit_profile_url( $current_user->ID ) ); ?>"
                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium group transition-colors duration-150">
                        Editar Perfil
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 group-hover:translate-x-1 transition-transform duration-150" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sección de Facturación y Suscripción -->
        <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 pb-3 border-b border-gray-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-3 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zm-7.5 3.5a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5z" clip-rule="evenodd" />
                </svg>
                Suscripción y Pagos
            </h2>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Administra tu plan, revisa tu historial de facturación y actualiza tus métodos de pago de forma segura.
            </p>
            <a href="<?php echo function_exists('wc_get_account_endpoint_url') ? esc_url( wc_get_account_endpoint_url( 'subscriptions' ) ) : '#error-wc-subscriptions-link'; ?>"
               class="w-full bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-bold py-4 px-6 rounded-lg text-lg text-center inline-block transition-all duration-300 ease-in-out shadow-md hover:shadow-lg transform hover:scale-105">
                Gestionar mi Suscripción y Facturación
            </a>
            <p class="text-xs text-gray-500 mt-5 text-center">
                Serás redirigido a nuestro portal seguro de gestión de pagos.
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
