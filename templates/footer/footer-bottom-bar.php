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
		<?php if ( is_active_sidebar( 'footer-bottom-left' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-bottom-left' ); ?>>
				<?php dynamic_sidebar( 'footer-bottom-left' ); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-12 col-md-6">
		<?php if ( is_active_sidebar( 'footer-bottom-right' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-bottom-right' ); ?>>
				<?php dynamic_sidebar( 'footer-bottom-right' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
