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

$url_host = wp_parse_url( get_home_url(), PHP_URL_HOST );

if ( is_multisite() ) {
	$url_host = wp_parse_url( network_home_url(), PHP_URL_HOST );
}

// Собираем год.
$year = gmdate( 'Y' );
if ( $args['start_year'] && (int) $args['start_year'] !== (int) $year ) {
	$year = $args['start_year'] . '-' . $year;
} ?>

<div class="copyright">
	<p class="copyright-text">&copy;&nbsp;<?php echo esc_html( $year ); ?> <?php esc_html_e( 'All rights reserved', 'aesthetix' ); ?> <?php echo esc_html( $url_host ); ?></p>
</div>
