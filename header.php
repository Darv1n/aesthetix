<?php
/**
 * Theme header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aesthetix
 * @since 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://gmpg.org/xfn/11" rel="profile">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>

	<header id="header" <?php aesthetix_header_classes(); ?> aria-label="<?php esc_attr_e( 'Site Header', 'aesthetix' ); ?>">

		<?php do_action( 'wp_header_open' ); ?>

		<?php if ( get_aesthetix_options( 'general_header_top_bar_display' ) ) { ?>
			<div class="header__top-bar">
				<div <?php aesthetix_container_classes( 'container-header' ); ?>>

					<?php get_template_part( 'templates/header/header', 'top-bar' ); ?>

				</div>
			</div>
		<?php } ?>

		<?php
			if ( get_aesthetix_options( 'general_header_type' ) === 'header-content' ) {
				get_template_part( 'templates/header/header-content-type-', 'content' );
			} elseif ( get_aesthetix_options( 'general_header_type' ) === 'header-logo-center' ) {
				get_template_part( 'templates/header/header-content-type-', 'logo-center' );
			} else {
				get_template_part( 'templates/header/header-content-type', 'simple' );
			}
		?>

		<?php do_action( 'wp_header_close' ); ?>

	</header>

	<?php 
		/**
		 * Hook: before_site_content.
		 *
		 * @hooked aesthetix_before_site_content - 10
		 */
		do_action( 'before_site_content' );
