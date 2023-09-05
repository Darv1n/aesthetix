<?php
/**
 * Customizer functions
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_post_types' ) ) {

	/**
	 * Get customizer post types for constract section and fields.
	 *
	 * @return array
	 */
	function get_aesthetix_customizer_post_types() {

		$post_types = array( 'post', 'project', 'service', 'product', 'event' );

		$post_types = apply_filters( 'get_aesthetix_customizer_post_types', $post_types );

		return $post_types;
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_roots' ) ) {

	/**
	 * Get roots array for enque inline script.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return void
	 */
	function get_aesthetix_customizer_roots( $control = null ) {

		$converter_colors = get_aesthetix_customizer_converter_colors();

		$roots            = array();
		$saturate_array   = array( 50, 100, 200, 300, 400, 500, 600, 700, 800, 900 );

		$roots['primary-font']   = get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_primary_font' ) ) . ', Arial, sans-serif';
		$roots['secondary-font'] = get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_secondary_font' ) ) . ', Arial, sans-serif';

		$primary_color    = get_aesthetix_options( 'root_primary_color' );
		$secondary_color  = get_aesthetix_options( 'root_secondary_color' );
		$gray_color       = get_aesthetix_options( 'root_gray_color' );

		foreach ( $saturate_array as $key => $saturate_value ) {
			$roots = array_merge( $roots, array(
					'primary-color-' . $saturate_value   => get_aesthetix_customizer_converter_colors( $primary_color . '-' . $saturate_value ),
					'secondary-color-' . $saturate_value => get_aesthetix_customizer_converter_colors( $secondary_color . '-' . $saturate_value ),
			) );
		}

		$roots['white-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
		$roots['black-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );

		if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
			$roots['primary-text-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
			$roots['primary-bg-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
			$roots['primary-bd-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
			$roots['secondary-bg-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
			$roots['secondary-bd-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-700' );
			$roots['primary-gray-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-400' );
			$roots['primary-gray-color-hover'] = get_aesthetix_customizer_converter_colors( $gray_color . '-500' );
			$roots['svg-filter']               = 'invert(100%)';
		} else {
			$roots['primary-text-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
			$roots['primary-bg-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
			$roots['primary-bd-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
			$roots['secondary-bg-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
			$roots['secondary-bd-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-300' );
			$roots['primary-gray-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-500' );
			$roots['primary-gray-color-hover'] = get_aesthetix_customizer_converter_colors( $gray_color . '-600' );
			$roots['svg-filter']               = 'invert(0%)';
		}

		if ( get_aesthetix_options( 'root_link_color' ) === 'blue' ) {
			$link_color = 'blue';
		} else {
			$link_color = get_aesthetix_options( 'root_' . get_aesthetix_options( 'root_link_color' ) . '_color' );
		}

		$roots['link-color-dark']      = get_aesthetix_customizer_converter_colors( $link_color . '-600' );
		$roots['link-color']           = get_aesthetix_customizer_converter_colors( $link_color . '-500' );
		$roots['link-color-light']     = get_aesthetix_customizer_converter_colors( $link_color . '-400' );
		$roots['button-padding-top']   = get_first_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_button_size' ) ), ' ' );
		$roots['button-padding-side']  = get_last_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_button_size' ) ), ' ' );
		$roots['button-border-width']  = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_button_border_width' ) );
		$roots['button-border-radius'] = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_button_border_radius' ) );
		$roots['box-shadow']           = get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_box_shadow' ) );
		$roots['box-shadow-hover']     = str_replace( '0.15', '0.25', get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_box_shadow' ) ) );
		$roots['border-width']         = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_border_width' ) );
		$roots['border-radius']        = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_border_radius' ) );

		// Merge child and parent default options.
		$roots = apply_filters( 'get_aesthetix_customizer_roots', $roots );

		// Return controls.
		if ( is_null( $control ) ) {
			return $roots;
		} elseif ( ! isset( $roots[ $control ] ) || empty( $roots[ $control ] ) ) {
			return false;
		} else {
			return $roots[ $control ];
		}
	}
}