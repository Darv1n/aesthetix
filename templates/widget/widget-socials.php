<?php
/**
 * Template part for displaying social list.
 * 
 * @since 1.3.2
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['structure']            = $args['structure'] ?? array();
$args['style']                = $args['style'] ?? 'inline'; // inline, block.
$args['icon_size']            = $args['icon_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? 'primary';
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_button_type' );
$args['button_content']       = $args['button_content'] ?? 'button-icon'; // button-icon-text, button-icon, button-text, link-icon-text, link-text, text-icon, text, icon
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' );

$classes[] = 'social-list';
if ( $args['style'] === 'block' ) {
	$classes[] = 'social-list-block';
} else {
	$classes[] = 'social-list-inline';
}

if ( $args['button_content'] === 'icon' ) {
	$classes[] = 'social-list-icons';
}

if ( has_aesthetix_customizer_social() ) { ?>
	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<?php foreach ( get_aesthetix_customizer_socials() as $social_key => $social_name ) {

		if ( isset( $args['structure'][ $social_key ] ) ) {
			$social_link = wp_http_validate_url( $args['structure'][ $social_key ] );
		} else {
			$social_link = wp_http_validate_url( get_aesthetix_options( 'other_' . $social_key ) );
		}

		if ( $social_link ) { ?>
			<li class="social-list-item">
				<a <?php icon_classes( 'icon icon-brand icon-' . $social_key, $args ); ?> href="<?php echo esc_url( $social_link ); ?>" target="_blank" rel="noopener noreferrer external">
					<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
						echo esc_html( mb_ucfirst( $social_name ) );
					} ?>
				</a>
			</li>

		<?php }
	} ?>

	</ul>
<?php } else {
	if ( current_user_can( 'edit_theme_options' ) ) { ?>
		<a <?php link_classes( 'setup-link' ); ?> href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank"><?php esc_html_e( 'Setup social links', 'aesthetix' ) ?></a>
	<?php }
}
