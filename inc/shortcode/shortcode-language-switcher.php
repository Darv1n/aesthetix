<?php
/**
 * Shortcode for displaying aesthetix language switcher.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_language_switcher' ) ) {

	/**
	 * Function for [aesthetix-language-switcher] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-language-switcher button_size="md" button_color="primary" button_type="common" button_content="button-icon-text" button_border_width="md" button_border_radius="md" button_title="slug" style="inline"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_language_switcher( $atts, $content ) {

		$defaults = array(
			'button_size'          => get_aesthetix_options( 'root_button_size' ),
			'button_color'         => 'primary',
			'button_type'          => get_aesthetix_options( 'root_button_type' ),
			'button_content'       => 'button-icon-text',
			'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
			'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
			'button_title'         => 'slug', // name, slug.
			'style'                => 'inline', // dropdown, inline, block.
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-language-switcher', '', $args );
	}
}
add_shortcode( 'aesthetix-language-switcher', 'aesthetix_shortcode_language_switcher' );
