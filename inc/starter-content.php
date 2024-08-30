<?php
/**
 * Starter content.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_starter_content' ) ) {

	/**
	 * Function to return the array of starter content for the theme.
	 * ONLY widgets are imported here.
	 * Menus, categories and posts are imported via a standard import file.
	 *
	 * @return array
	 */
	function aesthetix_starter_content() {

		$starter_content = array(
			'widgets' => array(
				'main'                 => array(
					'aesthetix-widget-table-of-contents' => array( 'aesthetix-widget-table-of-contents', array(
						'title'    => __( 'Table of contents', 'aesthetix' ),
						'subtitle' => __( 'Additional menu', 'aesthetix' ),
					), ),
					'aesthetix-widget-user'              => array( 'aesthetix-widget-user', array(
						'title'    => __( 'Author', 'aesthetix' ),
						'subtitle' => __( 'About me', 'aesthetix' ),
					), ),
					'aesthetix-widget-slider-posts'      => array( 'aesthetix-widget-slider-posts', array(
						'title'          => __( 'Featured', 'aesthetix' ),
						'subtitle'       => __( 'Our best picks', 'aesthetix' ),
						'posts_to_show'  => 1,
						'posts_per_page' => 4,
					), ),
					'aesthetix-widget-adv-banner'        => array( 'aesthetix-widget-adv-banner', array(
						'adv_desktop' => get_theme_file_uri( 'assets/img/promo/promo-default-004.jpg' ),
						'adv_link'    => 'https://aesthetix-pro.zolin.digital/',
						'adv_alt'     => 'Aesthetix PRO ' . __( 'Banner', 'aesthetix' ),
					), ),
					'aesthetix-widget-recent-posts'      => array( 'aesthetix-widget-recent-posts', array(
						'title'    => __( 'Trending', 'aesthetix' ),
						'subtitle' => __( 'Popular Posts', 'aesthetix' ),
					), ),
					'aesthetix-widget-recent-users'      => array( 'aesthetix-widget-recent-users', array(
						'title'    => __( 'Edithors', 'aesthetix' ),
						'subtitle' => __( 'By post count', 'aesthetix' ),
					), ),
				),
				'aside-menu'           => array(
					'aesthetix-widget-socials'           => array( 'aesthetix-widget-socials', array(
						'button_content' => 'button-icon',
					), ),
					// 'aesthetix-widget-language-switcher' => array( 'aesthetix-widget-language-switcher', array(), ),
				),
				'after-header'         => array(
					'aesthetix-widget-slider-posts-2' => array( 'aesthetix-widget-slider-posts', array(
						'posts_to_show'  => 4,
						'posts_per_page' => 8,
						'display'        => 'front-page',
					), ),
					'aesthetix-widget-breadcrumbs'  => array( 'aesthetix-widget-breadcrumbs', array(
						'display'        => 'not-front-page',
					), ),
				),
				'before-footer'        => array(
					'aesthetix-widget-subscribe-form' => array( 'aesthetix-widget-subscribe-form', array(
						'background_image' => get_theme_file_uri( 'assets/img/promo/promo-bg-001.jpg' ),
					), ),
				),
				'before-post-content'  => array(
					'aesthetix-widget-adv-banner'   => array( 'aesthetix-widget-adv-banner', array(
						'adv_desktop' => get_theme_file_uri( 'assets/img/promo/promo-default-002.jpg' ),
						'adv_link'    => 'https://aesthetix-pro.zolin.digital/',
						'adv_alt'     => 'Aesthetix PRO ' . __( 'Banner', 'aesthetix' ),
					), ),
				),
				'after-post-content'   => array(
					'aesthetix-widget-adv-banner'   => array( 'aesthetix-widget-adv-banner', array(
						'adv_desktop' => get_theme_file_uri( 'assets/img/promo/promo-default-002.jpg' ),
						'adv_link'    => 'https://aesthetix-pro.zolin.digital/',
						'adv_alt'     => 'Aesthetix PRO ' . __( 'Banner', 'aesthetix' ),
					), ),
				),
				'header-mobile-left'   => array(
					'aesthetix-widget-logo' => array( 'aesthetix-widget-logo', array(), ),
				),
				'header-mobile-center' => array(
					'aesthetix-widget-logo' => array( 'aesthetix-widget-logo', array(), ),
				),
				'header-mobile-right'  => array(
					'aesthetix-widget-search-toggle'    => array( 'aesthetix-widget-search-toggle', array(
						'button_content' => 'button-icon',
					), ),
					'aesthetix-widget-subscribe-toggle' => array( 'aesthetix-widget-subscribe-toggle', array(
						'button_content' => 'button-icon',
					), ),
				),
				'header-top-left'      => array(),
				'header-top-right'     => array(),
				'header-main-left'     => array(
					'aesthetix-widget-logo' => array( 'aesthetix-widget-logo', array(), ),
				),
				'header-main-center'   => array(
					'aesthetix-widget-logo' => array( 'aesthetix-widget-logo', array(), ),
				),
				'header-main-right'    => array(
					'aesthetix-widget-language-switcher' => array( 'aesthetix-widget-language-switcher', array(), ),
					'aesthetix-widget-search-toggle'     => array( 'aesthetix-widget-search-toggle', array(), ),
					'aesthetix-widget-subscribe-toggle'  => array( 'aesthetix-widget-subscribe-toggle', array(), ),
				),
				'header-bottom-left'   => array(
					'aesthetix-widget-subscribe-toggle' => array( 'aesthetix-widget-subscribe-toggle', array(), ),
				),
				'header-bottom-right'  => array(
					'aesthetix-widget-search-toggle'    => array( 'aesthetix-widget-search-toggle', array(), ),
					'aesthetix-widget-subscribe-toggle' => array( 'aesthetix-widget-subscribe-toggle', array(), ),
				),
				'footer-top-left'      => array(
					'aesthetix-widget-logo' => array( 'aesthetix-widget-logo', array(), ),
				),
				'footer-top-right'     => array(),
				'footer-main-first'    => array(
					'aesthetix-widget-logo'    => array( 'aesthetix-widget-logo', array(), ),
					'aesthetix-widget-socials' => array( 'aesthetix-widget-socials', array(
						'title'          => __( 'Follow us', 'aesthetix' ),
						'subtitle'       => __( 'Socials', 'aesthetix' ),
						'button_content' => 'button-icon',
					), ),
					// 'aesthetix-widget-language-switcher' => array( 'aesthetix-widget-language-switcher', array(
					// 	'style' => 'inline',
					// ), ),
				),
				'footer-main-second'   => array(
					'aesthetix-widget-recent-posts' => array( 'aesthetix-widget-recent-posts', array(
						'title'          => __( 'Trending', 'aesthetix' ),
						'subtitle'       => __( 'Popular Posts', 'aesthetix' ),
						'posts_per_page' => 2,
					), ),
				),
				'footer-main-third'    => array(
					'aesthetix-widget-menus' => array( 'aesthetix-widget-menus', array(
						'title'    => __( 'Browse', 'aesthetix' ),
						'subtitle' => __( 'Help & Info', 'aesthetix' ),
					), ),
				),
				'footer-main-fourth'   => array(
					'aesthetix-widget-contacts' => array( 'aesthetix-widget-contacts', array(
						'title'    => __( 'Contact us', 'aesthetix' ),
						'subtitle' => __( 'Feel free', 'aesthetix' ),
					), ),
				),
				'footer-bottom-left'   => array(
					'aesthetix-widget-creator' => array( 'aesthetix-widget-creator', array(), ),
				),
				'footer-bottom-right'  => array(
					'aesthetix-widget-copyright' => array( 'aesthetix-widget-copyright', array(), ),
				),
			),
		);

		return apply_filters( 'aesthetix_starter_content', $starter_content );
	}
}
