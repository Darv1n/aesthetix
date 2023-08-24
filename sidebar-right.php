<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aesthetix
 */

if ( ! is_active_sidebar( 'sidebar-right' ) ) {
	return;
}

?>

<aside id="secondary" <?php aesthetix_widget_area_classes( 'widget-area_right order-3 order-lg-3' ); ?> role="complementary">

	<?php do_action( 'aesthetix_before_main_sidebar' ); ?>

		<?php do_action( 'aesthetix_before_right_sidebar' ); ?>

			<?php dynamic_sidebar( 'sidebar-right' ); ?>

		<?php do_action( 'aesthetix_after_right_sidebar' ); ?>

	<?php do_action( 'aesthetix_after_main_sidebar' ); ?>

</aside>
