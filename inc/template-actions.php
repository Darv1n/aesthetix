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

if ( ! function_exists( 'aesthetix_breadcrumbs' ) ) {

	/**
	 * Display breadcrumbs on action hook wp_footer_close.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_breadcrumbs( $before = '', $after  = '' ) {

		if ( ! is_front_page() && ! is_home() && get_aesthetix_options( 'general_breadcrumbs_display' ) ) {

			$before .= '<section id="section-breadcrumbs" class="section section_breadcrumbs">';
				$before .= '<div class="' . esc_attr( implode( ' ', get_aesthetix_container_classes() ) ) . '">';
					$before .= '<div class="row">';
						$before .= '<div class="col-12 align-items-center">';

						$after .= '</div>';
					$after .= '</div>';
				$after .= '</div>';
			$after .= '</section>';

			if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {

				$before .= '<nav id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '" typeof="BreadcrumbList" vocab="https://schema.org/" aria-label="breadcrumb">';
					$before .= '<ol class="list-inline list-unstyled">';
					$after  .= '</ol>';
				$after  .= '</nav>';
			} else {
				$before .= '<div id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '">';
				$after  .= '</div>';
			}

			if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {
				echo $before;
					bcn_display_list();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'kama' && class_exists( 'Kama_Breadcrumbs' ) ) {
				echo $before;
					kama_breadcrumbs();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'yoast' && is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
				echo $before;
					yoast_breadcrumb( '<nav class="breadcrumbs__navigation">', '</nav>' );
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'rankmath' && is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
				echo $before;
					rank_math_the_breadcrumbs();
				echo $after;
			} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'seopress' && is_plugin_active( 'wp-seopress/seopress.php' ) ) {
				echo $before;
					seopress_display_breadcrumbs();
				echo $after;
			} elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				echo $before;
					woocommerce_breadcrumb();
				echo $after;
			}
		}
	}
}
add_action( 'before_site_content', 'aesthetix_breadcrumbs', 15 );

if ( ! function_exists( 'aesthetix_section_content_wrapper_start' ) ) {

	/**
	 * Display section content wrapper start in header.php.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_section_content_wrapper_start() {

		$output = '<section id="section-content" class="section section_content" aria-label="' . _x( 'Content section', 'aesthetix' ) . '">';
			$output .= '<div class="' . esc_attr( implode( ' ', get_aesthetix_container_classes() ) ) . '">';
				$output .= '<div class="row">';

		// Filter html output.
		$output = apply_filters( 'aesthetix_section_content_wrapper_start', $output );

		echo $output;
	}
}
add_action( 'before_site_content', 'aesthetix_section_content_wrapper_start', 50 );

if ( ! function_exists( 'aesthetix_section_content_wrapper_end' ) ) {

	/**
	 * Display section content wrapper end in footer.php.
	 * 
	 * @since 1.0.0
	 */
	function aesthetix_section_content_wrapper_end() {

				$output = '</div>';
			$output .= '</div>';
		$output .= '</section>';

		// Filter html output.
		$output = apply_filters( 'aesthetix_section_content_wrapper_end', $output );

		echo $output;
	}
}
add_action( 'after_site_content', 'aesthetix_section_content_wrapper_end', 50 );

