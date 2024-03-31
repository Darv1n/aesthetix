<?php
/**
 * Widget Init.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_widgets_init' ) ) {

	/**
	 * Register widgets.
	 */
	function aesthetix_widgets_init() {
		register_widget( 'WPA_Widget_Adv_Banner' );
		register_widget( 'WPA_Widget_Breadcrumbs' );
		register_widget( 'WPA_Widget_Buttons' );
		register_widget( 'WPA_Widget_Contacts' );
		register_widget( 'WPA_Widget_Copyright' );
		register_widget( 'WPA_Widget_Creator' );
		register_widget( 'WPA_Widget_Language_Switcher' );
		register_widget( 'WPA_Widget_Logo' );
		register_widget( 'WPA_Widget_Menus' );
		register_widget( 'WPA_Widget_Recent_Posts' );
		register_widget( 'WPA_Widget_Recent_Users' );
		register_widget( 'WPA_Widget_Search_Popup_Form' );
		register_widget( 'WPA_Widget_Slider_Posts' );
		register_widget( 'WPA_Widget_Socials' );
		register_widget( 'WPA_Widget_Subscribe_Form' );
		register_widget( 'WPA_Widget_Subscribe_Popup_Form' );
		register_widget( 'WPA_Widget_Table_Of_Contents' );
		register_widget( 'WPA_Widget_Use_Materials' );
		register_widget( 'WPA_Widget_User' );
	}
}
add_action( 'widgets_init', 'aesthetix_widgets_init' );

if ( ! function_exists( 'aesthetix_register_sidebar' ) ) {

	/**
	 * Register widget area.
	 *
	 * @return void
	 */
	function aesthetix_register_sidebar() {

		$sidebars = array(
			'main' => array(
				'name'        => esc_html__( 'Main sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in main sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'aside-menu' => array(
				'name'        => esc_html__( 'Aside menu sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in aside menu sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'after-header' => array(
				'name'        => esc_html__( 'After header sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in after header sidebar', 'aesthetix' ),
				'title_tag'   => 'h2',
			),
			'before-footer' => array(
				'name'        => esc_html__( 'Before footer sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in before footer sidebar', 'aesthetix' ),
				'title_tag'   => 'h2',
			),
			'before-post-content' => array(
				'name'        => esc_html__( 'Before post content sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in before post content sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'after-post-content' => array(
				'name'        => esc_html__( 'After post content sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in after post content sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'header-mobile-left' => array(
				'name'        => esc_html__( 'Header mobile left', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header mobile left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
			'header-mobile-right' => array(
				'name'        => esc_html__( 'Header mobile right', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header mobile right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			),
		);

		// Header mobile center sidebars.
		if ( get_aesthetix_options( 'general_header_mobile_type' ) === 'header-mobile-mid-3' ) {
			$header_mobile_center['header-mobile-center'] = array(
				'name'        => esc_html__( 'Header mobile center', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header mobile center sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars = array_insert_after( $sidebars, 'header-mobile-left', $header_mobile_center );
		}

		// Header top bar sidebars.
		if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) {
			$sidebars['header-top-left'] = array(
				'name'        => esc_html__( 'Header top bar left', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header top bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
			$sidebars['header-top-right'] = array(
				'name'        => esc_html__( 'Header top bar right', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header top bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		$sidebars['header-main-left'] = array(
			'name'        => esc_html__( 'Header main left', 'aesthetix' ),
			'description' => esc_html__( 'Add widgets in header main left sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['header-main-right'] = array(
			'name'        => esc_html__( 'Header main right', 'aesthetix' ),
			'description' => esc_html__( 'Add widgets in header main right sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2' ), true ) ) {
			$header_main_center['header-main-center'] = array(
				'name'        => esc_html__( 'Header main center', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header main center sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars = array_insert_after( $sidebars, 'header-main-left', $header_main_center );
		}

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2', 'mid-2-bot-3' ), true ) ) {
			$sidebars['header-bottom-left'] = array(
				'name'        => esc_html__( 'Header bottom left', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header bottom left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		if ( in_array( get_aesthetix_options( 'general_header_type' ), array( 'mid-3-bot-3', 'mid-3-bot-2', 'mid-2-bot-3', 'mid-2-bot-2' ), true ) ) {
			$sidebars['header-bottom-right'] = array(
				'name'        => esc_html__( 'Header bottom right', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in header bottom right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		// Footer top bar sidebars.
		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) {

			$sidebars['footer-top-left'] = array(
				'name'        => esc_html__( 'Footer top bar left', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in footer top bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars['footer-top-right'] = array(
				'name'        => esc_html__( 'Footer top bar right', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in footer top bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

		}

		// Footer main sidebars.
		$sidebars['footer-main-first'] = array(
			'name'        => esc_html__( 'Footer main first sidebar', 'aesthetix' ),
			'description' => esc_html__( 'Add widgets in footer main first sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['footer-main-second'] = array(
			'name'        => esc_html__( 'Footer main second sidebar', 'aesthetix' ),
			'description' => esc_html__( 'Add widgets in footer main second sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['footer-main-third'] = array(
			'name'        => esc_html__( 'Footer main third sidebar', 'aesthetix' ),
			'description' => esc_html__( 'Add widgets in footer main third sidebar', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$sidebars['footer-main-fourth'] = array(
				'name'        => esc_html__( 'Footer main fourth sidebar', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in footer main fourth sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);
		}

		// Footer bottom bar sidebars.
		if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) {

			$sidebars['footer-bottom-left'] = array(
				'name'        => esc_html__( 'Footer bottom bar left', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in footer bottom bar left sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

			$sidebars['footer-bottom-right'] = array(
				'name'        => esc_html__( 'Footer bottom bar right', 'aesthetix' ),
				'description' => esc_html__( 'Add widgets in footer bottom bar right sidebar', 'aesthetix' ),
				'title_tag'   => 'h3',
			);

		}

		// Merge child and parent default options.
		$sidebars = apply_filters( 'aesthetix_register_sidebar', $sidebars );

		foreach ( $sidebars as $sidebar_id => $sidebar ) {

			register_sidebar(
				apply_filters(
					'aesthetix_sidebar_' . $sidebar_id . '_init',
					array(
						'name'            => $sidebar['name'],
						'id'              => $sidebar_id,
						'description'     => $sidebar['description'],
						'before_widget'   => '<div id="%2$s" class="widget %2$s">', // This tag replaced on filter dynamic_sidebar_params, because we need to add a style background-image.
						'after_widget'    => '</div>',
						'before_title'    => '<' . $sidebar['title_tag'] . ' class="widget-title">',
						'after_title'     => '</' . $sidebar['title_tag'] . '>',
					)
				)
			);
		}
	}
}
add_action( 'widgets_init', 'aesthetix_register_sidebar' );

if ( ! function_exists( 'get_widget_name' ) ) {

	/**
	 * Return array with the widget names.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_widget_name( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			// $control = get_title_slug( $control );
		}

		$converter = array(
			'WPA_Widget_Adv_Banner'           => 'Aesthetix ' . mb_strtolower( __( 'Adv banner', 'aesthetix' ) ),
			'WPA_Widget_Breadcrumbs'          => 'Aesthetix ' . mb_strtolower( __( 'Breadcrumbs', 'aesthetix' ) ),
			'WPA_Widget_Buttons'              => 'Aesthetix ' . mb_strtolower( __( 'Buttons', 'aesthetix' ) ),
			'WPA_Widget_Contacts'             => 'Aesthetix ' . mb_strtolower( __( 'Contacts', 'aesthetix' ) ),
			'WPA_Widget_Copyright'            => 'Aesthetix ' . mb_strtolower( __( 'Copyright', 'aesthetix' ) ),
			'WPA_Widget_Creator'              => 'Aesthetix ' . mb_strtolower( __( 'Creator', 'aesthetix' ) ),
			'WPA_Widget_Language_Switcher'    => 'Aesthetix ' . mb_strtolower( __( 'Language switcher', 'aesthetix' ) ),
			'WPA_Widget_Logo'                 => 'Aesthetix ' . mb_strtolower( __( 'Logo', 'aesthetix' ) ),
			// 'widget-menu-primary'          => 'Aesthetix ' . mb_strtolower( __( 'Primary menu', 'aesthetix' ) ),
			'WPA_Widget_Menus'                => 'Aesthetix ' . mb_strtolower( __( 'Menus', 'aesthetix' ) ),
			'WPA_Widget_Recent_Posts'         => 'Aesthetix ' . mb_strtolower( __( 'Recent posts', 'aesthetix' ) ),
			'WPA_Widget_Recent_Users'         => 'Aesthetix ' . mb_strtolower( __( 'Recent users', 'aesthetix' ) ),
			'widget-search-form'              => 'Aesthetix ' . mb_strtolower( __( 'Search form', 'aesthetix' ) ),
			'WPA_Widget_Search_Popup_Form'    => 'Aesthetix ' . mb_strtolower( __( 'Search button', 'aesthetix' ) ),
			'WPA_Widget_Slider_Posts'         => 'Aesthetix ' . mb_strtolower( __( 'Slider posts', 'aesthetix' ) ),
			'WPA_Widget_Socials'              => 'Aesthetix ' . mb_strtolower( __( 'Socials', 'aesthetix' ) ),
			'WPA_Widget_Subscribe_Form'       => 'Aesthetix ' . mb_strtolower( __( 'Subscribe form', 'aesthetix' ) ),
			'WPA_Widget_Subscribe_Popup_Form' => 'Aesthetix ' . mb_strtolower( __( 'Subscribe button', 'aesthetix' ) ),
			'WPA_Widget_Table_Of_Contents'    => 'Aesthetix ' . mb_strtolower( __( 'Table of contents', 'aesthetix' ) ),
			'WPA_Widget_Use_Materials'        => 'Aesthetix ' . mb_strtolower( __( 'Use materials', 'aesthetix' ) ),
			'WPA_Widget_User'                 => 'Aesthetix ' . mb_strtolower( __( 'User', 'aesthetix' ) ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_widget_name', $converter );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}

if ( ! function_exists( 'admin_enqueue_scripts_widgets_callback' ) ) {

	/**
	 * Load dynamic logic for the widgets area.
	 * 
	 * @return void
	 */
	function admin_enqueue_scripts_widgets_callback( $hook_suffix ) {

		global $post;

		if ( in_array( $hook_suffix, array( 'widgets.php' ), true ) ) {
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_style( 'aesthetix-widgets', get_theme_file_uri( '/assets/css/admin-widgets.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/admin-widgets.min.css' ) ) );
			wp_enqueue_script( 'aesthetix-widgets', get_theme_file_uri( '/assets/js/admin-widgets.min.js' ), array( 'jquery', 'jquery-ui-sortable' ), filemtime( get_theme_file_path( '/assets/js/admin-widgets.min.js' ) ), true );
		
			$root_string = '';
			foreach ( get_aesthetix_customizer_roots() as $key => $root_value ) {
				$root_string .= '--' . $key . ': ' . $root_value . ';';
			}

			wp_add_inline_style( 'aesthetix-widgets', ':root {' . esc_attr( $root_string ) . '}' );
		}
	}
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts_widgets_callback' );
