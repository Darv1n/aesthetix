<?php
/**
 * WooCommerce wrappers
 *
 * @link https://woocommerce.com/
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @package aesthetix
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
add_filter( 'woocommerce_product_single_add_to_cart_class', 'add_custom_class_to_add_to_cart_button', 10, 2 );

