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

		if ( get_aesthetix_options( 'general_demo_widgets' ) ) {
			foreach ( get_aesthetix_widget_default() as $widget_id => $widget_names ) {
				if ( is_array( $widget_names ) && ! empty( $widget_names ) && isset( $sidebars_widgets[ $widget_id ] ) && is_array( $sidebars_widgets[ $widget_id ] ) && empty( $sidebars_widgets[ $widget_id ] ) ) {
					foreach ( $widget_names as $key => $widget_name ) {

						if ( (bool) array_search( $widget_id . '_' . $widget_name, $sidebars_widgets[ $widget_id ] ) === false ) {

							$sidebars_widgets[ $widget_id ][] = $widget_id . '_' . $widget_name;

							if ( array_search( $widget_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ) {
								unset( $sidebars_widgets[ 'wp_inactive_widgets' ][ array_search( $widget_id . '_' . $widget_name, $sidebars_widgets[ 'wp_inactive_widgets' ] ) ] );
							}
						}
					}
				}

				if ( isset( $sidebars_widgets[ $widget_id ] ) && is_array( $sidebars_widgets[ $widget_id ] ) && ! empty( $sidebars_widgets[ $widget_id ] ) ) {
					$sidebars_widgets[ $widget_id ] = array_unique( $sidebars_widgets[ $widget_id ] );
				}
			}
		}

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

		foreach ( get_aesthetix_widget_default() as $widget_id => $widget_names ) {
			if ( is_array( $widget_names ) && ! empty( $widget_names ) ) {
				foreach ( $widget_names as $key => $widget_name ) {

					// vardump( $widget_name );
					// vardump( get_widget_name( $widget_name ) );

					wp_register_sidebar_widget(
						$widget_id . '_' . $widget_name,
						get_widget_name( $widget_name ),
						'aesthetix_widget_default',
						array(
							// 'widget_id'   => $widget_id,
							// 'widget_name' => $widget_name,
						)
					);
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'aesthetix_register_default_sidebar_widgets' );

if ( ! function_exists( 'aesthetix_widget_default' ) ) {

	/**
	 * This function outputs the default widgets according to the specified structure as an array.
	 *
	 * @param array  $structure The right widgets structure for output. Default null
	 * @param string $widget_id Widget ID. Default null
	 *
	 * @return array
	 */
	function aesthetix_widget_default( $args ) {

		if ( isset( $args['widget_id'] ) ) {
			$widget_parts = explode( '_', $args['widget_id'] );

			if ( count( $widget_parts ) !== 2 ) {
				return false;
			}

			$widget_id   = $widget_parts[0];
			$widget_name = $widget_parts[1];

		} else {
			return false;
		}

		$widget_args = get_aesthetix_widget_default_args( $widget_id, $widget_name );

		if ( $widget_args === false ) {
			$widget_args = array();
		}

		echo $args['before_widget'];

		switch ( $widget_name ) {
			case has_action( 'aesthetix_widget_default_loop_' . $widget_name ):
				do_action( 'aesthetix_widget_default_loop_' . $widget_name, $widget_args, $widget_id, $widget_name );
				break;
			case 'widget-search-form':
				get_template_part( 'templates/widget/widget-entry-title', '', $widget_args );
				get_search_form();
				break;
			case 'widget-menu-primary':
				get_template_part( 'templates/widget/widget-entry-title', '', $widget_args );
				get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'primary' ) );
				break;
			default:
				if ( locate_template( '/templates/widget/' . $widget_name . '.php' ) !== '' ) {
					get_template_part( 'templates/widget/widget-entry-title', '', $widget_args );
					get_template_part( 'templates/widget/' . $widget_name, '', $widget_args );
				}
				break;
		}

		echo $args['after_widget'];

		return false;
	}
}

if ( ! function_exists( 'get_aesthetix_widget_default_args' ) ) {

	/**
	 * Return array with the default widget args.
	 * 
	 * @param string $control_widget_id   Widget ID to get values.
	 * @param string $control_widget_name Widget name to get values.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_widget_default_args( $control_widget_id = null, $control_widget_name = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control_widget_id ) ) {
			$control_widget_id = get_title_slug( $control_widget_id );
		}

		// Sanitize string (just to be safe).
		if ( ! is_null( $control_widget_name ) ) {
			$control_widget_name = get_title_slug( $control_widget_name );
		}

		$structure = get_aesthetix_widget_default();

		if ( ! is_array( $structure ) || empty( $structure ) ) {
			return false;
		}

		$converter = array();

		foreach ( $structure as $widget_id => $widget_names ) {
			if ( is_array( $widget_names ) && ! empty( $widget_names ) ) {
				foreach ( $widget_names as $key => $widget_name ) {
					if ( in_array( $widget_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right' ), true ) ) {

						if ( in_array( get_aesthetix_options( 'root_button_size' ), array( 'lg', 'xl' ), true ) ) {
							$converter[ $widget_id ][ $widget_name ]['button_size'] = 'md';
						}

						if ( $widget_name === 'widget-search-toggle' ) {
							$converter[ $widget_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_searchform_popup_form_button_content' );
						} elseif ( $widget_name === 'widget-subscribe-toggle' ) {
							$converter[ $widget_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_subscribe_popup_form_button_content' );
						} else {
							$converter[ $widget_id ][ $widget_name ]['button_content'] = get_aesthetix_options( 'root_menu_button_content' );
						}

						if ( in_array( $converter[ $widget_id ][ $widget_name ]['button_content'], array( 'button-icon-text', 'button-text', 'button-icon' ), true ) ) {
							$converter[ $widget_id ][ $widget_name ]['button_content'] = 'button-icon';
						} else {
							if ( $widget_name === 'widget-language-switcher' ) {
								$converter[ $widget_id ][ $widget_name ]['button_content'] = 'text-icon';
							} else {
								$converter[ $widget_id ][ $widget_name ]['button_content'] = 'icon';
							}
						}
					}

					if ( in_array( $widget_id, array( 'footer-main-first', 'footer-main-second', 'footer-main-third', 'footer-main-fourth' ), true ) ) {
						if ( $widget_name === 'widget-socials' ) {
							$converter[ $widget_id ][ $widget_name ]['widget_title']    = __( 'Follow us', 'aesthetix' );
							$converter[ $widget_id ][ $widget_name ]['widget_subtitle'] = __( 'Socials', 'aesthetix' );
						}

						if ( $widget_name === 'widget-contacts' ) {
							$converter[ $widget_id ][ $widget_name ]['widget_title']    = __( 'Contact us', 'aesthetix' );
							$converter[ $widget_id ][ $widget_name ]['widget_subtitle'] = __( 'Feel free', 'aesthetix' );
						}

						if ( $widget_name === 'widget-menus' ) {
							$menus = get_registered_nav_menus();
							unset( $menus['primary'] );
							unset( $menus['mobile'] );
							$converter[ $widget_id ][ $widget_name ]['menu_structure']  = implode( ',', array_keys( $menus ) );
							$converter[ $widget_id ][ $widget_name ]['widget_title']    = __( 'Browse', 'aesthetix' );
							$converter[ $widget_id ][ $widget_name ]['widget_subtitle'] = __( 'Help & Info', 'aesthetix' );
						}

						if ( $widget_name === 'widget-recent-posts' ) {
							$converter[ $widget_id ][ $widget_name ]['posts_per_page'] = 2;
						}
					}

					if ( $widget_id === 'aside-menu' && $widget_name === 'widget-socials' ) {
						$converter[ $widget_id ][ $widget_name ]['widget_title']    = __( 'Follow us', 'aesthetix' );
						$converter[ $widget_id ][ $widget_name ]['widget_subtitle'] = __( 'Socials', 'aesthetix' );
					}

					if ( in_array( $widget_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
						if ( $widget_name === 'widget-language-switcher' ) {
							$converter[ $widget_id ][ $widget_name ]['style'] = 'dropdown';
						}
					}

					if ( $widget_name === 'widget-menus' ) {
						$converter[ $widget_id ][ $widget_name ]['count_items_display'] = true;
					}

					if ( $widget_name === 'widget-recent-posts' ) {
						$converter[ $widget_id ][ $widget_name ]['post_title_size']     = 'h6';
						$converter[ $widget_id ][ $widget_name ]['post_layout']         = 'list';
						$converter[ $widget_id ][ $widget_name ]['post_structure']      = 'title,meta';
						$converter[ $widget_id ][ $widget_name ]['post_meta_structure'] = 'author,date';
						$converter[ $widget_id ][ $widget_name ]['widget_title']        = __( 'Recent posts', 'aesthetix' );
					}

					if ( $widget_name === 'widget-adv-banner' ) {
						// $converter[ $widget_id ][ $widget_name ]['adv_title']       = 'Aesthetix Themes';
						// $converter[ $widget_id ][ $widget_name ]['adv_description'] = __( 'WordPress premium templates', 'aesthetix' );

						if ( in_array( $widget_id, array( 'header-top-left', 'header-top-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
							// $converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/header-promo-728x90-desktop.png' );
						}

		/*				if ( $widget_id === 'main' ) {
							$converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/aside-promo-300x250-desktop.png' );
						}

						if ( $widget_id === 'after-header' ) {
							$converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
						}

						if ( $widget_id === 'before-post-content' ) {
							$converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-920x90-desktop.png' );
						}

						if ( $widget_id === 'after-post-content' ) {
							$converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
						}

						if ( $widget_id === 'before-footer' ) {
							$converter[ $widget_id ][ $widget_name ]['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
						}*/
					}

					// Merge child and parent default options.
					$converter = apply_filters( 'get_aesthetix_widget_default_args', $converter, $widget_id, $widget_name );
				}
			}
		}

		// Return controls.
		if ( is_null( $control_widget_id ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control_widget_id ] ) ) {
			return false;
		} else {
			if ( is_null( $control_widget_name ) ) {
				return $converter[ $control_widget_id ];
			} elseif ( ! isset( $converter[ $control_widget_id ][ $control_widget_name ] ) ) {
				return false;
			} else {
				return $converter[ $control_widget_id ][ $control_widget_name ];
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
			'main'                 => array( 'widget-search-form', 'widget-recent-posts', 'widget-adv-banner' ),
			'aside-menu'           => array( 'widget-socials', 'widget-language-switcher' ),
			'after-header'         => array( 'widget-adv-banner' ),
			'before-post-content'  => array( 'widget-adv-banner' ),
			'after-post-content'   => array( 'widget-adv-banner' ),
			'before-footer'        => array( 'widget-adv-banner' ),
			'header-mobile-left'   => array( 'widget-logo' ),
			'header-mobile-center' => array( 'widget-logo' ),
			'header-mobile-right'  => array( 'widget-search-toggle', 'widget-subscribe-toggle' ),
			'header-top-left'      => array(),
			'header-top-right'     => array(),
			'header-main-left'     => array( 'widget-logo' ),
			'header-main-center'   => array( 'widget-logo' ),
			'header-main-right'    => array( 'widget-adv-banner' ),
			'header-bottom-left'   => array( 'widget-subscribe-toggle' ),
			'header-bottom-right'  => array( 'widget-search-toggle', 'widget-subscribe-toggle' ),
			'footer-top-left'      => array( 'widget-logo' ),
			'footer-top-right'     => array( 'widget-menu-primary' ),
			'footer-main-first'    => array( 'widget-logo', 'widget-search-form', 'widget-language-switcher' ),
			'footer-main-second'   => array( 'widget-menus' ),
			'footer-main-third'    => array( 'widget-contacts', 'widget-socials' ),
			'footer-main-fourth'   => array( 'widget-contacts', 'widget-socials' ),
			'footer-bottom-left'   => array( 'widget-creator' ),
			'footer-bottom-right'  => array( 'widget-copyright' ),
		);

		if ( get_aesthetix_options( 'general_header_mobile_type' ) === 'mid-3' ) {
			$converter['header-mobile-left']  = array( 'widget-search-toggle', );
			$converter['header-mobile-right'] = array( 'widget-subscribe-toggle' );
		}

		if ( get_aesthetix_options( 'general_header_type' ) === 'mid-3-bot-3' ) {
			$converter['header-main-left']    = array( 'widget-adv-banner', );
			$converter['header-bottom-left']  = array( 'widget-search-toggle' );
			$converter['header-bottom-right'] = array( 'widget-subscribe-toggle' );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-3-bot-2' ) {
			$converter['header-main-left']    = array( 'widget-adv-banner', );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-2-bot-3' ) {
			$converter['header-bottom-left']  = array( 'widget-search-toggle' );
			$converter['header-bottom-right'] = array( 'widget-subscribe-toggle' );
		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-2-bot-2' ) {

		} elseif ( get_aesthetix_options( 'general_header_type' ) === 'mid-3' ) {
			$converter['header-main-left']  = array( 'widget-search-toggle' );
			$converter['header-main-right'] = array( 'widget-subscribe-toggle' );
		} else {
			$converter['header-main-right'] = array( 'widget-language-switcher', 'widget-search-toggle', 'widget-subscribe-toggle' );
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$converter['footer-main-second'] = array( 'widget-recent-posts' );
			$converter['footer-main-third']  = array( 'widget-menus' );
		}

		if ( get_aesthetix_options( 'general_footer_top_bar_display' ) === true ) {
			$converter['footer-main-first']  = array( 'widget-recent-posts' );
			$converter['footer-main-second'] = array( 'widget-menus' );
			$converter['footer-main-third']  = array( 'widget-contacts', 'widget-socials' );
			$converter['footer-main-fourth'] = array( 'widget-contacts', 'widget-socials' );
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
