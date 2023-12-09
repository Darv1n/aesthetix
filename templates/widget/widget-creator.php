<?php
/**
 * Template part for displaying creator.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'creator_link' => 'https://zolin.digital/',
);

$args = array_merge( $defaults, $args );

if ( isset( $args['creator_link'] ) && wp_http_validate_url( $args['creator_link'] ) ) {

	if ( is_multisite() ) {
		$home_url = wp_parse_url( network_home_url() );
		$utm      = add_query_arg( array( 'utm_source' => $home_url['host'], 'utm_medium' => $home_url['host'] ), $args['creator_link'] );
	} else {
		$home_url = wp_parse_url( get_home_url() );
		$utm      = add_query_arg( array( 'utm_source' => $home_url['host'] ), $args['creator_link'] );
	}

	$url = wp_parse_url( $args['creator_link'] ); ?>

	<div class="creator">
		<p class="creator-text"><?php esc_html_e( 'Created by', 'aesthetix' ); ?> <strong><a <?php link_classes(); ?> href="<?php echo esc_url( $utm ); ?>" rel="external"><?php echo esc_html( strtoupper( $url['host'] ) ); ?></a></strong></p>
	</div>
<?php }


