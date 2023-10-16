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

if ( ! function_exists( 'aesthetix_widgets_init' ) ) {

	/**
	 * Register Widgets.
	 *
	 * @since 1.2.0
	 */
	function aesthetix_widgets_init() {
		register_widget( 'Subscribe_Form_Widget' );
		register_widget( 'Subscribe_Popup_Form_Widget' );
		register_widget( 'Search_Popup_Form_Widget' );
	}
}
add_action( 'widgets_init', 'aesthetix_widgets_init' );

if ( ! function_exists( 'aesthetix_register_sidebar' ) ) {

	/**
	 * Register widget area.
	 * 
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function aesthetix_register_sidebar() {

		register_sidebar(
			apply_filters(
				'aesthetix_main_sidebar_init',
				array(
					'name'          => __( 'Main Sidebar', 'aesthetix' ),
					'id'            => 'sidebar',
					'description'   => __( 'Add widgets in main sidebar', 'aesthetix' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			)
		);

		if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_header_top_left_init',
					array(
						'name'          => __( 'Header top bar left', 'aesthetix' ),
						'id'            => 'sidebar-top-left',
						'description'   => __( 'Header top sidebar left', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_header_top_right_init',
					array(
						'name'          => __( 'Header top bar right', 'aesthetix' ),
						'id'            => 'sidebar-top-right',
						'description'   => __( 'Header top sidebar right', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}

		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_top_left_init',
					array(
						'name'          => __( 'Footer top bar left', 'aesthetix' ),
						'id'            => 'sidebar-footer-top-left',
						'description'   => __( 'Footer top sidebar left', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_top_right_init',
					array(
						'name'          => __( 'Footer top bar right', 'aesthetix' ),
						'id'            => 'sidebar-footer-top-right',
						'description'   => __( 'Footer top sidebar right', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}

		if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_bottom_left_init',
					array(
						'name'          => __( 'Footer bottom bar left', 'aesthetix' ),
						'id'            => 'sidebar-footer-bottom-left',
						'description'   => __( 'Footer bottom sidebar left', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_bottom_right_init',
					array(
						'name'          => __( 'Footer bottom bar right', 'aesthetix' ),
						'id'            => 'sidebar-footer-bottom-right',
						'description'   => __( 'Footer bottom sidebar right', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}

		if ( in_array( get_aesthetix_options( 'general_footer_type' ), array( 'footer-simple', 'footer-three-columns', 'footer-four-columns' ), true ) ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_first_init',
					array(
						'name'          => __( 'First footer sidebar', 'aesthetix' ),
						'id'            => 'sidebar-footer-one',
						'description'   => __( 'First footer sidebar', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_second_init',
					array(
						'name'          => __( 'Second footer sidebar', 'aesthetix' ),
						'id'            => 'sidebar-footer-two',
						'description'   => __( 'Second footer sidebar', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}

		if ( in_array( get_aesthetix_options( 'general_footer_type' ), array( 'footer-three-columns', 'footer-four-columns' ), true ) ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_third_init',
					array(
						'name'          => __( 'Third footer sidebar', 'aesthetix' ),
						'id'            => 'sidebar-footer-three',
						'description'   => __( 'Third footer sidebar', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_footer_fourth_init',
					array(
						'name'          => __( 'Fourth footer sidebar', 'aesthetix' ),
						'id'            => 'sidebar-footer-four',
						'description'   => __( 'Fourth footer sidebar', 'aesthetix' ),
						'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					)
				)
			);
		}
	}
}
add_action( 'widgets_init', 'aesthetix_register_sidebar' );
