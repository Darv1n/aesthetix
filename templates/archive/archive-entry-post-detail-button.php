<?php
/**
 * Template part for displaying archive entry post detail button.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="post-link-more" aria-label="<?php esc_attr_e( 'Post Continue Reading', 'aesthetix' ); ?>">
	<a <?php aesthetix_link_more_classes(); ?> href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'aesthetix' ); ?></a>
</div>
