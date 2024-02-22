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

$args  = array_merge( apply_filters( 'get_aesthetix_widget_recent_posts_default_args', $defaults ), $args );
$query = new WP_Query( $args );

if ( $query->have_posts() ) {

	$i = 1;

	while ( $query->have_posts() ) {
		$query->the_post();

		$args['counter'] = $i;

		if ( in_array( $args['post_layout'], array( 'list', 'list-chess' ), true ) ) {
			get_template_part( 'templates/widget/widget-post-list', get_post_type(), $args );
		} else {
			if ( has_post_format() ) {
				if ( get_theme_file_path( 'templates/widget/widget-post-' . get_post_type() . '-' . get_post_format() . '.php' ) ) {
					get_template_part( 'templates/widget/widget-post', get_post_type() . '-' . get_post_format(), $args );
				} else {
					get_template_part( 'templates/widget/widget-post', get_post_format(), $args );
				}
			} else {
				get_template_part( 'templates/widget/widget-post', get_post_type(), $args );
			}
		}

		$args['counter'] = $i++;
	}
}

wp_reset_postdata();
