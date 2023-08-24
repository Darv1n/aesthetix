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
		$aesthetix_controls['woo-general'] = array(
			'tab_title' => array( 'tab_title', __( 'Which pages display sidebar', 'aesthetix' ), '' ),
		);

		return $aesthetix_controls;
	}
}
add_filter( 'get_aesthetix_customizer_controls', 'get_aesthetix_customizer_controls_woo_callback' );