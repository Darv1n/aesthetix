<?php
/**
 * Customizer default options
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_options' ) ) {

	/**
	 * Return array with the default customizer options.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return string|string[]|false
	 */
	function get_aesthetix_options( $control = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$aesthetix_defaults = array(
			'general_container_width'                 => 'average',
			'general_content_width'                   => 'wide',

			'general_header_top_bar_display'          => false,
			'general_header_type'                     => 'header-simple',

			'general_menu_type'                       => 'menu-open',
			'general_menu_position'                   => 'absolute',
			'general_menu_align'                      => 'right',
			'general_menu_button_alignment'           => 'right',
			'general_menu_button_type'                => 'button-icon-text',
			'general_menu_button_icon_position'       => 'before',

			'general_footer_type'                     => 'footer-four-columns',
			'general_footer_top_bar_display'          => false,
			'general_footer_bottom_bar_display'       => false,

			'general_breadcrumbs_display'             => true,
			'general_breadcrumbs_type'                => 'woocommerce',
			'general_breadcrumbs_separator'           => '/',

			'general_scroll_top_button_display'       => true,
			'general_scroll_top_button_alignment'     => 'right',
			'general_scroll_top_button_type'          => 'icon-text',
			'general_scroll_top_button_icon_position' => 'before',

			'general_comments_display'                => false,
			'general_cookie_display'                  => true,
			'general_external_utm_links'              => true,

			'root_primary_font'                       => 'playfair-display',
			'root_secondary_font'                     => 'open-sans',
			'root_color_scheme'                       => 'white',
			'root_sortable_color_scheme'              => 'white,black',
			'root_primary_color'                      => 'sky',
			'root_secondary_color'                    => 'orange',
			'root_gray_color'                         => 'slate',
			'root_link_color'                         => 'primary',
			'root_button_type'                        => 'common',
			'root_button_icon'                        => true,
			'root_button_icon_position'               => 'before',
			'root_button_size'                        => 'btn',
			'root_button_border_width'                => 'border-2',
			'root_button_border_radius'               => 'rounded-md',
			'root_box_shadow'                         => 'shadow-md',
			'root_border_width'                       => 'border-2',
			'root_border_radius'                      => 'rounded-md',

			'sidebar_left_display'                    => true,
			'sidebar_right_display'                   => false,
			'sidebar_display_home'                    => true,
			'sidebar_display_post'                    => true,
			'sidebar_display_page'                    => true,
			'sidebar_display_archive'                 => true,
			'sidebar_display_search'                  => true,
			'sidebar_display_error'                   => true,
			'sidebar_display_author'                  => false,\
		);

		foreach ( get_post_types() as $key => $post_type ) {
			$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
				'single_' . $post_type . '_template_type'  => 'one',
				'archive_' . $post_type . '_columns'       => 'three',
				'archive_' . $post_type . '_template_type' => 'tils',
			) );
		}

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
				'single_' . $post_type . '_meta_display'               => true,
				'single_' . $post_type . '_meta_author_display'        => false,
				'single_' . $post_type . '_meta_date_display'          => true,
				'single_' . $post_type . '_meta_date_modified_display' => false,
				'single_' . $post_type . '_meta_cats_display'          => true,
				'single_' . $post_type . '_meta_tags_display'          => false,
				'single_' . $post_type . '_meta_comments_display'      => false,
				'single_' . $post_type . '_meta_time_display'          => true,
				'single_' . $post_type . '_meta_edit_display'          => true,

				'single_' . $post_type . '_thumbnail_display'          => true,
				'single_' . $post_type . '_post_nav_display'           => false,
				'single_' . $post_type . '_entry_footer_display'       => true,

				'single_' . $post_type . '_similar_posts_display'     => true,
				'single_' . $post_type . '_similar_posts_order'       => 'desc',
				'single_' . $post_type . '_similar_posts_orderby'     => 'date',
				'single_' . $post_type . '_similar_posts_count'       => 3,
			) );

			$post_type_object  = get_post_type_object( $post_type );
			$object_taxonomies = get_object_taxonomies( $post_type );

			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
					'archive_' . $post_type . '_meta_display'          => true,
					'archive_' . $post_type . '_meta_author_display'   => false,
					'archive_' . $post_type . '_meta_date_display'     => true,
					'archive_' . $post_type . '_meta_comments_display' => false,
					'archive_' . $post_type . '_meta_time_display'     => true,
					'archive_' . $post_type . '_meta_edit_display'     => false,
					'archive_' . $post_type . '_posts_per_page'        => get_option( 'posts_per_page' ),
					'archive_' . $post_type . '_posts_order'           => 'desc',
					'archive_' . $post_type . '_posts_orderby'         => 'date',
					'archive_' . $post_type . '_pagination'            => 'numeric',
					'archive_' . $post_type . '_detail_button'         => 'button',
					'archive_' . $post_type . '_detail_description'    => 'excerpt',
				) );
			}

			if ( $post_type === 'post' ) {
				$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
					'single_post_entry_footer_cats_display' => false,
					'single_post_entry_footer_tags_display' => true,
					'archive_post_meta_cats_display'        => false,
					'archive_post_meta_tags_display'        => false,
				) );
			}
		}

		$aesthetix_defaults = array_merge( $aesthetix_defaults, array(
			'other_vkontakte'           => '',
			'other_facebook'            => '',
			'other_instagram'           => '',
			'other_youtube'             => '',
			'other_twitter'             => '',
			'other_telegram'            => '',
			'other_linkedin'            => '',

			'other_whatsapp_phone'      => '',
			'other_telegram_chat_link'  => '',
			'other_address'             => '',
			'other_phone'               => '',
			'other_email'               => '',

			'other_yandex_verification' => '',
			'other_google_verification' => '',
			'other_yandex_counter'      => '',
			'other_google_counter'      => '',
		) );


		// Merge child and parent default options.
		$aesthetix_defaults = apply_filters( 'get_aesthetix_options', $aesthetix_defaults );

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


