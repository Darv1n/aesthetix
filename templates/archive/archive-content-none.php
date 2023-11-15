<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<header class="content-area-header" aria-label="<?php esc_attr_e( 'Page header', 'aesthetix' ); ?>">
	<h2 class="content-area-title"><?php esc_html_e( 'Nothing found', 'aesthetix' ); ?></h2>
</header>

<section class="content-area-content" aria-label="<?php esc_attr_e( 'Page content', 'aesthetix' ); ?>">
	<div class="no-results-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
			<?php printf( '<p>' . wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>', 'aesthetix' ), array( 'a' => array( 'href' => array() ) ) ) . '</p>', esc_url( admin_url( 'post-new.php' ) ) ); ?>
		<?php } elseif ( is_search() ) { ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords', 'aesthetix' ); ?></p>
		<?php } else { ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help', 'aesthetix' ); ?></p>
		<?php } ?>
	</div>
</section>

<footer class="content-area-footer" aria-label="<?php esc_attr_e( 'Page footer', 'aesthetix' ); ?>">
	<?php get_search_form(); ?>
</footer>
