<?php
/**
 * Shortcode for displaying aesthetix creator.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_creator' ) ) {

	/**
	 * Function for [aesthetix-creator] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-creator creator_link="https://zolin.digital/"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_creator( $atts, $content ) {

		$defaults = array(
			'creator_link' => 'https://zolin.digital/',
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-creator', '', $args );
	}
}
add_shortcode( 'aesthetix-creator', 'aesthetix_shortcode_creator' );
