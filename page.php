<?php
/**
 * The template for disdisdisplaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_single_page' ); ?>

	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>

		<?php do_action( 'aesthetix_before_article_page' ); ?>

			<?php get_template_part( 'templates/single/single-content-type', 'page' ); ?>

		<?php do_action( 'aesthetix_after_article_page' ); ?>

		<?php
			// @hooked the_aesthetix_post_navigation - 15
			do_action( 'aesthetix_before_comment_form' ); ?>

			<!-- If comments are open or we have at least one comment, load up the comment template. -->
			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template(); ?>
			<?php endif; ?>

		<?php do_action( 'aesthetix_after_comment_form' ); ?>

	<?php endwhile; ?>

	<?php do_action( 'aesthetix_after_single_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
