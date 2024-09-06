<?php
/**
 * Template part for displaying widget recent posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$post_type = $args['post_type'] ?? 'post';
$defaults  = array(
	'order'               => get_aesthetix_options( 'archive_' . $post_type . '_posts_order' ),
	'orderby'             => get_aesthetix_options( 'archive_' . $post_type . '_posts_orderby' ),
	'posts_per_page'      => 4,
	'post_type'           => $post_type,
	'post_status'         => 'publish',
	'ignore_sticky_posts' => true,
	'post_layout'         => get_aesthetix_options( 'archive_' . $post_type . '_layout' ),
	'post_structure'      => get_aesthetix_options( 'archive_' . $post_type . '_structure' ),
	'post_meta_structure' => get_aesthetix_options( 'archive_' . $post_type . '_meta_structure' ),
	'post_equal_height'   => get_aesthetix_options( 'archive_' . $post_type . '_equal_height' ),
);

if ( is_single() ) {
	$defaults['post__not_in'] = array( get_the_ID() );
}

$args = array_merge( apply_filters( 'get_aesthetix_widget_recent_posts_default_args', $defaults, $args ), $args );

if ( $args['orderby'] === 'views' ) {
	$args['orderby']  = array( 'meta_value_num' => $args['order'] );
	$args['meta_key'] = 'views';
	unset( $args['order'] );
}

if ( $args['orderby'] === 'likes' ) {
	$args['orderby']  = array( 'meta_value_num' => $args['order'] );
	$args['meta_key'] = '_like';
	unset( $args['order'] );
}

$query = new WP_Query( $args );

if ( $query->have_posts() ) {

	$i = 1;

	while ( $query->have_posts() ) {
		$query->the_post();

		$args['counter'] = $i;

		$template_path = get_post_type_widget_template_path( get_post_type(), $args['post_layout'], get_post_format() );
		get_template_part( $template_path, null, $args );

		$args['counter'] = $i++;
	}
}

wp_reset_postdata();
