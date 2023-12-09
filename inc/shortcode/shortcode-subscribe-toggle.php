<?php
/**
 * Shortcode for displaying aesthetix subscribe toggle.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_subscribe_toggle' ) ) {

	/**
	 * Function for [aesthetix-subscribe-toggle] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-subscribe-toggle button_size="md" button_color="primary" button_type="common" button_content="button-icon-text" button_border_width="md" button_border_radius="md"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_subscribe_toggle( $atts, $content ) {

		$defaults = array(
			'button_size'          => get_aesthetix_options( 'root_button_size' ),
			'button_color'         => get_aesthetix_options( 'root_subscribe_popup_form_button_color' ),
			'button_type'          => get_aesthetix_options( 'root_subscribe_popup_form_button_type' ),
			'button_content'       => get_aesthetix_options( 'root_subscribe_popup_form_button_content' ),
			'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
			'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-subscribe-toggle', '', $args );
	}
}
add_shortcode( 'aesthetix-subscribe-toggle', 'aesthetix_shortcode_subscribe_toggle' );
