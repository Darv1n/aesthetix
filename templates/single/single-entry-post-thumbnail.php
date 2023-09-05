<?php
/**
 * Template part for displaying entry thumbnail.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */
 ?>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail" aria-label="<?php _e( 'Post thumbnail', 'aesthetix' ); ?>">
		<?php the_post_thumbnail(); ?>
	</div>
<?php } ?>