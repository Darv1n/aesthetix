<?php
/**
 * WooCommerce filters.
 *
 * @link https://woocommerce.com/
 *
 * @package Aesthetix
 */

if ( ! function_exists( 'aesthetix_woo_active_body_class' ) ) {

	/**
	 * Add 'woocommerce-active' class to the body tag.
	 *
	 * @param array $classes CSS classes applied to the body tag.
	 * 
	 * @return array
	 */
	function aesthetix_woo_active_body_class( $classes ) {
		$classes[] = 'woocommerce-active';

		return $classes;
	}
}
add_filter( 'body_class', 'aesthetix_woo_active_body_class' );

if ( ! function_exists( 'get_aesthetix_woo_sidebar' ) ) {

	/**
	 * Assign shop sidebar for store page.
	 *
	 * @param string $sidebar Sidebar.
	 *
	 * @return string
	 */
	function get_aesthetix_woo_sidebar( $sidebar ) {

		if ( is_shop() || is_product_taxonomy() || is_checkout() || is_cart() || is_account_page() ) {
			$sidebar = 'shop-sidebar';
		} elseif ( is_product() ) {
			$sidebar = 'single-product-sidebar';
		}

		return $sidebar;
	}
}
add_filter( 'get_aesthetix_sidebar', 'get_aesthetix_woo_sidebar' );

if ( ! function_exists( 'aesthetix_woo_rating_markup' ) ) {

	/**
	 * Rating Markup.
	 *
	 * @param string $html   Rating Markup.
	 * @param float  $rating Rating being shown.
	 * @param int    $count  Total number of ratings.
	 * 
	 * @return string
	 */
	function aesthetix_woo_rating_markup( $html, $rating, $count ) {

		if ( '0' === $rating ) {
			$html  = '<div class="star-rating" role="img">';
				$html .= wc_get_star_rating_html( $rating, $count );
			$html .= '</div>';
		}

		return $html;
	}
}
add_filter( 'woocommerce_product_get_rating_html', 'aesthetix_woo_rating_markup', 10, 3 );

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

