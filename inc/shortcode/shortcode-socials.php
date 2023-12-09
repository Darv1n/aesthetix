<?php
/**
 * Shortcode for displaying aesthetix socials.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_socials' ) ) {

	/**
	 * Function for [aesthetix-socials] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-socials structure="instagram=https://instagram.com/art_zolin&telegram=https://telegram.me/artzolin" button_size="md" button_color="primary" button_type="common" button_content="button-icon-text" button_border_width="md" button_border_radius="md" icon_size="md" style="inline"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_socials( $atts, $content ) {

		$defaults = array(
			'button_size'          => get_aesthetix_options( 'root_button_size' ),
			'button_color'         => 'primary',
			'button_type'          => get_aesthetix_options( 'root_button_type' ),
			'button_content'       => 'button-icon',
			'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
			'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
			'icon_size'            => get_aesthetix_options( 'root_button_size' ),
			'structure'            => '',
			'style'                => 'inline', // inline, block.
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-socials', '', $args );
	}
}
add_shortcode( 'aesthetix-socials', 'aesthetix_shortcode_socials' );
