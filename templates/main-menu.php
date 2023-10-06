<?php
/**
 * Template part for displaying main menu.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */

$args = array(
	'theme_location' => 'primary',
	'menu_id'        => 'primary-navigation',
	'container'      => '',
); ?>

<div id="main-menu" <?php aesthetix_main_menu_classes(); ?>>

	<?php get_template_part( 'templates/button-menu-toggle' ); ?>

	<nav id="main-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Site main menu', 'aesthetix' ); ?>">
		<?php wp_nav_menu( $args ); ?>
	</nav>

</div>