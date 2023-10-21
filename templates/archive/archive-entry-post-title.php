<?php
/**
 * Template part for displaying archive entry post title.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="post-header" aria-label="<?php esc_attr_e( 'Post title', 'aesthetix' ); ?>">
	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
</div>
