<?php
/**
 * Template footer bottom bar.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php
	if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-3' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-7' );
	} else {
		$first_col_classes = array( 'col-12', 'col-sm-6', 'col-md-4' );
		$last_col_classes  = array( 'col-12', 'col-sm-6', 'col-md-8' );
	}
?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="<?php echo esc_attr( implode( ' ', $first_col_classes ) ); ?>">

		<?php if ( is_active_sidebar( 'footer-top-left' ) ) {
			dynamic_sidebar( 'footer-top-left' );
		} else {
			aesthetix_widget_default( 'footer-top-left' );
		} ?>

	</div>
	<div class="<?php echo esc_attr( implode( ' ', $last_col_classes ) ); ?>">

		<?php if ( is_active_sidebar( 'footer-top-right' ) ) {
			dynamic_sidebar( 'footer-top-right' );
		} else {
			aesthetix_widget_default( 'footer-top-right' );
		} ?>

	</div>
</div>
