<?php
/**
 * Template part for displaying archive entry post title.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="post-header" aria-label="<?php esc_attr_e( 'Post title', 'aesthetix' ); ?>">
	<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
</div>
