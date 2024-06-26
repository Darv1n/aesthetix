<?php
/**
 * Customizer selects.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'get_woocommerce_customizer_product_catalog_structure' ) ) {

	/**
	 * Return array with the customizer product catalog structure.
	 *
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type
	 *
	 * @return string|array|false
	 */
	function get_woocommerce_customizer_product_catalog_structure( $control = null, $post_type = null ) {

		// Sanitize string (just to be safe).
		if ( ! is_null( $control ) ) {
			$control = get_title_slug( $control );
		}

		$converter = array(
			'title'    => __( 'Product title', 'aesthetix' ),
			'rating'   => __( 'Rating', 'aesthetix' ),
			'price'    => __( 'Price', 'aesthetix' ),
			'add_cart' => __( 'Add to cart button', 'aesthetix' ),
		);

		// Merge child and parent default options.
		$converter = apply_filters( 'get_woocommerce_customizer_product_catalog_structure', $converter, $post_type );

		// Return controls.
		if ( is_null( $control ) ) {
			return $converter;
		} elseif ( ! isset( $converter[ $control ] ) || empty( $converter[ $control ] ) ) {
			return false;
		} else {
			return $converter[ $control ];
		}
	}
}
