<?php
/**
 * Template part for displaying entry thumbnail.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail" aria-label="<?php esc_attr_e( 'Post thumbnail', 'aesthetix' ); ?>">
		<?php the_post_thumbnail(); ?>
	</div>
<?php } ?>
