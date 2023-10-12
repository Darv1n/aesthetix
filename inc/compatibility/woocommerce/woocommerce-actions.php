<?php
/**
 * WooCommerce actions.
 *
 * @link https://woocommerce.com/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'aesthetix_woo_wrapper_before' ) ) {

	/**
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @hooked woocommerce_before_main_content - 10
	 * 
	 * @since 1.0.6
	 */
	function aesthetix_woo_wrapper_before() { ?>

		<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">
	<?php }
}
add_action( 'woocommerce_before_main_content', 'aesthetix_woo_wrapper_before' );

if ( ! function_exists( 'aesthetix_woo_wrapper_after' ) ) {

	/**
	 * Closes the wrapping div.
	 *
	 * @hooked woocommerce_after_main_content - 10
	 * 
	 * @since 1.0.6
	 */
	function aesthetix_woo_wrapper_after() { ?>

		</main>
	<?php }
}
add_action( 'woocommerce_after_main_content', 'aesthetix_woo_wrapper_after' );

if ( ! function_exists( 'aesthetix_woo_shop_thumbnail_wrap_start' ) ) {

	/**
	 * Thumbnail wrap start.
	 * 
	 * @hooked woocommerce_before_shop_loop_item - 6
	 * 
	 * @since 1.0.6
	 */
	function aesthetix_woo_shop_thumbnail_wrap_start() {

		echo '<div class="product-thumbnail-wrap">';
	}
}
add_action( 'woocommerce_before_shop_loop_item', 'aesthetix_woo_shop_thumbnail_wrap_start', 6 );

if ( ! function_exists( 'aesthetix_woo_shop_thumbnail_wrap_end' ) ) {

	/**
	 * Thumbnail wrap end.
	 * 
	 * @hooked woocommerce_after_shop_loop_item - 8
	 * 
	 * @since 1.0.6
	 */
	function aesthetix_woo_shop_thumbnail_wrap_end() {

		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'aesthetix_woo_shop_thumbnail_wrap_end', 8 );

if ( ! function_exists( 'aesthetix_woo_shop_out_of_stock' ) ) {

	/**
	 * Add Out of Stock to the Shop page
	 *
	 * @hooked woocommerce_shop_loop_item_title - 10
	 *
	 * @since 1.0.6
	 */
	function aesthetix_woo_shop_out_of_stock() {
		$stock_status        = get_post_meta( get_the_ID(), '_stock_status', true );
		$out_of_stock_string = apply_filters( 'aesthetix_woo_shop_out_of_stock_string', __( 'Out of stock', 'aesthetix' ) );
		$on_backorder_string = apply_filters( 'aesthetix_woo_shop_on_backorder_string', __( 'On backorder', 'aesthetix' ) );

		if ( 'outofstock' === $stock_status ) { ?>
			<span class="stock out-of-stock"><?php esc_html_e( $out_of_stock_string ); ?></span>
		<?php } elseif ( 'onbackorder' === $stock_status ) { ?>
			<span class="stock on-backorder"><?php esc_html_e( $on_backorder_string ); ?></span>
		<?php }
	}
}
add_action( 'woocommerce_shop_loop_item_title', 'aesthetix_woo_shop_out_of_stock', 10 );

/**
 * Remove WooCommerce shop structure.
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

if ( ! function_exists( 'aesthetix_woo_shop_product_content' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 * 
	 * @hooked woocommerce_after_shop_loop_item - 10
	 * 
	 * @since 1.0.6
	 */
	function aesthetix_woo_shop_product_content() {

		$structure = get_aesthetix_options( 'woocommerce_product_catalog_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {
			
			$structure = array_map( 'trim', explode( ',', $structure ) );

			echo '<div class="product-summary-wrap">';

			foreach ( $structure as $key => $value ) {

				switch ( $value ) {
					case has_action( 'woocommerce_product_catalog_loop_' . $value ):
						do_action( 'woocommerce_product_catalog_loop_' . $value, $post );
						break;
					case 'title':
						woocommerce_template_loop_product_title();
						break;
					case 'price':
						woocommerce_template_loop_price();
						break;
					case 'rating':
						woocommerce_template_loop_rating();
						break;
					case 'short_desc':
						// astra_woo_shop_product_short_description();
						break;
					case 'add_cart':
						woocommerce_template_loop_add_to_cart();
						break;
					case 'category':
						// astra_woo_shop_parent_category();
						break;
					default:
						break;
				}
			}

			echo '</div>';

		}
	}
}
add_action( 'woocommerce_after_shop_loop_item', 'aesthetix_woo_shop_product_content' );