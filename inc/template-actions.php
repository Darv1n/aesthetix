<?php
/**
 * Template actions
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_pre_get_posts' ) ) {

	/**
	 * Function for 'pre_get_posts' action hook.
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_pre_get_posts( $query ) {

		// Exit if is admin or not main query request.
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Sort search results by post_type.
		if ( $query->is_search ) {
			$query->set( 'orderby', 'type' );
			$query->set( 'posts_per_page', 36 );
		}

		// Sort post by aesthetix option.
		if ( $query->is_archive ) {

			$post_type = $query->get( 'post_type' ) ?? 'post';

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_per_page' ) ) {
				$query->set( 'posts_per_page', get_aesthetix_options( 'archive_' . $post_type . '_posts_per_page' ) );
			}

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ) ) {
				$query->set( 'order', get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ) );
			}

			if ( get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ) ) {
				$query->set( 'orderby', get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ) );
			}
		}
	}
}
add_action( 'pre_get_posts', 'aesthetix_pre_get_posts', 1 );

if ( ! function_exists( 'admin_bar_init_callback' ) ) {

	/**
	 * Function for `admin_bar_init` action-hook.
	 * 
	 * @return void
	 * 
	 * @since 1.1.1
	 */
	function admin_bar_init_callback() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );

		add_action( 'wp_head', static function() {
			$type_attr = current_theme_supports( 'html5', 'style' ) ? '' : ' type="text/css"'; ?>
				<style<?php echo $type_attr; ?> media="screen">
					header { margin-top: 32px !important; }
					@media screen and ( max-width: 782px ) {
						header { margin-top: 46px !important; }
					}
				</style>
		<?php } );
	}
}
add_action( 'admin_bar_init', 'admin_bar_init_callback');

if ( ! function_exists( 'before_site_content_structure' ) ) {

	/**
	 * Display before site content structure in header.php.
	 * 
	 * @since 1.1.1
	 */
	function before_site_content_structure() {

		$structure = array(
			'search-sidebar',
			'first-screen',
			'breadcrumbs',
			'content-wrapper-start',
		);

		$structure = apply_filters( 'before_site_content_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'before_site_content_structure_loop_' . $value ):
					do_action( 'before_site_content_structure_loop_' . $value );
					break;
				case 'search-sidebar':
					get_template_part( 'templates/search-sidebar' );
					break;
				case 'first-screen':
					get_template_part( 'templates/first-screen' );
					break;
				case 'breadcrumbs':
					get_template_part( 'templates/breadcrumbs' );
					break;
				case 'content-wrapper-start':
					get_template_part( 'templates/content-wrapper', 'start' );
					break;
				default:
					break;
			}
		}
	}
}
add_action( 'before_site_content', 'before_site_content_structure' );

if ( ! function_exists( 'after_site_content_structure' ) ) {

	/**
	 * Display after site content structure in footer.php.
	 * 
	 * @since 1.1.1
	 */
	function after_site_content_structure() {

		$structure = array(
			'content-wrapper-end',
		);

		$structure = apply_filters( 'after_site_content_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'after_site_content_structure_loop_' . $value ):
					do_action( 'after_site_content_structure_loop_' . $value );
					break;
				case 'content-wrapper-end':
					get_template_part( 'templates/content-wrapper', 'end' );
					break;
				default:
					break;
			}
		}
	}
}
add_action( 'after_site_content', 'after_site_content_structure' );

if ( ! function_exists( 'wp_footer_close_structure' ) ) {

	/**
	 * Display mobile menu structure in footer.php.
	 * 
	 * @since 1.1.1
	 */
	function wp_footer_close_structure() {

		$structure = array(
			'scroll-top',
			'cookie',
		);

		$structure = apply_filters( 'wp_footer_close_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'wp_footer_close_structure_loop_' . $value ):
					do_action( 'wp_footer_close_structure_loop_' . $value );
					break;
				case 'scroll-top':
					get_template_part( 'templates/button', 'scroll-top' );
					break;
				case 'cookie':
					get_template_part( 'templates/cookie' );
					break;
				default:
					break;
			}
		}
	}
}
add_action( 'wp_footer_close', 'wp_footer_close_structure' );

if ( ! function_exists( 'aesthetix_after_main_navigation_structure' ) ) {

	/**
	 * Display mobile menu structure in templates/header-content-*.php.
	 * 
	 * @since 1.1.1
	 */
	function aesthetix_after_main_navigation_structure() {

		$structure = get_aesthetix_options( 'general_mobile_menu_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {
			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_after_main_navigation_structure_loop_' . $value ):
						do_action( 'aesthetix_after_main_navigation_structure_loop_' . $value );
						break;
					case 'menu':
						get_template_part( 'templates/button', 'menu-toggle' );
						break;
					case 'search':
						get_template_part( 'templates/button', 'search-toggle' );
						break;
					default:
						break;
				}
			}
		}
	}
}
add_action( 'aesthetix_after_main_navigation', 'aesthetix_after_main_navigation_structure' );
