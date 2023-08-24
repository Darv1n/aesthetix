<?php
/**
 * Template part for displaying archive entry post content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */
 ?>

<?php if ( get_aesthetix_options( 'archive_' . get_post_type() . '_detail_description' ) === 'content' ) { ?>
	<div class="post-content">
		<?php the_content(); ?>
	</div>
<?php } else { ?>
	<div class="post-excerpt">
		<?php the_excerpt(); ?>
	</div>
<?php }
