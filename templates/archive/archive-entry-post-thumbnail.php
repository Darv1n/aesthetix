<?php
/**
 * Template part for displaying archive entry post thumbnail.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( has_post_format() && get_post_format() === 'gallery' && get_post_meta( get_the_ID(), 'post_image_gallery', true ) ) {

	$images = get_post_meta( get_the_ID(), 'post_image_gallery', true );
	$images = array_merge( array( get_post_thumbnail_id() ), array_map( 'trim', explode( ',', $images ) ) ); ?>

	<div class="slick-slider post-gallery-slider">
		<?php foreach ( $images as $key => $image ) { ?>
			<figure class="slick-item wp-block-image">
				<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
					<?php echo wp_get_attachment_image( $image, 'large', false, array( 'class' => 'post-thumbnail', ) ); ?>
				</a>
			</figure>
		<?php } ?>
	</div>

	<?php

	wp_enqueue_style( 'slick-style' );
	wp_enqueue_script( 'slick-script' );
	wp_enqueue_script( 'slick-script-init' );

} else { ?>

	<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
		<?php the_post_thumbnail( 'large', array( 'class' => 'post-thumbnail' ) ); ?>
	</a>

<?php } ?>
