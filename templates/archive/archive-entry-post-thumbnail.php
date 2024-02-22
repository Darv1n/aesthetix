<?php
/**
 * Template part for displaying archive entry post thumbnail.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

if ( has_post_format() && $args['post_format'] === 'gallery' && get_post_meta( get_the_ID(), 'post_image_gallery', true ) ) {

	$images = get_post_meta( get_the_ID(), 'post_image_gallery', true );
	$images = array_merge( array( get_post_thumbnail_id() ), array_map( 'trim', explode( ',', $images ) ) ); ?>

	<div class="slick-slider slick-gallery-slider">
		<?php foreach ( $images as $key => $image ) { ?>
			<figure class="slick-item post-thumbnail">
				<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
					<?php echo wp_get_attachment_image( $image, 'large', false, array( 'class' => 'wp-post-image', ) ); ?>
				</a>
			</figure>
		<?php } ?>
	</div>

	<?php

	wp_enqueue_style( 'slick-style' );
	wp_enqueue_script( 'slick-script' );
	wp_enqueue_script( 'slick-script-init' );

} else { ?>

	<?php if ( has_post_thumbnail( $post ) ) { ?>

		<figure class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
				<?php if ( image_downsize( get_post_thumbnail_id( $post ), 'large' ) ) { ?>
					<?php the_post_thumbnail( 'large', array() ); ?>
				<?php } else { ?>
					<?php the_post_thumbnail( 'full', array() ); ?>
				<?php } ?>
			</a>
		</figure>

	<?php } elseif ( get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_default' ) ) { ?>

		<figure class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
				<?php $default_thumbnail_file_path = apply_filters( 'default_thumbnail_file_path', '/assets/img/default-thumbnail.jpg' );

				if ( file_exists( get_theme_file_path( $default_thumbnail_file_path ) ) ) {
					list( $width, $height, $type, $attr ) = getimagesize( get_theme_file_path( $default_thumbnail_file_path ) ); ?>

					<img <?php echo $attr; ?> src="<?php echo esc_url( get_theme_file_uri( $default_thumbnail_file_path ) ); ?>" class="wp-post-image" alt="<?php the_title(); ?>" decoding="async" loading="lazy">
				<?php } ?>
			</a>
		</figure>

	<?php } ?>

<?php } ?>
