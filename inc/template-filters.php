<?php
/**
 * Template filters.
 *
 * @package Aesthetix
 * @since 1.0.0
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
			'nonce' => wp_create_nonce( 'ajax-nonce' ), // Создаем nonce.
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
	 * @param string $url         The URL to the privacy policy page. Empty string if it doesn't exist.
	 * @param int $policy_page_id The ID of privacy policy page.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_privacy_policy_url( $url ) {

		if ( empty( $url ) && is_multisite() && ! is_main_site() ) {
			switch_to_blog( 1 );
			$url = get_privacy_policy_url();
			restore_current_blog();
		}

		if ( empty( $url ) ) {
			$url = get_home_url();
		}

		return trailingslashit( $url );
	}
}
add_filter( 'privacy_policy_url', 'aesthetix_privacy_policy_url', 10 ); // Add a privacy policy link if it doesn't exist.

if ( ! function_exists( 'aesthetix_robots' ) ) {

	/**
	 * Function for 'wp_robots' filter-hook. Prints noindex, nofollow tags on archive pages, if there are no posts in this archive page.
	 *
	 * @param array $robots Parameter for filter.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
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
	 * @param string $output the robots.txt output.
	 * @param bool   $public whether the site is considered 'public'.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
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
	 * @param array $default_sizes An array of intermediate image size names.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
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
	 * @param array $args Parameter for filter.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
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
	 * @param string   $menu_id   The ID that is applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
	 */
	function remove_nav_menu_item_id( $id, $item, $args ) {
		return '';
	}
}
add_filter( 'nav_menu_item_id', 'remove_nav_menu_item_id', 10, 3 );

if ( ! function_exists( 'level_nav_menu_item_class' ) ) {

	/**
	 * Function for 'wp_nav_menu_objects' filter-hook.
	 * 
	 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 * @param stdClass $args              An object containing wp_nav_menu() arguments.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function level_nav_menu_item_class( $sorted_menu_items, $args ) {
		$level = 1;
		$stack = array('0');
		foreach ( $sorted_menu_items as $key => $item ) {
			while ( $item->menu_item_parent != array_pop( $stack ) ) {
				$level--;
			}
			$level++;
			$stack[] = $item->menu_item_parent;
			$stack[] = $item->ID;
			$sorted_menu_items[ $key ]->classes[] = 'level-'. ( $level - 1 );
		}
		return $sorted_menu_items;
	}
}
add_filter( 'wp_nav_menu_objects', 'level_nav_menu_item_class', 10, 2 );

if ( ! function_exists( 'remove_nav_menu_item_class' ) ) {

	/**
	 * Function for 'nav_menu_css_class' filter-hook.
	 * 
	 * @param array $classes   Array of the CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post  $menu_item The current menu item object.
	 * @param stdClass $args      An object of wp_nav_menu() arguments.
	 * @param int      $depth     Depth of menu item. Used for padding.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function remove_nav_menu_item_class( $classes, $item, $args ) {

		foreach ( $classes as $key => $class ) {
			if ( ! in_array( $class, array( 'menu-item', 'current-menu-item', 'menu-item-has-children', 'level-1' ), true ) ) {
				unset( $classes[ $key ] ); 
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
	 * @param string $text is text for highlight.
	 *
	 * @return string
	 * 
	 * @since 1.0.0
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

if ( ! function_exists( 'aesthetix_icon_color' ) ) {

	/**
	 * Return icon color depending on button, link or theme color scheme.
	 *
	 * @param string $classes Classes on the basis of which decisions are made.
	 *
	 * @return array
	 * 
	 * @since 1.1.6
	 */
	function aesthetix_icon_color( $classes, $color = 'primary', $button_type = null ) {

		if ( is_string( $classes ) ) {
			$classes = explode( ' ', $classes );
		}

		if ( ! is_array( $classes ) || ! in_array( 'icon', $classes, true ) ) {
			return $classes;
		}

		$color_scheme = get_aesthetix_options( 'root_color_scheme' );

		if ( in_array( 'link', $classes, true ) ) {
			if ( $color_scheme === 'black' ) {
				$classes[] = 'icon_white';
			} else {
				$classes[] = 'icon_black';
			}
		}

		if ( in_array( 'button', $classes, true ) ) {

			if ( in_array( 'button-reset', $classes, true ) ) {
				if ( $color_scheme === 'black' ) {
					$classes[] = 'icon_white';
				} else {
					$classes[] = 'icon_black';
				}
			} else {

				if ( is_null( $button_type ) ) {
					$button_type = get_aesthetix_options( 'root_button_type' );
				}

				if ( $color_scheme === 'white' && ( $button_type === 'empty' || in_array( 'button-disabled', $classes, true ) ) ) {
					$classes[] = 'icon_black';
				} else {
					$classes[] = 'icon_white';
				}
			}
		}

		return $classes;
	}
}
add_filter( 'get_link_classes', 'aesthetix_icon_color', 90 );
add_filter( 'get_button_classes', 'aesthetix_icon_color', 90, 3 );

