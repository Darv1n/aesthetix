<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_archive_page' ); ?>

	<?php if ( have_posts() ) : ?>

		<?php $i = 1; ?>

		<?php if ( get_the_archive_title() || get_the_archive_description() ):

			$structure = array( 'title', 'description' );
			$structure = apply_filters( 'aesthetix_archive_header_structure', $structure );

			if ( is_array( $structure ) && ! empty( $structure ) ) { ?>
				<header class="content-area-header" aria-label="<?php esc_attr_e( 'Archive page header', 'aesthetix' ); ?>">
					<?php foreach ( $structure as $key => $value ) {
						switch ( $value ) {
							case has_action( 'aesthetix_archive_header_loop_' . $value ):
								do_action( 'aesthetix_archive_header_loop_' . $value );
								break;
							case 'title':
								the_archive_title( '<h1 class="content-area-title">', '</h1>' );
								break;
							case 'description':
								the_archive_description( '<div class="content-area-description">', '</div>' );
								break;
							default:
								if ( locate_template( '/templates/section/' . $value . '.php' ) !== '' ) {
									get_template_part( 'templates/section/' . $value );
								}  elseif ( locate_template( '/templates/' . $value . '.php' ) !== '' ) {
									get_template_part( 'templates/' . $value );
								}
								break;
						}
					} ?>
				</header>
			<?php } ?>
		<?php endif ?>

		<?php do_action( 'aesthetix_before_archive_page_content' ); ?>

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

		<?php do_action( 'aesthetix_after_archive_page_content' ); ?>

		<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Archive page footer', 'aesthetix' ); ?>">
			<?php get_template_part( 'templates/archive/archive-pagination' ); ?>
		</footer>

	<?php else : ?>

		<?php get_template_part( 'templates/archive/archive-content-none' ); ?>

	<?php endif; ?>

	<?php do_action( 'aesthetix_after_archive_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
