<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
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

	<footer id="footer" class="footer" aria-label="<?php esc_attr_e( 'Site footer', 'aesthetix' ); ?>">

		<?php do_action( 'wp_footer_open' ); ?>

		<?php if ( get_aesthetix_options( 'general_footer_top_bar_display' ) ) { ?>
			<section <?php aesthetix_section_classes( 'footer-section footer-top-bar', get_aesthetix_options( 'root_bg_footer_top_bar' ) ); ?>>
				<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
					<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
						<?php get_template_part( 'templates/footer/footer-top-bar' ); ?>
					</div>
				</div>
			</section>
		<?php } ?>

		<section <?php aesthetix_section_classes( 'footer-section footer-middle-bar', get_aesthetix_options( 'root_bg_footer_middle_bar' ) ); ?>>
			<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
				<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
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
		</section>

		<?php if ( get_aesthetix_options( 'general_footer_bottom_bar_display' ) ) { ?>
			<section <?php aesthetix_section_classes( 'footer-section footer-bottom-bar', get_aesthetix_options( 'root_bg_footer_bottom_bar' ) ); ?>>
				<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
					<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
						<?php get_template_part( 'templates/footer/footer-bottom-bar' ); ?>
					</div>
				</div>
			</section>
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
