<?php
/**
 * Template three columns footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package aesthetix
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes(); ?>>
	<div class="col-12 col-sm-6 col-md-4 footer-column">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-one' ) ) {
				dynamic_sidebar( 'sidebar-footer-one' );
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
	<div class="col-12 col-sm-6 col-md-4 footer-column">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-two' ) ) {
				dynamic_sidebar( 'sidebar-footer-two' );
			} else { ?>
				<h3 class="widget-title"><?php _e( 'Menu', 'aesthetix' ); ?></h3>
				<div class="main-menu">
					<nav id="footer-navigation" class="footer-navigation" role="navigation" aria-label="<?php _e( 'Site main menu', 'aesthetix' ); ?>">
						<?php
							$args = array(
								'theme_location' => 'primary',
								'menu_id'        => 'primary-navigation',
								'container'      => '',
								'fallback_cb'    => 'primary_menu_fallback',
							);

							wp_nav_menu( $args );
						?>
					</nav>
				</div>
			<?php }
		?>
	</div>
	<div class="col-12 col-sm-12 col-md-4 footer-column">
		<?php
			if ( is_active_sidebar( 'sidebar-footer-three' ) ) {
				dynamic_sidebar( 'sidebar-footer-three' );
			} else { ?>
				<div class="widget widget_footer_contacts">
					<h3 class="widget-title"><?php _e( 'Contacts', 'aesthetix' ); ?></h3>
					<?php echo do_shortcode( '[aesthetix-contacts-list]' ); ?>
					<?php echo do_shortcode( '[aesthetix-social-list]' ); ?>
				</div>
			<?php }
		?>
	</div>
</div>
