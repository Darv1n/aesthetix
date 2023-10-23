<?php
/**
 * Widgets Init.
 * 
 * @since 1.2.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'WPA_Widgets_init' ) ) {

	/**
	 * Register widgets.
	 *
	 * @since 1.2.0
	 */
	function WPA_Widgets_init() {
		register_widget( 'WP_Widget_Search_Popup_Form' );
		register_widget( 'WP_Widget_Subscribe_Form' );
		register_widget( 'WP_Widget_Subscribe_Popup_Form' );
		register_widget( 'WP_Widget_Adv_Banner' );
	}
}
add_action( 'widgets_init', 'WPA_Widgets_init' );

if ( ! function_exists( 'aesthetix_register_sidebar' ) ) {

	/**
	 * Register widget area.
	 * 
	 * @since 1.0.0
	 * @since 1.2.4 Widget registration has been completely reworked.
	 *
	 * @return void
	 */
	function aesthetix_register_sidebar() {

		$sidebars = array(
			'main' => array(
				'name'        => __( 'Main sidebar', 'aesthetix' ),
				'description' => __( 'Add widgets in main sidebar', 'aesthetix' ),
				'title_tag'   => 'h2',
			),
			'header-mobile-left' => array(
				'name'        => __( 'Header mobile left', 'aesthetix' ),
				'description' => __( 'Add widgets in header mobile left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'header-mobile-right' => array(
				'name'        => __( 'Header mobile right', 'aesthetix' ),
				'description' => __( 'Add widgets in header mobile right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
		);

		// Header mobile center sidebars.
		if ( get_aesthetix_options( 'general_header_mobile_type' ) === 'header-mobile-mid-3' ) {
			$header_mobile_center['header-mobile-center'] = array(
				'name'        => __( 'Header mobile center', 'aesthetix' ),
				'description' => __( 'Add widgets in header mobile center sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars = array_insert_after( $sidebars, 'header-mobile-left', $header_mobile_center );
		}

		// Header top bar sidebars.
		if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) {
			$sidebars['header-top-left'] = array(
				'name'        => __( 'Header top bar left', 'aesthetix' ),
				'description' => __( 'Add widgets in header top bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
			$sidebars['header-top-right'] = array(
				'name'        => __( 'Header top bar right', 'aesthetix' ),
				'description' => __( 'Add widgets in header top bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		$sidebars['header-main-left'] = array(
			'name'        => __( 'Header main left', 'aesthetix' ),
			'description' => __( 'Add widgets in header main left sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['header-main-right'] = array(
			'name'        => __( 'Header main right', 'aesthetix' ),
			'description' => __( 'Add widgets in header main right sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2' ), true ) ) {
			$header_main_center['header-main-center'] = array(
				'name'        => __( 'Header main center', 'aesthetix' ),
				'description' => __( 'Add widgets in header main center sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars = array_insert_after( $sidebars, 'header-main-left', $header_main_center );
		}

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2', 'mid-2-bot-3' ), true ) ) {
			$sidebars['header-bottom-left'] = array(
				'name'        => __( 'Header bottom left', 'aesthetix' ),
				'description' => __( 'Add widgets in header bottom left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2', 'mid-2-bot-3', 'mid-2-bot-2' ), true ) ) {
			$sidebars['header-bottom-right'] = array(
				'name'        => __( 'Header bottom right', 'aesthetix' ),
				'description' => __( 'Add widgets in header bottom right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		// Footer top bar sidebars.
		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) {

			$sidebars['footer-top-left'] = array(
				'name'        => __( 'Footer top bar left', 'aesthetix' ),
				'description' => __( 'Add widgets in footer top bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars['footer-top-right'] = array(
				'name'        => __( 'Footer top bar right', 'aesthetix' ),
				'description' => __( 'Add widgets in footer top bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

		}

		// Footer main sidebars.
		$sidebars['footer-main-first'] = array(
			'name'        => __( 'Footer main first sidebar', 'aesthetix' ),
			'description' => __( 'Add widgets in footer main first sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['footer-main-second'] = array(
			'name'        => __( 'Footer main second right', 'aesthetix' ),
			'description' => __( 'Add widgets in footer main second sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['footer-main-third'] = array(
			'name'        => __( 'Footer main third right', 'aesthetix' ),
			'description' => __( 'Add widgets in footer main third sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$sidebars['footer-main-fourth'] = array(
				'name'        => __( 'Footer main fourth right', 'aesthetix' ),
				'description' => __( 'Add widgets in footer main fourth sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		// Footer bottom bar sidebars.
		if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) {

			$sidebars['footer-bottom-left'] = array(
				'name'        => __( 'Footer bottom bar left', 'aesthetix' ),
				'description' => __( 'Add widgets in footer bottom bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars['footer-bottom-right'] = array(
				'name'        => __( 'Footer bottom bar right', 'aesthetix' ),
				'description' => __( 'Add widgets in footer bottom bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

		}

		// Merge child and parent default options.
		$sidebars = apply_filters( 'aesthetix_register_sidebar', $sidebars );

		foreach ( $sidebars as $id => $sidebar ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_' . $id . '_init',
					array(
						'name'          => $sidebar['name'],
						'id'            => $id,
						'description'   => $sidebar['description'],
						'before_widget' => '<div ' . widget_classes( '', $id, false ) . '>',
						'after_widget'  => '</div>',
						'before_title'  => '<' . $sidebar['title_tag'] . ' class="widget-title">',
						'after_title'   => '</' . $sidebar['title_tag'] . '>',
					)
				)
			);
		}
	}
}
add_action( 'widgets_init', 'aesthetix_register_sidebar' );
