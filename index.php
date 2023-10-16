<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to disdisplay a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_index_page' ); ?>

	<?php if ( have_posts() ) : ?>
		<?php $i = 0; ?>

		<?php if ( ! is_home() && ! is_front_page() ) { ?>
			<header class="content-area-header" aria-label="<?php esc_attr_e( 'Archive Page Header', 'aesthetix' ); ?>">
				<h1 class="content-area-title"><?php single_post_title(); ?></h1>
			</header>
		<?php } ?>

		<section <?php aesthetix_section_classes( 'content-area-content' ); ?> aria-label="<?php esc_attr_e( 'Archive Page Content', 'aesthetix' ); ?>">
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'loop' ); ?>>

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

				<?php endwhile; ?>

			</div>
		</section>

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Archive Page Footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive', 'pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content', 'none' ); ?>

	<?php endif; ?>

	<?php do_action( 'aesthetix_after_index_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
