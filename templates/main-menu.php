<?php
/**
 * Template part for displaying main menu.
 * 
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<nav <?php aesthetix_main_menu_classes(); ?> role="navigation" aria-label="<?php esc_attr_e( 'Site main menu', 'aesthetix' ); ?>">

	<?php
		$args = array(
			'theme_location' => 'primary',
			'container'      => '',
			'menu_id'        => 'main-menu',
			'menu_class'     => 'menu menu-desktop',
			'fallback_cb'    => 'primary_menu_fallback',
		);

		wp_nav_menu( $args );
	?>

</nav>
