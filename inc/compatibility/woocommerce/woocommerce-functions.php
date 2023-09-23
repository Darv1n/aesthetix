<?php
/**
 * WooCommerce functions.
 *
 * @link https://woocommerce.com/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'is_woocommerce_activated' ) ) {

	/**
	 * Query WooCommerce activation.
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

if ( ! function_exists( 'is_product_archive' ) ) {

	/**
	 * Checks if the current page is a product archive.
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function is_product_archive() {
		if ( is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag() ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'is_product_subcategory' ) ) {

	/**
	 * Check if the current page is a Product Subcategory page or not.
	 *
	 * @param integer $category_id Current page Category ID.
	 * 
	 * @return boolean
	 * 
	 * @since 1.0.6
	 */
	function is_product_subcategory( $category_id = null ) {
		if ( is_tax( 'product_cat' ) ) {
			if ( empty( $category_id ) ) {
				$category_id = get_queried_object_id();
			}
			$category = get_term( get_queried_object_id(), 'product_cat' );
			if ( empty( $category->parent ) ) {
				return false;
			}
			return true;
		}
		return false;
	}
}