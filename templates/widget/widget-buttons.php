<?php
/**
 * Template part for displaying buttons.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['structure']            = $args['structure'] ?? 'telegram,whatsapp,subscribe,search';
$args['style']                = $args['style'] ?? 'inline'; // inline, block.
$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? 'primary';
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_button_type' );
$args['button_content']       = $args['button_content'] ?? 'button-icon-text';
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' );

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

		<li class="button-list-item">

			<?php switch ( $value ) {
				case has_action( 'aesthetix_widget_buttons_loop_' . $value ):
					do_action( 'aesthetix_widget_buttons_loop_' . $value, $post, $args );
					break;
				case 'telegram': ?>
					<?php if ( wp_http_validate_url( get_aesthetix_options( 'other_telegram_chat' ) ) ) { ?>
						<a <?php icon_classes( 'button-telegram icon icon-brand icon-telegram', $args ); ?> href="<?php echo esc_url( get_aesthetix_options( 'other_telegram_chat' ) ); ?>" aria-label="<?php esc_attr_e( 'Telegram button', 'aesthetix' ) ?>" target="_blank">
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								esc_html_e( 'Telegram', 'aesthetix' );
							} ?>
						</a>
					<?php } ?>
					<?php break;
				case 'whatsapp': ?>
					<?php if ( get_aesthetix_options( 'other_whatsapp' ) ) { ?>
						<a <?php icon_classes( 'button-whatsapp icon icon-brand icon-whatsapp', $args ); ?> href="<?php echo esc_url( 'https://api.whatsapp.com/send?phone=' . preg_replace( '/(\D)/', '', get_aesthetix_options( 'other_whatsapp' ) ) ); ?>" aria-label="<?php esc_attr_e( 'WhatsApp button', 'aesthetix' ) ?>" target="_blank">
							<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
								esc_html_e( 'WhatsApp', 'aesthetix' );
							} ?>
						</a>
					<?php } ?>
					<?php break;
				case 'subscribe': ?>
					<?php get_template_part( 'templates/widget/widget-subscribe-toggle', '', $args );?>
					<?php break;
				case 'search': ?>
					<?php get_template_part( 'templates/widget/widget-search-toggle', '', $args );?>
					<?php break;
				default:
					break;
			} ?>

		</li>

	<?php } ?>

	</ul>
<?php }
