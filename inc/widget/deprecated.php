<?php

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
			'main'                 => array( 'widget-user', 'widget-slider-posts', 'widget-recent-posts', 'widget-adv-banner', 'widget-recent-users' ),
			'aside-menu'           => array( 'widget-socials', 'widget-language-switcher' ),
			'after-header'         => array( 'widget-slider-posts', 'widget-breadcrumbs', 'widget-adv-banner' ),
			'before-footer'        => array( 'widget-adv-banner', 'widget-subscribe-form' ),
			'before-post-content'  => array( 'widget-user', 'widget-subscribe-form' ),
			'after-post-content'   => array( 'widget-user', 'widget-subscribe-form' ),
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
x