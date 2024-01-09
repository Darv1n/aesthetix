<?php
/**
 * Template part for displaying widget social list.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => 'primary',
	'button_type'          => get_aesthetix_options( 'root_button_type' ),
	'button_content'       => 'button-icon',
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'icon_size'            => get_aesthetix_options( 'root_button_size' ),
	'structure'            => '', // example for string: instagram=https://instagram.com/art_zolin&telegram=https://telegram.me/artzolin
	'style'                => 'inline', // inline, block.
);

$args      = array_merge( $defaults, $args );
$classes[] = 'social-list';

if ( $args['style'] === 'block' ) {
	$classes[] = 'social-list-block';
} else {
	$classes[] = 'social-list-inline';
}

if ( $args['button_content'] === 'icon' ) {
	$classes[] = 'social-list-icons';
}

if ( is_string( $args['structure'] ) && ! empty( $args['structure'] ) ) {
	wp_parse_str( $args['structure'], $args['structure'] );
}

if ( empty( $args['structure'] ) ) {
	$args['structure'] = array();
	foreach ( get_aesthetix_customizer_socials() as $key => $value ) {
		if ( get_aesthetix_options( 'other_' . $key ) ) {
			$args['structure'][ $key ] = get_aesthetix_options( 'other_' . $key );
		}
	}
}

if ( ! empty( $args['structure'] ) ) { ?>
	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php foreach ( $args['structure'] as $key => $value ) {
			if ( wp_http_validate_url( $value ) ) { ?>
				<li class="social-list-item">
					<a <?php button_classes( 'icon icon-brand icon-' . $key, $args ); ?> href="<?php echo esc_url( $value ); ?>" target="_blank" rel="noopener noreferrer external">
						<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
							echo esc_html( mb_ucfirst( get_aesthetix_customizer_socials()[ $key ] ) );
						} ?>
					</a>
				</li>
			<?php }
		} ?>

	</ul>
<?php } else {
	if ( current_user_can( 'edit_theme_options' ) ) { ?>
		<a <?php link_classes( 'setup-link' ); ?> href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank"><?php esc_html_e( 'Setup social links', 'aesthetix' ); ?></a>
	<?php }
}
