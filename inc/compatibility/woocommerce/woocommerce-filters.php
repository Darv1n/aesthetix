<?php
/**
 * WooCommerce filters.
 *
 * @link https://woocommerce.com/
 *
 * @package Aesthetix
 */

if ( ! function_exists( 'get_aesthetix_sidebar_woo_callback' ) ) {

	/**
	 * Assign shop sidebar for store page.
	 *
	 * @param string $sidebar Sidebar.
	 *
	 * @return string
	 */
	function get_aesthetix_sidebar_woo_callback( $sidebar ) {

		if ( is_shop() || is_product_taxonomy() || is_checkout() || is_cart() || is_account_page() ) {
			$sidebar = 'woo-sidebar-shop';
		} elseif ( is_product() ) {
			$sidebar = 'woo-sidebar-single-product';
		}

		return $sidebar;
	}
}
add_filter( 'get_aesthetix_sidebar', 'get_aesthetix_sidebar_woo_callback' );

if ( ! function_exists( 'aesthetix_register_sidebar_woo_callback' ) ) {

	/**
	 * Function for 'aesthetix_register_sidebar' filter-hook.
	 *
	 * @param array $sidebars Theme sidebars for register.
	 * 
	 * @return array
	 */
	function aesthetix_register_sidebar_woo_callback( $sidebars ) {

		$sidebars['woo-sidebar-shop'] = array(
			'name'        => esc_html__( 'WooCommerce sidebar', 'aesthetix' ),
			'description' => esc_html__( 'This sidebar will be used on product archive, cart, checkout and my account pages', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		$sidebars['woo-sidebar-single-product'] = array(
			'name'        => esc_html__( 'Product sidebar', 'aesthetix' ),
			'description' => esc_html__( 'This sidebar will be used on single product page', 'aesthetix' ),
			'title_tag'   => 'h3',
		);

		return $sidebars;
	}
}
add_filter( 'aesthetix_register_sidebar', 'aesthetix_register_sidebar_woo_callback' );

if ( ! function_exists( 'get_widget_classes_woo_callback' ) ) {

	/**
	 * Function for 'aesthetix_register_sidebar' filter-hook.
	 *
	 * @param array  $classes   Widget classes.
	 * @param string $widget_id Widget ID.
	 * 
	 * @return array
	 */
	function get_widget_classes_woo_callback( $classes, $widget_id ) {

		if ( ! is_null( $widget_id ) && in_array( $widget_id, array( 'woo-sidebar-shop', 'woo-sidebar-single-product' ), true ) ) {
			$classes[] = 'widget-background';
			$classes[] = 'widget-' . get_aesthetix_options( 'root_bg_aside_widgets' );
		}

		return $classes;
	}
}
add_filter( 'get_widget_classes', 'get_widget_classes_woo_callback', 10, 2 );

if ( ! function_exists( 'woocommerce_product_get_rating_html_aesthetix_callback' ) ) {

	/**
	 * Rating Markup.
	 *
	 * @param string $html   Rating Markup.
	 * @param float  $rating Rating being shown.
	 * @param int    $count  Total number of ratings.
	 * 
	 * @return string
	 */
	function woocommerce_product_get_rating_html_aesthetix_callback( $html, $rating, $count ) {

		if ( '0' === $rating ) {
			$html  = '<div class="star-rating" role="img">';
				$html .= wc_get_star_rating_html( $rating, $count );
			$html .= '</div>';
		}

		return $html;
	}
}
add_filter( 'woocommerce_product_get_rating_html', 'woocommerce_product_get_rating_html_aesthetix_callback', 10, 3 );

if ( ! function_exists( 'woocommerce_breadcrumb_defaults_aesthetix_callback' ) ) {

	/**
	 * Function for 'woocommerce_breadcrumb_defaults' filter-hook.
	 *
	 * @param array $args Arguments.
	 * 
	 * @return string
	 */
	function woocommerce_breadcrumb_defaults_aesthetix_callback( $args ) {

		$args['wrap_before'] = '<nav id="breadcrumbs" class="woocommerce-breadcrumb breadcrumbs breadcrumbs-woocommerce" aria-label="' . esc_attr_x( 'Breadcrumbs', 'breadcrumbs aria label', 'aesthetix' ) . '">';

		return $args;
	}
}
add_filter( 'woocommerce_breadcrumb_defaults', 'woocommerce_breadcrumb_defaults_aesthetix_callback', 10, 3 );
