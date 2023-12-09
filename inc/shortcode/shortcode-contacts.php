<?php
/**
 * Shortcode for displaying aesthetix contacts.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_contacts' ) ) {

	/**
	 * Function for [aesthetix-contacts] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-contacts address="" phone="" email="" whatsapp="" telegram="" style=""]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_contacts( $atts, $content ) {

		$defaults = array(
			'address'  => get_aesthetix_options( 'other_address' ),
			'phone'    => get_aesthetix_options( 'other_phone' ),
			'email'    => get_aesthetix_options( 'other_email' ),
			'whatsapp' => get_aesthetix_options( 'other_whatsapp' ),
			'telegram' => get_aesthetix_options( 'other_telegram_chat' ),
			'style'    => 'block', // inline, block.
		);

		$args = shortcode_atts( $defaults, $atts );

		return return_template_part( 'templates/widget/widget-contacts', '', $args );
	}
}
add_shortcode( 'aesthetix-contacts', 'aesthetix_shortcode_contacts' );
