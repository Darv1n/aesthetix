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

		<?php
			$post_type = get_post_type();
			$layout    = get_aesthetix_options( 'archive_' . $post_type . '_layout' );
			$columns   = get_aesthetix_options( 'archive_' . $post_type . '_columns' );
			$i         = 1;
		?>

		<?php if ( ! is_home() && ! is_front_page() ) { ?>
			<header class="content-area-header" aria-label="<?php esc_attr_e( 'Archive page header', 'aesthetix' ); ?>">
				<h1 class="content-area-title"><?php single_post_title(); ?></h1>
			</header>
		<?php } ?>

		<?php do_action( 'aesthetix_before_index_content' ); ?>

		<section class="content-area-content" aria-label="<?php esc_attr_e( 'Archive page content', 'aesthetix' ); ?>">
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'loop' ); ?> data-columns="<?php echo esc_attr( $columns ); ?>">

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<div <?php aesthetix_archive_page_columns_classes( $i ); ?>>

						<?php
							if ( in_array( $layout, array( 'list', 'list-chess' ), true ) ) {
								get_template_part( 'templates/archive/archive-post-list', get_post_type(), array( 'counter' => $i ) );
							} else {
								if ( has_post_format() ) {
									if ( get_theme_file_path( 'templates/archive/archive-post-' . get_post_type() . '-' . get_post_format() . '.php' ) ) {
										get_template_part( 'templates/archive/archive-post', get_post_type() . '-' . get_post_format(), array( 'counter' => $i ) );
									} else {
										get_template_part( 'templates/archive/archive-post', get_post_format(), array( 'counter' => $i ) );
									}
								} else {
									get_template_part( 'templates/archive/archive-post', get_post_type(), array( 'counter' => $i ) );
								}
							}

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
