<?php
/**
 * Customizer sections.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_sections' ) ) {

	/**
	 * Return array with the customizer fonts.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_customizer_sections( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		// Add sections.
		$sections = array(
			'general'      => array(
				'title' => __( 'General options', 'aesthetix' ),
				'type'  => 'section',
			),
			'root'         => array(
				'title' => __( 'Root style options', 'aesthetix' ),
				'type'  => 'section',
			),
			'breadcrumbs'  => array(
				'title' => __( 'Breadcrumbs options', 'aesthetix' ),
				'type'  => 'section',
			),
			'front_page'   => array(
				'title' => __( 'Front page options', 'aesthetix' ),
				'type'  => 'section',
			),
			'archive_page' => array(
				'title' => __( 'Archive options', 'aesthetix' ),
				'type'  => 'section',
			),
		);

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$sections[ 'single_' . $post_type ] = array(
				'title' => sprintf( __( 'Single %s options', 'aesthetix' ), $post_type ),
				'type'  => 'section',
			);
			$sections[ 'archive_' . $post_type ] = array(
				'title' => sprintf( __( 'Archive %s options', 'aesthetix' ), $post_type ),
				'type'  => 'section',
			);
		}

		$sections['comments'] = array(
			'title' => __( 'Comments options', 'aesthetix' ),
			'type'  => 'section',
		);

		$sections['other'] = array(
			'title' => __( 'Other options', 'aesthetix' ),
			'type'  => 'section',
		);

		$sections['adv'] = array(
			'title' => __( 'Advertising banners', 'aesthetix' ),
			'type'  => 'section',
		);

		// Merge child and parent default options.
		$sections = apply_filters( 'get_aesthetix_customizer_sections', $sections );

		// Return controls.
		if ( is_null( $control ) ) {
			return $sections;
		} elseif ( ! isset( $sections[ $control ] ) || empty( $sections[ $control ] ) ) {
			return false;
		} else {
			return $sections[ $control ];
		}
	}
}
