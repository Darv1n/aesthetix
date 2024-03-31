<?php
/**
 * Customizer functions.
 *
 * @package Aesthetix
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

		$args = array(
			'public'   => true,
			'_builtin' => false
		);

		$post_types   = get_post_types( $args, 'names', 'and' );
		$post_types[] = 'post';

		$post_types   = apply_filters( 'get_aesthetix_customizer_post_types', $post_types );

		return $post_types;
	}
}

if ( ! function_exists( 'get_aesthetix_customizer_roots' ) ) {

	/**
	 * Get roots array for enque inline script.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return void
	 */
	function get_aesthetix_customizer_roots( $control = null ) {

		$converter_colors = get_aesthetix_customizer_converter_colors();

		$roots                   = array();
		$saturate_array          = array( 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950 );
		$reversed_saturate_array = array_reverse( $saturate_array );

		$roots['primary-font']   = get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_primary_font' ) ) . ', Arial, sans-serif';
		$roots['secondary-font'] = get_aesthetix_customizer_fonts( get_aesthetix_options( 'root_secondary_font' ) ) . ', Arial, sans-serif';

		$primary_color   = get_aesthetix_options( 'root_primary_color' );
		$secondary_color = get_aesthetix_options( 'root_secondary_color' );
		$gray_color      = get_aesthetix_options( 'root_gray_color' );

		foreach ( $saturate_array as $key => $saturate_value ) {

			if ( in_array( get_aesthetix_options( 'root_color_scheme' ), array( 'dark', 'black' ), true ) ) {
				$roots = array_merge( $roots, array(
					'primary-color-' . $saturate_value   => get_aesthetix_customizer_converter_colors( $primary_color . '-' . $reversed_saturate_array[ $key ] ),
					'secondary-color-' . $saturate_value => get_aesthetix_customizer_converter_colors( $secondary_color . '-' . $reversed_saturate_array[ $key ] ),
					'gray-color-' . $saturate_value      => get_aesthetix_customizer_converter_colors( $gray_color . '-' . $reversed_saturate_array[ $key ] ),
				) );
			} else {
				$roots = array_merge( $roots, array(
					'primary-color-' . $saturate_value   => get_aesthetix_customizer_converter_colors( $primary_color . '-' . $saturate_value ),
					'secondary-color-' . $saturate_value => get_aesthetix_customizer_converter_colors( $secondary_color . '-' . $saturate_value ),
					'gray-color-' . $saturate_value      => get_aesthetix_customizer_converter_colors( $gray_color . '-' . $saturate_value ),
				) );
			}
		}

		if ( in_array( get_aesthetix_options( 'root_color_scheme' ), array( 'dark', 'black' ), true ) ) {
			$roots['text-color']  = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
		} else {
			$roots['text-color']  = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
		}

		$roots['white-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
		$roots['black-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );

		if ( get_aesthetix_options( 'root_link_color' ) === 'blue' ) {
			$link_color = 'blue';
		} else {
			$link_color = get_aesthetix_options( 'root_' . get_aesthetix_options( 'root_link_color' ) . '_color' );
		}

		$roots['link-color-dark']  = get_aesthetix_customizer_converter_colors( $link_color . '-600' );
		$roots['link-color']       = get_aesthetix_customizer_converter_colors( $link_color . '-500' );
		$roots['link-color-light'] = get_aesthetix_customizer_converter_colors( $link_color . '-400' );

		$roots['font-size-xs']     = '.75rem';
		$roots['font-size-sm']     = '.875rem';
		$roots['font-size-md']     = '1rem';
		$roots['font-size-lg']     = '1.25rem';
		$roots['font-size-xl']     = '1.5rem';

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			switch ( get_aesthetix_options( 'archive_' . $post_type . '_background' ) ) {
				case has_action( 'aesthetix_archive_root_' . $post_type . '_background_loop' ):
					do_action( 'aesthetix_archive_root_' . $post_type . '_background_loop', get_post() );
					break;
				case 'theme':
					if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
					} else {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
					}
					break;
				case 'white':
					$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
					$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
					break;
				case 'black':
					$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
					$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
					break;
				case 'gray':
					if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
					} else {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
					}
					break;
				case 'primary':
					if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $primary_color . '-950' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $primary_color . '-900' );
					} else {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $primary_color . '-50' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $primary_color . '-100' );
					}
					break;
				case 'secondary':
					if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $secondary_color . '-950' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $secondary_color . '-900' );
					} else {
						$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $secondary_color . '-50' );
						$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $secondary_color . '-100' );
					}
					break;
				default:
					$roots[ $post_type . '-background' ]   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
					$roots[ $post_type . '-border-color' ] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
					break;
			}

			$roots[ $post_type . '-border-width' ]           = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'archive_' . $post_type . '_border_width' ) );
			$roots[ $post_type . '-border-radius' ]          = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'archive_' . $post_type . '_border_radius' ) );
			$roots[ $post_type . '-margin' ]                 = '.5rem';
			$roots[ $post_type . '-thumbnail-aspect-ratio' ] = get_aesthetix_customizer_aspect_ratio( get_aesthetix_options( 'archive_' . $post_type . '_thumbnail_aspect_ratio' ) );
			$roots[ $post_type . '-thumbnail-padding' ]      = get_aesthetix_customizer_converter_sizes( get_aesthetix_options( 'archive_' . $post_type . '_thumbnail_padding' ) );
			$roots[ $post_type . '-content-padding' ]        = get_aesthetix_customizer_converter_sizes( get_aesthetix_options( 'archive_' . $post_type . '_content_padding' ) );
			$roots[ $post_type . '-shadow' ]                 = get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'archive_' . $post_type . '_shadow' ) );
			$roots[ $post_type . '-shadow-hover' ]           = str_replace( '0.15', '0.25', get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'archive_' . $post_type . '_shadow' ) ) );
		}

		$roots['button-padding-top']     = get_first_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_button_size' ) ), ' ' );
		$roots['button-padding-side']    = get_last_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_button_size' ) ), ' ' );
		$roots['button-border-width']    = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_button_border_width' ) );
		$roots['button-border-radius']   = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_button_border_radius' ) );

		$roots['input-padding-top']      = get_first_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_input_size' ) ), ' ' );
		$roots['input-padding-side']     = get_last_value_from_string( get_aesthetix_customizer_converter_button_sizes( get_aesthetix_options( 'root_input_size' ) ), ' ' );
		$roots['input-border-width']     = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_input_border_width' ) );
		$roots['input-border-radius']    = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_input_border_radius' ) );

		$roots['box-shadow']             = get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_box_shadow' ) );
		$roots['box-shadow-hover']       = str_replace( '0.15', '0.25', get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_box_shadow' ) ) );
		$roots['border-width']           = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_border_width' ) );
		$roots['border-radius']          = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_border_radius' ) );

		foreach ( $roots as $key => $value ) {
			if ( $value === false || $value === null ) {
				vardump( $key . ': ' . $value  );
			}
		}

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

if ( ! function_exists( 'has_aesthetix_customizer_social' ) ) {

	/**
	 * Return true/false if has social links.
	 *
	 * @return bool
	 */
	function has_aesthetix_customizer_social() {

		foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
			if ( wp_http_validate_url( get_aesthetix_options( 'other_' . $key ) ) ) {
				return true;
			}
		}

		return false;
	}
}
