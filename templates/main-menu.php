<?php
/**
 * Template part for displaying main menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<div id="main-menu" <?php aesthetix_main_menu_classes(); ?>>

	<?php do_action( 'aesthetix_before_main_navigation' ); ?>

		<nav id="main-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Site Main Menu', 'aesthetix' ); ?>">

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