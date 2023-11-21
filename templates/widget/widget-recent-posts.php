<?php
/**
 * Template tils for displaying widget recent posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['order']                        = $args['order'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_posts_order' );
$args['orderby']                      = $args['orderby'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_posts_orderby' );
$args['posts_per_page']               = $args['posts_per_page'] ?? 4;
$args['post_type']                    = $args['post_type'] ?? 'post';
$args['post_status']                  = $args['post_status'] ?? 'publish';
$args['post_layout']                  = $args['post_layout'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_layout' );
$args['post_structure']               = $args['post_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_structure' );
$args['post_meta_structure']          = $args['post_meta_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_meta_structure' );
$args['post_taxonomies_structure']    = $args['post_taxonomies_structure'] ?? get_aesthetix_options( 'archive_' . get_post_type() . '_taxonomies_structure' );

if ( is_single() ) {
	$args['post__not_in'] = array( get_the_ID() );
}

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	$i = 1;

	while ( $query->have_posts() ) {
		$query->the_post();

		$args['counter'] = $i;

		if ( in_array( $args['post_layout'], array( 'list', 'list-chess' ), true ) ) {
			get_template_part( 'templates/widget/widget-post-list', $args['post_type'], $args );
		} else {
			if ( has_post_format() ) {
				if ( get_theme_file_path( 'templates/widget/widget-post-' . $args['post_type'] . '-' . get_post_format() . '.php' ) ) {
					get_template_part( 'templates/widget/widget-post', $args['post_type'] . '-' . get_post_format(), $args );
				} else {
					get_template_part( 'templates/widget/widget-post', get_post_format(), $args );
				}
			} else {
				get_template_part( 'templates/widget/widget-post', $args['post_type'], $args );
			}
		}

		$args['counter'] = $i++;
	}
}

wp_reset_postdata();
