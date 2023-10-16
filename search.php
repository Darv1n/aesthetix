<?php
/**
 * The template for disdisplaying search results pages.
 * 
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php if ( have_posts() ) : ?>
		<?php $i = 0; ?>

		<header class="content-area-header" aria-label="<?php esc_attr_e( 'Search page header', 'aesthetix' ); ?>">
			<h1 class="content-area-title">
				<?php printf( __( 'Search Results for: %s', 'aesthetix' ), '<span class="search-query">' . get_search_query() . '</span>' ); ?>
			</h1>
		</header>

		<section <?php aesthetix_section_classes( 'content-area-content' ); ?> aria-label="<?php esc_attr_e( 'Search page content', 'aesthetix' ); ?>">

			<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<?php $post_type_object = get_post_type_object( get_post_type() ); ?>

					<?php if ( ! isset( $post_type_current ) ) : ?>
						<div <?php aesthetix_archive_page_columns_classes( '', 1 ); ?>>
							<h2 class="post-type-title h4"><?php _e( 'Post type:' ) ?> <?php echo esc_html( $post_type_object->name ); ?></h2>
						</div>
					<?php endif; ?>

					<?php if ( isset( $post_type_current ) && $post_type_current !== get_post_type() ) : ?>
						</div>
						<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
							<div <?php aesthetix_archive_page_columns_classes( '', 1 ); ?>>
								<h2 class="post-type-title h4"><?php esc_html_e( 'Post type' ) ?>: <?php echo esc_html( $post_type_object->name ); ?></h2>
							</div>
					<?php endif; ?>

					<?php $post_type_current = get_post_type(); ?>

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

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Search page footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive', 'pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content', 'none' ); ?>

	<?php endif; ?>

</main>

<?php

get_sidebar();
get_footer();
