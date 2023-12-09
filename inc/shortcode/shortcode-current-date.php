<?php
/**
 * Shortcode for displaying aesthetix current date.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_shortcode_current_date' ) ) {

	/**
	 * Function for [aesthetix-current-date] shortcode.
	 * 
	 * @param array  $atts    Array of attributes specified in the shortcode.
	 * @param string $content Shortcode text when using a content shortcode.
	 * 
	 * @example [aesthetix-current-date start_date="01-01-2018"]
	 * 
	 * @return void
	 */
	function aesthetix_shortcode_current_date( $atts, $content ) {

		$defaults = array(
			'start_date' => '',
		);

		$args      = shortcode_atts( $defaults, $atts );
		$classes[] = 'date';

		// Собираем год.
		$date = gmdate( 'j F Y' );
		if ( $args['start_date'] && (int) $args['start_date'] !== (int) $date ) {
			if ( date( 'Y', strtotime( $args['start_date'] ) ) === gmdate( 'Y' ) ) {
				if ( date( 'm', strtotime( $args['start_date'] ) ) === gmdate( 'm' ) ) {
					$date = mysql2date( 'j', $args['start_date'] ) . '-' . mysql2date( 'j F Y', $date );
				} else {
					$date = mysql2date( 'j F', $args['start_date'] ) . ' — ' . mysql2date( 'j F Y', $date );
				}
			} else {
				$date = mysql2date( 'j F Y', $args['start_date'] ) . ' — ' . mysql2date( 'j F Y', $date );
			}
			$classes[] = 'date-range';
		} else {
			$date = mysql2date( 'j F Y', $date );
		}

		return '<span class="' . esc_attr( implode( ' ', $classes ) ) . '">' . esc_html( $date ) . '</span>';
	}
}
add_shortcode( 'aesthetix-current-date', 'aesthetix_shortcode_current_date' );
add_shortcode( 'current-date', 'aesthetix_shortcode_current_date' );
