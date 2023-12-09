<?php
/**
 * Template part for displaying use materials.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$home_url = wp_parse_url( get_home_url() );

if ( is_multisite() ) {
	$home_url = wp_parse_url( network_home_url() );
}

$defaults = array(
	'text' => sprintf( __( 'Use of site materials is permitted only with reference to the source %s', 'aesthetix' ), $home_url['host'] ),
);

$args = array_merge( $defaults, $args );

?>

<div class="use-materials">
	<p class="use-materials-text"><?php echo wp_kses_post( $args['text'] ); ?></p>
</div>
