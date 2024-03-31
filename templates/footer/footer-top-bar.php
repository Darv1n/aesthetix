<?php
/**
 * Template footer bottom bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php
	if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-3', 'col-sm-state-change' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-9' );
	} else {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-4', 'col-sm-state-change' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-8' );
	}
?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="<?php echo esc_attr( implode( ' ', $first_col_classes ) ); ?>">
		<?php if ( is_active_sidebar( 'footer-top-left' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-top-left' ); ?>>
				<?php dynamic_sidebar( 'footer-top-left' ); ?>
			</div>
		<?php } ?>
	</div>
	<div class="<?php echo esc_attr( implode( ' ', $last_col_classes ) ); ?>">
		<?php if ( is_active_sidebar( 'footer-top-right' ) ) { ?>
			<div <?php widgets_classes( '', 'footer-top-right' ); ?>>
				<?php dynamic_sidebar( 'footer-top-right' ); ?>
			</div>
		<?php } ?>
	</div>
</div>
