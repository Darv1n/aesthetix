<?php
/**
 * Customizer default options.
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Replace default settings in customizer.
if ( ! function_exists( 'aesthetix_woocommerce_options_callback' ) ) {
	function aesthetix_woocommerce_options_callback( $aesthetix_defaults ) {

		$woocommerce_defaults = array(
			'woocommerce_product_catalog_structure' => 'title,rating,price,add_cart',
		);

		return wp_parse_args( $woocommerce_defaults, $aesthetix_defaults );
	}
}
add_filter( 'get_aesthetix_options', 'aesthetix_woocommerce_options_callback' );
