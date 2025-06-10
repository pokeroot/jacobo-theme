<?php
/**
 * Customer processing order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-processing-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 9.9.0
 */

use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start(); // Jacobo: Start output buffering

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', '¡Bienvenido a la Revolución del Marketing con IA!', $email ); // Jacobo: Replaced email heading
?>

<?php echo $email_improvements_enabled ? '<div class="email-introduction">' : ''; ?>
<p>
<?php
// Jacobo: Customized welcome message
if ( ! empty( $order->get_billing_first_name() ) ) {
	printf(
		// translators: %1$s: Customer first name.
		esc_html__( 'Hola %1$s, ¡estamos increíblemente felices de tenerte a bordo! Tu nueva suscripción está activa. Ya puedes iniciar sesión en tu dashboard y empezar a crear campañas inteligentes. Si tienes alguna pregunta, nuestro equipo está aquí para ayudarte. ¡Vamos a crear algo legendario!', 'woocommerce' ),
		esc_html( $order->get_billing_first_name() )
	);
} else {
	esc_html_e( 'Hola, ¡estamos increíblemente felices de tenerte a bordo! Tu nueva suscripción está activa. Ya puedes iniciar sesión en tu dashboard y empezar a crear campañas inteligentes. Si tienes alguna pregunta, nuestro equipo está aquí para ayudarte. ¡Vamos a crear algo legendario!', 'woocommerce' );
}
?>
</p>
<?php echo $email_improvements_enabled ? '</div>' : ''; ?>

<style type="text/css">
	table, th, td {
		border-color: #334155 !important; /* Jacobo: Ensure borders are visible on dark background */
		color: #E0E0E0 !important; /* Jacobo: Ensure text is legible on dark background */
	}
	th {
		background-color: #1E293B !important; /* Jacobo: Darker background for headers for contrast */
	}
	td a, p a {
		color: #7DD3FC !important; /* Jacobo: Light blue for links, matching common dark theme palettes */
	}
</style>

<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo $email_improvements_enabled ? '<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td class="email-additional-content">' : '';
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
	echo $email_improvements_enabled ? '</td></tr></table>' : '';
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

<?php $content = ob_get_clean(); echo jacobo_get_email_template_html( '¡Bienvenido a Jacobo!', $content ); // Jacobo: End output buffering and pass to template ?>
