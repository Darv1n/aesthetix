<?php
/**
 * Widget Default.
 * 
 * @since 1.3.2
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
	 * @since 1.2.9
	 *
	 * @param array  $structure The right widgets structure for output. Default null
	 * @param string $id        Widget ID. Default null
	 *
	 * @return array
	 */
	function aesthetix_widget_default( $id = null, $structure = null ) {

		if ( is_null( $id ) ) {
			return false;
		}

		if ( is_null( $structure ) ) {
			$structure = get_aesthetix_widget_default( $id );
		}

		if ( ! is_array( $structure ) || empty( $structure ) ) {
			return false;
		}

		$args = array();

		foreach ( $structure as $key => $value ) {

			if ( in_array( $id, array( 'header-mobile-left', 'header-mobile-center', 'header-mobile-right' ), true ) && in_array( $value, array( 'widget-search-toggle', 'widget-subscribe-toggle' ), true ) ) {

				if ( in_array( get_aesthetix_options( 'root_button_size' ), array( 'lg', 'xl' ), true ) ) {
					$args['button_size'] = 'md';
				}

				if ( $value === 'widget-search-toggle' ) {
					$button_content = get_aesthetix_options( 'root_searchform_popup_form_button_content' );
				} elseif ( $value === 'widget-subscribe-toggle' ) {
					$button_content = get_aesthetix_options( 'root_subscribe_popup_form_button_content' );
				}

				if ( isset( $button_content ) ) {
					if ( in_array( $button_content, array( 'button-icon-text', 'button-text', 'button-icon' ), true ) ) {
						$args['button_content'] = 'button-icon';
					} else {
						$args['button_content'] = 'icon';
					}
				}
			}

			if ( in_array( $id, array( 'footer-main-first', 'footer-main-second', 'footer-main-third', 'footer-main-fourth' ), true ) ) {
				if ( $value === 'widget-socials' ) {
					$args['widget_title']    = __( 'Follow us', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Socials', 'aesthetix' );
				}

				if ( $value === 'widget-contacts' ) {
					$args['widget_title']    = __( 'Contact us', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Feel free', 'aesthetix' );
				}

				if ( $value === 'widget-menus' ) {
					$menus = get_registered_nav_menus();
					unset( $menus['primary'] );
					unset( $menus['mobile'] );
					$args['menu_structure']  = implode( ',', array_keys( $menus ) );
					$args['widget_title']    = __( 'Browse', 'aesthetix' );
					$args['widget_subtitle'] = __( 'Help & Info', 'aesthetix' );
				}
			}

			if ( $value === 'widget-menus' ) {
				$args['menu_titles']         = get_registered_nav_menus();
				$args['count_items_display'] = true;
			}

			if ( $value === 'widget-recent-posts' ) {
				$args['posts_per_page']               = 2;
				$args['post_layout']                  = 'list';
				$args['post_structure']               = 'taxonomies,title,meta';
				$args['post_meta_structure']          = 'author,date';
				$args['post_taxonomies_structure']    = 'category';
				$args['post_taxonomies_in_thumbnail'] = false;
			}

			switch ( $value ) {
				case has_action( 'aesthetix_aesthetix_widget_default_loop_' . $value ):
					do_action( 'aesthetix_aesthetix_widget_default_loop_' . $value );
					break;
				case 'widget-logo': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-logo', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-search-toggle': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-search-toggle', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-subscribe-toggle': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-subscribe-toggle', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-socials': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-socials', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-contacts': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-contacts', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-adv-banner': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-adv-banner', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-recent-posts': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-recent-posts', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menus': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menus', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menu': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menu', '', $args ); ?>
					</div>
					<?php break;
				case 'widget-menu-primary': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'primary' ) ); ?>
					</div>
					<?php break;
				case 'search-form': ?>
					<div <?php widget_classes( '', $id ) ?>>
						<?php get_template_part( 'templates/widget/widget-entry-title', '', $args ); ?>
						<?php get_search_form(); ?>
					</div>
					<?php break;
				default:
					break;
			}
		}

		return false;
	}
}

if ( ! function_exists( 'get_aesthetix_widget_default' ) ) {

	/**
	 * Return array with the default widget.
	 * 
	 * @since 1.3.2
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
			'footer-main-first'    => array( 'widget-recent-posts' ),
			'footer-main-second'   => array( 'widget-menus' ),
			'footer-main-third'    => array( 'widget-contacts', 'widget-socials' ),
			'footer-main-fourth'   => array( 'widget-contacts', 'widget-socials' ),
			'footer-bottom-left'   => array(),
			'footer-bottom-right'  => array(),
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
			$converter['header-main-right'] = array( 'widget-search-toggle', 'widget-subscribe-toggle' );
		}

		if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
			$converter['footer-main-second'] = array( 'widget-recent-posts' );
			$converter['footer-main-third']  = array( 'widget-menus' );
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
