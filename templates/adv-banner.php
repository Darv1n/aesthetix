<?php
/**
 * Template part for displaying advertising banner.
 * 
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['adv_desktop'] = $args['adv_desktop'] ?? get_aesthetix_options( 'default_adv_desktop' );
$args['adv_mobile']  = $args['adv_mobile'] ?? get_aesthetix_options( 'default_adv_mobile' );
$args['adv_link']    = $args['adv_link'] ?? get_aesthetix_options( 'default_adv_link' );
$args['adv_alt']     = $args['adv_alt'] ?? get_aesthetix_options( 'default_adv_alt' );

$url = wp_http_validate_url( $args['adv_link'] );

$classes[] = 'ab';

if ( ! empty( $args['adv_mobile'] ) ) {
	$classes[] = 'has_mobile';
}

?>

<?php if ( $url && ! empty( $args['adv_desktop'] ) ) { ?>
	<a href="<?php echo esc_url( $url ); ?>" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<img src="<?php echo esc_url( $args['adv_desktop'] ); ?>" class="ab-desktop" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php if ( ! empty( $args['adv_mobile'] ) ) { ?>
			<img src="<?php echo esc_url( $args['adv_mobile'] ); ?>" class="ab-mobile" alt="<?php echo esc_attr( $args['adv_alt'] ); ?>">
		<?php } ?>
	</a>
<?php }
