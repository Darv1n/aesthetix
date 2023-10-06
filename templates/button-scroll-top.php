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

<?php if ( get_aesthetix_options( 'general_scroll_top_button_display' ) ) { ?>
	<button id="scroll-top" <?php the_aesthetix_scroll_top_classes(); ?>>
		<?php if ( ! in_array( get_aesthetix_options( 'general_scroll_top_button_type' ), array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Scroll up', 'aesthetix' );
		} ?>
	</button>
<?php }
