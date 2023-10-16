<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 * 
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aesthetix
 */
 ?>

<?php
	/**
	 * Hook: after_site_content.
	 *
	 * @hooked after_site_content_structure - 10
	 */
	do_action( 'after_site_content' ); ?>

	<footer id="footer" <?php aesthetix_footer_classes(); ?> aria-label="<?php esc_attr_e( 'Site footer', 'aesthetix' ); ?>">

		<?php do_action( 'wp_footer_open' ); ?>

		<?php if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) { ?>
			<div class="footer__top-bar">
				<div <?php aesthetix_container_classes( 'container-footer' ); ?>>
					<?php get_template_part( 'templates/footer/footer', 'top-bar' ); ?>
				</div>
			</div>
		<?php } ?>

		<div class="footer__middle-bar">
			<div <?php aesthetix_container_classes( 'container-footer' ); ?>>

				<?php
					if ( get_aesthetix_options( 'general_footer_type' ) === 'footer-three-columns' ) {
						get_template_part( 'templates/footer/footer-content-type', 'three-columns' );
					} elseif ( get_aesthetix_options( 'general_footer_type' ) === 'footer-four-columns' ) {
						get_template_part( 'templates/footer/footer-content-type', 'four-columns' );
					} else {
						get_template_part( 'templates/footer/footer-content-type', 'simple' );
					}
				?>

			</div>
		</div>

		<?php if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) { ?>
			<div class="footer__bottom-bar">
				<div <?php aesthetix_container_classes( 'container-footer' ); ?>>
					<?php get_template_part( 'templates/footer/footer', 'bottom-bar' ); ?>
				</div>
			</div>
		<?php } ?>

		<?php
			/**
			 * Hook: after_site_content.
			 *
			 * @hooked wp_footer_close_structure - 10
			 */
			do_action( 'wp_footer_close' ); ?>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
