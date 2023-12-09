<?php
/**
 * Shortcode for displaying aesthetix copyright.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_copyright' ) ) {

	/**
	 * Function for [aesthetix-copyright] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-copyright start_year="2020"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_copyright( $atts, $content ) {

		$defaults = array(
			'start_year' => '',
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-copyright', '', $args );
	}
}
add_shortcode( 'aesthetix-copyright', 'aesthetix_shortcode_copyright' );
