<?php
/**
 * Widget Default.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_sidebars_widgets' ) ) {

	/**
	 * Function for 'sidebars_widgets' filter-hook.
	 * 
	 * @param array $sidebars_widgets An associative array of sidebars and their widgets.
	 *
	 * @return array
	 */
	function aesthetix_sidebars_widgets( $sidebars_widgets ) {

		// vardump( $sidebars_widgets );

		if ( get_aesthetix_options( 'general_demo_widgets' ) ) {

			$uniqueizer = array();

			foreach ( get_aesthetix_widget_default() as $sidebar_id => $widget_names ) {
				if ( is_array( $widget_names ) && ! empty( $widget_names ) && isset( $sidebars_widgets[ $sidebar_id ] ) && is_array( $sidebars_widgets[ $sidebar_id ] ) && empty( $sidebars_widgets[ $sidebar_id ] ) ) {
					foreach ( $widget_names as $key => $widget_name ) {

						if ( isset( $uniqueizer[ $widget_name ] ) ) {
							$uniqueizer[ $widget_name ]++;
							$widget_id = $widget_name . '-' . $uniqueizer[ $widget_name ];
						} else {
							$widget_id = $widget_name;
							$uniqueizer[ $widget_name ] = 1;
						}

						// vardump( $widget_id );
						// vardump( get_title_slug( $widget_id ) );
						// vardump( $widget_name );
						// vardump( get_widget_name( $widget_name ) );

						$sidebars_widgets[ $sidebar_id ][] = get_title_slug( $widget_id );


/*						if ( (bool) array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ $sidebar_id ] ) === false ) {

							$sidebars_widgets[ $sidebar_id ][] = $sidebar_id . '_' . $widget_name;

							if ( array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ) {
								unset( $sidebars_widgets[ 'wp_inactive_widgets' ][ array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ] );
							}
						}*/
					}
				}

/*				if ( isset( $sidebars_widgets[ $sidebar_id ] ) && is_array( $sidebars_widgets[ $sidebar_id ] ) && ! empty( $sidebars_widgets[ $sidebar_id ] ) ) {
					$sidebars_widgets[ $sidebar_id ] = array_unique( $sidebars_widgets[ $sidebar_id ] );
				}*/
			}


/*			foreach ( get_aesthetix_widget_default() as $sidebar_id => $widget_names ) {
				if ( is_array( $widget_names ) && ! empty( $widget_names ) && isset( $sidebars_widgets[ $sidebar_id ] ) && is_array( $sidebars_widgets[ $sidebar_id ] ) && empty( $sidebars_widgets[ $sidebar_id ] ) ) {
					foreach ( $widget_names as $key => $widget_name ) {

						if ( (bool) array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ $sidebar_id ] ) === false ) {

							$sidebars_widgets[ $sidebar_id ][] = $sidebar_id . '_' . $widget_name;

							if ( array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ) {
								unset( $sidebars_widgets[ 'wp_inactive_widgets' ][ array_search( $sidebar_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ] );
							}
						}
					}
				}

				if ( isset( $sidebars_widgets[ $sidebar_id ] ) && is_array( $sidebars_widgets[ $sidebar_id ] ) && ! empty( $sidebars_widgets[ $sidebar_id ] ) ) {
					$sidebars_widgets[ $sidebar_id ] = array_unique( $sidebars_widgets[ $sidebar_id ] );
				}
			}*/
		}

		// vardump( $sidebars_widgets );

		return $sidebars_widgets;
	}
}
add_filter( 'sidebars_widgets', 'aesthetix_sidebars_widgets' );

if ( ! function_exists( 'aesthetix_register_default_sidebar_widgets' ) ) {

	/**
	 * Register default sidebar widgets.
	 *
	 * @return void
	 */
	function aesthetix_register_default_sidebar_widgets() {

		if ( get_aesthetix_options( 'general_demo_widgets' ) === false ) {
			return;
		}

		$uniqueizer = array();

		foreach ( get_aesthetix_widget_default() as $sidebar_id => $widget_names ) {
			if ( is_array( $widget_names ) && ! empty( $widget_names ) ) {
				foreach ( $widget_names as $key => $widget_name ) {

					if ( isset( $uniqueizer[ $widget_name ] ) ) {
						$uniqueizer[ $widget_name ]++;
						$widget_id = $widget_name . '-' . $uniqueizer[ $widget_name ];
					} else {
						$widget_id = $widget_name;
						$uniqueizer[ $widget_name ] = 1;
					}

					// vardump( $widget_id );
					// vardump( get_title_slug( $widget_id ) );
					// vardump( $widget_name );
					// vardump( get_widget_name( $widget_name ) );

					wp_register_sidebar_widget( get_title_slug( $widget_id ), get_widget_name( $widget_name ), 'aesthetix_widget_default', array() );
				}
			}
		}
	}
}
// add_action( 'widgets_init', 'aesthetix_register_default_sidebar_widgets' );

if ( ! function_exists( 'aesthetix_widget_default' ) ) {

	/**
	 * This function outputs the default widgets according to the specified structure as an array.
	 *
	 * @param array $args Params for added widget.
	 *
	 * @return array
	 */
	function aesthetix_widget_default( $args, $params ) {

		if ( ! isset( $params['widget'], $params['sidebar_id'] ) ) {
			return;
		}

		$instance = get_aesthetix_widget_default_instance( $params['sidebar_id'], $params['widget'] );

		if ( $instance === false ) {
			$instance = array();
		}

		// vardump( $instance );

		the_widget( $params['widget'], $instance, $args );

		return false;
	}
}

if ( ! function_exists( 'get_aesthetix_widget_default_instance' ) ) {

	/**
	 * Return array with the default widget args.
	 * 
	 * @param string $control_sidebar_id  Sidebar ID to get values.
	 * @param string $control_widget_name Widget name to get values.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_widget_default_instance( $control_sidebar_id = null, $control_widget_name = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control_sidebar_id ) ) {
			$control_sidebar_id = get_title_slug( $control_sidebar_id );
		}

		// Sanitize string (just to be safe).
		if ( ! is_null( $control_widget_name ) ) {
			// $control_widget_name = get_title_slug( $control_widget_name );
		}

		$structure = get_aesthetix_widget_default();

		if ( ! is_array( $structure ) || empty( $structure ) ) {
			return false;
		}

		$converter = array();

		foreach ( $structure as $sidebar_id => $widget_names ) {
			if ( is_array( $widget_names ) && ! empty( $widget_names ) ) {
				foreach ( $widget_names as $key => $widget_name ) {

					if ( $widget_name === 'WPA_Widget_Slider_Posts' ) {
						$converter[ $sidebar_id ][ $widget_name ]['posts_to_show']  = 4;
						$converter[ $sidebar_id ][ $widget_name ]['posts_per_page'] = 8;
					}

					if ( $widget_name === 'WPA_Widget_Menus' ) {
						$menus = get_registered_nav_menus();
						unset( $menus['primary'] );
						unset( $menus['mobile'] );
						$converter[ $sidebar_id ][ $widget_name ]['menu_structure']  = implode( ',', array_keys( $menus ) );
					}

					if ( $widget_name === 'WPA_Widget_Menus' ) {
						$converter[ $sidebar_id ][ $widget_name ]['count_items_display'] = true;
					}

					if ( $widget_name === 'WPA_Widget_Recent_Posts' ) {
						$converter[ $sidebar_id ][ $widget_name ]['post_title_size']     = 'h6';
						$converter[ $sidebar_id ][ $widget_name ]['post_layout']         = 'list';
						$converter[ $sidebar_id ][ $widget_name ]['post_structure']      = 'title,meta';
						$converter[ $sidebar_id ][ $widget_name ]['post_meta_structure'] = 'author,date';
					}

					if ( $widget_name === 'WPA_Widget_Adv_Banner' ) {
						// $converter[ $sidebar_id ][ $widget_name ]['adv_title']       = 'Aesthetix Themes';
						// $converter[ $sidebar_id ][ $widget_name ]['adv_description'] = __( 'WordPress premium templates', 'aesthetix' );

						if ( in_array( $sidebar_id, array( 'header-top-left', 'header-top-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
							// $converter[ $sidebar_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/header-promo-728x90-desktop.png' );
						}

		/*				if ( $sidebar_id === 'main' ) {
							$converter[ $sidebar_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/aside-promo-300x250-desktop.png' );
						}

						if ( $sidebar_id === 'before-post-content' ) {
							$converter[ $sidebar_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-920x90-desktop.png' );
						}

						if ( $sidebar_id === 'after-post-content' ) {
							$converter[ $sidebar_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
						}*/
					}

					// Args for header mobile.
					if ( in_array( $sidebar_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right' ), true ) ) {

						if ( in_array( get_aesthetix_options( 'root_button_size' ), array( 'lg', 'xl' ), true ) ) {
							$converter[ $sidebar_id ][ $widget_name ]['button_size'] = 'md';
						}

						if ( $widget_name === 'WPA_Widget_Search_Popup_Form' ) {
							$converter[ $sidebar_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_searchform_popup_form_button_content' );
						} elseif ( $widget_name === 'WPA_Widget_Subscribe_Popup_Form' ) {
							$converter[ $sidebar_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_subscribe_popup_form_button_content' );
						} else {
							$converter[ $sidebar_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_menu_button_content' );
						}

						if ( in_array( $converter[ $sidebar_id ][ $widget_name ]['button_content'], array( 'button-icon-text', 'button-text', 'button-icon' ), true ) ) {
							$converter[ $sidebar_id ][ $widget_name ]['button_content'] = 'button-icon';
						} else {
							if ( $widget_name === 'WPA_Widget_Language_Switcher' ) {
								$converter[ $sidebar_id ][ $widget_name ]['button_content'] = 'text-icon';
							} else {
								$converter[ $sidebar_id ][ $widget_name ]['button_content'] = 'icon';
							}
						}
					}

					// Dropdown language switcher in the header widgets.
					if ( in_array( $sidebar_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
						if ( $widget_name === 'WPA_Widget_Language_Switcher' ) {
							$converter[ $sidebar_id ][ $widget_name ]['style'] = 'dropdown';
						}
					}

					// Args for aside widgets.
					if ( in_array( $sidebar_id, array( 'aside-menu', 'main', 'footer-main-first', 'footer-main-second', 'footer-main-third', 'footer-main-fourth' ), true ) ) {
						if ( $widget_name === 'WPA_Widget_Socials' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Socials', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Follow us', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Contacts' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Feel free', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Contact us', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Menus' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Help & Info', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Browse', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Slider_Posts' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Our best picks', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Featured', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Recent_Posts' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Popular Posts', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Trending', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Recent_Users' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'By post count', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'Edithors', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_User' ) {
							$converter[ $sidebar_id ][ $widget_name ]['subtitle'] = __( 'Author', 'aesthetix' );
							$converter[ $sidebar_id ][ $widget_name ]['title']    = __( 'About me', 'aesthetix' );
						}

						if ( $widget_name === 'WPA_Widget_Recent_Posts' ) {
							if ( $sidebar_id === 'main' ) {
								$converter[ $sidebar_id ][ $widget_name ]['posts_per_page'] = 4;
							} else {
								$converter[ $sidebar_id ][ $widget_name ]['posts_per_page'] = 2;
							}
						}

						if ( in_array( $widget_name, array( 'WPA_Widget_User', 'WPA_Widget_Recent_Users' ), true ) ) {
							$converter[ $sidebar_id ][ $widget_name ]['container_class'] = 'user-aside';
						}

						if ( $widget_name === 'WPA_Widget_Slider_Posts' ) {
							$converter[ $sidebar_id ][ $widget_name ]['posts_to_show']  = 1;
							$converter[ $sidebar_id ][ $widget_name ]['posts_per_page'] = 4;
							// $converter[ $sidebar_id ][ $widget_name ]['post_title_size']     = 'h6';
							// $converter[ $sidebar_id ][ $widget_name ]['post_layout']         = 'grid';
							// $converter[ $sidebar_id ][ $widget_name ]['post_structure']      = 'title,meta';
							// $converter[ $sidebar_id ][ $widget_name ]['post_meta_structure'] = 'author,date';
						}
					}

					// Args for full size widgets.
					if ( in_array( $sidebar_id, array( 'after-header', 'before-footer' ), true ) ) {
						// code...
					}

					// Args for single post content widgets.
					if ( in_array( $sidebar_id, array( 'before-post-content', 'after-post-content' ), true ) ) {
						// code...
					}

					// Merge child and parent default options.
					$converter = apply_filters( 'get_aesthetix_widget_default_instance', $converter, $sidebar_id, $widget_name );
				}
			}
		}

		// vardump( $control_sidebar_id );
		// vardump( $control_widget_name );

		// Return controls.
		if ( is_null( $control_sidebar_id ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control_sidebar_id ] ) ) {
			return false;
		} else {
			if ( is_null( $control_widget_name ) ) {
				return $converter[ $control_sidebar_id ];
			} elseif ( ! isset( $converter[ $control_sidebar_id ][ $control_widget_name ] ) ) {
				return false;
			} else {
				return $converter[ $control_sidebar_id ][ $control_widget_name ];
			}
		}
	}
}

if ( ! function_exists( 'get_aesthetix_widget_default' ) ) {

	/**
	 * Return array with the default widget.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_widget_default( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'main'                 => array( 'WPA_Widget_User', 'WPA_Widget_Slider_Posts', 'WPA_Widget_Adv_Banner', 'WPA_Widget_Recent_Posts', 'WPA_Widget_Recent_Users' ),
			'aside-menu'           => array( 'WPA_Widget_Socials', 'WPA_Widget_Language_Switcher' ),
			'after-header'         => array( 'WPA_Widget_Slider_Posts', 'WPA_Widget_Breadcrumbs' ),
			'before-footer'        => array( 'WPA_Widget_Subscribe_Form' ),
			'before-post-content'  => array( 'WPA_Widget_User', 'WPA_Widget_Subscribe_Form' ),
			'after-post-content'   => array( 'WPA_Widget_User', 'WPA_Widget_Subscribe_Form' ),
			'header-mobile-left'   => array( 'WPA_Widget_Logo' ),
			'header-mobile-center' => array( 'WPA_Widget_Logo' ),
			'header-mobile-right'  => array( 'WPA_Widget_Search_Popup_Form', 'WPA_Widget_Subscribe_Popup_Form' ),
			'header-top-left'      => array(),
			'header-top-right'     => array(),
			'header-main-left'     => array( 'WPA_Widget_Logo' ),
			'header-main-center'   => array( 'WPA_Widget_Logo' ),
			'header-main-right'    => array(),
			'header-bottom-left'   => array( 'WPA_Widget_Subscribe_Popup_Form' ),
			'header-bottom-right'  => array( 'WPA_Widget_Search_Popup_Form', 'WPA_Widget_Subscribe_Popup_Form' ),
			'footer-top-left'      => array( 'WPA_Widget_Logo' ),
			'footer-top-right'     => array(), //'widget-menu-primary'
			'footer-main-first'    => array( 'WPA_Widget_Logo', 'WPA_Widget_Language_Switcher' ),
			'footer-main-second'   => array( 'WPA_Widget_Menus' ),
			'footer-main-third'    => array( 'WPA_Widget_Contacts', 'WPA_Widget_Socials' ),
			'footer-main-fourth'   => array( 'WPA_Widget_Contacts', 'WPA_Widget_Socials' ),
			'footer-bottom-left'   => array( 'WPA_Widget_Creator' ),
			'footer-bottom-right'  => array( 'WPA_Widget_Copyright' ),
		);

		if ( get_aesthetix_options( 'general_header_mobile_type' ) === 'mid-3' ) {
			$converter['header-mobile-left']  = array( 'WPA_Widget_Search_Popup_Form', );
			$converter['header-mobile-right'] = array( 'WPA_Widget_Subscribe_Popup_Form' );
		}

		if ( get_aesthetix_options( 'general_header_type' ) === 'mid-3-bot-3' ) {
			$converter['header-main-left']    = array( 'WPA_Widget_Adv_Banner' );
			$converter['header-bottom-left']  = array( 'WPA_Widget_Search_Popup_Form' );
			$converter['header-bottom-right'] = array( 'WPA_Widget_Subscribe_Popup_Form' );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-3-bot-2' ) {
			$converter['header-main-left']    = array( 'WPA_Widget_Adv_Banner' );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-2-bot-3' ) {
			$converter['header-bottom-left']  = array( 'WPA_Widget_Search_Popup_Form' );
			$converter['header-bottom-right'] = array( 'WPA_Widget_Subscribe_Popup_Form' );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-2-bot-2' ) {

		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-3' ) {
			$converter['header-main-left']  = array( 'WPA_Widget_Search_Popup_Form' );
			$converter['header-main-right'] = array( 'WPA_Widget_Subscribe_Popup_Form' );
		} else {
			$converter['header-main-right'] = array( 'WPA_Widget_Language_Switcher', 'WPA_Widget_Search_Popup_Form', 'WPA_Widget_Subscribe_Popup_Form' );
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$converter['footer-main-second'] = array( 'WPA_Widget_Recent_Posts' );
			$converter['footer-main-third']  = array( 'WPA_Widget_Menus' );
		}

		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) === true ) {
			$converter['footer-main-first']  = array( 'WPA_Widget_Recent_Posts' );
			$converter['footer-main-second'] = array( 'WPA_Widget_Menus' );
			$converter['footer-main-third']  = array( 'WPA_Widget_Contacts', 'WPA_Widget_Socials' );
			$converter['footer-main-fourth'] = array( 'WPA_Widget_Contacts', 'WPA_Widget_Socials' );
		}

		// Merge child and parent default options.
		$converter = apply_filters( 'get_aesthetix_widget_default', $converter );

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
