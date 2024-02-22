<?php
/**
 * Template actions.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_pre_get_posts' ) ) {

	/**
	 * Function for 'pre_get_posts' action-hook.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/pre_get_posts/
	 *
	 * @param WP_Query $query The WP_Query instance (passed by reference).
	 *
	 * @return void
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
		if ( $query->is_archive || $query->is_home ) {

			if ( $query->get( 'post_type' ) ) {
				$post_type = $query->get( 'post_type' );
			} else {
				$post_type = 'post';
			}


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

if ( ! function_exists( 'before_site_content_structure' ) ) {

	/**
	 * Display before site content structure in header.php.
	 */
	function before_site_content_structure() {

		$structure = array(
			'aside-menu',
			'aside-search', // TODO: Load by condition.
			'aside-subscribe', // TODO: Load by condition.
			'aside-cookie',
			'aside-scroll-top',
			'section-widget',
			'wrapper-section-content-start',
		);

		$structure = apply_filters( 'before_site_content_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'before_site_content_structure_loop_' . $value ):
					do_action( 'before_site_content_structure_loop_' . $value );
					break;
				case 'aside-menu':
					get_template_part( 'templates/aside/aside-menu' );
					break;
				case 'aside-search':
					get_template_part( 'templates/aside/aside-search' );
					break;
				case 'aside-subscribe':
					get_template_part( 'templates/aside/aside-subscribe' );
					break;
				case 'aside-cookie':
					get_template_part( 'templates/aside/aside-cookie' );
					break;
				case 'aside-scroll-top':
					get_template_part( 'templates/aside/aside-scroll-top' );
					break;
				case 'section-widget':
					get_template_part( 'templates/section/section-widget', '', array( 'widget_id' => 'after-header' ) );
					break;
				case 'wrapper-section-content-start':
					get_template_part( 'templates/wrapper/wrapper-section-content-start' );
					break;
				default:
					if ( locate_template( '/templates/section/' . $value . '.php' ) !== '' ) {
						get_template_part( 'templates/section/' . $value );
					}
					break;
			}
		}
	}
}
add_action( 'before_site_content', 'before_site_content_structure' );

if ( ! function_exists( 'after_site_content_structure' ) ) {

	/**
	 * Display after site content structure in footer.php.
	 */
	function after_site_content_structure() {

		$structure = array(
			'wrapper-section-content-end',
			'section-widget',
		);

		if ( get_aesthetix_options( 'general_subscribe_form_display' ) ) {
			$structure[] = 'subscribe-form';
		}

		$structure = apply_filters( 'after_site_content_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'after_site_content_structure_loop_' . $value ):
					do_action( 'after_site_content_structure_loop_' . $value );
					break;
				case 'wrapper-section-content-end':
					get_template_part( 'templates/wrapper/wrapper-section-content-end' );
					break;
				case 'section-widget':
					get_template_part( 'templates/section-widget', '', array( 'widget_id' => 'before-footer' ) );
					break;
				default:
					if ( locate_template( '/templates/section/' . $value . '.php' ) !== '' ) {
						get_template_part( 'templates/section/' . $value );
					}
					break;
			}
		}
	}
}
add_action( 'after_site_content', 'after_site_content_structure' );

if ( ! function_exists( 'before_single_post_structure' ) ) {

	/**
	 * Display before single post structure in single.php.
	 */
	function before_single_post_structure() {

		$structure = array(
			'section-widget',
		);

		$structure = apply_filters( 'before_single_post_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'before_single_post_structure_loop_' . $value ):
					do_action( 'before_single_post_structure_loop_' . $value );
					break;
				case 'section-widget':
					get_template_part( 'templates/section-widget', '', array( 'widget_id' => 'before-post-content' ) );
					break;
				default:
					if ( locate_template( '/templates/section/' . $value . '.php' ) !== '' ) {
						get_template_part( 'templates/section/' . $value );
					}
					break;
			}
		}
	}
}
add_action( 'before_single_post', 'before_single_post_structure' );

if ( ! function_exists( 'after_single_post_structure' ) ) {

	/**
	 * Display after single post structure in single.php.
	 */
	function after_single_post_structure() {

		$structure = array(
			'single-pagination',
			'section-widget',
			'single-similar-posts',
			'single-comments',
		);

		$structure = apply_filters( 'after_single_post_structure', $structure );

		foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'after_single_post_structure_loop_' . $value ):
					do_action( 'after_single_post_structure_loop_' . $value );
					break;
				case 'single-pagination':
					get_template_part( 'templates/single-pagination' );
					break;
				case 'single-similar-posts':
					get_template_part( 'templates/single/single-similar-posts' );
					break;
				case 'single-comments':
					comments_template();
					break;
				case 'section-widget':
					get_template_part( 'templates/section-widget', '', array( 'widget_id' => 'after-post-content' ) );
					break;
				default:
					if ( locate_template( '/templates/section/' . $value . '.php' ) !== '' ) {
						get_template_part( 'templates/section/' . $value );
					}
					break;
			}
		}
	}
}
add_action( 'after_single_post', 'after_single_post_structure' );
