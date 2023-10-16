<?php
/**
 * The template for displaying 404 pages (not found)
 * 
 * @since 1.0.0
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Aesthetix
 */

get_header(); ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_404_page' ); ?>

	<header class="content-area-header" aria-label="<?php esc_attr_e( '404 page header', 'aesthetix' ); ?>">
		<h1 class="content-area-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found', 'aesthetix' ); ?></h1>
	</header>

	<section <?php aesthetix_section_classes( 'content-area-content' ); ?> aria-label="<?php esc_attr_e( '404 page content', 'aesthetix' ); ?>">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'aesthetix' ); ?></p>

		<?php get_search_form(); ?>
	</section>

	<footer class="content-area-footer" aria-label="<?php esc_attr_e( '404 page footer', 'aesthetix' ); ?>">
		<?php do_action( '404_widgets' ); ?>
	</footer>

	<?php do_action( 'aesthetix_after_404_page' ); ?>

</main>

<?php

get_sidebar();
get_footer();
