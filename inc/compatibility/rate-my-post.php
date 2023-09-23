<?php
/**
 * Rate my Post
 *
 * @link https://wordpress.org/plugins/rate-my-post/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'rmp_save_post' ) ) {

	/**
	 * Function for 'save_post' action hook.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/save_post/
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function rmp_save_post( $post_id ) {

		// Add a starting rating for all published pages.
		add_post_meta( $post_id, 'rmp_vote_count', 1, true );
		add_post_meta( $post_id, 'rmp_rating_val_sum', 5, true );
	}
}
add_action( 'save_post', 'rmp_save_post' );

if ( ! function_exists( 'get_rmp_result_customizer_post_meta_structure' ) ) {

	/**
	 * Function for 'get_aesthetix_customizer_post_meta_structure' action hook.
	 *
	 * @param string $control   array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function get_rmp_result_customizer_post_meta_structure( $converter, $post_type ) {

		// Kama PostViews options.
		$converter['rmp'] = __( 'Rating', 'aesthetix' );

		return $converter;
	}
}
add_filter( 'get_aesthetix_customizer_post_meta_structure', 'get_rmp_result_customizer_post_meta_structure', 10, 2 );

if ( ! function_exists( 'get_rmp_result_options' ) ) {

	/**
	 * Function for 'get_aesthetix_options' action hook.
	 *
	 * @param string $aesthetix_defaults array with default theme options.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function get_rmp_result_options( $aesthetix_defaults ) {

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$archive_meta_structure = array_map( 'trim', explode( ',', $aesthetix_defaults[ 'archive_' . $post_type . '_meta_structure' ] ) );
			array_pop( $archive_meta_structure );
			$archive_meta_structure[] = 'rmp';
			$archive_meta_structure[] = 'edit';
			$aesthetix_defaults[ 'archive_' . $post_type . '_meta_structure' ] = implode( ',', $archive_meta_structure );

			$single_meta_structure = array_map( 'trim', explode( ',', $aesthetix_defaults[ 'single_' . $post_type . '_meta_structure' ] ) );
			array_pop( $single_meta_structure );
			$single_meta_structure[] = 'rmp';
			$single_meta_structure[] = 'edit';
			$aesthetix_defaults[ 'single_' . $post_type . '_meta_structure' ] = implode( ',', $single_meta_structure );
		}

		return $aesthetix_defaults;
	}
}
add_filter( 'get_aesthetix_options', 'get_rmp_result_options' );

if ( ! function_exists( 'rmp_result_archive_entry_post_meta_loop' ) ) {

	/**
	 * Function for 'aesthetix_archive_entry_post_meta_loop' action hook.
	 *
	 * @param WP_Object $post Post Object.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/save_post/
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function rmp_result_archive_entry_post_meta_loop( $post ) {  ?>

		<li class="meta__item meta__item_rating-count data-title" data-title="<?php _e( 'Rating', 'aesthetix' ); ?>">
			<?php echo do_shortcode( '[ratemypost-result]' ); ?>
		</li>

	<?php }
}
add_action( 'aesthetix_archive_entry_post_meta_loop_views', 'rmp_result_archive_entry_post_meta_loop' );
add_action( 'aesthetix_single_entry_post_meta_loop_views', 'rmp_result_archive_entry_post_meta_loop' );

if ( ! function_exists( 'get_rmp_customizer_single_post_footer_structure' ) ) {

	/**
	 * Function for 'get_aesthetix_customizer_single_post_footer_structure' action hook.
	 *
	 * @param string $control   array key to get one value.
	 * @param string $post_type current post type
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function get_rmp_customizer_single_post_footer_structure( $converter, $post_type ) {

		// Kama PostViews options.
		$converter['rmp'] = __( 'Rating', 'aesthetix' );

		return $converter;
	}
}
add_filter( 'get_aesthetix_customizer_single_post_footer_structure', 'get_rmp_customizer_single_post_footer_structure', 10, 2 );

if ( ! function_exists( 'get_rmp_options' ) ) {

	/**
	 * Function for 'get_aesthetix_options' action hook.
	 *
	 * @param string $aesthetix_defaults array with default theme options.
	 *
	 * @return array
	 * 
	 * @since 1.0.0
	 */
	function get_rmp_options( $aesthetix_defaults ) {

		foreach ( get_aesthetix_customizer_post_types() as $key => $post_type ) {

			if ( ! post_type_exists( $post_type ) ) {
				continue;
			}

			$single_footer_structure = array_map( 'trim', explode( ',', $aesthetix_defaults[ 'single_' . $post_type . '_footer_structure' ] ) );
			array_pop( $single_footer_structure );
			$single_footer_structure[] = 'rmp';
			$single_footer_structure[] = 'edit';
			$aesthetix_defaults[ 'single_' . $post_type . '_footer_structure' ] = implode( ',', $single_footer_structure );
		}

		return $aesthetix_defaults;
	}
}
add_filter( 'get_aesthetix_options', 'get_rmp_options' );

if ( ! function_exists( 'rmp_single_entry_post_footer_loop_rmp' ) ) {

	/**
	 * Function for 'aesthetix_single_entry_post_footer_loop_rmp' action hook.
	 *
	 * @param WP_Object $post Post Object.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/save_post/
	 *
	 * @return void
	 * 
	 * @since 1.0.0
	 */
	function rmp_single_entry_post_footer_loop_rmp( $post ) {  ?>

		<?php echo do_shortcode( '[ratemypost]' ); ?>

	<?php }
}
add_action( 'aesthetix_single_entry_post_footer_loop_rmp', 'rmp_single_entry_post_footer_loop_rmp' );

if ( ! function_exists( 'wp_enqueue_rmp_styles' ) ) {

	/**
	 * Enqueue rmp styles.
	 * 
	 * @since 1.0.0
	 */
	function wp_enqueue_rmp_styles() {

		$css = '
			.rmp-results-widget {
				font-size: .75rem;
				display: inline-block;
				vertical-align: baseline;
			}
			.rmp-results-widget__avg-rating, .rmp-results-widget__vote-count {
				vertical-align: top;
			}
			.rmp-widgets-container.rmp-wp-plugin.rmp-main-container {
				text-align: left;
			}';

		wp_add_inline_style( 'common-styles', minify_css( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_rmp_styles', 11 );
