<?php
/**
 * Template part for displaying advertising banner.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'adv_desktop'     => get_theme_file_uri( '/assets/img/header-promo.png' ),
	'adv_tablet'      => '',
	'adv_mobile'      => '',
	'adv_link'        => 'https://zolin.digital/',
	'adv_alt'         => __( 'Banner', 'aesthetix' ),
	'adv_title'       => '',
	'adv_description' => '',
);

$args      = array_merge( $defaults, $args );
$url       = wp_http_validate_url( $args['adv_link'] );
$classes[] = 'ab';

if ( ! empty( $args['adv_tablet'] ) ) {
	$classes[] = 'has_tablet';
}

if ( ! empty( $args['adv_mobile'] ) ) {
	$classes[] = 'has_mobile';
}

?>

<?php if ( $url && ! empty( $args['adv_desktop'] ) ) { ?>
	<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" target="_blank">
		<img src="<?php echo esc_url( $args['adv_desktop'] ); ?>" class="ab-desktop" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php if ( ! empty( $args['adv_tablet'] ) ) { ?>
			<img src="<?php echo esc_url( $args['adv_tablet'] ); ?>" class="ab-tablet" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php } ?>
		<?php if ( ! empty( $args['adv_mobile'] ) ) { ?>
			<img src="<?php echo esc_url( $args['adv_mobile'] ); ?>" class="ab-mobile" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php } ?>
		<?php if ( ! empty( $args['adv_title'] ) || ! empty( $args['adv_description'] ) ) { ?>
			<div class="ab-offer">
				<?php if ( ! empty( $args['adv_title'] ) ) { ?>
					<h3 class="ab-offer-title">
						<?php echo esc_html( $args['adv_title'] ); ?>	
					</h3>
				<?php } ?>
				<?php if ( ! empty( $args['adv_description'] ) ) { ?>
					<p class="ab-offer-description">
						<?php echo esc_html( $args['adv_description'] ); ?>	
					</p>
				<?php } ?>
			</div>
		<?php } ?>
	</a>
<?php }
