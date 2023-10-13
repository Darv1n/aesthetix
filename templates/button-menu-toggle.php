<?php
/**
 * Template part for displaying button menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

$button_color   = $args['button-color'] ?? get_aesthetix_options( 'general_scroll_top_button_color' );
$button_type    = $args['button-type'] ?? get_aesthetix_options( 'general_scroll_top_button_type' );
$button_content = $args['button-content'] ?? get_aesthetix_options( 'general_scroll_top_button_content' );

$classes[] = 'menu-toggle';
$classes[] = 'icon';
$classes[] = 'icon_bars';

if ( in_array( $button_type, array( 'button-icon-text', 'button-icon', 'icon-text', 'icon' ), true ) ) {
	$data      = ' data-icon-on="icon_xmark" data-icon-off="icon_bars"';
	$classes[] = 'toggle-icon';
} else {
	$data = '';
} ?>

<button id="menu-toggle" <?php button_classes( $classes, $button_color, $button_type, $button_content ); ?><?php esc_attr_e( $data ); ?> aria-label="<?php esc_attr_e( 'Open Menu Button', 'aesthetix' ); ?>" aria-haspopup="true" aria-controls="main-navigation">
	<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Menu', 'aesthetix' );
	} ?>
</button>