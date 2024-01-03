<?php
/**
 * Customizer default options.
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
	 * @param string $control Array key to get one value.
	 *
	 * @return string|array|false
	 */
	function get_aesthetix_options( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$defaults = array(
			'general_demo_var'                          => 'demo-1',
			'general_container_width'                   => 'lg',
			'general_content_width'                     => 'wide',

			'general_header_top_bar_display'            => false,
			'general_header_type'                       => 'default',
			'general_header_mobile_type'                => 'default',

			'general_menu_align'                        => 'left',
			'general_menu_count_items_display'          => false,

			'general_footer_type'                       => 'footer-four-columns',
			'general_footer_top_bar_display'            => false,
			'general_footer_bottom_bar_display'         => true,

			// 'general_breadcrumbs_display'               => true,
			// 'general_breadcrumbs_type'                  => 'woocommerce',
			// 'general_breadcrumbs_separator'             => '/',

			'general_subscribe_form_display'            => true,
			'general_subscribe_form_type'               => 'theme',
			'general_subscribe_form_title'              => apply_filters( 'get_aesthetix_general_subscribe_form_title', esc_html__( 'Subscribe to our newsletter for all the latest updates', 'aesthetix' ) ),
			'general_subscribe_form_bg'                 => '',
			'general_subscribe_form_shortcode'          => '',

			'general_scroll_top_structure'              => 'telegram,whatsapp,scroll-top',
			'general_cookie_display'                    => true,

			'front_page_slider_display'                 => true,
			'front_page_slider_post_type'               => 'post',
			'front_page_slider_slides_count'            => 6,
			'front_page_slider_slides_to_show'          => 4,
			'front_page_slider_slides_layout'           => 'grid', // grid, grid-image, list, list-chess.

			'root_primary_font'                         => 'open-sans',
			'root_secondary_font'                       => 'open-sans',
			'root_color_scheme'                         => 'white',
			'root_primary_color'                        => 'blue',
			'root_secondary_color'                      => 'red',
			'root_gray_color'                           => 'slate',
			'root_link_color'                           => 'primary',
			'root_box_shadow'                           => 'md',
			'root_border_width'                         => 'sm',
			'root_border_radius'                        => 'md',

			'root_button_type'                          => 'common',
			'root_button_icon_position'                 => 'before',
			'root_button_size'                          => 'lg',
			'root_button_border_width'                  => 'sm',
			'root_button_border_radius'                 => 'md',

			'root_menu_button_color'                    => 'primary',
			'root_menu_button_type'                     => 'common',
			'root_menu_button_content'                  => 'button-icon-text', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.

			'root_home_button_color'                    => 'primary',
			'root_home_button_display'                  => 'none',
			'root_home_button_type'                     => 'common',
			'root_home_button_content'                  => 'button-icon', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.

			'root_scroll_top_button_color'              => 'primary',
			'root_scroll_top_button_type'               => 'common',
			'root_scroll_top_button_content'            => 'button-icon', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.

			'root_subscribe_popup_form_button_color'    => 'primary',
			'root_subscribe_popup_form_button_type'     => 'common',
			'root_subscribe_popup_form_button_content'  => 'button-icon-text', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.

			'root_searchform_form_button_color'         => 'primary',
			'root_searchform_form_button_type'          => 'common',
			'root_searchform_form_button_content'       => 'button-icon', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.

			'root_searchform_popup_form_button_color'   => 'primary',
			'root_searchform_popup_form_button_type'    => 'common',
			'root_searchform_popup_form_button_content' => 'button-icon',

			'root_input_size'                           => 'md',
			'root_input_border_width'                   => 'sm',
			'root_input_border_radius'                  => 'md',

			'breadcrumbs_display'                       => true,
			'breadcrumbs_type'                          => 'default',
			'breadcrumbs_separator'                     => '/',
		);

		foreach ( get_post_types() as $key => $post_type ) {
			$defaults = array_merge( $defaults, array(
				'single_' . $post_type . '_template_type' => 'one',
				'archive_' . $post_type . '_masonry'      => false,
				'archive_' . $post_type . '_layout'       => 'grid', // grid, grid-image, list, list-chess.
			) );

			if ( in_array( $defaults['archive_' . $post_type . '_layout'], array( 'list', 'list-chess' ), true ) ) {
				$defaults[ 'archive_' . $post_type . '_columns' ] = 1;
			} else {
				$defaults[ 'archive_' . $post_type . '_columns' ] = 3;
			}
		}

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$post_type_object  = get_post_type_object( $post_type );
			$object_taxonomies = get_object_taxonomies( $post_type );

			$defaults = array_merge( $defaults, array(
				'single_' . $post_type . '_structure'             => 'header,thumbnail,meta,content,footer',
				'single_' . $post_type . '_meta_structure'        => 'date,time,views,edit',
				'single_' . $post_type . '_footer_structure'      => 'likes,edit',
				'single_' . $post_type . '_post_nav_display'      => false,
				'single_' . $post_type . '_entry_footer_display'  => true,
				'single_' . $post_type . '_similar_posts_display' => true,
				'single_' . $post_type . '_similar_posts_order'   => 'desc',
				'single_' . $post_type . '_similar_posts_orderby' => 'date',
				'single_' . $post_type . '_similar_posts_count'   => 3,
			) );

			if ( is_array( $object_taxonomies ) && ! empty( $object_taxonomies ) ) {
				$defaults['breadcrumbs_' . $post_type . '_term'] = $object_taxonomies[0];
			}

			if ( $post_type_object->has_archive ) {
				$defaults['breadcrumbs_' . $post_type . '_archive_display'] = true;
			}

			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$defaults = array_merge( $defaults, array(
					'archive_' . $post_type . '_background'              => 'theme',
					'archive_' . $post_type . '_equal_height'            => 'excerpt',
					'archive_' . $post_type . '_title_size'              => 'h4',
					'archive_' . $post_type . '_thumbnail_aspect_ratio'  => '4-3',
					'archive_' . $post_type . '_thumbnail_padding'       => 'xs',
					'archive_' . $post_type . '_content_padding'         => 'xl',
					'archive_' . $post_type . '_shadow'                  => 'md',
					'archive_' . $post_type . '_border_width'            => 'xs',
					'archive_' . $post_type . '_border_radius'           => 'md',

					'archive_' . $post_type . '_structure'               => 'meta,title,excerpt,author,more',
					'archive_' . $post_type . '_meta_structure'          => 'date,time,views,likes,edit',
					'archive_' . $post_type . '_thumbnail_default'       => true,
					'archive_' . $post_type . '_thumbnail_before'        => '',
					'archive_' . $post_type . '_thumbnail_after'         => 'post_format,sticky',
					'archive_' . $post_type . '_posts_per_page'          => get_option( 'posts_per_page' ),
					'archive_' . $post_type . '_posts_order'             => 'desc',
					'archive_' . $post_type . '_posts_orderby'           => 'date',
					'archive_' . $post_type . '_pagination'              => 'numeric',
					'archive_' . $post_type . '_more_button_content'     => 'link-icon-text', // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon.
				) );
			}

			if ( $post_type === 'post' ) {
				$defaults = array_merge( $defaults, array(
					'single_post_meta_structure'            => 'date,category,post_tag,time,views,edit',
					'single_post_footer_structure'          => 'category,post_tag,likes,edit',
					'single_post_entry_footer_cats_display' => false,
					'single_post_entry_footer_tags_display' => true,
					'archive_post_meta_structure'           => 'date,category,post_tag,post_format,time,views,likes,edit',
					'archive_post_thumbnail_before'         => 'category',
					'archive_post_thumbnail_after'          => 'post_format,sticky',
				) );
			}
		}

		$defaults = array_merge( $defaults, array(
			'comments_ajax'      => true,
			'comments_structure' => 'header,content,notifications,footer',
		) );

		$defaults = array_merge( $defaults, array(
			'other_address'       => '',
			'other_phone'         => '',
			'other_email'         => '',
			'other_whatsapp'      => '',
			'other_telegram_chat' => '',
		) );

		foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
			$defaults[ 'other_' . $key ] = '';
		}

		$defaults = array_merge( $defaults, array(
			'title_tagline_logo_size' => 'md',
		) );

		if ( $defaults['general_header_type'] === 'mid-2-bot-2' ) {
			$defaults['root_home_button_display'] = 'menu-start';
		}

		if ( $defaults['general_header_type'] === 'mid-2-bot-3' ) {
			$defaults['root_home_button_display'] = 'menu-center';
		}

		// Merge child and parent default options.
		$defaults = apply_filters( 'get_aesthetix_options', $defaults );

		// Merge defaults and theme options.
		$defaults = wp_parse_args( get_option( 'aesthetix_options', array() ), $defaults );

		// Return controls.
		if ( is_null( $control ) ) {
			return $defaults;
		} elseif ( ! isset( $defaults[ $control ] ) ) {
			return false;
		} else {
			return $defaults[ $control ];
		}
	}
}
