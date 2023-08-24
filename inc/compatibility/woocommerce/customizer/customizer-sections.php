<?php
/**
 * Customizer sections
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Usage: filter customizer sections.
if ( ! function_exists( 'get_aesthetix_customizer_sections_woo_callback' ) ) {
	function get_aesthetix_customizer_sections_woo_callback( $sections ) {

		$sections['woo-general'] = array(
			'title'    => __( 'General', 'aesthetix' ),
			'type'     => 'section',
			'priority' => 2,
			'panel'    => 'woocommerce',
		);

		return $sections;
	}
}
add_filter( 'get_aesthetix_customizer_sections', 'get_aesthetix_customizer_sections_woo_callback' );