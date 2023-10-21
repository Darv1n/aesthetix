<?php
/**
 * Template footer top bar.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="col-12 col-md-6">
		<div <?php widgets_classes( '', 'footer-bottom-left' ); ?>>
			<?php dynamic_sidebar( 'footer-bottom-left' ); ?>
		</div>
	</div>
	<div class="col-12 col-md-6">
		<div <?php widgets_classes( '', 'footer-bottom-right' ); ?>>
			<?php dynamic_sidebar( 'footer-bottom-right' ); ?>
		</div>
	</div>
</div>
