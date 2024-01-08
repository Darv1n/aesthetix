<?php
/**
 * Template simple footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
	<div class="col-12 col-md-3">
		<?php if ( is_active_sidebar( 'footer-main-first' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-main-first' ); ?>>
				<?php dynamic_sidebar( 'footer-main-first' ); ?>
			</div>
		<?php } ?>
	</div>
	<div class="col-12 col-md-9">
		<?php if ( is_active_sidebar( 'footer-main-second' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-main-second' ); ?>>
				<?php dynamic_sidebar( 'footer-main-second' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
