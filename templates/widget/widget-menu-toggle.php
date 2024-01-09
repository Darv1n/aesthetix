<?php
/**
 * Template part for displaying widget toggle menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => get_aesthetix_options( 'root_menu_button_color' ),
	'button_type'          => get_aesthetix_options( 'root_menu_button_type' ),
	'button_content'       => get_aesthetix_options( 'root_menu_button_content' ),
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'button_classes'       => 'menu-open icon icon-bars',
);

$args = array_merge( $defaults, $args );

if ( is_string( $args['button_classes'] ) && ! empty( $args['button_classes'] ) ) {
	$args['button_classes'] = explode( ' ', $args['button_classes'] );
}

if ( in_array( 'menu-close', $args['button_classes'], true ) ) {
	$args['button_classes'] = 'menu-close icon icon-xmark';
} ?>

<button <?php button_classes( $args['button_classes'], $args ); ?> aria-label="<?php esc_attr_e( 'Open menu button', 'aesthetix' ); ?>" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Menu', 'aesthetix' );
	} ?>
</button>
