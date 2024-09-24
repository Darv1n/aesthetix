<?php
/**
 * Template part for displaying widget site logo.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'logo_size' => get_aesthetix_options( 'title_tagline_logo_size' ),
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_logo_default_args', $defaults, $args ), $args );

// Check if the image is set in the customizer settings or display the text.
if ( has_custom_logo() ) { ?>
	<div class="logo logo-<?php echo esc_attr( $args['logo_size'] ); ?>">
		<?php the_custom_logo(); ?>
	</div>
<?php } else {
	// For all pages except the main page, display a link to it.
	if ( ( is_front_page() || is_home() ) && ! is_paged() ) { ?>
		<div class="logo logo-<?php echo esc_attr( $args['logo_size'] ); ?>">
			<strong class="logo-title"><?php bloginfo( 'name' ); ?></strong>
			<p class="logo-description"><?php bloginfo( 'description' ); ?></p>
		</div>
	<?php } else { ?>
		<a class="logo logo-<?php echo esc_attr( $args['logo_size'] ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<strong class="logo-title"><?php bloginfo( 'name' ); ?></strong>
			<p class="logo-description"><?php bloginfo( 'description' ); ?></p>
		</a>
	<?php }
}
