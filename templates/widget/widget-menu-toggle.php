<?php
/**
 * Template part for displaying toggle menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? get_aesthetix_options( 'root_menu_button_color' );
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_menu_button_type' );
$args['button_content']       = $args['button_content'] ?? get_aesthetix_options( 'root_menu_button_content' );
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' );
$args['button_classes']       = $args['button_classes'] ?? 'menu-open icon icon-bars';

if ( is_string( $args['button_classes'] ) && ! empty( $args['button_classes'] ) ) {
	$args['button_classes'] = explode( ' ', $args['button_classes'] );
}

if ( in_array( 'menu-close', $args['button_classes'], true ) ) {
	$args['button_classes'] = 'menu-close icon icon-xmark';
}

?>

<button <?php icon_classes( $args['button_classes'], $args ); ?> aria-label="<?php esc_attr_e( 'Open menu button', 'aesthetix' ); ?>" aria-haspopup="true" aria-controls="aside-menu" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Menu', 'aesthetix' );
	} ?>
</button>
