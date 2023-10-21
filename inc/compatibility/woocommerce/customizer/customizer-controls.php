<?php
/**
 * Customizer controls.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_controls_woo_callback' ) ) {
	function get_aesthetix_customizer_controls_woo_callback( $aesthetix_controls ) {

		// Woo options.
		$aesthetix_controls['single_product'] = array(
			'tab_title'     => array( 'tab_title', __( 'Which pages display sidebar', 'aesthetix' ), '' ),
			'border_radius' => array( 'select_control', __( 'Select element border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),
		);

		// Woo options.
		$aesthetix_controls['woocommerce_product_catalog'] = array(
			'structure_title' => array( 'tab_title', __( 'Post structure', 'aesthetix' ), '' ),
			'structure'       => array( 'sortable_control', '', '', get_woocommerce_customizer_product_catalog_structure( null, 'product' ) ),
			'shop_title'      => array( 'tab_title', __( 'Shop display options', 'aesthetix' ), '' ),
		);

		return $aesthetix_controls;
	}
}
add_filter( 'get_aesthetix_customizer_controls', 'get_aesthetix_customizer_controls_woo_callback' );