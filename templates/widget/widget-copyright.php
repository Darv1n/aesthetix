<?php
/**
 * Template part for displaying copyright.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'start_year' => '',
);

$args = array_merge( $defaults, $args );

$home_url = wp_parse_url( get_home_url() );

if ( is_multisite() ) {
	$home_url = wp_parse_url( network_home_url() );
}

// Собираем год.
$year = gmdate( 'Y' );
if ( $args['start_year'] && (int) $args['start_year'] !== (int) $year ) {
	$year = $args['start_year'] . '-' . $year;
} ?>

<div class="copyright">
	<p class="copyright-text">&copy;&nbsp;<?php echo esc_html( $year ); ?> <?php esc_html_e( 'All rights reserved', 'aesthetix' ); ?> <?php echo esc_html( $home_url['host'] ); ?></p>
</div>
