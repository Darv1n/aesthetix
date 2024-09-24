<?php
/**
 * Template part for displaying archive entry post title.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'post_title_size'   => get_aesthetix_options( 'archive_' . get_post_type() . '_title_size' ),
	'post_equal_height' => get_aesthetix_options( 'archive_' . get_post_type() . '_equal_height' ),
);

$args = array_merge( apply_filters( 'get_aesthetix_archive_entry_post_title_default_args', $defaults, $args ), $args );

$classes[] = 'post-entry-header';

if ( isset( $args['post_equal_height'] ) && $args['post_equal_height'] === 'title' ) {
	$classes[] = 'equal-height';
} ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Post title', 'aesthetix' ); ?>">
	<h3 class="post-title <?php echo esc_attr( $args['post_title_size'] ); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
</div>
