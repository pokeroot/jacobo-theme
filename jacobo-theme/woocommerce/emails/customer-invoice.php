<?php
/**
 * Customer invoice email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-invoice.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 9.8.0
 */

use Automattic\WooCommerce\Enums\OrderStatus;
use Automattic\WooCommerce\Utilities\FeaturesUtil;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

ob_start(); // Jacobo: Start output buffering

$email_improvements_enabled = FeaturesUtil::feature_is_enabled( 'email_improvements' );

/**
 * Executes the e-mail header.
 *
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', 'Factura de tu pedido en Jacobo / Detalles del Pedido', $email ); // Jacobo: Changed email heading
?>

<?php echo $email_improvements_enabled ? '<div class="email-introduction">' : ''; ?>
<p>
<?php
if ( ! empty( $order->get_billing_first_name() ) ) {
	/* translators: %s: Customer first name */
	printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) );
} else {
	printf( esc_html__( 'Hi,', 'woocommerce' ) );
}
?>
</p>
<?php if ( $order->needs_payment() ) { ?>
	<p>
	<?php
	// Jacobo: Kept original logic for orders needing payment, but could be customized if needed.
	if ( $order->has_status( OrderStatus::FAILED ) ) {
		printf(
			wp_kses(
			/* translators: %1$s Site title, %2$s Order pay link */
				__( 'Sorry, your order on %1$s was unsuccessful. Your order details are below, with a link to try your payment again: %2$s', 'woocommerce' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			),
			esc_html( get_bloginfo( 'name', 'display' ) ),
			'<a href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . esc_html__( 'Pay for this order', 'woocommerce' ) . '</a>'
		);
	} else {
		printf(
			wp_kses(
			/* translators: %1$s Site title, %2$s Order pay link */
				__( 'An order has been created for you on %1$s. Your order details are below, with a link to make payment when you’re ready: %2$s', 'woocommerce' ),
				array(
					'a' => array(
						'href' => array(),
					),
				)
			),
			esc_html( get_bloginfo( 'name', 'display' ) ),
			'<a href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . esc_html__( 'Pay for this order', 'woocommerce' ) . '</a>'
		);
	}
	?>
	</p>

<?php } else { ?>
	<p>
	<?php
	// Jacobo: Customized invoice text
	/* translators: %s: Order number */
	printf( esc_html__( 'Adjuntamos los detalles de tu factura para el pedido %s. Estamos aquí para cualquier consulta.', 'woocommerce' ), esc_html( $order->get_order_number() ) );
	?>
	</p>
	<?php
}
?>
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

/**
 * Hook for the woocommerce_email_order_details.
 *
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook for the woocommerce_email_order_meta.
 *
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/**
 * Hook for woocommerce_email_customer_details.
 *
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

/**
 * Executes the email footer.
 *
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );

<?php $content = ob_get_clean(); echo jacobo_get_email_template_html( 'Factura de tu pedido en Jacobo / Detalles del Pedido', $content ); // Jacobo: End output buffering and pass to template ?>
