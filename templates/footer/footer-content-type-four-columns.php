<?php
/**
 * Template four columns footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
	<div class="col-12 col-sm-6 col-lg-3">
		<div <?php widgets_classes( '', 'footer-main-first' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-first' ) ) {
				dynamic_sidebar( 'footer-main-first' );
			} else {
				aesthetix_widget_default( 'footer-main-first' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3">
		<div <?php widgets_classes( '', 'footer-main-second' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-second' ) ) {
				dynamic_sidebar( 'footer-main-second' );
			} else {
				aesthetix_widget_default( 'footer-main-second' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3">
		<div <?php widgets_classes( '', 'footer-main-third' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-third' ) ) {
				dynamic_sidebar( 'footer-main-third' );
			} else {
				aesthetix_widget_default( 'footer-main-third' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-sm-6 col-lg-3">
		<div <?php widgets_classes( '', 'footer-main-fourth' ); ?>>

			<?php if ( is_active_sidebar( 'footer-main-fourth' ) ) {
				dynamic_sidebar( 'footer-main-fourth' );
			} else {
				aesthetix_widget_default( 'footer-main-fourth' );
			} ?>

		</div>
	</div>
</div>
