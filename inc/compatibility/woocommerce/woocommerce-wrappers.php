<?php
/**
 * WooCommerce wrappers.
 *
 * @link https://woocommerce.com/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add custom class to "Add to Cart" button
function add_custom_class_to_add_to_cart_button( $classes, $product ) {
    // Add your custom class name here
    $classes[] = 'custom-add-to-cart';

    return $classes;
}
// add_filter( 'woocommerce_product_single_add_to_cart_class', 'add_custom_class_to_add_to_cart_button', 10, 2 );

