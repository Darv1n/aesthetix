<?php
/**
 * Template part for displaying button scroll top.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<?php if ( get_aesthetix_options( 'general_scroll_top_button_display' ) ) {

	$button_color   = $args['button-color'] ?? get_aesthetix_options( 'general_scroll_top_button_color' );
	$button_type    = $args['button-type'] ?? get_aesthetix_options( 'general_scroll_top_button_type' );
	$button_content = $args['button-content'] ?? get_aesthetix_options( 'general_scroll_top_button_content' ); ?>

	<button id="scroll-top" <?php button_classes( 'scroll-top icon icon_arrow-up', $button_color, $button_type, $button_content ); ?> aria-label="<?php esc_attr_e( 'Scroll Top', 'aesthetix' ) ?>">
		<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Scroll up', 'aesthetix' );
		} ?>
	</button>
<?php }
