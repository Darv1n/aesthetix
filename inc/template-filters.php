<?php
/**
 * Template filters.
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

if ( ! function_exists( 'setup_menu_fallback' ) ) {
	function setup_menu_fallback() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			echo '<ul class="setup-menu">';
				echo '<li>';
					echo '<a ' . link_classes( 'setup-link', array(), false ) . ' href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" target="_blank">' . esc_html__( 'Setup menu', 'aesthetix' ) .'</a>';
				echo '</li>';
			echo '</ul>';
		}
	}
}

if ( ! function_exists( 'aesthetix_privacy_policy_url' ) ) {

	/**
	 * Add a privacy policy link if it doesn't exist.
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
add_filter( 'privacy_policy_url', 'aesthetix_privacy_policy_url', 10 );

if ( ! function_exists( 'aesthetix_robots' ) ) {

	/**
	 * Function for 'wp_robots' filter-hook. Prints noindex, nofollow tags on archive pages, if there are no posts in this archive page.
	 * 
	 * @param array $robots Parameter for filter.
	 *
	 * @return array
	 */
	function aesthetix_robots( $robots ) {

		// Close archive links if hasn't posts.
		if ( is_archive() && ! have_posts() ) {
			$robots['noindex']  = true;
			$robots['nofollow'] = true;
		}

		// Close non-publish posts from indexing.
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
	 * @param array $default_sizes Array of intermediate image size names.
	 *
	 * @return array
	 */
	function unset_intermediate_image_sizes( $sizes ) {

		// Sizes to be removed.
		$unset_sizes = array(
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
	 * @param array $args Parameter for filter.
	 *
	 * @return array
	 */
	function aesthetix_nav_menu_args( $args = '' ) {

		if ( $args['container'] === 'div' ) {
			$args['container'] = 'nav';
		}

		$menu_class[] = 'menu';
		$menu_class[] = 'menu-' . $args['theme_location'];

		if ( $args['theme_location'] === 'primary' ) {
			$menu_class[] = 'menu-inline';
		}

		sort( $menu_class );
		$args['menu_class'] = implode( ' ', $menu_class );

		return $args;
	}
}
add_filter( 'wp_nav_menu_args', 'aesthetix_nav_menu_args' );

if ( ! function_exists( 'aesthetix_nav_menu_item_id' ) ) {

	/**
	 * Function for 'nav_menu_item_id' filter-hook.
	 * 
	 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item.
	 * @param stdClass $args      Object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	function aesthetix_nav_menu_item_id( $id, $item, $args ) {
		return '';
	}
}
add_filter( 'nav_menu_item_id', 'aesthetix_nav_menu_item_id', 10, 3 );

if ( ! function_exists( 'aesthetix_nav_menu_css_class' ) ) {

	/**
	 * Function for 'nav_menu_css_class' filter-hook.
	 * 
	 * @param array    $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      Object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function aesthetix_nav_menu_css_class( $classes, $item, $args ) {

		foreach ( $classes as $key_class => $class ) {
			if ( str_contains( $class, 'menu-item-' ) && ! in_array( $class, array( 'menu-item-has-children', 'menu-item-logo' ), true ) ) {
				unset( $classes[ $key_class ] ); 
			} elseif ( str_contains( $class, 'current_page' ) ) {
				unset( $classes[ $key_class ] ); 
			}
		}

		if ( in_array( 'menu-item-has-children', $classes, true ) ) {
			$classes[] = 'dropdown-container';
		}

		return $classes;
	}
}
add_filter( 'nav_menu_css_class', 'aesthetix_nav_menu_css_class', 10, 3 );

if ( ! function_exists( 'aesthetix_nav_menu_item_args' ) ) {

	/**
	 * Function for 'nav_menu_item_args' filter-hook.
	 * 
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param WP_Post  $menu_item Menu item data object.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return stdClass
	 */
	function aesthetix_nav_menu_item_args( $args, $menu_item, $depth ) {

		$title_classes[] = 'menu-title';

		if ( (int) $menu_item->menu_item_parent === 0 ) {
			$title_classes[] = 'has-top-lvl';
		}

		if ( $menu_item->description ) {
			$title_classes[] = 'has-description';
		}

		$args->link_before = '<span class="' . esc_attr( implode( ' ', $title_classes ) ) . '"></span>';
		$args->after       = '';

		if ( $menu_item->description ) {
			$args->link_after = '<span class="menu-description">' . $menu_item->description . '</span>';
		}

		if ( in_array( 'menu-item-has-children', $menu_item->classes, true ) ) {
			$args->after .= '<button ' . button_classes( 'dropdown-button toggle-icon icon icon-angle-down', array( 'button_content' => 'icon', 'button_size' => 'xxs' ), false ) . ' data-icon-on="icon-angle-up" data-icon-off="icon-angle-down" type="button"></button>';
		}

		if ( isset( $args->count_items_display ) && $args->count_items_display && $menu_item->type === 'taxonomy' ) {
			$term = get_term( $menu_item->object_id, $menu_item->object );
			if ( $term && isset( $term->count ) && (int) $term->count > 0 ) {
				$args->after .= '<button ' . button_classes( 'menu-count-button button-disabled', array( 'button_content' => 'button-text', 'button_size' => 'xxs' ), false ) . ' type="button">';
					$args->after .= esc_html( $term->count );
				$args->after .= '</button>';
			}
		}

		return $args;
	}
}
add_filter( 'nav_menu_item_args', 'aesthetix_nav_menu_item_args', 10, 3 );

if ( ! function_exists( 'aesthetix_wp_nav_menu_objects' ) ) {

	/**
	 * Function for 'wp_nav_menu_objects' filter-hook.
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
				} elseif ( get_aesthetix_options( 'root_home_button_display' ) === 'menu-end' ) {
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

if ( ! function_exists( 'aesthetix_nav_menu_link_attributes' ) ) {

	/**
	 * Function for 'nav_menu_link_attributes' filter-hook.
	 * 
	 * @param array    $atts      The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function aesthetix_nav_menu_link_attributes( $atts, $item, $args, $depth ) {

		if ( in_array( 'current-menu-item', $item->classes, true ) ) {
			$atts['class'] = implode( ' ', get_link_classes() );
		} else {
			$atts['class'] = implode( ' ', get_link_classes( 'link-color-border' ) );
		}

		return $atts;
	}
}
add_filter( 'nav_menu_link_attributes', 'aesthetix_nav_menu_link_attributes', 1, 4 );

if ( ! function_exists( 'aesthetix_nav_menu_submenu_css_class' ) ) {

	/**
	 * Function for 'nav_menu_submenu_css_class' filter-hook.
	 * 
	 * @param string[] $classes Array of the CSS classes that are applied to the menu <ul> element.
	 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
	 * @param int      $depth   Depth of menu item. Used for padding.
	 *
	 * @return string[]
	 */
	function aesthetix_nav_menu_submenu_css_class( $classes, $args, $depth ) {

		$classes[] = 'dropdown-content';

		if ( $args->theme_location == 'primary' ) {
			$classes[] = 'dropdown-content-absolute';
		}

		return $classes;
	}
}
add_filter( 'nav_menu_submenu_css_class', 'aesthetix_nav_menu_submenu_css_class', 10, 3 );

if ( ! function_exists( 'aesthetix_search_highlight' ) ) {

	/**
	 * Highlight search results.
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
// add_filter( 'the_title', 'aesthetix_search_highlight' );
// add_filter( 'the_content', 'aesthetix_search_highlight' );
// add_filter( 'the_excerpt', 'aesthetix_search_highlight' );