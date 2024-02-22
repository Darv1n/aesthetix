<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aesthetix
 */

$sidebar = apply_filters( 'get_aesthetix_sidebar', 'main' );

if ( is_active_sidebar( $sidebar ) ) { ?>

	<aside id="aside" <?php aesthetix_widget_area_classes(); ?> role="complementary">

		<?php do_action( 'aesthetix_before_sidebar' ); ?>

			<div <?php widgets_classes( '', $sidebar ); ?>>
				<?php dynamic_sidebar( $sidebar ); ?>
			</div>

		<?php do_action( 'aesthetix_after_sidebar' ); ?>

	</aside>

<?php }
