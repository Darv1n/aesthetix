<?php
/**
 * Template part for displaying archive entry post content.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( get_aesthetix_options( 'archive_' . get_post_type() . '_detail_description' ) === 'content' ) { ?>
	<div class="post-content" aria-label="<?php esc_attr_e( 'Post Content', 'aesthetix' ); ?>">
		<?php the_content(); ?>
	</div>
<?php } else { ?>
	<div class="post-excerpt" aria-label="<?php esc_attr_e( 'Post Excerpt', 'aesthetix' ); ?>">
		<?php the_excerpt(); ?>
	</div>
<?php }
