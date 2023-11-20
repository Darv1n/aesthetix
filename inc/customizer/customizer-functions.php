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

		$post_types = array( 'post', 'project', 'service', 'product', 'event' );

		$post_types = apply_filters( 'get_aesthetix_customizer_post_types', $post_types );

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

		if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
			// $roots['primary-text-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
			$roots['primary-bg-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
			$roots['primary-bd-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
			$roots['secondary-bg-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
			$roots['secondary-bd-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-700' );
			$roots['primary-gray-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-300' );
			$roots['primary-gray-color-hover'] = get_aesthetix_customizer_converter_colors( $gray_color . '-400' );
		} else {
			// $roots['primary-text-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
			$roots['primary-bg-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
			$roots['primary-bd-color']         = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
			$roots['secondary-bg-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
			$roots['secondary-bd-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-300' );
			$roots['primary-gray-color']       = get_aesthetix_customizer_converter_colors( $gray_color . '-500' );
			$roots['primary-gray-color-hover'] = get_aesthetix_customizer_converter_colors( $gray_color . '-600' );
		}

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

		switch ( get_aesthetix_options( 'root_post_background' ) ) {
			case has_action( 'aesthetix_archive_root_post_background_loop_' . get_aesthetix_options( 'root_post_background' ) ):
				do_action( 'aesthetix_archive_root_post_background_loop_' . get_aesthetix_options( 'root_post_background' ), $post );
				break;
			case 'theme':
				if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
				} else {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
				}
				break;
			case 'white':
				$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
				$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
				break;
			case 'black':
				$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-950' );
				$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
				break;
			case 'gray':
				if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-900' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-800' );
				} else {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-200' );
				}
				break;
			case 'primary':
				if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $primary_color . '-950' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $primary_color . '-900' );
				} else {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $primary_color . '-50' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $primary_color . '-100' );
				}
				break;
			case 'secondary':
				if ( get_aesthetix_options( 'root_color_scheme' ) === 'black' ) {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $secondary_color . '-950' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $secondary_color . '-900' );
				} else {
					$roots['post-background']   = get_aesthetix_customizer_converter_colors( $secondary_color . '-50' );
					$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $secondary_color . '-100' );
				}
				break;
			default:
				$roots['post-background']   = get_aesthetix_customizer_converter_colors( $gray_color . '-50' );
				$roots['post-border-color'] = get_aesthetix_customizer_converter_colors( $gray_color . '-100' );
				break;
		}

		$roots['post-border-width']      = get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_post_border_width' ) );
		$roots['post-border-radius']     = get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_post_border_radius' ) );
		$roots['post-margin']            = '.5rem';
		$roots['post-thumbnail-padding'] = get_aesthetix_customizer_converter_sizes( get_aesthetix_options( 'root_post_thumbnail_padding' ) );
		$roots['post-content-padding']   = get_aesthetix_customizer_converter_sizes( get_aesthetix_options( 'root_post_content_padding' ) );
		$roots['post-shadow']            = get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_post_shadow' ) );
		$roots['post-shadow-hover']      = str_replace( '0.15', '0.25', get_aesthetix_customizer_converter_shadows( get_aesthetix_options( 'root_post_shadow' ) ) );

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

function prefix_filter_theme_json_theme( $theme_json ) {

	$new_data = array(
		'version'  => 2,
		'settings' => array(
			'border' => array(
					'style'  => 'solid',
					'width'  => get_aesthetix_customizer_converter_borders( get_aesthetix_options( 'root_border_width' ) ),
					'radius' => get_aesthetix_customizer_converter_radiuses( get_aesthetix_options( 'root_border_radius' ) ),
				),
			'color' => array(
				'palette' => array(
					array(
						'slug'  => 'base',
						'color' => 'white',
						'name'  => __( 'Base', 'text-domain' ),
					),
				),
			),
		),
	);

	$theme_json->update_with( $new_data );

	// vardump( $theme_json );

	return $theme_json;
}
add_filter( 'wp_theme_json_data_default', 'prefix_filter_theme_json_theme' );

if ( ! function_exists( 'set_aesthetix_customizer_demo_var' ) ) {

	/**
	 * Function for 'admin_bar_init' action-hook.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/admin_bar_init/
	 *
	 * @return void
	 */
	function set_aesthetix_customizer_demo_var() {

		$demo_var = get_aesthetix_options( 'general_demo_var' );

		$demo_var = apply_filters( 'set_aesthetix_customizer_demo_var', $demo_var );

		if ( $demo_var ) {
			set_query_var( 'demo_var', $demo_var );
		}
	}
}
// add_action( 'admin_bar_init', 'set_aesthetix_customizer_demo_var' );
// add_action( 'wp_loaded', 'set_aesthetix_customizer_demo_var' );
// add_action( '_admin_menu', 'set_aesthetix_customizer_demo_var' );

if ( ! function_exists( 'get_aesthetix_options_with_demo_var' ) ) {

	/**
	 * Function for 'get_aesthetix_options' action-hook.
	 *
	 * @param string $aesthetix_defaults Array with default theme options.
	 *
	 * @return array
	 */
	function get_aesthetix_options_with_demo_var( $aesthetix_defaults ) {

		$aesthetix_options = get_option( 'aesthetix_options', array() );

		if ( get_query_var( 'demo', false ) ) {
			$demo_var = get_query_var( 'demo', false );
		} elseif ( isset( $aesthetix_options['general_demo_var'] ) ) {
			$demo_var = $aesthetix_options['general_demo_var'];
		} else {
			$demo_var = $aesthetix_defaults['general_demo_var'];
		}

		if ( $demo_var === 'demo-1' ) {
			$demo_defaults = array(
				'root_color_scheme'       => 'black',
				'general_container_width' => 'fluid',
			);
		}

		if ( isset( $demo_defaults ) && is_array( $demo_defaults ) && ! empty( $demo_defaults ) ) {
			$aesthetix_defaults = wp_parse_args( $demo_defaults, $aesthetix_defaults );
		}

		return $aesthetix_defaults;
	}
}
// add_filter( 'get_aesthetix_options', 'get_aesthetix_options_with_demo_var' );

if ( ! function_exists( 'add_demo_query_vars' ) ) {

	/**
	 * Function for 'query_vars' filter-hook.
	 * 
	 * @param string[] $public_query_vars The array of allowed query variable names.
	 *
	 * @return string[]
	 */
	function add_demo_query_vars( $qvars ) {
		$qvars[] = 'demo';
		return $qvars;
	}
}
add_filter( 'query_vars', 'add_demo_query_vars' );

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
