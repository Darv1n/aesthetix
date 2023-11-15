<?php
/**
 * Template three columns footer.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
	<div class="col-12 col-sm-6 col-md-4">
		<div <?php widgets_classes( '', 'footer-main-first' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-first' ) ) {
				dynamic_sidebar( 'footer-main-first' );
			} else {
				aesthetix_widget_default( 'footer-main-first' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-4">
		<div <?php widgets_classes( '', 'footer-main-second' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-second' ) ) {
				dynamic_sidebar( 'footer-main-second' );
			} else {
				aesthetix_widget_default( 'footer-main-second' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-sm-12 col-md-4">
		<div <?php widgets_classes( '', 'footer-main-third' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-third' ) ) {
				dynamic_sidebar( 'footer-main-third' );
			} else {
				aesthetix_widget_default( 'footer-main-third' );
			} ?>

		</div>
	</div>
</div>
