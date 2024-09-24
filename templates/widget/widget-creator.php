<?php
/**
 * Template part for displaying widget creator.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'creator_link' => 'https://zolin.digital/',
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_creator_default_args', $defaults, $args ), $args );

if ( isset( $args['creator_link'] ) && wp_http_validate_url( $args['creator_link'] ) ) {

	if ( is_multisite() ) {
		$url_host = wp_parse_url( network_home_url(), PHP_URL_HOST );
		$utm      = add_query_arg( array( 'utm_source' => $url_host, 'utm_medium' => $url_host ), $args['creator_link'] );
	} else {
		$url_host = wp_parse_url( get_home_url(), PHP_URL_HOST );
		$utm      = add_query_arg( array( 'utm_source' => $url_host ), $args['creator_link'] );
	}

	$url = wp_parse_url( $args['creator_link'], PHP_URL_HOST ); ?>

	<div class="creator">
		<p class="creator-text"><?php esc_html_e( 'Created by', 'aesthetix' ); ?> <strong><a <?php link_classes(); ?> href="<?php echo esc_url( $utm ); ?>" rel="external"><?php echo esc_html( strtoupper( $url ) ); ?></a></strong></p>
	</div>
<?php }


