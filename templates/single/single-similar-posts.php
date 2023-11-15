<?php
/**
 * Template part for displaying similar posts in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<?php if ( get_post_type() === 'post' && get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_display' ) ) { ?>

	<section id="similar-posts" <?php aesthetix_section_classes( 'section-similar-posts similar-posts' ); ?> aria-label="<?php esc_attr_e( 'Similar posts', 'aesthetix' ); ?>">

		<h2 class="section-title"><?php esc_html_e( 'Similar posts', 'aesthetix' ); ?></h2>

		<?php

			$args = array(
				'post__not_in'   => array( get_the_ID() ),
				'order'          => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_order' ),
				'orderby'        => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_orderby' ),
				'posts_per_page' => get_aesthetix_options( 'single_' . get_post_type() . '_similar_posts_count' ),
			);

			if ( get_post_type() === 'post' && has_category() ) {
				foreach ( get_the_category() as $key => $cat ) {
					$args['category__in'][] = $cat->term_id;
				}
			}

			if ( get_post_type() === 'post' && has_tag() ) {
				foreach ( get_the_tags() as $key => $tag ) {
					$args['tag__in'][] = $tag->term_id;
				}
			}

			$query = new wp_query( $args );

			if ( $query->have_posts() ) : ?>
				<?php $i = 0; ?>

				<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>

				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>

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

			<?php endif; ?>

			<?php wp_reset_postdata(); ?>

	</section>

<?php } ?>
