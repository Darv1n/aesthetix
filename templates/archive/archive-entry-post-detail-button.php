<?php
/**
 * Template part for displaying archive entry post detail button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<div class="post-link-more">
	<a <?php aesthetix_link_more_classes(); ?> href="<?php the_permalink(); ?>"><?php _e( 'Read more', 'aesthetix' ); ?></a>
</div>
