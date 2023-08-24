<?php
/**
 * Template part for displaying button scroll top.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */
 ?>

<button id="scroll-top" <?php the_aesthetix_scroll_top_classes(); ?>>
	<?php if ( in_array( get_aesthetix_options( 'general_scroll_top_button_type' ), array( 'icon', 'button-icon' ), true ) ) { ?>
		<i class="icon"></i>
	<?php } else {
		_e( 'Scroll up', 'aesthetix' );
	} ?>
</button>