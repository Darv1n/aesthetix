<?php
/**
 * Template part for displaying button scroll top.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( get_aesthetix_options( 'root_scroll_top_button_display' ) ) {

	$args['button_size']    = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
	$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'root_scroll_top_button_color' );
	$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'root_scroll_top_button_type' );
	$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'root_scroll_top_button_content' );
	$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'root_scroll_top_button_rounded' ); ?>

	<div class="scroll-top-wrap">
		<button id="scroll-top" <?php button_classes( 'scroll-top icon icon-arrow-up', $args ); ?> aria-label="<?php esc_attr_e( 'Scroll top button', 'aesthetix' ) ?>">
			<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
				esc_html_e( 'Scroll up', 'aesthetix' );
			} ?>
		</button>
	</div>
<?php }
