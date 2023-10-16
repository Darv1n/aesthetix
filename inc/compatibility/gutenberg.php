<?php
/**
 * Gutenberg.
 * 
 * @since 1.0.0
 *
 * @link https://wordpress.org/gutenberg/
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Remove autogen styles with .wp-block-button__link and .wp-block-file__button classes
add_action( 'wp_enqueue_scripts', function() {
	wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

// Button block additional class.
add_filter( 'render_block', function( $block_content, $block ) {

	$block_content = str_replace(
		'wp-block-button__link',
		implode( ' ', get_button_classes() ),
		$block_content
	);

	return $block_content;

}, 5, 2 );
