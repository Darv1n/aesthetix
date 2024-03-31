<?php
/**
 * Shortcode for displaying aesthetix logo.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_logo' ) ) {

	/**
	 * Function for [aesthetix-logo] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-logo logo_size="md"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_logo( $atts, $content ) {

		$defaults = array(
			'logo_size' => get_aesthetix_options( 'title_tagline_logo_size' ),
		);

		return return_template_part( 'templates/widget/widget-logo', '', shortcode_atts( $defaults, $atts ) );
	}
}
add_shortcode( 'aesthetix-logo', 'aesthetix_shortcode_logo' );
