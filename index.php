<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to disdisplay a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_index_page' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php $i = 1; ?>

		<?php if ( ! is_home() && ! is_front_page() ) { ?>
			<header class="content-area-header" aria-label="<?php esc_attr_e( 'Archive page header', 'aesthetix' ); ?>">
				<h1 class="content-area-title"><?php single_post_title(); ?></h1>
			</header>
		<?php } ?>

		<?php do_action( 'aesthetix_before_index_content' ); ?>

		<section class="content-area-loop" aria-label="<?php esc_attr_e( 'Archive page content', 'aesthetix' ); ?>">
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'loop' ); ?> data-columns="<?php echo esc_attr( get_aesthetix_options( 'archive_' . get_post_type() . '_columns' ) ); ?>">

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<div <?php aesthetix_archive_page_columns_classes( $i ); ?>>

						<?php
							$template_path = get_post_type_archive_template_path( get_post_type(), null, get_post_format() );
							get_template_part( $template_path, null, array( 'counter' => $i ) );
							$i++;
						?>

					</div>

				<?php endwhile; ?>

			</div>
		</section>

		<?php do_action( 'aesthetix_after_index_content' ); ?>

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Archive page footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive-pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content-none' ); ?>

	<?php endif; ?>

	<?php do_action( 'aesthetix_after_index_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
