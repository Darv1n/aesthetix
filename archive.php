<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_archive_page' ); ?>

	<?php if ( have_posts() ) : ?>
		<?php $i = 0; ?>

		<header class="content-area-header" aria-label="<?php esc_attr_e( 'Archive page header', 'aesthetix' ); ?>">
			<?php the_archive_title( '<h1 class="content-area-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="content-area-description">', '</div>' ); ?>
		</header>

		<?php do_action( 'aesthetix_before_archive_page_content' ); ?>

		<section class="content-area-content" aria-label="<?php esc_attr_e( 'Archive page content', 'aesthetix' ); ?>">
			<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<div <?php aesthetix_archive_page_columns_classes( $i ); ?>>

						<?php
							// Get a template with a post type, if there is one in the theme.
							if ( file_exists( get_theme_file_path( 'templates/archive/archive-content-type-' . get_post_type() . '.php' ) ) ) {
								get_template_part( 'templates/archive/archive-content-type', get_post_type(), array( 'counter' => $i ) );
							} elseif ( get_aesthetix_options( 'archive_' . get_post_type() . '_template_type' ) ) {
								get_template_part( 'templates/archive/archive-content-type', get_aesthetix_options( 'archive_' . get_post_type() . '_template_type' ), array( 'counter' => $i ) );
							} else {
								get_template_part( 'templates/archive/archive-content-type', 'tils', array( 'counter' => $i ) );
							}
						?>

					</div>

					<?php $i++; ?>
				<?php endwhile; ?>

			</div>
		</section>

		<?php do_action( 'aesthetix_after_archive_page_content' ); ?>

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Archive page footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive', 'pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content', 'none' ); ?>

	<?php endif; ?>

	<?php do_action( 'aesthetix_after_archive_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
