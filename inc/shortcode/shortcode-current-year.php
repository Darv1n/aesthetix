<?php
/**
 * Shortcode for displaying aesthetix current year.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_current_year' ) ) {

	/**
	 * Function for [aesthetix-current-year] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-current-year start_year="2018"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_current_year( $atts, $content ) {

		$defaults = array(
			'start_year' => '',
		);

		$args      = shortcode_atts( $defaults, $atts );
		$classes[] = 'year';

		// Собираем год.
		$year = gmdate( 'Y' );
		if ( $args['start_year'] && (int) $args['start_year'] !== (int) $year ) {
			$year      = $args['start_year'] . '-' . $year;
			$classes[] = 'year-range';
		}

		return '<span class="' . esc_attr( implode( ' ', $classes ) ) . '">' . esc_html( $year ) . '</span>';
	}
}
add_shortcode( 'aesthetix-current-year', 'aesthetix_shortcode_current_year' );
add_shortcode( 'current-year', 'aesthetix_shortcode_current_year' );
