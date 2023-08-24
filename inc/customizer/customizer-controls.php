<?php
/**
 * Customizer controls array
 *
 * @package aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_controls' ) ) {

	/**
	 * Return array with customizer controls.
	 *
	 * @param string $control array key to get one value.
	 *
	 * @return array
	 */
	function get_aesthetix_customizer_controls( $control = null ) {

		// Selects.
		$root_color_scheme_select = array(
			'white' => __( 'White', 'aesthetix' ),
			// 'light' => __( 'Light', 'aesthetix' ),
			// 'dark'  => __( 'Dark', 'aesthetix' ),
			'black' => __( 'Black', 'aesthetix' ),
		);

		$general_container_width_select = array(
			'narrow'  => __( 'Narrow', 'aesthetix' ),
			'general' => __( 'General', 'aesthetix' ),
			'average' => __( 'Average', 'aesthetix' ),
			'wide'    => __( 'Wide', 'aesthetix' ),
			'fluid'   => __( 'Fluid', 'aesthetix' ),
		);

		$general_content_width_select = array(
			'narrow' => __( 'Narrow', 'aesthetix' ),
			'wide'   => __( 'Wide', 'aesthetix' ),
		);

		$general_header_type_select = array(
			'header-simple'      => __( 'Header Simple', 'aesthetix' ),
			'header-logo-center' => __( 'Header Logo Center', 'aesthetix' ),
			'header-content'     => __( 'Header Content', 'aesthetix' ),
		);

		$general_menu_type_select = array(
			'menu-open'  => __( 'Open', 'aesthetix' ),
			'menu-close' => __( 'Close', 'aesthetix' ),
		);

		$general_menu_position_select = array(
			'absolute' => __( 'Absolute', 'aesthetix' ),
			'fixed'    => __( 'Fixed', 'aesthetix' ),
		);

		$general_menu_align_select = array(
			'right'  => __( 'Right', 'aesthetix' ),
			'left'   => __( 'Left', 'aesthetix' ),
			'center' => __( 'Center', 'aesthetix' ),
		);

		$general_menu_button_align_select = array(
			'right'  => __( 'Right', 'aesthetix' ),
			'left'   => __( 'Left', 'aesthetix' ),
			'center' => __( 'Center', 'aesthetix' ),
		);

		$general_menu_button_type_select = array(
			'button-icon-text' => __( 'Button + Icon + Text', 'aesthetix' ),
			'button-icon'      => __( 'Button + Icon', 'aesthetix' ),
			'button-text'      => __( 'Button + Text', 'aesthetix' ),
			'icon'             => __( 'Icon', 'aesthetix' ),
			'icon-text'        => __( 'Icon + Text', 'aesthetix' ),
			'text'             => __( 'Text', 'aesthetix' ),
		);

		$general_breadcrumbs_select = array(
			'woocommerce' => __( 'WooCommerce (Plugin must be activated)', 'aesthetix' ),
			'navxt'       => __( 'Breadcrumb NavXT plugin', 'aesthetix' ),
			'yoast'       => __( 'Yoast (Must be enabled in the plugin)', 'aesthetix' ),
			'rankmath'    => __( 'RankMath (Must be enabled in the plugin)', 'aesthetix' ),
			'seopress'    => __( 'SEOPress (Must be enabled in the plugin)', 'aesthetix' ),
		);

		$general_footer_type_select = array(
			'footer-simple'        => __( 'Footer Simple', 'aesthetix' ),
			'footer-three-columns' => __( 'Footer Three Columns', 'aesthetix' ),
			'footer-four-columns'  => __( 'Footer Four Columns', 'aesthetix' ),
		);

		$alignment_select = array(
			'right' => __( 'Right', 'aesthetix' ),
			'left'  => __( 'Left', 'aesthetix' ),
		);

		$alignment_pseudo_select = array(
			'before' => __( 'Before', 'aesthetix' ),
			'after'  => __( 'After', 'aesthetix' ),
		);

		$single_post_template_type_select = array(
			'one' => __( 'One', 'aesthetix' ),
			'two' => __( 'Two', 'aesthetix' ),
		);

		$archive_page_order_select = array(
			'asc'  => 'ASC',
			'desc' => 'DESC',
		);

		$archive_page_columns_select = array(
			'one'   => __( 'One', 'aesthetix' ),
			'two'   => __( 'Two', 'aesthetix' ),
			'three' => __( 'Three', 'aesthetix' ),
			'four'  => __( 'Four', 'aesthetix' ),
			'five'  => __( 'Five', 'aesthetix' ),
			'six'   => __( 'Six', 'aesthetix' ),
		);

		$archive_page_template_type_select = array(
			'list'    => __( 'List', 'aesthetix' ),
			'tils'    => __( 'Tils', 'aesthetix' ),
			'banner'  => __( 'Banner', 'aesthetix' ),
			'simple'  => __( 'Simple', 'aesthetix' ),
		);

		$archive_page_pagination_select = array(
			'default' => __( 'Default', 'aesthetix' ),
			'numeric' => __( 'Numeric', 'aesthetix' ),
		);

		$archive_page_detail_description_select = array(
			'nothing' => __( 'Nothing', 'aesthetix' ),
			'excerpt' => __( 'Excerpt', 'aesthetix' ),
			'content' => __( 'Content', 'aesthetix' ),
		);

		$archive_page_detail_button_select = array(
			'button'  => __( 'Button', 'aesthetix' ),
			'link'    => __( 'Link', 'aesthetix' ),
			'nothing' => __( 'Nothing', 'aesthetix' ),
		);

		$bg_image_size = array(
			'cover'   => __( 'Cover', 'aesthetix' ),
			'initial' => __( 'Pattern', 'aesthetix' ),
		);

		$aesthetix_controls = array();

		// General common options.
		$aesthetix_controls['general'] = array(
			'content_tab_title'               => array( 'tab_title', __( 'Content', 'aesthetix' ), '' ),
			'container_width'                 => array( 'select_control', __( 'Select container width', 'aesthetix' ), __( 'Here you can change the width of the site', 'aesthetix' ), $general_container_width_select ),
			'content_width'                   => array( 'select_control', __( 'Select content width', 'aesthetix' ), __( 'Note: its work if sidebar dont show', 'aesthetix' ), $general_content_width_select ),

			'header_tab_title'                => array( 'tab_title', __( 'Header', 'aesthetix' ), '' ),
			'header_top_bar_display'          => array( 'checkbox_control', __( 'Top bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars before the header of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'header_type'                     => array( 'select_control', __( 'Select header type', 'aesthetix' ), '', $general_header_type_select ),

			'menu_tab_title'                  => array( 'tab_title', __( 'Menu', 'aesthetix' ), '' ),
			'menu_type'                       => array( 'select_control', __( 'Select menu type', 'aesthetix' ), '', $general_menu_type_select ),
			'menu_position'                   => array( 'select_control', __( 'Select menu position', 'aesthetix' ), __( 'Position of the menu container when opened', 'aesthetix' ), $general_menu_position_select ),
			'menu_align'                      => array( 'select_control', __( 'Select menu alignment', 'aesthetix' ), __( 'Alignment of the menu container', 'aesthetix' ), $general_menu_align_select ),
			'menu_button_alignment'           => array( 'select_control', __( 'Select menu button alignment', 'aesthetix' ), '', $general_menu_button_align_select ),
			'menu_button_type'                => array( 'select_control', __( 'Select menu button type', 'aesthetix' ), '', $general_menu_button_type_select ),
			'menu_button_icon_position'       => array( 'select_control', __( 'Select menu button icon position', 'aesthetix' ), '', $alignment_pseudo_select ),

			'footer_tab_title'                => array( 'tab_title', __( 'Footer', 'aesthetix' ), '' ),
			'footer_top_bar_display'          => array( 'checkbox_control', __( 'Top bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars before the footer of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'footer_bottom_bar_display'       => array( 'checkbox_control', __( 'Bottom bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars after the footer of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'footer_type'                     => array( 'select_control', __( 'Select footer type', 'aesthetix' ), '', $general_footer_type_select ),

			'breadcrumbs_tab_title'           => array( 'tab_title', __( 'Breadcrumbs', 'aesthetix' ), '' ),
			'breadcrumbs_display'             => array( 'checkbox_control', __( 'Breadcrumbs display', 'aesthetix' ), '' ),
			'breadcrumbs_type'                => array( 'select_control', __( 'Select breadcrumbs type', 'aesthetix' ), '', $general_breadcrumbs_select ),
			'breadcrumbs_separator'           => array( 'text_control', __( 'Breadcrumbs separator', 'aesthetix' ), '' ),

			'scroll_top_tab_title'            => array( 'tab_title', __( 'Scroll top', 'aesthetix' ), '' ),
			'scroll_top_button_display'       => array( 'checkbox_control', __( 'Scroll to top button display', 'aesthetix' ), '' ),
			'scroll_top_button_alignment'     => array( 'select_control', __( 'Select scroll top button alignment', 'aesthetix' ), '', $alignment_select ),
			'scroll_top_button_type'          => array( 'select_control', __( 'Select scroll top button type', 'aesthetix' ), '', $general_menu_button_type_select ),
			'scroll_top_button_icon_position' => array( 'select_control', __( 'Select scroll top button icon position', 'aesthetix' ), '', $alignment_pseudo_select ),

			'other_tab_title'                 => array( 'tab_title', __( 'Other', 'aesthetix' ), '' ),
			'comments_display'                => array( 'checkbox_control', __( 'Comments display', 'aesthetix' ), __( 'Comments block hide/display', 'aesthetix' ) ),
			'cookie_display'                  => array( 'checkbox_control', __( 'Cookie display', 'aesthetix' ), __( 'Displays a notification about the use of cookies on the site', 'aesthetix' ) ),
			'external_utm_links'              => array( 'checkbox_control', __( 'External UTM Links', 'aesthetix' ), __( 'Adds utm tags to all external links', 'aesthetix' ) ),
		);

		// Sidebar options.
		$aesthetix_controls['root'] = array(
			'fonts_tab_title'      => array( 'tab_title', __( 'Fonts', 'aesthetix' ), '' ),
			'primary_font'         => array( 'select_control', __( 'Select primary font', 'aesthetix' ), '', get_aesthetix_customizer_fonts() ),
			'secondary_font'       => array( 'select_control', __( 'Select secondary font', 'aesthetix' ), '', get_aesthetix_customizer_fonts() ),
			'colors_tab_title'     => array( 'tab_title', __( 'Colors', 'aesthetix' ), '' ),
			'sortable_color_scheme'         => array( 'sortable_control', __( 'Select color scheme', 'aesthetix' ), '', $root_color_scheme_select ),
			'color_scheme'         => array( 'select_control', __( 'Select color scheme', 'aesthetix' ), '', $root_color_scheme_select ),
			'primary_color'        => array( 'select_control', __( 'Select primary color', 'aesthetix' ), '', get_aesthetix_customizer_colors() ),
			'secondary_color'      => array( 'select_control', __( 'Select secondary color', 'aesthetix' ), '', get_aesthetix_customizer_colors() ),
			'gray_color'           => array( 'select_control', __( 'Select gray color', 'aesthetix' ), '', get_aesthetix_customizer_gray_colors() ),
			'link_color'           => array( 'select_control', __( 'Select link color', 'aesthetix' ), '', get_aesthetix_customizer_link_colors() ),
			'buttons_tab_title'    => array( 'tab_title', __( 'Buttons', 'aesthetix' ), '' ),
			'button_type'          => array( 'select_control', __( 'Select button type', 'aesthetix' ), '', get_aesthetix_customizer_button_types() ),
			'button_icon'          => array( 'checkbox_control', __( 'Display button icons', 'aesthetix' ), '', '' ),
			'button_icon_position' => array( 'select_control', __( 'Select button icon position', 'aesthetix' ), '', $alignment_pseudo_select ),
			'button_size'          => array( 'select_control', __( 'Select button size', 'aesthetix' ), '', get_aesthetix_customizer_button_sizes() ),
			'button_border_width'  => array( 'select_control', __( 'Select button border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'button_border_radius' => array( 'select_control', __( 'Select button border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),
			'other_tab_title'      => array( 'tab_title', __( 'Other', 'aesthetix' ), '' ),
			'box_shadow'           => array( 'select_control', __( 'Select element shadow', 'aesthetix' ), '', get_aesthetix_customizer_box_shadows() ),
			'border_width'         => array( 'select_control', __( 'Select element border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'border_radius'        => array( 'select_control', __( 'Select element border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),
		);

		// Sidebar options.
		$aesthetix_controls['sidebar'] = array(
			'tab_title'       => array( 'tab_title', __( 'Which pages display sidebar', 'aesthetix' ), '' ),
			'left_display'    => array( 'checkbox_control', __( 'Left Sidebar Display', 'aesthetix' ), '' ),
			'right_display'   => array( 'checkbox_control', __( 'Right Sidebar Display', 'aesthetix' ), '' ),
			'display_home'    => array( 'checkbox_control', __( 'Home page', 'aesthetix' ), '' ),
			'display_post'    => array( 'checkbox_control', __( 'Single post', 'aesthetix' ), '' ),
			'display_page'    => array( 'checkbox_control', __( 'Single page', 'aesthetix' ), '' ),
			'display_archive' => array( 'checkbox_control', __( 'Archive page', 'aesthetix' ), '' ),
			'display_search'  => array( 'checkbox_control', __( 'Search page', 'aesthetix' ), '' ),
			'display_error'   => array( 'checkbox_control', __( '404 page', 'aesthetix' ), '' ),
			'display_author'  => array( 'checkbox_control', __( 'Author page', 'aesthetix' ), '' ),
		);

		$post_types = get_aesthetix_customizer_post_types();

		foreach ( $post_types as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$post_type_object  = get_post_type_object( $post_type );
			$object_taxonomies = get_object_taxonomies( $post_type );

			$archive_page_orderby_select = array(
				'date'       => __( 'By date', 'aesthetix' ),
				'modified'   => __( 'By modified date', 'aesthetix' ),
				'title'      => __( 'By title', 'aesthetix' ),
				'rand'       => __( 'By random', 'aesthetix' ),
			);

			if ( post_type_supports( $post_type, 'page-attributes' ) ) {
				$archive_page_orderby_select['menu_order'] = __( 'By menu order', 'aesthetix' );
			}

			// Single $post_type options.
			$aesthetix_controls['single_' . $post_type] = array(
				'meta_title'                 => array( 'tab_title', __( 'Meta options', 'aesthetix' ), '' ),
				'meta_display'               => array( 'checkbox_control', __( 'Meta display', 'aesthetix' ), '' ),
				'meta_author_display'        => array( 'checkbox_control', __( 'Meta author display', 'aesthetix' ), '' ),
				'meta_date_display'          => array( 'checkbox_control', __( 'Meta publish date display', 'aesthetix' ), '' ),
				'meta_date_modified_display' => array( 'checkbox_control', __( 'Meta modified date display', 'aesthetix' ), '' ),
				'meta_cats_display'          => array( 'checkbox_control', __( 'Meta categoties display', 'aesthetix' ), '' ),
				'meta_tags_display'          => array( 'checkbox_control', __( 'Meta tags display', 'aesthetix' ), '' ),
				'meta_comments_display'      => array( 'checkbox_control', __( 'Meta comments display', 'aesthetix' ), '' ),
				'meta_time_display'          => array( 'checkbox_control', __( 'Meta read time display', 'aesthetix' ), '' ),
				'meta_edit_display'          => array( 'checkbox_control', __( 'Meta edit display', 'aesthetix' ), '' ),

				'options_title'              => array( 'tab_title', __( 'Post options', 'aesthetix' ), '' ),
				'template_type'              => array( 'select_control', __( 'Select template type', 'aesthetix' ), __( 'This field displays template of the post', 'aesthetix' ), $single_post_template_type_select ),
				'thumbnail_display'          => array( 'checkbox_control', __( 'Thumbnail display', 'aesthetix' ), '' ),
				'post_nav_display'           => array( 'checkbox_control', __( 'Prev/next post navigation display', 'aesthetix' ), '' ),
				'entry_footer_display'       => array( 'checkbox_control', __( 'Entry footer display', 'aesthetix' ), '' ),
			);

			// Archive $post_type options.
			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$aesthetix_controls['archive_' . $post_type] = array(
					'meta_title'            => array( 'tab_title', __( 'Meta options', 'aesthetix' ), '' ),
					'meta_display'          => array( 'checkbox_control', __( 'Meta display', 'aesthetix' ), '' ),
					'meta_author_display'   => array( 'checkbox_control', __( 'Meta author display', 'aesthetix' ), '' ),
					'meta_date_display'     => array( 'checkbox_control', __( 'Meta publish date display', 'aesthetix' ), '' ),
				);
			}

			if ( $post_type === 'post' ) {
				$aesthetix_controls['archive_' . $post_type] = array_merge( $aesthetix_controls['archive_' . $post_type], array(
					'meta_cats_display'     => array( 'checkbox_control', __( 'Meta categoties display', 'aesthetix' ), '' ),
					'meta_tags_display'     => array( 'checkbox_control', __( 'Meta tags display', 'aesthetix' ), '' ),
				) );
			}

			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$aesthetix_controls['archive_' . $post_type] = array_merge( $aesthetix_controls['archive_' . $post_type], array(
					'meta_comments_display' => array( 'checkbox_control', __( 'Meta comments display', 'aesthetix' ), '' ),
					'meta_time_display'     => array( 'checkbox_control', __( 'Meta read time display', 'aesthetix' ), '' ),
					'meta_edit_display'     => array( 'checkbox_control', __( 'Meta edit display', 'aesthetix' ), '' ),

					'options_title'         => array( 'tab_title', __( 'Main options', 'aesthetix' ), '' ),
					'columns'               => array( 'select_control', __( 'Select columns of posts', 'aesthetix' ), __( 'Choose how many columns to display posts', 'aesthetix' ), $archive_page_columns_select ),
					'template_type'         => array( 'select_control', __( 'Select template type', 'aesthetix' ), __( 'This field displays template of posts', 'aesthetix' ), $archive_page_template_type_select ),
					'posts_per_page'        => array( 'number_control', __( 'Select posts per page', 'aesthetix' ), array( 'step' => '1' ) ),
					'posts_order'           => array( 'select_control', __( 'Select posts order', 'aesthetix' ), '', $archive_page_order_select ),
					'posts_orderby'         => array( 'select_control', __( 'Select posts orderby', 'aesthetix' ), '', $archive_page_orderby_select ),
					'pagination'            => array( 'select_control', __( 'Post Pagination', 'aesthetix' ), '', $archive_page_pagination_select ),

					'detail_description'    => array( 'select_control', __( 'Select description', 'aesthetix' ), '', $archive_page_detail_description_select ),
					'detail_button'         => array( 'select_control', __( 'Select button type', 'aesthetix' ), '', $archive_page_detail_button_select ),
				) );
			}

			if ( $post_type === 'post' ) {
				$aesthetix_controls['single_' . $post_type] = array_merge( $aesthetix_controls['single_' . $post_type], array(
					'entry_footer_cats_display' => array( 'checkbox_control', __( 'Entry footer cats display', 'aesthetix' ), '' ),
					'entry_footer_tags_display' => array( 'checkbox_control', __( 'Entry footer tags display', 'aesthetix' ), '' ),
					'similar_posts_display'     => array( 'checkbox_control', __( 'Similar posts display', 'aesthetix' ), '' ),
					'similar_posts_order'       => array( 'select_control', __( 'Select posts order', 'aesthetix' ), '', $archive_page_order_select ),
					'similar_posts_orderby'     => array( 'select_control', __( 'Select posts orderby', 'aesthetix' ), '', $archive_page_orderby_select ),
					'similar_posts_count'       => array( 'number_control', __( 'Select posts count', 'aesthetix' ), array( 'step' => '1' ) ),
				) );
			}
		}

		// Other options.
		$aesthetix_controls['other'] = array(
			'tab_social_list'     => array( 'tab_title', __( 'Social List', 'aesthetix' ), __( 'Add a link to social-list networks using a shortcode <strong>[aesthetix-social-list]</strong>', 'aesthetix' ) ),
			'facebook'            => array( 'url_control', __( 'Facebook link', 'aesthetix' ), '' ),
			'instagram'           => array( 'url_control', __( 'Instagram link', 'aesthetix' ), '' ),
			'youtube'             => array( 'url_control', __( 'Youtube link', 'aesthetix' ), '' ),
			'twitter'             => array( 'url_control', __( 'Twitter link', 'aesthetix' ), '' ),
			'telegram'            => array( 'url_control', __( 'Telegram link', 'aesthetix' ), '' ),
			'linkedin'            => array( 'url_control', __( 'Linkedin link', 'aesthetix' ), '' ),
			'vkontakte'           => array( 'url_control', __( 'Vkontakte link', 'aesthetix' ), '' ),

			'tab_contacts_list'   => array( 'tab_title', __( 'Contacts List', 'aesthetix' ), __( 'Add a link to contacts-list using a shortcode <strong>[aesthetix-contacts-list]</strong> or single <strong>[aesthetix-email]</strong>, <strong>[aesthetix-phone]</strong>, <strong>[aesthetix-address]</strong>', 'aesthetix' ) ),
			'address'             => array( 'text_control', __( 'Address', 'aesthetix' ), '' ),
			'phone'               => array( 'text_control', __( 'Phone', 'aesthetix' ), '' ),
			'email'               => array( 'text_control', __( 'Email', 'aesthetix' ), '' ),
			'whatsapp_phone'      => array( 'text_control', __( 'Whatsapp phone', 'aesthetix' ), __( 'Enter data in the format 7999XXXXXXX without "+"', 'aesthetix' ) ),
			'telegram_chat_link'  => array( 'text_control', __( 'Telegram chat link', 'aesthetix' ), __( 'Enter you telegram chet link for contact with you', 'aesthetix' ) ),

			'tab_verification'    => array( 'tab_title', __( 'Verifications and counters', 'aesthetix' ), '' ),
			'google_verification' => array( 'text_control', __( 'Google', 'aesthetix' ), __( 'Get your google verification code in the Google Search Console', 'aesthetix' ) ),
			'yandex_verification' => array( 'text_control', __( 'Yandex', 'aesthetix' ), __( 'Get your yandex verification code in the Yandex Webmaster Tools', 'aesthetix' ) ),
			'google_counter'      => array( 'text_control', __( 'Google', 'aesthetix' ), __( 'Get google counter ID like a UA-********-*', 'aesthetix' ) ),
			'yandex_counter'      => array( 'text_control', __( 'Yandex', 'aesthetix' ), __( 'Get yandex counter ID like a ********', 'aesthetix' ) ),
		);

		// Merge child and parent controls.
		$aesthetix_controls = apply_filters( 'get_aesthetix_customizer_controls', $aesthetix_controls );

		// Return controls.
		if ( is_null( $control ) ) {
			return $aesthetix_controls;
		} elseif ( ! isset( $aesthetix_controls[ $control ] ) || empty( $aesthetix_controls[ $control ] ) ) {
			return false;
		} else {
			return $aesthetix_controls[ $control ];
		}
	}
}
