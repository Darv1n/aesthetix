<?php
/**
 * Template part for displaying any menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['theme_location']      = $args['theme_location'] ?? 'primary';
$args['count_items_display'] = $args['count_items_display'] ?? get_aesthetix_options( 'general_menu_count_items_display' );
$args['menu_class']          = $args['menu_class'] ?? '';
$args['menu_class']          = explode( ' ', trim( $args['menu_class'] ) );
$args['menu_class'][]        = 'menu';
$args['menu_class'][]        = 'menu-' . $args['theme_location'];

$args = array(
	'theme_location' => $args['theme_location'],
	'container'           => '',
	'menu_id'             => '',
	'menu_class'          => trim( implode( ' ', array_unique( $args['menu_class'] ) ) ),
	'count_items_display' => (bool) $args['count_items_display'],
	'fallback_cb'         => 'setup_menu_fallback',
) ?>

<nav <?php aesthetix_menu_wrapper_classes( 'menu-' . $args['theme_location'] ); ?> role="navigation">
	<?php wp_nav_menu( $args ); ?>
</nav>
