<?php
/**
 * Template part for displaying page content in page.php
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post_single post_page' ); ?>>

	<header class="post-header" aria-label="<?php esc_attr_e( 'Page header', 'aesthetix' ); ?>">
		<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
	</header>

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post-thumbnail" aria-label="<?php esc_attr_e( 'Page thumbnail', 'aesthetix' ); ?>">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>

	<div class="post-content" aria-label="<?php esc_attr_e( 'Page content', 'aesthetix' ); ?>">
		<?php
			do_action( 'aesthetix_before_single_page_content' );

			the_content();

			wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aesthetix' ), 'after'  => '</div>', ) );

			do_action( 'aesthetix_after_single_page_content' );
		?>
	</div>

	<?php if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) { ?>
		<footer class="post-footer" aria-label="<?php esc_attr_e( 'Page footer', 'aesthetix' ); ?>">
			<a <?php link_classes( 'edit-link' ); ?> href="<?php echo esc_url( get_edit_post_link() ); ?>"><?php esc_html_e( 'Edit', 'aesthetix' ); ?></a>
		</footer>
	<?php } ?>
</article>
