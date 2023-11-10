<?php
/**
 * Customizer default options.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_options' ) ) {

	/**
	 * Return array with the default customizer options.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_options( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$aesthetix_defaults = array(
			'general_demo_var'                          => 'demo-1',
			'general_container_width'                   => 'md',
			'general_content_width'                     => 'wide',

			'general_header_top_bar_display'            => false,
			'general_header_type'                       => 'default',
			'general_header_mobile_type'                => 'default',

			'general_menu_align'                        => 'left',

			'general_footer_type'                       => 'footer-four-columns',
			'general_footer_top_bar_display'            => false,
			'general_footer_bottom_bar_display'         => false,

			'general_breadcrumbs_display'               => true,
			'general_breadcrumbs_type'                  => 'woocommerce',
			'general_breadcrumbs_separator'             => '/',

			'general_subscribe_form_display'            => true,
			'general_subscribe_form_type'               => 'theme',
			'general_subscribe_form_title'              => apply_filters( 'get_aesthetix_general_subscribe_form_title', esc_html__( 'Subscribe to our newsletter for all the latest updates', 'aesthetix' ) ),
			'general_subscribe_form_bg'                 => '',
			'general_subscribe_form_shortcode'          => '',

			'general_cookie_display'                    => true,

			'front_page_slider_display'                 => true,
			'front_page_slider_post_type'               => 'post',
			'front_page_slider_slides_count'            => 6,
			'front_page_slider_slides_to_show'          => 4,
			'front_page_slider_slides_template_type'    => 'tils',

			'root_primary_font'                         => 'open-sans',
			'root_secondary_font'                       => 'open-sans',
			'root_color_scheme'                         => 'white',
			'root_primary_color'                        => 'blue',
			'root_secondary_color'                      => 'red',
			'root_gray_color'                           => 'slate',
			'root_link_color'                           => 'primary',

			'root_post_background'                      => 'theme',
			'root_post_thumbnail_padding'               => 'sm',
			'root_post_content_padding'                 => 'lg',
			'root_post_shadow'                          => 'shadow-md',
			'root_post_border_width'                    => 'border',
			'root_post_border_radius'                   => 'rounded-md',

			'root_button_type'                          => 'common',
			'root_button_icon'                          => true,
			'root_button_icon_position'                 => 'before',
			'root_button_size'                          => 'md',
			'root_button_border_width'                  => 'border-2',
			'root_button_border_radius'                 => 'rounded-md',

			'root_menu_button_color'                    => 'primary',
			'root_menu_button_type'                     => 'common',
			'root_menu_button_content'                  => 'button-icon-text',
			'root_menu_button_rounded'                  => false,

			'root_home_button_color'                    => 'primary',
			'root_home_button_display'                  => 'none',
			'root_home_button_type'                     => 'common',
			'root_home_button_content'                  => 'button-icon',
			'root_home_button_rounded'                  => false,

			'root_scroll_top_button_display'            => true,
			'root_scroll_top_button_color'              => 'primary',
			'root_scroll_top_button_type'               => 'common',
			'root_scroll_top_button_content'            => 'button-icon',
			'root_scroll_top_button_rounded'            => false,

			'root_subscribe_popup_form_button_color'    => 'primary',
			'root_subscribe_popup_form_button_type'     => 'common',
			'root_subscribe_popup_form_button_content'  => 'button-icon-text',
			'root_subscribe_popup_form_button_rounded'  => false,

			'root_searchform_form_button_color'         => 'primary',
			'root_searchform_form_button_type'          => 'common',
			'root_searchform_form_button_content'       => 'button-icon',
			'root_searchform_form_button_rounded'       => false,

			'root_searchform_popup_form_button_color'   => 'primary',
			'root_searchform_popup_form_button_type'    => 'common',
			'root_searchform_popup_form_button_content' => 'button-icon',
			'root_searchform_popup_form_button_rounded' => false,

			'root_input_size'                           => 'md',
			'root_input_border_width'                   => 'border-2',
			'root_input_border_radius'                  => 'rounded-md',

			'root_box_shadow'                           => 'shadow-md',
			'root_border_width'                         => 'border-2',
			'root_border_radius'                        => 'rounded-md',
		);

		foreach ( get_post_types() as $key => $post_type ) {
			$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
				'single_' . $post_type . '_template_type' => 'one',
				'archive_' . $post_type . '_masonry'      => false,
				'archive_' . $post_type . '_layout'       => 'grid', // grid, grid-image, list, list-chess
			) );

			if ( in_array( $aesthetix_defaults['archive_' . $post_type . '_layout'], array( 'list', 'list-chess' ), true ) ) {
				$aesthetix_defaults['archive_' . $post_type . '_columns'] = 1;
			} else {
				$aesthetix_defaults['archive_' . $post_type . '_columns'] = 3;
			}
		}

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
				'single_' . $post_type . '_structure'             => 'header,thumbnail,meta,content,footer',
				'single_' . $post_type . '_meta_structure'        => 'date,time,edit',
				'single_' . $post_type . '_footer_structure'      => 'edit',
				'single_' . $post_type . '_post_nav_display'      => false,
				'single_' . $post_type . '_entry_footer_display'  => true,
				'single_' . $post_type . '_similar_posts_display' => true,
				'single_' . $post_type . '_similar_posts_order'   => 'desc',
				'single_' . $post_type . '_similar_posts_orderby' => 'date',
				'single_' . $post_type . '_similar_posts_count'   => 3,
			) );

			$post_type_object  = get_post_type_object( $post_type );
			$object_taxonomies = get_object_taxonomies( $post_type );

			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
					'archive_' . $post_type . '_structure'           => 'meta,title,excerpt,author,more',
					'archive_' . $post_type . '_thumbnail_structure' => 'post_format,sticky',
					'archive_' . $post_type . '_meta_structure'      => 'date,time,edit',
					'archive_' . $post_type . '_posts_per_page'      => get_option( 'posts_per_page' ),
					'archive_' . $post_type . '_posts_order'         => 'desc',
					'archive_' . $post_type . '_posts_orderby'       => 'date',
					'archive_' . $post_type . '_pagination'          => 'numeric',
					'archive_' . $post_type . '_detail_button'       => 'button',
				) );
			}

			if ( $post_type === 'post' ) {
				$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
					'archive_post_thumbnail_structure'      => 'category,post_tag,post_format,sticky',
					'archive_post_meta_structure'           => 'date,category,post_tag,post_format,time,edit',
					'archive_post_taxonomies_display'       => 'tag',
					'single_post_meta_structure'            => 'date,category,post_tag,time,edit',
					'single_post_footer_structure'          => 'category,post_tag,edit',
					'single_post_entry_footer_cats_display' => false,
					'single_post_entry_footer_tags_display' => true,
				) );
			}
		}

		$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
			'other_vkontakte'          => '',
			'other_facebook'           => '',
			'other_instagram'          => '',
			'other_youtube'            => '',
			'other_twitter'            => '',
			'other_telegram'           => '',
			'other_linkedin'           => '',

			'other_whatsapp_phone'     => '',
			'other_telegram_chat_link' => '',
			'other_address'            => '',
			'other_phone'              => '',
			'other_email'              => '',
		) );

		$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
			'title_tagline_logo_size' => 'md',
		) );

		if ( $aesthetix_defaults['general_header_type'] === 'mid-2-bot-2' ) {
			$aesthetix_defaults['root_home_button_display'] = 'menu-start';
		}

		if ( $aesthetix_defaults['general_header_type'] === 'mid-2-bot-3' ) {
			$aesthetix_defaults['root_home_button_display'] = 'menu-center';
		}

		// Merge child and parent default options.
		$aesthetix_defaults = apply_filters( 'get_aesthetix_options', $aesthetix_defaults );

		// Merge defaults and theme options.
		$aesthetix_defaults = wp_parse_args( get_option( 'aesthetix_options', array() ), $aesthetix_defaults );

		// Return controls.
		if ( is_null( $control ) ) {
			return $aesthetix_defaults;
		} elseif ( ! isset( $aesthetix_defaults[ $control ] ) ) {
			return false;
		} else {
			return $aesthetix_defaults[ $control ];
		}
	}
}
