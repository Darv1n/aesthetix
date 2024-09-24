<?php
/**
 * Template part for displaying widget use materials.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$url_host = wp_parse_url( get_home_url(), PHP_URL_HOST );

if ( is_multisite() ) {
	$url_host = wp_parse_url( network_home_url(), PHP_URL_HOST );
}

$defaults = array(
	'text' => sprintf( __( 'Use of site materials is permitted only with reference to the source %s', 'aesthetix' ), $url_host ),
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_use_materials_default_args', $defaults, $args ), $args );

?>

<div class="use-materials">
	<p class="use-materials-text"><?php echo wp_kses_post( $args['text'] ); ?></p>
</div>
