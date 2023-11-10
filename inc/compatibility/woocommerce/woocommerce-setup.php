<?php
/**
 * WooCommerce setup.
 * 
 * @since 1.0.0
 *
 * @link https://woocommerce.com/
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_woo_setup' ) ) {

	/**
	 * WooCommerce setup function.
	 * 
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function aesthetix_woo_setup() {

		add_theme_support( 'woocommerce', array(
			'product_grid' => array(
				'default_rows'    => 3,
				'min_rows'        => 2,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		) );

		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

		/**
		 * Disable the default WooCommerce stylesheet.
		 *
		 * Removing the default WooCommerce stylesheet and enqueing your own will protect you during WooCommerce core updates.
		 *
		 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
		 */
		// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	}
}
add_action( 'after_setup_theme', 'aesthetix_woo_setup' );

if ( ! function_exists( 'aesthetix_woo_enqueue_styles' ) ) {

	/**
	 * Function for 'woocommerce_enqueue_styles' filter-hook.
	 * 
	 * @since 1.0.0
	 * 
	 * @param array $array List of default WooCommerce styles.
	 *
	 * @return array
	 */
	function aesthetix_woo_enqueue_styles( $styles ) {

		$styles = array(
			'woocommerce-layout'      => array(
				'src'     => get_theme_file_uri( '/assets/css/woocommerce/woocommerce-layout.min.css' ),
				'deps'    => '',
				'version' => filemtime( get_theme_file_path( '/assets/css/woocommerce/woocommerce-layout.min.css' ) ),
				'media'   => 'all',
				'has_rtl' => true,
			),
			'woocommerce-smallscreen' => array(
				'src'     => get_theme_file_uri( '/assets/css/woocommerce/woocommerce-smallscreen.min.css' ),
				'deps'    => 'woocommerce-layout',
				'version' => filemtime( get_theme_file_path( '/assets/css/woocommerce/woocommerce-smallscreen.min.css' ) ),
				'media'   => 'only screen and (max-width: ' . apply_filters( 'woocommerce_style_smallscreen_breakpoint', '768px' ) . ')',
				'has_rtl' => true,
			),
			'woocommerce-general'     => array(
				'src'     => get_theme_file_uri( '/assets/css/woocommerce/woocommerce.min.css' ),
				'deps'    => '',
				'version' => filemtime( get_theme_file_path( '/assets/css/woocommerce/woocommerce.min.css' ) ),
				'media'   => 'all',
				'has_rtl' => true,
			),
		);

		return $styles;
	}
}
add_filter( 'woocommerce_enqueue_styles', 'aesthetix_woo_enqueue_styles' );

if ( ! function_exists( 'aesthetix_woo_scripts' ) ) {

	/**
	 * WooCommerce specific scripts & stylesheets.
	 * 
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function aesthetix_woo_scripts() {

		// wp_enqueue_style( 'woocommerce', get_theme_file_uri( '/assets/css/woocommerce.min.css' ), array(), filemtime( get_theme_file_path( '/assets/css/woocommerce.min.css' ) ) );

		$font_path      = WC()->plugin_url() . '/assets/fonts/';
		$wc_inline_font = '@font-face {
				font-family: "star";
				src: url("' . $font_path . 'star.eot");
				src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
					url("' . $font_path . 'star.woff") format("woff"),
					url("' . $font_path . 'star.ttf") format("truetype"),
					url("' . $font_path . 'star.svg#star") format("svg");
				font-weight: normal;
				font-style: normal;
			}';

		// wp_add_inline_style( 'woocommerce', $wc_inline_font );

		$button_classes = get_button_classes( 'icon icon-cart-shopping' );

		if ( is_product_archive() || is_product() ) {
			$add_button_classes = 'jQuery(function($) {
				$( \'.add_to_cart_button\' ).each(function() {
					$(this).addClass( \'' . esc_attr( implode( ' ', $button_classes ) ) . '\' );
				});
			});';

			wp_add_inline_script( 'woocommerce', minify_js( $add_button_classes ) );
		}

		$link_classes = get_link_classes();

		if ( is_product_archive() || is_product() ) {
			$add_link_classes = 'jQuery(function($) {
				$( \'.woocommerce-breadcrumb a, .product_meta a, .woocommerce-review-link\' ).each(function() {
					$(this).addClass( \'' . esc_attr( implode( ' ', $link_classes ) ) . '\' );
				});
			});';

			wp_add_inline_script( 'woocommerce', minify_js( $add_link_classes ) );
		}

	}
}
add_action( 'wp_enqueue_scripts', 'aesthetix_woo_scripts' );

if ( ! function_exists( 'aesthetix_woo_widgets_init' ) ) {

	/**
	 * Register widget area.
	 * 
	 * @since 1.0.0
	 *
	 * @return void
	 */
	function aesthetix_woo_widgets_init() {
		register_sidebar(
			apply_filters(
				'aesthetix_woo_sidebar_shop_init',
				array(
					'name'          => esc_html__( 'WooCommerce sidebar', 'aesthetix' ),
					'id'            => 'shop-sidebar',
					'description'   => __( 'This sidebar will be used on product archive, cart, checkout and my account pages', 'aesthetix' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			)
		);
		register_sidebar(
			apply_filters(
				'aesthetix_woo_sidebar_single_product_init',
				array(
					'name'          => esc_html__( 'Product sidebar', 'aesthetix' ),
					'id'            => 'single-product-sidebar',
					'description'   => __( 'This sidebar will be used on single product page', 'aesthetix' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2 class="widget-title">',
					'after_title'   => '</h2>',
				)
			)
		);
	}
}
add_action( 'widgets_init', 'aesthetix_woo_widgets_init' );




























if ( ! function_exists( 'aesthetix_woo_products_per_page' ) ) {

	/**
	 * Products per page.
	 *
	 * @return int.
	 */
	function aesthetix_woo_products_per_page() {
		return 12;
	}
}
// add_filter( 'loop_shop_per_page', 'aesthetix_woo_products_per_page' );

if ( ! function_exists( 'aesthetix_woo_loop_columns' ) ) {

	/**
	 * Set min and max loop shop columns count.
	 *
	 * @return integer products per row.
	 */
	function aesthetix_woo_loop_columns( $columns ) {

		return 4;

		if ( (int) $columns < 2 ) {
			return 2;
		} elseif ( (int) $columns > 6 ) {
			return 6;
		}

		return $columns;
	}
}
// add_filter( 'loop_shop_columns', 'aesthetix_woo_loop_columns' );

if ( ! function_exists( 'aesthetix_woo_thumbnail_columns' ) ) {

	/**
	 * Product gallery thumnbail columns.
	 *
	 * @return int.
	 */
	function aesthetix_woo_thumbnail_columns() {
		return 4;
	}
}
// add_filter( 'woocommerce_product_thumbnails_columns', 'aesthetix_woo_thumbnail_columns' );



if ( ! function_exists( 'aesthetix_woo_related_products_args' ) ) {

	/**
	 * Related Products Args.
	 *
	 * @param array $args related products args.
	 *
	 * @return array.
	 */
	function aesthetix_woo_related_products_args( $args ) {
		$defaults = array(
			'posts_per_page' => 3,
			'columns'        => 3,
		);

		$args = wp_parse_args( $defaults, $args );

		return $args;
	}
}
add_filter( 'woocommerce_output_related_products_args', 'aesthetix_woo_related_products_args' );

if ( ! function_exists( 'aesthetix_woo_product_columns_wrapper' ) ) {

	/**
	 * Product columns wrapper.
	 *
	 * @return void
	 */
	function aesthetix_woo_product_columns_wrapper() {
		echo '<div class="columns-' . absint( aesthetix_woo_loop_columns() ) . '">';
	}
}
// add_action( 'woocommerce_before_shop_loop', 'aesthetix_woo_product_columns_wrapper', 40 );

if ( ! function_exists( 'aesthetix_woo_product_columns_wrapper_close' ) ) {

	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function aesthetix_woo_product_columns_wrapper_close() {
		echo '</div>';
	}
}
// add_action( 'woocommerce_after_shop_loop', 'aesthetix_woo_product_columns_wrapper_close', 40 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'aesthetix_woo_header_cart' ) ) {
			aesthetix_woo_header_cart();
		}
	?>
 */

if ( ! function_exists( 'aesthetix_woo_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments. Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 *
	 * @return array Fragments to refresh via AJAX.
	 */
	function aesthetix_woo_cart_link_fragment( $fragments ) {
		ob_start();
		aesthetix_woo_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'aesthetix_woo_cart_link_fragment' );

if ( ! function_exists( 'aesthetix_woo_cart_link' ) ) {

	/**
	 * Cart Link. Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function aesthetix_woo_cart_link() { ?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'aesthetix' ); ?>">
			<?php
				$item_count_text = sprintf(
					/* translators: number of items in the mini cart. */
					_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'aesthetix' ),
					WC()->cart->get_cart_contents_count()
				);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'aesthetix_woo_header_cart' ) ) {

	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function aesthetix_woo_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		} ?>

		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php aesthetix_woo_cart_link(); ?>
			</li>
			<li>
				<?php
					$instance = array(
						'title' => '',
					);

					the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

if ( ! function_exists( 'aesthetix_change_breadcrumb_delimiter' ) ) {
	/**
	 * Breadcrumbs delimetr.
	 *
	 * @return array
	 */
	function aesthetix_change_breadcrumb_delimiter( $defaults ) {
		$defaults['delimiter'] = '  /  ';
		return $defaults;
	}
}
add_filter( 'woocommerce_breadcrumb_defaults', 'aesthetix_change_breadcrumb_delimiter' );