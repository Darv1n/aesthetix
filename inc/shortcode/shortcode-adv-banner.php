<?php
/**
 * Shortcode for displaying aesthetix adv banner.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_adv_banner' ) ) {

	/**
	 * Function for [aesthetix-adv-banner] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-adv-banner adv_desktop="" adv_tablet="" adv_mobile="" adv_link="" adv_alt="" adv_title="" adv_description=""]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_adv_banner( $atts, $content ) {

		$defaults = array(
			'adv_desktop'     => get_theme_file_uri( '/assets/img/promo/promo-default-002.jpg' ),
			'adv_tablet'      => '',
			'adv_mobile'      => '',
			'adv_link'        => 'https://aesthetix-pro.zolin.digital/',
			'adv_alt'         => __( 'Banner', 'aesthetix' ),
			'adv_title'       => '',
			'adv_description' => '',
		);

		return return_template_part( 'templates/widget/widget-adv-banner', '', shortcode_atts( $defaults, $atts ) );
	}
}
add_shortcode( 'aesthetix-adv-banner', 'aesthetix_shortcode_adv_banner' );
