<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
	<div class="md:col-span-1">
		<?php
		/**
		 * My Account navigation.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_navigation' );
		?>
	</div>
	<div class="md:col-span-3 bg-gray-800/50 backdrop-blur-sm p-6 md:p-8 rounded-2xl shadow-lg border border-gray-700">
		<div class="woocommerce-MyAccount-content">
			<?php
				/**
				 * My Account content.
				 *
				 * @since 2.6.0
				 */
				do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>
</div>

<style>
    /* My Account Navigation Styling */
    .woocommerce-MyAccount-navigation ul {
        list-style: none;
        padding-left: 0;
        margin-bottom: 2rem; /* Space below nav */
    }
    .woocommerce-MyAccount-navigation ul li {
        margin-bottom: 0.25rem; /* space-y-1 equivalent */
    }
    .woocommerce-MyAccount-navigation ul li a {
        display: block;
        padding: 0.75rem 1rem; /* py-3 px-4 more padding for better touch targets */
        color: #D1D5DB; /* text-grisClaro */
        text-decoration: none;
        border-radius: 0.375rem; /* rounded-md */
        transition: background-color 0.15s ease-in-out, color 0.15s ease-in-out;
        border: 1px solid transparent; /* Base border */
    }
    .woocommerce-MyAccount-navigation ul li a:hover {
        background-color: rgba(55, 65, 81, 0.5); /* hover:bg-gray-700/50 */
        color: #FFFFFF; /* hover:text-blancoPuro */
    }
    .woocommerce-MyAccount-navigation ul li.is-active > a {
        background-color: #8B5CF6; /* bg-violetaNeon */
        color: #FFFFFF; /* text-blancoPuro */
        font-weight: 600; /* semibold */
        border-color: rgba(139, 92, 246, 0.5); /* Optional: border to match bg */
    }

    /* General WooCommerce Elements Styling */
    .woocommerce-MyAccount-content .button,
    .woocommerce-MyAccount-content input[type="submit"],
    .woocommerce-MyAccount-content button.button {
        background-color: #6366F1; /* bg-indigo-600 */
        color: #FFFFFF;
        font-weight: bold;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem; /* rounded-lg */
        transition: all 0.3s ease-in-out;
        display: inline-block;
        text-decoration: none;
    }
    .woocommerce-MyAccount-content .button:hover,
    .woocommerce-MyAccount-content input[type="submit"]:hover,
    .woocommerce-MyAccount-content button.button:hover {
        background-color: #4F46E5; /* hover:bg-indigo-700 */
        transform: scale(1.05);
    }

    .woocommerce-message {
        background-color: rgba(16, 185, 129, 0.1); /* bg-green-500/20 (approx) */
        color: #6EE7B7; /* text-green-300 (approx) */
        border: 1px solid rgba(16, 185, 129, 0.3); /* border-green-500/30 (approx) */
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem; /* rounded-md */
        font-size: 0.875rem; /* text-sm */
    }
     .woocommerce-info {
        background-color: rgba(59, 130, 246, 0.1); /* bg-blue-500/20 (approx) */
        color: #93C5FD; /* text-blue-300 (approx) */
        border: 1px solid rgba(59, 130, 246, 0.3); /* border-blue-500/30 (approx) */
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem; /* rounded-md */
        font-size: 0.875rem; /* text-sm */
    }
    .woocommerce-error {
        background-color: rgba(239, 68, 68, 0.1); /* bg-red-500/20 (approx) */
        color: #FCA5A5; /* text-red-300 (approx) */
        border: 1px solid rgba(239, 68, 68, 0.3); /* border-red-500/30 (approx) */
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 0.375rem; /* rounded-md */
        font-size: 0.875rem; /* text-sm */
    }
    .woocommerce-error li {
        margin-left: 1.5rem; /* Indent list items in errors */
    }

    .woocommerce-MyAccount-content form .form-row label {
        display: block;
        color: #D1D5DB; /* text-grisClaro */
        margin-bottom: 0.5rem;
        font-weight: 500;
    }
    .woocommerce-MyAccount-content form input[type="text"],
    .woocommerce-MyAccount-content form input[type="email"],
    .woocommerce-MyAccount-content form input[type="password"],
    .woocommerce-MyAccount-content form input[type="tel"],
    .woocommerce-MyAccount-content form input[type="number"],
    .woocommerce-MyAccount-content form select,
    .woocommerce-MyAccount-content form textarea {
        display: block;
        width: 100%;
        background-color: rgba(55, 65, 81, 0.5); /* bg-gray-700/50 */
        border: 1px solid #4B5563; /* border-gray-600 */
        color: #F3F4F6; /* text-gray-100 or blancoPuro */
        border-radius: 0.375rem; /* rounded-md */
        padding: 0.75rem; /* p-3 */
        margin-bottom: 1rem; /* Add some space below inputs */
    }
    .woocommerce-MyAccount-content form input[type="text"]:focus,
    .woocommerce-MyAccount-content form input[type="email"]:focus,
    .woocommerce-MyAccount-content form input[type="password"]:focus,
    .woocommerce-MyAccount-content form input[type="tel"]:focus,
    .woocommerce-MyAccount-content form input[type="number"]:focus,
    .woocommerce-MyAccount-content form select:focus,
    .woocommerce-MyAccount-content form textarea:focus {
        border-color: #06B6D4; /* focus:border-cianElectrico */
        box-shadow: 0 0 0 1px #06B6D4; /* focus:ring-cianElectrico focus:ring-1 */
        outline: none;
    }
    .woocommerce-MyAccount-content form .form-row {
        margin-bottom: 1rem;
    }
    .woocommerce-MyAccount-content form p:has(button[type="submit"]) {
        margin-top: 1.5rem; /* Add space above submit button paragraph */
    }

</style>
