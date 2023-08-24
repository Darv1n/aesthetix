<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aesthetix
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

?>

<?php if ( ! get_aesthetix_options( 'sidebar_left_display' ) && get_aesthetix_options( 'sidebar_right_display' ) ) {
	$class = 'widget-area_right order-3 order-lg-3';
} else {
	$class = 'widget-area_left order-2 order-lg-1';
} ?>

<aside id="secondary" <?php aesthetix_widget_area_classes( $class ); ?> role="complementary">

	<?php do_action( 'aesthetix_before_main_sidebar' ); ?>

		<?php do_action( 'aesthetix_before_left_sidebar' ); ?>

			<?php dynamic_sidebar( 'sidebar' ); ?>

		<?php do_action( 'aesthetix_after_left_sidebar' ); ?>

	<?php do_action( 'aesthetix_after_main_sidebar' ); ?>

</aside>
