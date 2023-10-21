<?php
/**
 * Customizer sections.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_customizer_section_control_callback' ) ) {
	function aesthetix_customizer_section_control_callback( $section, $id ) {

		if ( str_contains( $section, 'woocommerce' ) ) {
			$section = str_replace( 'aesthetix_', '', $section );
		}

		return $section;
	}
}
add_filter( 'aesthetix_customizer_section_control', 'aesthetix_customizer_section_control_callback', 10, 2 );

if ( ! function_exists( 'get_aesthetix_customizer_sections_woo_callback' ) ) {
	function get_aesthetix_customizer_sections_woo_callback( $sections ) {

		$sections['single_product'] = array(
			'title'    => __( 'Single product', 'aesthetix' ),
			'type'     => 'section',
			'priority' => 10,
			'panel'    => 'woocommerce',
		);

		return $sections;
	}
}
add_filter( 'get_aesthetix_customizer_sections', 'get_aesthetix_customizer_sections_woo_callback' );


