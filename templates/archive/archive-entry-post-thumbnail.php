<?php
/**
 * Template part for displaying archive entry post thumbnail.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<?php if ( has_post_thumbnail() ) {
	$background_image = get_the_post_thumbnail_url( get_the_ID(), 'large' );
} elseif ( file_exists( get_theme_file_path( '/assets/img/default-banner.jpg' ) ) ) {
	$background_image = get_theme_file_uri( '/assets/img/default-banner.jpg' );
}

if ( isset( $background_image ) ) { ?>
	<div class="post-thumbnail-wrap">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>" style="background: url( <?php echo esc_url( $background_image ); ?> ) center/cover no-repeat" aria-hidden="true" tabindex="-1" role="img" aria-label="<?php esc_attr_e( 'Post Thumbnail', 'aesthetix' ); ?>"></a>
	
	<?php

		$structure = get_aesthetix_options( 'archive_' . get_post_type() . '_thumbnail_structure' );

		if ( is_string( $structure ) && ! empty( $structure ) ) {

			$structure = array_map( 'trim', explode( ',', $structure ) );

			foreach ( $structure as $key => $value ) {
				switch ( $value ) {
					case has_action( 'aesthetix_archive_entry_post_thumbnail_loop_' . $value ):
						do_action( 'aesthetix_archive_entry_post_thumbnail_loop_' . $value, $post );
						break;
					case 'taxonomies':
						get_template_part( 'templates/archive/archive-entry', 'post-taxonomies' );
						break;
					case 'formats':
						get_template_part( 'templates/archive/archive-entry', 'post-formats' );
						break;
					default:
						break;
				}
			}
		}

	?>

	</div>
<?php }
