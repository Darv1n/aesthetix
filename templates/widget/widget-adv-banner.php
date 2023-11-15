<?php
/**
 * Template part for displaying advertising banner.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['adv_desktop']     = $args['adv_desktop'] ?? get_theme_file_uri( '/assets/img/header-promo.png' );
$args['adv_mobile']      = $args['adv_mobile'] ?? '';
$args['adv_link']        = $args['adv_link'] ?? 'https://www.3forty.media/zosia/demo-2/';
$args['adv_alt']         = $args['adv_alt'] ?? __( 'Banner', 'aesthetix' );
$args['adv_description'] = $args['adv_description'] ?? '';

$url = wp_http_validate_url( $args['adv_link'] );

$classes[] = 'ab';

if ( ! empty( $args['adv_mobile'] ) ) {
	$classes[] = 'has_mobile';
}

?>

<?php if ( $url && ! empty( $args['adv_desktop'] ) ) { ?>
	<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" target="_blank">
		<img src="<?php echo esc_url( $args['adv_desktop'] ); ?>" class="ab-desktop" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php if ( ! empty( $args['adv_mobile'] ) ) { ?>
			<img src="<?php echo esc_url( $args['adv_mobile'] ); ?>" class="ab-mobile" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php } ?>
		<?php if ( ! empty( $args['adv_description'] ) ) { ?>
			<div class="ab-description">
				<p class="ab-description-inner">
					<?php echo esc_html( $args['adv_description'] ); ?>	
				</p>
			</div>
		<?php } ?>
	</a>
<?php }
