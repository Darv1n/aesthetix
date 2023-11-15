<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aesthetix
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

$sidebar = apply_filters( 'get_aesthetix_sidebar', 'main' );

if ( is_active_sidebar( $sidebar ) ) { ?>

	<aside id="aside" <?php aesthetix_widget_area_classes( 'order-3 order-lg-3' ); ?> role="complementary">

		<?php do_action( 'aesthetix_before_sidebar' ); ?>

			<?php dynamic_sidebar( $sidebar ); ?>

		<?php do_action( 'aesthetix_after_sidebar' ); ?>

	</aside>

<?php }
