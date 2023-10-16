<?php
/**
 * Template part for displaying button menu.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'general_scroll_top_button_color' );
$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'general_scroll_top_button_type' );
$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'general_scroll_top_button_content' );
$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'general_scroll_top_button_rounded' );

$classes[] = 'menu-toggle';
$classes[] = 'icon';
$classes[] = 'icon_bars';

if ( in_array( $args['button_type'], array( 'button-icon-text', 'button-icon', 'icon-text', 'icon' ), true ) ) {
	$data      = ' data-icon-on="icon_xmark" data-icon-off="icon_bars"';
	$classes[] = 'toggle-icon';
} else {
	$data = '';
} ?>

<button id="menu-toggle" <?php button_classes( $classes, $args ); ?><?php esc_attr_e( $data ); ?> aria-label="<?php esc_attr_e( 'Open Menu Button', 'aesthetix' ); ?>" aria-haspopup="true" aria-controls="main-navigation">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Menu', 'aesthetix' );
	} ?>
</button>