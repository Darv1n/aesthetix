<?php
/**
 * Customizer controls array
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Usage: filter customizer controls.
if ( ! function_exists( 'get_aesthetix_customizer_controls_woo_callback' ) ) {
	function get_aesthetix_customizer_controls_woo_callback( $aesthetix_controls ) {

		// Woo options.
		$aesthetix_controls['woocommerce_product_catalog'] = array(
			'tab_title' => array( 'tab_title', __( 'Which pages display sidebar', 'aesthetix' ), '' ),
			'border_radius'        => array( 'select_control', __( 'Select element border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),
		);

		return $aesthetix_controls;
	}
}
add_filter( 'get_aesthetix_customizer_controls', 'get_aesthetix_customizer_controls_woo_callback' );