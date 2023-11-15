<?php
/**
 * Template part for displaying entry thumbnail.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( has_post_thumbnail() ) { ?>
	<div class="post-thumbnail-wrap" aria-label="<?php esc_attr_e( 'Post thumbnail', 'aesthetix' ); ?>">
		<?php the_post_thumbnail( 'full', array( 'class' => 'post-thumbnail' ) ); ?>
	</div>
<?php } ?>
