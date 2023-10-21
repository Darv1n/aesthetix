<?php
/**
 * Template filters.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ajax_localize_params' ) ) {
	function ajax_localize_params() {

		global $wp_query;

		// Parameters for the ajax handler.
		$ajax_localize = array(
			'url'   => admin_url( 'admin-ajax.php' ),
			'query' => $wp_query->query,
			'lang'  => determine_locale(),
			'nonce' => wp_create_nonce( 'ajax-nonce' ),
		);

		if ( isset( $wp_query->query_vars ) ) {
			foreach ( $wp_query->query_vars as $key => $query_var ) {
				if ( ! empty( $query_var ) ) {
					$ajax_localize['query'][ $key ] = $query_var;
				}
			}
		}

		// Add filter to array.
		$ajax_localize = apply_filters( 'ajax_localize_params', $ajax_localize );

		return $ajax_localize;
	}
}

if ( ! function_exists( 'primary_menu_fallback' ) ) {
	function primary_menu_fallback() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			echo '<ul id="top-menu">';
				echo '<li>';
					echo '<a ' . link_classes( '', false ) . ' href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Setup Menu', 'aesthetix' ) .'</a>';
				echo '</li>';
			echo '</ul>';
		}
	}
}

if ( ! function_exists( 'aesthetix_privacy_policy_url' ) ) {

	/**
	 * Function for 'privacy_policy_url' filter-hook.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string $url            The URL to the privacy policy page. Empty string if it doesn't exist.
	 * @param int    $policy_page_id The ID of privacy policy page.
	 *
	 * @return string
	 */
	function aesthetix_privacy_policy_url( $url ) {

		if ( empty( $url ) ) {
			$url = get_home_url();
		}

		if ( empty( $url ) && is_multisite() && ! is_main_site() ) {
			switch_to_blog( 1 );
			$url = get_privacy_policy_url();
			restore_current_blog();
		}

		return trailingslashit( $url );
	}
}
add_filter( 'privacy_policy_url', 'aesthetix_privacy_policy_url', 10 ); // Add a privacy policy link if it doesn't exist.

if ( ! function_exists( 'aesthetix_robots' ) ) {

	/**
	 * Function for 'wp_robots' filter-hook. Prints noindex, nofollow tags on archive pages, if there are no posts in this archive page.
	 *
	 * @since 1.0.0
	 * 
	 * @param array $robots Parameter for filter.
	 *
	 * @return array
	 */
	function aesthetix_robots( $robots ) {

		if ( is_archive() && ! have_posts() ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}

		if ( is_single() && get_post_status() !== 'publish' ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}

		$robots['max-snippet']       = '-1';
		$robots['max-image-preview'] = 'large';
		$robots['max-video-preview'] = '-1';

		return $robots;
	}
}
add_filter( 'wp_robots', 'aesthetix_robots', 10 ); // Add a few rules to the robots meta-tag.

if ( ! function_exists( 'aesthetix_robots_txt' ) ) {

	/**
	 * Function for 'robots_txt' filter-hook.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $output The robots.txt output.
	 * @param bool   $public Whether the site is considered 'public'.
	 *
	 * @return string
	 */
	function aesthetix_robots_txt( $output, $public ) {

		$output .= 'Disallow: /cgi-bin' . "\r\n";
		$output .= 'Disallow: /wp-json' . "\r\n";
		$output .= 'Disallow: */xmlrpc.php' . "\r\n";

		return apply_filters( 'aesthetix_robots_txt', $output, $public );
	}
}
add_filter( 'robots_txt', 'aesthetix_robots_txt', 20, 2 ); // Add a few rules to the dynamic robots.txt

if ( ! function_exists( 'unset_intermediate_image_sizes' ) ) {

	/**
	 * Function for 'intermediate_image_sizes' filter-hook.
	 * 
	 * @since 1.0.0
	 * 
	 * @param array $default_sizes Array of intermediate image size names.
	 *
	 * @return array
	 */
	function unset_intermediate_image_sizes( $sizes ) {

		// Sizes to be removed.
		$unset_sizes = array(
			'thumbnail',
			'medium_large',
			'1536x1536',
			'2048x2048',
		);

		return array_diff( $sizes, $unset_sizes );
	}
}
add_filter( 'intermediate_image_sizes', 'unset_intermediate_image_sizes' );

if ( ! function_exists( 'aesthetix_nav_menu_args' ) ) {

	/**
	 * Filters the arguments used to display a navigation menu. Replace tag div with nav.
	 *
	 * @since 1.0.0
	 * 
	 * @param array $args Parameter for filter.
	 *
	 * @return array
	 */
	function aesthetix_nav_menu_args( $args = '' ) {
		if ( $args['container'] === 'div' ) {
			$args['container'] = 'nav';
		}
		return $args;
	}
}
add_filter( 'wp_nav_menu_args', 'aesthetix_nav_menu_args' );

if ( ! function_exists( 'remove_nav_menu_item_id' ) ) {

	/**
	 * Function for 'nav_menu_item_id' filter-hook.
	 * 
	 * @since 1.0.0
	 * 
	 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item.
	 * @param stdClass $args      Object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	function remove_nav_menu_item_id( $id, $item, $args ) {
		return '';
	}
}
add_filter( 'nav_menu_item_id', 'remove_nav_menu_item_id', 10, 3 );

if ( ! function_exists( 'remove_nav_menu_item_class' ) ) {

	/**
	 * Function for 'nav_menu_css_class' filter-hook.
	 * 
	 * @since 1.0.0
	 * 
	 * @param array    $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      Object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function remove_nav_menu_item_class( $classes, $item, $args ) {

		foreach ( $classes as $key_class => $class ) {
			if ( str_contains( $class, 'menu-item-' ) && ! in_array( $class, array( 'menu-item-has-children', 'menu-item-logo' ), true ) ) {
				unset( $classes[ $key_class ] ); 
			} else if ( str_contains( $class, 'current_page' ) ) {
				unset( $classes[ $key_class ] ); 
			}
		}

		return $classes;
	}
}
add_filter( 'nav_menu_css_class', 'remove_nav_menu_item_class', 10, 3 );

if ( ! function_exists( 'aesthetix_search_highlight' ) ) {

	/**
	 * Highlight search results.
	 * 
	 * @since 1.0.0
	 *
	 * @param string $text Text for highlight.
	 *
	 * @return string
	 */
	function aesthetix_search_highlight( $text ) {

		$s = get_query_var( 's' );

		if ( is_search() && in_the_loop() && ! empty( $s ) ) {

			$style       = 'background-color:#307FE2;color:#fff;font-weight:bold;';
			$query_terms = get_query_var( 'search_terms' );

			if ( ! empty( $query_terms ) ) {
				$query_terms = explode( ' ', $s );
			}

			if ( empty( $query_terms ) ) {
				return $text;
			}

			foreach ( $query_terms as $term ) {
				$term  = preg_quote( $term, '/' ); // Like in search string.
				$term1 = mb_strtolower( $term ); // Lowercase.
				$term2 = mb_strtoupper( $term ); // Uppercase.
				$term3 = mb_convert_case( $term, MB_CASE_TITLE, 'UTF-8' ); // Capitalise.
				$term4 = mb_strtolower( mb_substr( $term, 0, 1 ) ) . mb_substr( $term2, 1 ); // First lowercase.
				$text  = preg_replace( "@(?<!<|</)($term|$term1|$term2|$term3|$term4)@i", "<span style=\"{$style}\">$1</span>", $text );
			}

		} // is_search.

		return $text;
	}
}
add_filter( 'the_title', 'aesthetix_search_highlight' );
add_filter( 'the_content', 'aesthetix_search_highlight' );
add_filter( 'the_excerpt', 'aesthetix_search_highlight' );

if ( ! function_exists( 'aesthetix_nav_menu_item_args' ) ) {

	/**
	 * Function for 'nav_menu_item_args' filter-hook.
	 * 
	 * @since 1.2.4
	 * 
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param WP_Post  $menu_item Menu item data object.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return stdClass
	 */
	function aesthetix_nav_menu_item_args( $args, $menu_item, $depth ) {

		if ( (int) $menu_item->menu_item_parent === 0 ) {
			$args->link_before = '<span class="menu-title menu-title-lvl-1">';
		} else {
			$args->link_before = '<span class="menu-title">';
		}

		$args->link_after  = '</span>';

		if ( in_array( 'menu-item-has-children', $menu_item->classes, true ) ) {

			$button_args = array(
				'button_size'    => 'xs',
				'button_content' => 'icon',
			);

			$args->link_after = '<button ' . button_classes( 'sub-menu-toggle toggle-icon icon icon_center icon_angle-up', $button_args, false ) . ' data-icon-on="icon_angle-up" data-icon-off="icon_angle-down"></button>';
			$args->link_after .= '</span>';
		}

		if ( $menu_item->description ) {
			$args->link_after .= '<span class="menu-description">' . $menu_item->description . '</span>';
		}

		return $args;
	}
}
add_filter( 'nav_menu_item_args', 'aesthetix_nav_menu_item_args', 10, 3 );

if ( ! function_exists( 'aesthetix_wp_nav_menu_objects' ) ) {

	/**
	 * Function for 'wp_nav_menu_objects' filter-hook.
	 * 
	 * @since 1.2.4
	 * 
	 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 * @param stdClass $args              An object containing wp_nav_menu() arguments.
	 *
	 * @return array
	 */
	function aesthetix_wp_nav_menu_objects( $sorted_menu_items, $args ) {

		if ( ( get_aesthetix_options( 'general_header_type' ) === 'mid-3' || get_aesthetix_options( 'root_home_button_display' ) !== 'none' ) && $args->theme_location === 'primary' ) {

			$logo_obj = (object) array(
				'ID'               => 'logo',
				'post_author'      => 1,
				'post_content'     => '',
				'post_title'       => 'Logo',
				'post_status'      => 'publish',
				'post_name'        => 'logo',
				'post_parent'      => 0,
				'post_type'        => 'nav_menu_item',
				'menu_order'       => 1,
				'menu_item_parent' => 0,
				'object'           => 'custom',
				'type'             => 'custom',
				'type_label'       => 'Custom Link',
				'title'            => 'Logo',
				'description'      => '',
				'url'              => get_home_url( '/' ),
				'classes'          => array( 'menu-item' ),
				'db_id'            => 1,
				'target'           => '',
				'xfn'              => '',
				'current'          => false,
			);

			$first_level_items = array();

			foreach ( $sorted_menu_items as $key => $sorted_menu_item ) {
				if ( (int) $sorted_menu_item->menu_item_parent === 0 ) {
					$first_level_items[] = $sorted_menu_item;
				}
			}

			$i        = floor( count( $first_level_items ) / 2 );
			$item     = $first_level_items[ $i ];
			$move_key = false;

			foreach ( $sorted_menu_items as $key => $sorted_menu_item ) {

				if ( get_aesthetix_options( 'root_home_button_display' ) === 'menu-start' ) {
					$menu_items[0] = $logo_obj;
					$menu_items[ intval( $key + 1 ) ] = $sorted_menu_item;
				} else if ( get_aesthetix_options( 'root_home_button_display' ) === 'menu-end' ) {
					$menu_items[ $key ] = $sorted_menu_item;
					if ( (int) $key === count( $sorted_menu_items ) ) {
						$menu_items[ intval( $key + 1 ) ] = $logo_obj;
					}
				} else {
					if ( $item->ID === $sorted_menu_item->ID ) {
						$move_key   = true;
						$needed_key = $sorted_menu_item->ID;
						$menu_items[ $key ] = $logo_obj;
					}

					if ( $move_key === false ) {
						$menu_items[ $key ] = $sorted_menu_item;
					} else {
						$sorted_menu_item->menu_order = intval( $sorted_menu_item->menu_order + 1 );
						$menu_items[ intval( $key + 1 ) ] = $sorted_menu_item;
					}
				}
			}

			return $menu_items;
		}

		return $sorted_menu_items;
	}
}
add_filter( 'wp_nav_menu_objects', 'aesthetix_wp_nav_menu_objects', 10, 2 );

if ( ! function_exists( 'aesthetix_wp_nav_menu_items' ) ) {

	/**
	 * Function for 'wp_nav_menu_items' filter-hook.
	 * 
	 * @since 1.2.4
	 * 
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 *
	 * @return string
	 */
	function aesthetix_wp_nav_menu_items( $items, $args ) {

		if ( ( get_aesthetix_options( 'general_header_type' ) === 'mid-3' || get_aesthetix_options( 'root_home_button_display' ) !== 'none' ) && $args->theme_location === 'primary' ) {

			preg_match_all( '/<li class="([^"]+)">(.*)?<\/li>/', $items, $matches );

			if ( $matches && is_array( $matches ) && ! empty( $matches ) && isset( $matches[1] ) && isset( $matches[2] ) && count( $matches[1] ) === count( $matches[2] ) ) {
				foreach ( $matches[1] as $key => $classes ) {
					if ( in_array( 'menu-item-logo', explode( ' ', $classes ), true ) ) {
						if ( get_aesthetix_options( 'general_header_type' ) === 'mid-3' ) {
							$items = str_replace( $matches[2][ $key ], return_template_part( 'templates/logo' ), $items );
						} else {
							$items = str_replace( $matches[2][ $key ], return_template_part( 'templates/button', 'home' ), $items );
						}
					}
				}
			}
		}

		return $items;
	}
}
add_filter( 'wp_nav_menu_items', 'aesthetix_wp_nav_menu_items', 10, 2 );

if ( ! function_exists( 'get_aesthetix_custom_logo_image_attributes' ) ) {

	/**
	 * Function for 'get_custom_logo_image_attributes' filter-hook.
	 * 
	 * @since 1.2.4
	 * 
	 * @param array $custom_logo_attr Custom logo image attributes.
	 * @param int   $custom_logo_id   Custom logo attachment ID.
	 * @param int   $blog_id          ID of the blog to get the custom logo for.
	 *
	 * @return array
	 */
	function get_aesthetix_custom_logo_image_attributes( $custom_logo_attr, $custom_logo_id, $blog_id ) {

		$custom_logo_attr['class'] = 'logo-image';

		return $custom_logo_attr;
	}
}
add_filter( 'get_custom_logo_image_attributes', 'get_aesthetix_custom_logo_image_attributes', 10, 3 );