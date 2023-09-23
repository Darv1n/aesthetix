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

		<?php do_action( 'aesthetix_archive_entry_post_before_thumbnail' ); ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" style="background: url( <?php echo esc_url( $background_image ); ?> ) center/cover no-repeat" aria-hidden="true" tabindex="-1" role="img"></a>

		<?php do_action( 'aesthetix_archive_entry_post_after_thumbnail' ); ?>

<?php }
