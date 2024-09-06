<?php
/**
 * The template for disdisplaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php if ( have_posts() ) : ?>

		<?php $i = 1; ?>

		<header class="content-area-header" aria-label="<?php esc_attr_e( 'Search page header', 'aesthetix' ); ?>">
			<h1 class="content-area-title">
				<?php printf( __( 'Search results for: %s', 'aesthetix' ), '<span class="search-query">' . get_search_query() . '</span>' ); ?>
			</h1>
		</header>

		<section class="content-area-loop" aria-label="<?php esc_attr_e( 'Search page content', 'aesthetix' ); ?>">
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

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Search page footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive-pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content-none' ); ?>

	<?php endif; ?>

</main>

<?php

get_sidebar();
get_footer();
