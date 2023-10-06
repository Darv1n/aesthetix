<?php
/**
 * Template part for displaying entry header.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<header class="post-header" aria-label="<?php esc_attr_e( 'Post header', 'aesthetix' ); ?>">
	<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
</header>
