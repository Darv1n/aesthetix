<?php
/**
 * Mailchimp
 *
 * @link https://mailchimp.com/
 * @link https://wordpress.org/plugins/mailchimp-for-wp/
 *
 * @package Aesthetix
 * @since 1.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_mailchimp_aesthetix_subscription_form_type' ) ) {

	/**
	 * Function for 'get_aesthetix_subscription_form_type' filter-hook.
	 * 
	 * @param array $converter Array with subscribation forms in customizer options.
	 *
	 * @return array
	 * 
	 * @since 1.1.3
	 */
	function get_mailchimp_aesthetix_subscription_form_type( $converter ) {

		$converter['mailchimp'] = 'Mailchimp';

		return $converter;
	}
}
add_filter( 'get_aesthetix_subscription_form_type', 'get_mailchimp_aesthetix_subscription_form_type' );

if ( ! function_exists( 'get_mailchimp_aesthetix_options' ) ) {

	/**
	 * Function for 'get_aesthetix_options' filter-hook.
	 * 
	 * @param array $aesthetix_defaults Array with default aesthetix options.
	 *
	 * @return array
	 * 
	 * @since 1.1.3
	 */
	function get_mailchimp_aesthetix_options( $aesthetix_defaults ) {

		$mailchimp_defaults = array(
			'general_subscription_form_type' => 'mailchimp',
		);

		return wp_parse_args( $mailchimp_defaults, $aesthetix_defaults );
	}
}
add_filter( 'get_aesthetix_options', 'get_mailchimp_aesthetix_options' );

if ( ! function_exists( 'wp_enqueue_mailchimp_styles' ) ) {

	/**
	 * Function for 'wp_enqueue_scripts' filter-hook.
	 * 
	 * @since 1.1.3
	 */
	function wp_enqueue_mailchimp_styles() {

		$css = '
			.mc4wp-form > *:not(:last-child) {
				margin-bottom: .75rem;
			}
			.mc4wp-form * {
				margin-bottom: 0;
			}
			.mc4wp-form input:not([type="submit"]) {
				margin-top: .25rem;
				margin-bottom: .5rem !important;
			}
			.mc4wp-alert {
				display: block
				margin-bottom: .5rem
				padding: .5rem 1rem
				max-width: inherit
				border-radius: var( --border-radius )
				background-color: var( --primary-bg-color )
				font-size: .75rem;
				hyphens: none;
			}
			.mc4wp-success {
				background-color: #79D97C;
			}
			 ';

		wp_add_inline_style( 'common-styles', minify_css( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_mailchimp_styles', 11 );
