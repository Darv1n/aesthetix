<?php
/**
 * Template part for displaying widget any menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'theme_location'      => 'primary',
	'container'           => '',
	'menu_id'             => '',
	'count_items_display' => (bool) get_aesthetix_options( 'general_menu_count_items_display' ),
	'fallback_cb'         => 'setup_menu_fallback',
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_menu_default_args', $defaults, $args ), $args ); ?>

<nav <?php aesthetix_menu_wrapper_classes( 'menu-' . $args['theme_location'] ); ?> role="navigation">
	<?php wp_nav_menu( $args ); ?>
</nav>
