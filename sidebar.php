<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aesthetix
 */

$sidebar = apply_filters( 'get_aesthetix_sidebar', 'main' );

if ( is_active_sidebar( $sidebar ) || ! empty( get_aesthetix_widget_default( $sidebar ) ) ) { ?>

	<aside id="aside" <?php aesthetix_widget_area_classes( 'order-3 order-lg-3' ); ?> role="complementary">

		<?php do_action( 'aesthetix_before_sidebar' ); ?>

			<?php if ( is_active_sidebar( $sidebar ) ) {
				dynamic_sidebar( $sidebar );
			} else {
				aesthetix_widget_default( $sidebar );
			} ?>

		<?php do_action( 'aesthetix_after_sidebar' ); ?>

	</aside>

<?php }
