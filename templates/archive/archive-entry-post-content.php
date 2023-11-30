<?php
/**
 * Template part for displaying archive entry post content.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$classes[] = 'post-entry-excerpt';

if ( isset( $args['post_equal_height'] ) && $args['post_equal_height'] === 'excerpt' ) {
	$classes[] = 'equal-height';
} ?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Post excerpt', 'aesthetix' ); ?>">
	<?php the_excerpt(); ?>
</div>
