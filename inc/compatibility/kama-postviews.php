<?php
/**
 * Kama Postviews.
 *
 * @link https://wp-kama.ru/plugin/kama-postviews
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'kama_postviews_save_post' ) ) {

	/**
	 * Function for 'save_post' action-hook.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/save_post/
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	function kama_postviews_save_post( $post_id ) {

		// Add starting number of views for all published pages.
		$views = random_int( 20, 50 );

		add_post_meta( $post_id, 'views', $views, true );
		add_post_meta( $post_id, 'views_prev_month', $views, true );
	}
}
add_action( 'save_post', 'kama_postviews_save_post' );

if ( ! function_exists( 'kama_postview_archive_entry_post_meta_loop' ) ) {

	/**
	 * Function for 'aesthetix_archive_entry_post_meta_loop' action-hook.
	 *
	 * @param WP_Object $post Post object.
	 *
	 * @return void
	 */
	function kama_postview_archive_entry_post_meta_loop( $post ) {  ?>

		<li class="post-entry-meta-item icon icon-before icon-eye data-title" data-title="<?php esc_attr_e( 'Views', 'aesthetix' ); ?>">
			<?php echo get_fresh_kap_views( get_the_ID(), 'post' ); ?>
		</li>
	<?php }
}
add_action( 'aesthetix_archive_entry_post_meta_loop_views', 'kama_postview_archive_entry_post_meta_loop' );
add_action( 'aesthetix_single_entry_post_meta_loop_views', 'kama_postview_archive_entry_post_meta_loop' );

if ( ! function_exists( 'wp_enqueue_kama_postviews_styles' ) ) {

	/**
	 * Function for wp_enqueue_scripts action-hook.
	 * 
	 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
	 * 
	 * @return void
	 */
	function wp_enqueue_kama_postviews_styles() {

		$css = '
			.fresh-views__month {
				display: none;
			}';

		wp_add_inline_style( 'common-styles', minify_css( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_kama_postviews_styles', 11 );

if ( ! function_exists( 'get_kama_postview_customizer_post_meta_structure' ) ) {

	/**
	 * Function for 'get_aesthetix_customizer_post_meta_structure' action-hook.
	 * 
	 * @param string $control   Array key to get one value.
	 * @param string $post_type Current post type.
	 *
	 * @return array
	 */
	function get_kama_postview_customizer_post_meta_structure( $converter, $post_type ) {

		// Kama PostViews options.
		$converter['views'] = __( 'Views', 'aesthetix' );

		return $converter;
	}
}
add_filter( 'get_aesthetix_customizer_post_meta_structure', 'get_kama_postview_customizer_post_meta_structure', 10, 2 );

if ( ! function_exists( 'get_kama_postview_options' ) ) {

	/**
	 * Function for 'get_aesthetix_options' action-hook.
	 *
	 * @param string $aesthetix_defaults Array with default theme options.
	 *
	 * @return array
	 */
	function get_kama_postview_options( $aesthetix_defaults ) {

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$archive_meta_structure = array_map( 'trim', explode( ',', $aesthetix_defaults[ 'archive_' . $post_type . '_meta_structure' ] ) );
			array_pop( $archive_meta_structure );
			$archive_meta_structure[] = 'views';
			$archive_meta_structure[] = 'edit';
			$aesthetix_defaults[ 'archive_' . $post_type . '_meta_structure' ] = implode( ',', $archive_meta_structure );

			$single_meta_structure = array_map( 'trim', explode( ',', $aesthetix_defaults[ 'single_' . $post_type . '_meta_structure' ] ) );
			array_pop( $single_meta_structure );
			$single_meta_structure[] = 'views';
			$single_meta_structure[] = 'edit';
			$aesthetix_defaults[ 'single_' . $post_type . '_meta_structure' ] = implode( ',', $single_meta_structure );
		}

		return $aesthetix_defaults;
	}
}
add_filter( 'get_aesthetix_options', 'get_kama_postview_options' );
