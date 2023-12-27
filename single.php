<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'before_single_post' ); ?>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php
			// Get a template with a post type, if there is one in the theme.
			if ( file_exists( get_theme_file_path( 'templates/single/single-' . get_post_type() . '.php' ) ) ) {
				get_template_part( 'templates/single/single', get_post_type() );
			} else {
				get_template_part( 'templates/single/single', get_aesthetix_options( 'single_' . get_post_type() . '_template_type' ) );
			}
		?>

	<?php endwhile; ?>

	<?php do_action( 'after_single_post' ); ?>

</main>

<?php

get_sidebar();
get_footer();
