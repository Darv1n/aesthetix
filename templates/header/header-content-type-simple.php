<?php
/**
 * Template header center
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<div class="header__middle-bar" <?php echo has_custom_header() ? 'style="background: url( ' . esc_url( get_header_image() ) . ' ) center/cover no-repeat" role="img"' : ''; ?>>

	<div <?php aesthetix_container_classes( 'container-header' ); ?>>
		<div class="d-flex justify-content-between align-items-center relative">

			<?php do_action( 'aesthetix_before_logo' ); ?>

				<?php get_template_part( 'templates/logo' ); ?>

			<?php do_action( 'aesthetix_after_logo' ); ?>

			<?php do_action( 'aesthetix_before_site_main_menu' ); ?>

			<div id="main-menu" <?php aesthetix_main_menu_classes(); ?>>

				<?php do_action( 'aesthetix_before_main_navigation' ); ?>

					<nav id="main-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Site main menu', 'aesthetix' ); ?>">

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

				<?php do_action( 'aesthetix_after_main_navigation' ); ?>

			</div>

			<?php do_action( 'aesthetix_after_site_main_menu' ); ?>

		</div>
	</div>

</div>
