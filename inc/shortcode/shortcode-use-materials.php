<?php
/**
 * Shortcode for displaying aesthetix use materials.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_use_materials' ) ) {

	/**
	 * Function for [aesthetix-use-materials] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-use-materials text="Use of site materials is permitted only with reference to the source"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_use_materials( $atts, $content ) {

		$defaults = array(
			'text' => '',
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-use-materials', '', $args );
	}
}
add_shortcode( 'aesthetix-use-materials', 'aesthetix_shortcode_use_materials' );
