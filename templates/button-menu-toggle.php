<?php
/**
 * Template part for displaying button menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

$menu_classes = get_aesthetix_menu_toggle_classes();

if ( in_array( 'toggle-icon', $menu_classes, true ) ) { ?>
	<button id="menu-toggle" class="<?php echo esc_attr( implode( ' ', $menu_classes ) ); ?>" data-icon-on="icon_xmark" data-icon-off="icon_bars" aria-label="<?php esc_attr_e( 'Open Menu Button', 'aesthetix' ); ?>" aria-haspopup="true" aria-controls="main-navigation">
<?php } else { ?>
	<button id="menu-toggle" class="<?php echo esc_attr( implode( ' ', $menu_classes ) ); ?>" aria-label="<?php esc_attr_e( 'Open Menu Button', 'aesthetix' ); ?>" aria-haspopup="true" aria-controls="main-navigation">
<?php } ?>
	<?php if ( in_array( get_aesthetix_options( 'general_menu_button_type' ), array( 'icon', 'button-icon' ), true ) ) { ?>
		<i class="icon"></i>
	<?php } else {
		esc_html_e( 'Menu', 'aesthetix' );
	} ?>
</button>