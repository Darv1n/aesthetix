<?php
/**
 * Widget Default.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_widget_default' ) ) {

	/**
	 * This function outputs the default widgets according to the specified structure as an array.
	 *
	 * @param array  $structure The right widgets structure for output. Default null
	 * @param string $widget_id Widget ID. Default null
	 *
	 * @return array
	 */
	function aesthetix_widget_default( $widget_id = null, $structure = null ) {

		if ( is_null( $widget_id ) ) {
			return false;
		}

		if ( is_null( $structure ) ) {
			$structure = get_aesthetix_widget_default( $widget_id );
		}

		if ( ! is_array( $structure ) || empty( $structure ) ) {
			return false;
		}

		do_action( 'dynamic_sidebar_before', $widget_id, true );

		foreach ( $structure as $key => $widget_name ) {

			$args = array();

			if ( in_array( $widget_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right' ), true ) ) {

				if ( in_array( get_aesthetix_options( 'root_button_size' ), array( 'lg', 'xl' ), true ) ) {
					$args['button_size'] = 'md';
				}

				if ( $widget_name === 'widget-search-toggle' ) {
					$args['button_content'] = get_aesthetix_options( 'root_searchform_popup_form_button_content' );
				} elseif ( $widget_name === 'widget-subscribe-toggle' ) {
					$args['button_content'] = get_aesthetix_options( 'root_subscribe_popup_form_button_content' );
				} else {
					$args['button_content'] = get_aesthetix_options( 'root_menu_button_content' );
				}

				if ( in_array( $args['button_content'], array( 'button-icon-text', 'button-text', 'button-icon' ), true ) ) {
					$args['button_content'] = 'button-icon';
				} else {
					if ( $widget_name === 'widget-language-switcher' ) {
						$args['button_content'] = 'text-icon';
					} else {
						$args['button_content'] = 'icon';
					}
				}
			}

			if ( in_array( $widget_id, array( 'footer-main-first', 'footer-main-second', 'footer-main-third', 'footer-main-fourth' ), true ) ) {
				if ( $widget_name === 'widget-socials' ) {
					$args['widget_title']    = __( 'Follow us', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Socials', 'aesthetix' );
				}

				if ( $widget_name === 'widget-contacts' ) {
					$args['widget_title']    = __( 'Contact us', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Feel free', 'aesthetix' );
				}

				if ( $widget_name === 'widget-menus' ) {
					$menus = get_registered_nav_menus();
					unset( $menus['primary'] );
					unset( $menus['mobile'] );
					$args['menu_structure']  = implode( ',', array_keys( $menus ) );
					$args['widget_title']    = __( 'Browse', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Help & Info', 'aesthetix' );
				}
			}

			if ( $widget_id === 'aside-menu' && $widget_name === 'widget-socials' ) {
				$args['widget_title']    = __( 'Follow us', 'aesthetix' );
				$args['widget_subtitle'] = __( 'Socials', 'aesthetix' );
			}

			if ( in_array( $widget_id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
				if ( $widget_name === 'widget-language-switcher' ) {
					$args['style'] = 'dropdown';
				}
			}

			if ( $widget_name === 'widget-menus' ) {
				$args['count_items_display'] = true;
			}

			if ( $widget_name === 'widget-recent-posts' ) {
				$args['posts_per_page']      = 2;
				$args['post_title_size']     = 'h6';
				$args['post_layout']         = 'list';
				$args['post_structure']      = 'title,meta';
				$args['post_meta_structure'] = 'author,date';
				$args['widget_title']        = __( 'Recent posts', 'aesthetix' );
			}

			if ( $widget_name === 'widget-adv-banner' ) {
				$args['adv_title']       = 'Aesthetix Themes';
				$args['adv_description'] = __( 'WordPress premium templates', 'aesthetix' );

				if ( in_array( $widget_id, array( 'header-top-left', 'header-top-right', 'header-main-left', 'header-main-center', 'header-main-right', 'header-bottom-left', 'header-bottom-right' ), true ) ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/header-promo-728x90-desktop.png' );
				}

				if ( $widget_id === 'main' ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/aside-promo-300x250-desktop.png' );
				}

				if ( $widget_id === 'after-header' ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
				}

				if ( $widget_id === 'before-post-content' ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-920x90-desktop.png' );
				}

				if ( $widget_id === 'after-post-content' ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
				}

				if ( $widget_id === 'before-footer' ) {
					$args['adv_desktop'] = get_theme_file_uri( '/data/img/adv/content-promo-1200x113-desktop.png' );
				}
			}

			// Merge child and parent default options.
			$args = apply_filters( 'get_aesthetix_widget_default_args', $args, $widget_id, $widget_name );

			switch ( $widget_name ) {
				case has_action( 'aesthetix_widget_default_loop_' . $widget_name ):
					do_action( 'aesthetix_widget_default_loop_' . $widget_name, $args, $widget_id, $widget_name );
					break;
				case 'widget-search-form': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_search_form(); ?>
					</div>
					<?php break;
				case 'widget-logo': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-logo', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-socials': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-socials', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-contacts': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-contacts', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-recent-posts': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-recent-posts', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menus': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menus', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menu': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menu', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menu-primary': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'primary' ) ); ?>
					</div>
					<?php break;
				case 'widget-search-toggle': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-search-toggle', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-subscribe-toggle': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-subscribe-toggle', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-adv-banner': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-adv-banner', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-language-switcher': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-language-switcher', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-copyright': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-copyright', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-creator': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-creator', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-use-materials': ?>
					<div <?php widget_classes( '', $widget_id ); ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-use-materials', '', $args ); ?>
					</div>
					<?php break;
				default:
					if ( locate_template( '/templates/widget/' . $widget_name . '.php' ) !== '' ) { ?>
						<div <?php widget_classes( '', $widget_id ); ?>>
							<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
							<?php get_template_part( 'templates/widget/' . $widget_name, '', $args ); ?>
						</div>
					<?php }
					break;
			}
		}

		do_action( 'dynamic_sidebar_after', $widget_id, true );

		return false;
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
			'main'                 => array(),
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
