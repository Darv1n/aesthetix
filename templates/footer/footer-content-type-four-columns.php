<?php
/**
 * Template four columns footer.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
	<div class="col-12 col-sm-6 col-md-3">
		<div <?php widgets_classes( '', 'footer-main-first' ); ?>>
			<?php
				if ( is_active_sidebar( 'footer-main-first' ) ) {
					dynamic_sidebar( 'footer-main-first' );
				} else { ?>
					<div class="widget widget_branding">
						<?php get_template_part( 'templates/logo' ); ?>
					</div>
					<div class="widget widget_search">
						<?php get_search_form(); ?>
					</div>
				<?php }
			?>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div <?php widgets_classes( '', 'footer-main-second' ); ?>>
			<?php
				if ( is_active_sidebar( 'footer-main-second' ) ) {
					dynamic_sidebar( 'footer-main-second' );
				}
			?>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div <?php widgets_classes( '', 'footer-main-third' ); ?>>
			<?php
				if ( is_active_sidebar( 'footer-main-third' ) ) {
					dynamic_sidebar( 'footer-main-third' );
				}
			?>
		</div>
	</div>
	<div class="col-12 col-sm-6 col-md-3">
		<div <?php widgets_classes( '', 'footer-main-fourth' ); ?>>
			<?php
				if ( is_active_sidebar( 'footer-main-fourth' ) ) {
					dynamic_sidebar( 'footer-main-fourth' );
				} else { ?>
					<div class="widget widget_footer_contacts">
						<h3 class="widget-title"><?php esc_html_e( 'Contacts', 'aesthetix' ); ?></h3>
						<?php echo do_shortcode( '[aesthetix-contacts-list]' ); ?>
						<?php echo do_shortcode( '[aesthetix-social-list]' ); ?>
					</div>
				<?php }
			?>
		</div>
	</div>
</div>
