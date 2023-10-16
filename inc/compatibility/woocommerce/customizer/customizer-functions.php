<?php
/**
 * Customizer functions.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_woo_customizer_post_types' ) ) {
	function get_aesthetix_woo_customizer_post_types( $post_types ) {

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			unset( $post_types[ array_search( 'product', $post_types ) ] );
		}

		return $post_types;
	}
}
add_filter( 'get_aesthetix_customizer_post_types', 'get_aesthetix_woo_customizer_post_types' );