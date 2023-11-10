<?php
/**
 * Template part for displaying button home.
 *
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']    = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'root_home_button_color' );
$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'root_home_button_type' );
$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'root_home_button_content' );
$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'root_home_button_rounded' ); ?>

<a <?php button_classes( 'button-home icon icon-house', $args ); ?> href="<?php echo home_url( '/' ); ?>" aria-label="<?php esc_attr_e( 'Home button', 'aesthetix' ) ?>">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Home', 'aesthetix' );
	} ?>
</a>
