<?php
/**
 * Customizer controls array.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_aesthetix_customizer_controls' ) ) {

	/**
	 * Return array with customizer controls.
	 *
	 * @param string $control Array key to get one value.
	 *
	 * @return array
	 */
	function get_aesthetix_customizer_controls( $control = null ) {

		// Selects.
		$root_color_scheme_select = array(
			'white' => __( 'White', 'aesthetix' ),
			'black' => __( 'Black', 'aesthetix' ),
		);

		$general_content_width_select = array(
			'narrow' => __( 'Narrow', 'aesthetix' ),
			'wide'   => __( 'Wide', 'aesthetix' ),
		);

		$general_header_type_select = array(
			'default'     => __( 'Header desktop default', 'aesthetix' ),
			'mid-3'       => __( 'Header desktop 3 + 0 columns', 'aesthetix' ),
			'mid-2-bot-2' => __( 'Header desktop 2 + 2 columns', 'aesthetix' ),
			'mid-2-bot-3' => __( 'Header desktop 2 + 3 columns', 'aesthetix' ),
			'mid-3-bot-2' => __( 'Header desktop 3 + 2 columns', 'aesthetix' ),
			'mid-3-bot-3' => __( 'Header desktop 3 + 3 columns', 'aesthetix' ),
		);

		$general_header_mobile_type_select = array(
			'default' => __( 'Header mobile default', 'aesthetix' ),
			'mid-3'   => __( 'Header mobile three columns', 'aesthetix' ),
		);

		$general_footer_type_select = array(
			'footer-simple'        => __( 'Footer simple', 'aesthetix' ),
			'footer-three-columns' => __( 'Footer three columns', 'aesthetix' ),
			'footer-four-columns'  => __( 'Footer four columns', 'aesthetix' ),
		);

		$general_menu_align_select = array(
			'right'  => __( 'Right', 'aesthetix' ),
			'left'   => __( 'Left', 'aesthetix' ),
			'center' => __( 'Center', 'aesthetix' ),
		);

		$general_breadcrumbs_select = array(
			'woocommerce' => __( 'WooCommerce (Plugin must be activated)', 'aesthetix' ),
			'navxt'       => __( 'Breadcrumb NavXT plugin', 'aesthetix' ),
			'yoast'       => __( 'Yoast (Must be enabled in the plugin)', 'aesthetix' ),
			'rankmath'    => __( 'RankMath (Must be enabled in the plugin)', 'aesthetix' ),
			'seopress'    => __( 'SEOPress (Must be enabled in the plugin)', 'aesthetix' ),
		);

		$alignment_pseudo_select = array(
			'before' => __( 'Before', 'aesthetix' ),
			'after'  => __( 'After', 'aesthetix' ),
		);

		$home_button_display_select = array(
			'none'        => __( 'None', 'aesthetix' ),
			'menu-start'  => __( 'Menu start', 'aesthetix' ),
			'menu-center' => __( 'Menu center', 'aesthetix' ),
			'menu-end'    => __( 'Menu end', 'aesthetix' ),
		);

		$single_post_template_type_select = array(
			'one' => __( 'One', 'aesthetix' ),
			'two' => __( 'Two', 'aesthetix' ),
		);

		$archive_page_columns_select = array(
			1 => __( 'One', 'aesthetix' ),
			2 => __( 'Two', 'aesthetix' ),
			3 => __( 'Three', 'aesthetix' ),
			4 => __( 'Four', 'aesthetix' ),
			5 => __( 'Five', 'aesthetix' ),
			6 => __( 'Six', 'aesthetix' ),
		);

		$archive_page_slides_count_select = array(
			1  => __( 'One', 'aesthetix' ),
			2  => __( 'Two', 'aesthetix' ),
			3  => __( 'Three', 'aesthetix' ),
			4  => __( 'Four', 'aesthetix' ),
			5  => __( 'Five', 'aesthetix' ),
			6  => __( 'Six', 'aesthetix' ),
			7  => __( 'Seven', 'aesthetix' ),
			8  => __( 'Eight', 'aesthetix' ),
			9  => __( 'Nine', 'aesthetix' ),
			10 => __( 'Ten', 'aesthetix' ),
		);

		$archive_page_slides_to_show_select = array(
			'one'   => __( 'One', 'aesthetix' ),
			'two'   => __( 'Two', 'aesthetix' ),
			'three' => __( 'Three', 'aesthetix' ),
			'four'  => __( 'Four', 'aesthetix' ),
		);

		$archive_page_pagination_select = array(
			'default'  => __( 'Default', 'aesthetix' ),
			'numeric'  => __( 'Numeric', 'aesthetix' ),
			'loadmore' => __( 'Load more', 'aesthetix' ),
		);

		$aesthetix_controls = array();

		// General common options.
		$aesthetix_controls['general'] = array(
			'demo_tab_title'            => array( 'tab_title', __( 'Demo', 'aesthetix' ), '' ),
			'demo_var'                  => array( 'select_control', __( 'Select demo variant', 'aesthetix' ), '', get_aesthetix_customizer_demo_variant() ),

			'content_tab_title'         => array( 'tab_title', __( 'Content', 'aesthetix' ), '' ),
			'container_width'           => array( 'select_control', __( 'Select container width', 'aesthetix' ), __( 'Here you can change the container width of the site', 'aesthetix' ), get_aesthetix_customizer_sizes() ),
			'content_width'             => array( 'select_control', __( 'Select content width', 'aesthetix' ), __( 'Note: its work if sidebar dont show', 'aesthetix' ), $general_content_width_select ),

			'header_tab_title'          => array( 'tab_title', __( 'Header', 'aesthetix' ), '' ),
			'header_top_bar_display'    => array( 'checkbox_control', __( 'Top bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars before the header of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'header_type'               => array( 'select_control', __( 'Select header type', 'aesthetix' ), __( 'You can change parts of the header on the widgets page', 'aesthetix' ), $general_header_type_select ),
			'header_mobile_type'        => array( 'select_control', __( 'Select header mobile type', 'aesthetix' ), '', $general_header_mobile_type_select ),

			'menu_tab_title'            => array( 'tab_title', __( 'Menu', 'aesthetix' ), '' ),
			'menu_align'                => array( 'select_control', __( 'Select menu alignment', 'aesthetix' ), __( 'Alignment of the menu container', 'aesthetix' ), $general_menu_align_select ),
			'menu_count_items_display'  => array( 'checkbox_control', __( 'Count category items display', 'aesthetix' ), __( 'This checkbox displays count posts in taxonomies', 'aesthetix' ) ),

			'footer_tab_title'          => array( 'tab_title', __( 'Footer', 'aesthetix' ), '' ),
			'footer_top_bar_display'    => array( 'checkbox_control', __( 'Top bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars before the footer of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'footer_bottom_bar_display' => array( 'checkbox_control', __( 'Bottom bar display', 'aesthetix' ), __( 'This checkbox displays two sidebars after the footer of the site. They are adds in the widget section options', 'aesthetix' ) ),
			'footer_type'               => array( 'select_control', __( 'Select footer type', 'aesthetix' ), '', $general_footer_type_select ),

			'breadcrumbs_tab_title'     => array( 'tab_title', __( 'Breadcrumbs', 'aesthetix' ), '' ),
			'breadcrumbs_display'       => array( 'checkbox_control', __( 'Breadcrumbs display', 'aesthetix' ), '' ),
			'breadcrumbs_type'          => array( 'select_control', __( 'Select breadcrumbs type', 'aesthetix' ), '', $general_breadcrumbs_select ),
			'breadcrumbs_separator'     => array( 'text_control', __( 'Breadcrumbs separator', 'aesthetix' ), '' ),

			'subscribe_form_tab_title'  => array( 'tab_title', __( 'Subscribe form', 'aesthetix' ), '' ),
			'subscribe_form_display'    => array( 'checkbox_control', __( 'Subscribe form before footer display', 'aesthetix' ), '' ),
			'subscribe_form_type'       => array( 'select_control', __( 'Subscribe form type', 'aesthetix' ), '', get_aesthetix_customizer_subscribe_form_type() ),
			'subscribe_form_title'      => array( 'text_control', __( 'Subscribe form title', 'aesthetix' ), '' ),
			'subscribe_form_bg'         => array( 'image_control', __( 'Subscribe form background image', 'aesthetix' ), '', '' ),
			'subscribe_form_shortcode'  => array( 'text_control', __( 'Subscribe form shortcode', 'aesthetix' ), __( 'Use this field if you chose Mailchimp', 'aesthetix' ) ),

			'scroll_top_tab_title'      => array( 'tab_title', __( 'Scroll top structure', 'aesthetix' ), '' ),
			'scroll_top_structure'      => array( 'sortable_control', '', '', get_aesthetix_customizer_scroll_top_structure() ),
			
			'other_tab_title'           => array( 'tab_title', __( 'Other', 'aesthetix' ), '' ),
			'cookie_display'            => array( 'checkbox_control', __( 'Cookie display', 'aesthetix' ), __( 'Displays a notification about the use of cookies on the site', 'aesthetix' ) ),
		);

		$aesthetix_controls['front_page'] = array(
			'slider_tab_title'            => array( 'tab_title', __( 'Slider', 'aesthetix' ), '' ),
			'slider_display'              => array( 'checkbox_control', __( 'Slider display', 'aesthetix' ), '' ),
			'slider_post_type'            => array( 'select_control', __( 'Slider post type', 'aesthetix' ), '', get_post_types( array( 'publicly_queryable' => 1, ) ) ),
			'slider_slides_count'         => array( 'select_control', __( 'Slides count', 'aesthetix' ), '', $archive_page_slides_count_select ),
			'slider_slides_to_show'       => array( 'select_control', __( 'Slides to show', 'aesthetix' ), '', $archive_page_slides_to_show_select ),
			'slider_slides_template_type' => array( 'select_control', __( 'Select template type', 'aesthetix' ), __( 'This field displays template of posts', 'aesthetix' ), get_aesthetix_customizer_archive_post_layout() ),
		);

		// Sidebar options.
		$aesthetix_controls['root'] = array(
			'fonts_tab_title'                       => array( 'tab_title', __( 'Fonts', 'aesthetix' ), '' ),
			'primary_font'                          => array( 'select_control', __( 'Select primary font', 'aesthetix' ), '', get_aesthetix_customizer_fonts() ),
			'secondary_font'                        => array( 'select_control', __( 'Select secondary font', 'aesthetix' ), '', get_aesthetix_customizer_fonts() ),

			'colors_tab_title'                      => array( 'tab_title', __( 'Colors', 'aesthetix' ), '' ),
			'color_scheme'                          => array( 'select_control', __( 'Select color scheme', 'aesthetix' ), '', $root_color_scheme_select ),
			'primary_color'                         => array( 'select_control', __( 'Select primary color', 'aesthetix' ), '', get_aesthetix_customizer_colors() ),
			'secondary_color'                       => array( 'select_control', __( 'Select secondary color', 'aesthetix' ), '', get_aesthetix_customizer_colors() ),
			'gray_color'                            => array( 'select_control', __( 'Select gray color', 'aesthetix' ), '', get_aesthetix_customizer_gray_colors() ),
			'link_color'                            => array( 'select_control', __( 'Select link color', 'aesthetix' ), '', get_aesthetix_customizer_link_colors() ),

			'post_tab_title'                        => array( 'tab_title', __( 'Post', 'aesthetix' ), '' ),
			'post_background'                       => array( 'select_control', __( 'Select post background', 'aesthetix' ), '', get_aesthetix_customizer_background_colors() ),
			'post_thumbnail_padding'                => array( 'select_control', __( 'Select post thumbnail padding', 'aesthetix' ), '', get_aesthetix_customizer_sizes() ),
			'post_content_padding'                  => array( 'select_control', __( 'Select post content padding', 'aesthetix' ), '', get_aesthetix_customizer_sizes() ),
			'post_shadow'                           => array( 'select_control', __( 'Select post shadow', 'aesthetix' ), '', get_aesthetix_customizer_box_shadows() ),
			'post_border_width'                     => array( 'select_control', __( 'Select post border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'post_border_radius'                    => array( 'select_control', __( 'Select post border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),

			'button_tab_title'                      => array( 'tab_title', __( 'Buttons', 'aesthetix' ), '' ),
			'button_type'                           => array( 'select_control', __( 'Select button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'button_icon_position'                  => array( 'select_control', __( 'Select button icon position', 'aesthetix' ), '', $alignment_pseudo_select ),
			'button_size'                           => array( 'select_control', __( 'Select button size', 'aesthetix' ), '', get_aesthetix_customizer_sizes() ),
			'button_border_width'                   => array( 'select_control', __( 'Select button border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'button_border_radius'                  => array( 'select_control', __( 'Select button border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),

			'menu_button_tab_title'                 => array( 'tab_title', __( 'Menu button', 'aesthetix' ), '' ),
			'menu_button_color'                     => array( 'select_control', __( 'Select menu button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'menu_button_type'                      => array( 'select_control', __( 'Select menu button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'menu_button_content'                   => array( 'select_control', __( 'Select menu button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'home_button_tab_title'                 => array( 'tab_title', __( 'Home button', 'aesthetix' ), '' ),
			'home_button_display'                   => array( 'select_control', __( 'Select home button display', 'aesthetix' ), '', $home_button_display_select ),
			'home_button_color'                     => array( 'select_control', __( 'Select home button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'home_button_type'                      => array( 'select_control', __( 'Select home button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'home_button_content'                   => array( 'select_control', __( 'Select home button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'scroll_top_tab_title'                  => array( 'tab_title', __( 'Scroll top button', 'aesthetix' ), '' ),
			'scroll_top_button_color'               => array( 'select_control', __( 'Select scroll top button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'scroll_top_button_type'                => array( 'select_control', __( 'Select scroll top button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'scroll_top_button_content'             => array( 'select_control', __( 'Select scroll top button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'subscribe_popup_form_button_tab_title' => array( 'tab_title', __( 'Subscribe popup form button', 'aesthetix' ), '' ),
			'subscribe_popup_form_button_color'     => array( 'select_control', __( 'Select subscribe popup form button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'subscribe_popup_form_button_type'      => array( 'select_control', __( 'Select subscribe popup form button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'subscribe_popup_form_button_content'   => array( 'select_control', __( 'Select subscribe popup form button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'searchform_form_tab_title'             => array( 'tab_title', __( 'Search form button', 'aesthetix' ), '' ),
			'searchform_form_button_color'          => array( 'select_control', __( 'Select search form button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'searchform_form_button_type'           => array( 'select_control', __( 'Select search form button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'searchform_form_button_content'        => array( 'select_control', __( 'Select search form button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'searchform_popup_form_tab_title'       => array( 'tab_title', __( 'Search popup form button', 'aesthetix' ), '' ),
			'searchform_popup_form_button_color'    => array( 'select_control', __( 'Select search popup form button color', 'aesthetix' ), '', get_aesthetix_customizer_button_color() ),
			'searchform_popup_form_button_type'     => array( 'select_control', __( 'Select search popup form button type', 'aesthetix' ), '', get_aesthetix_customizer_button_type() ),
			'searchform_popup_form_button_content'  => array( 'select_control', __( 'Select search popup form button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),

			'input_tab_title'                       => array( 'tab_title', __( 'Inputs', 'aesthetix' ), '' ),
			'input_size'                            => array( 'select_control', __( 'Select input size', 'aesthetix' ), '', get_aesthetix_customizer_sizes() ),
			'input_border_width'                    => array( 'select_control', __( 'Select input border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'input_border_radius'                   => array( 'select_control', __( 'Select input border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),

			'other_tab_title'                       => array( 'tab_title', __( 'Other', 'aesthetix' ), '' ),
			'box_shadow'                            => array( 'select_control', __( 'Select element shadow', 'aesthetix' ), '', get_aesthetix_customizer_box_shadows() ),
			'border_width'                          => array( 'select_control', __( 'Select element border width', 'aesthetix' ), '', get_aesthetix_customizer_button_border_widths() ),
			'border_radius'                         => array( 'select_control', __( 'Select element border radius', 'aesthetix' ), '', get_aesthetix_customizer_button_border_radiuses() ),
		);

		$post_types = get_aesthetix_customizer_post_types();

		foreach ( $post_types as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$post_type_object  = get_post_type_object( $post_type );
			$object_taxonomies = get_object_taxonomies( $post_type );

			// Single $post_type options.
			$aesthetix_controls[ 'single_' . $post_type ] = array(
				'structure_title'           => array( 'tab_title', __( 'Post structure', 'aesthetix' ), '' ),
				'structure'                 => array( 'sortable_control', '', '', get_aesthetix_customizer_single_post_structure( null, $post_type ) ),
				'meta_structure_title'      => array( 'tab_title', __( 'Post meta structure', 'aesthetix' ), '' ),
				'meta_structure'            => array( 'sortable_control', '', '', get_aesthetix_customizer_post_meta_structure( null, $post_type ) ),
				'footer_structure_title'    => array( 'tab_title', __( 'Post footer structure', 'aesthetix' ), '' ),
				'footer_structure'          => array( 'sortable_control', '', '', get_aesthetix_customizer_single_post_footer_structure( null, $post_type ) ),
				'options_title'             => array( 'tab_title', __( 'Main options', 'aesthetix' ), '' ),
				'template_type'             => array( 'select_control', __( 'Select template type', 'aesthetix' ), __( 'This field displays template of the post', 'aesthetix' ), $single_post_template_type_select ),
				'post_nav_display'          => array( 'checkbox_control', __( 'Prev/next post navigation display', 'aesthetix' ), '' ),
				'entry_footer_display'      => array( 'checkbox_control', __( 'Entry footer display', 'aesthetix' ), '' ),
			);

			if ( $post_type === 'post' ) {
				$aesthetix_controls[ 'single_' . $post_type ] = array_merge( $aesthetix_controls[ 'single_' . $post_type ], array(
					'entry_footer_cats_display' => array( 'checkbox_control', __( 'Entry footer cats display', 'aesthetix' ), '' ),
					'entry_footer_tags_display' => array( 'checkbox_control', __( 'Entry footer tags display', 'aesthetix' ), '' ),
					'similar_posts_display'     => array( 'checkbox_control', __( 'Similar posts display', 'aesthetix' ), '' ),
					'similar_posts_order'       => array( 'select_control', __( 'Select posts order', 'aesthetix' ), '', get_aesthetix_customizer_archive_post_order() ),
					'similar_posts_orderby'     => array( 'select_control', __( 'Select posts orderby', 'aesthetix' ), '', get_aesthetix_customizer_archive_post_orderby( '', $post_type ) ),
					'similar_posts_count'       => array( 'number_control', __( 'Select posts count', 'aesthetix' ), array( 'step' => '1', 'min' => '1', 'max' => '100' ) ),
				) );
			}

			// Archive $post_type options.
			if ( $post_type_object->has_archive || ! empty( $object_taxonomies ) ) {
				$aesthetix_controls[ 'archive_' . $post_type ] = array(
					'options_title'              => array( 'tab_title', __( 'Main options', 'aesthetix' ), '' ),
					'masonry'                    => array( 'checkbox_control', __( 'Masonry blog style', 'aesthetix' ), '' ),
					'columns'                    => array( 'select_control', __( 'Select columns of posts', 'aesthetix' ), __( 'Choose how many columns to display posts', 'aesthetix' ), $archive_page_columns_select ),
					'layout'                     => array( 'select_control', __( 'Select template type', 'aesthetix' ), __( 'This field displays template of posts', 'aesthetix' ), get_aesthetix_customizer_archive_post_layout() ),
					'posts_per_page'             => array( 'number_control', __( 'Select posts per page', 'aesthetix' ), array( 'step' => '1', 'min' => '1', 'max' => '100' ) ),
					'posts_order'                => array( 'select_control', __( 'Select posts order', 'aesthetix' ), '', get_aesthetix_customizer_archive_post_order() ),
					'posts_orderby'              => array( 'select_control', __( 'Select posts orderby', 'aesthetix' ), '', get_aesthetix_customizer_archive_post_orderby( '', $post_type ) ),
					'pagination'                 => array( 'select_control', __( 'Post pagination', 'aesthetix' ), '', $archive_page_pagination_select ),
					'more_button_content'        => array( 'select_control', __( 'Read more button content', 'aesthetix' ), '', get_aesthetix_customizer_button_content() ),
					'structure_title'            => array( 'tab_title', __( 'Post structure', 'aesthetix' ), '' ),
					'structure'                  => array( 'sortable_control', '', '', get_aesthetix_customizer_archive_post_structure( null, $post_type ) ),
					'taxonomies_structure_title' => array( 'tab_title', __( 'Post taxonomies structure', 'aesthetix' ), '' ),
					'taxonomies_in_thumbnail'    => array( 'checkbox_control', __( 'Display taxonomies in thumbnail', 'aesthetix' ), '' ),
					'taxonomies_structure'       => array( 'sortable_control', '', '', get_aesthetix_customizer_post_taxonomies_structure( null, $post_type ) ),
					'meta_structure_title'       => array( 'tab_title', __( 'Post meta structure', 'aesthetix' ), '' ),
					'meta_structure'             => array( 'sortable_control', '', '', get_aesthetix_customizer_post_meta_structure( null, $post_type ) ),
				);
			}
		}

		// Other options.
		$aesthetix_controls['other'] = array(
			'tab_contacts_list' => array( 'tab_title', __( 'Contacts list', 'aesthetix' ), __( 'Add a link to contacts-list using a shortcode <strong>[aesthetix-contacts-list]</strong> or single <strong>[aesthetix-email]</strong>, <strong>[aesthetix-phone]</strong>, <strong>[aesthetix-address]</strong>', 'aesthetix' ) ),
			'address'           => array( 'text_control', __( 'Address', 'aesthetix' ), '' ),
			'phone'             => array( 'text_control', __( 'Phone', 'aesthetix' ), '' ),
			'email'             => array( 'text_control', __( 'Email', 'aesthetix' ), '' ),
			'whatsapp'          => array( 'text_control', __( 'WhatsApp', 'aesthetix' ), __( 'Enter your WhatsApp phone for contact with you', 'aesthetix' ) ),
			'telegram_chat'     => array( 'text_control', __( 'Telegram', 'aesthetix' ), __( 'Enter your personal/bot Telegram link for contact with you', 'aesthetix' ) ),
			'tab_social_list'   => array( 'tab_title', __( 'Social list', 'aesthetix' ), __( 'Add a link to social-list networks using a shortcode <strong>[aesthetix-social-list]</strong>', 'aesthetix' ) ),
		);

		foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
			$aesthetix_controls['other'][ $key ] = array( 'url_control', $value, '' );
		}

		// Site Identity options.
		$aesthetix_controls['title_tagline'] = array(
			'logo_size' => array( 'select_control', __( 'Select logo size', 'aesthetix' ), '', get_aesthetix_customizer_sizes() ),
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
