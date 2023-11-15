<?php
/**
 * Template footer top bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="col-12 col-md-6">
		<div <?php widgets_classes( '', 'footer-bottom-left' ); ?>>

			<?php if ( is_active_sidebar( 'footer-bottom-left' ) ) {
				dynamic_sidebar( 'footer-bottom-left' );
			} else {
				aesthetix_widget_default( 'footer-bottom-left' );
			} ?>

		</div>
	</div>
	<div class="col-12 col-md-6">
		<div <?php widgets_classes( '', 'footer-bottom-right' ); ?>>

			<?php if ( is_active_sidebar( 'footer-bottom-right' ) ) {
				dynamic_sidebar( 'footer-bottom-right' );
			} else {
				aesthetix_widget_default( 'footer-bottom-right' );
			} ?>

		</div>
	</div>
</div>
