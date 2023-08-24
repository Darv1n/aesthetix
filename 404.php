<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package aesthetix
 */

get_header();

if ( get_aesthetix_options( 'sidebar_left_display' ) ) {
	get_sidebar();
} ?>

<main id="primary" <?php aesthetix_content_area_classes(); ?> role="main">

	<?php do_action( 'aesthetix_before_404_page' ); ?>

	<header class="content-area-header" aria-label="<?php _e( '404 page header', 'aesthetix' ); ?>">
		<h1 class="content-area-title"><?php _e( 'Oops! That page can&rsquo;t be found', 'aesthetix' ); ?></h1>
	</header>

	<section class="content-area-content" aria-label="<?php _e( '404 page content', 'aesthetix' ); ?>">
		<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'aesthetix' ); ?></p>

		<?php get_search_form(); ?>
	</section>

	<footer class="content-area-footer" aria-label="<?php _e( '404 page footer', 'aesthetix' ); ?>">
		<?php do_action( '404_widgets' ); ?>
	</footer>

	<?php do_action( 'aesthetix_after_404_page' ); ?>

</main>

<?php

if ( get_aesthetix_options( 'sidebar_left_display' ) && get_aesthetix_options( 'sidebar_right_display' ) ) {
	get_sidebar( 'right' );
} elseif ( get_aesthetix_options( 'sidebar_right_display' ) ) {
	get_sidebar();
}

get_footer();
