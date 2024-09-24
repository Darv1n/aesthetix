<?php
/**
 * Template part for displaying widget buttons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => 'primary',
	'button_type'          => get_aesthetix_options( 'root_button_type' ),
	'button_content'       => 'button-icon-text',
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'structure'            => 'telegram,whatsapp,subscribe,search',
	'style'                => 'inline', // inline, block.
);

$args      = array_merge( apply_filters( 'get_aesthetix_widget_buttons_default_args', $defaults, $args ), $args );
$classes[] = 'button-list';

if ( $args['style'] === 'block' ) {
	$classes[] = 'button-list-block';
} else {
	$classes[] = 'button-list-inline';
}

if ( is_string( $args['structure'] ) && ! empty( $args['structure'] ) ) {
	$args['structure'] = array_map( 'trim', explode( ',', $args['structure'] ) );
} ?>

<?php if ( is_array( $args['structure'] ) && ! empty( $args['structure'] ) ) { ?>

	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

	<?php foreach ( $args['structure'] as $key => $value ) { ?>

		<?php switch ( $value ) {
			case has_action( 'aesthetix_widget_buttons_loop_' . $value ):
				do_action( 'aesthetix_widget_buttons_loop_' . $value, $post, $args );
				break;
			case 'telegram': ?>
				<?php if ( wp_http_validate_url( get_aesthetix_options( 'other_telegram_chat' ) ) ) { ?>
					<li class="button-list-item">
						<a <?php button_classes( 'button-telegram icon icon-brand icon-telegram', $args ); ?> href="<?php echo esc_url( get_aesthetix_options( 'other_telegram_chat' ) ); ?>" aria-label="<?php esc_attr_e( 'Telegram button', 'aesthetix' ); ?>" target="_blank">
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								esc_html_e( 'Telegram', 'aesthetix' );
							} ?>
						</a>
					</li>
				<?php } ?>
				<?php break;
			case 'whatsapp': ?>
				<?php if ( get_aesthetix_options( 'other_whatsapp' ) ) { ?>
					<li class="button-list-item">
						<a <?php button_classes( 'button-whatsapp icon icon-brand icon-whatsapp', $args ); ?> href="<?php echo esc_url( 'https://api.whatsapp.com/send?phone=' . preg_replace( '/(\D)/', '', get_aesthetix_options( 'other_whatsapp' ) ) ); ?>" aria-label="<?php esc_attr_e( 'WhatsApp button', 'aesthetix' ); ?>" target="_blank">
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								esc_html_e( 'WhatsApp', 'aesthetix' );
							} ?>
						</a>
					</li>
				<?php } ?>
				<?php break;
			case 'subscribe': ?>
				<li class="button-list-item">
					<?php get_template_part( 'templates/widget/widget-subscribe-toggle', '', $args ); ?>
				</li>
				<?php break;
			case 'search': ?>
				<li class="button-list-item">
					<?php get_template_part( 'templates/widget/widget-search-toggle', '', $args ); ?>
				</li>
				<?php break;
			default:
				break;
		} ?>

	<?php } ?>

	</ul>
<?php }
