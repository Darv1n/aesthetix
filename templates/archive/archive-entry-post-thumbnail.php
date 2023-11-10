<?php
/**
 * Template part for displaying archive entry post thumbnail.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$image_gallery = get_post_meta( get_the_ID(), 'post_image_gallery', true );

if ( has_post_format() && get_post_format() === 'gallery' && $image_gallery ) {

	$images = array_merge( array( get_post_thumbnail_id() ), array_map( 'trim', explode( ',', $image_gallery ) ) ); ?>

	<div class="slick-slider post-gallery-slider">
		<?php foreach ( $images as $key => $image ) { ?>
			<figure class="slick-item wp-block-image">
				<a href="<?php the_permalink(); ?>" class="post-thumbnail-link" tabindex="-1">
					<?php echo wp_get_attachment_image( $image, 'large' ); ?>
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

<?php }

$structure = get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_structure' );

if ( is_string( $structure ) && ! empty( $structure ) ) {

	$structure = array_map( 'trim', explode( ',', $structure ) ); ?>

	<ul class="post-taxonomies" aria-label="<?php esc_attr_e( 'Post taxonomies', 'aesthetix' ); ?>">

		<?php foreach ( $structure as $key => $value ) {
			switch ( $value ) {
				case has_action( 'aesthetix_archive_entry_post_thumbnail_loop_' . $value ):
					do_action( 'aesthetix_archive_entry_post_thumbnail_loop_' . $value, $post );
					break;
				case 'sticky':
					if ( is_sticky() ) { ?>
						<li class="post-taxonomies-item">
							<button <?php button_classes( 'post-taxonomies-button button-disabled icon icon-thumbtack', array( 'button_size' => 'xs', 'button_rounded' => true ) ); ?> type="button" disabled>
								<?php esc_html_e( 'Sticky', 'aesthetix' ); ?>
							</button>
						</li>
					<?php }
					break;
				case 'post_format':
					if ( has_post_format() ) { ?>
						<li class="post-taxonomies-item">
							<button <?php button_classes( 'post-taxonomies-button button-disabled icon icon-' . get_post_format(), array( 'button_size' => 'xs', 'button_rounded' => true ) ); ?> type="button" disabled>
								<?php echo ucfirst( get_post_format() ); ?>
							</button>
						</li>
					<?php }
					break;
				default:
					if ( has_term( '', $value ) ) {
						foreach ( get_the_terms( get_the_ID(), $value ) as $key => $taxonomy ) { ?>
							<li class="post-taxonomies-item">
								<a <?php button_classes( 'post-taxonomies-button', array( 'button_size' => 'xs', 'button_color' => 'secondary', 'button_rounded' => true ) ); ?> href="<?php echo esc_url( get_term_link( $taxonomy->term_id, $taxonomy->taxonomy ) ); ?>"><?php echo esc_html( $taxonomy->name ); ?></a>
							</li>
						<?php }
					}
					break;
			}
		} ?>

	</ul>

<?php }

