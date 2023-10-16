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

<?php if ( get_aesthetix_options( 'general_scroll_top_button_display' ) ) {

	$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'general_scroll_top_button_color' );
	$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'general_scroll_top_button_type' );
	$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'general_scroll_top_button_content' );
	$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'general_scroll_top_button_rounded' ); ?>

	<button id="scroll-top" <?php button_classes( 'scroll-top icon icon_arrow-up', $args ); ?> aria-label="<?php esc_attr_e( 'Scroll Top', 'aesthetix' ) ?>">
		<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Scroll up', 'aesthetix' );
		} ?>
	</button>
<?php }
