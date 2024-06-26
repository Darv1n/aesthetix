<?php
/**
 * Template part for displaying button scroll top.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => get_aesthetix_options( 'root_scroll_top_button_color' ),
	'button_type'          => get_aesthetix_options( 'root_scroll_top_button_type' ),
	'button_content'       => get_aesthetix_options( 'root_scroll_top_button_content' ),
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
	'scroll_top_structure' => get_aesthetix_options( 'general_scroll_top_structure' ),
);

$args = array_merge( $defaults, $args );

if ( is_string( $args['scroll_top_structure'] ) && ! empty( $args['scroll_top_structure'] ) ) {
	$args['scroll_top_structure'] = array_map( 'trim', explode( ',', $args['scroll_top_structure'] ) );
}

if ( is_array( $args['scroll_top_structure'] ) && ! empty( $args['scroll_top_structure'] ) ) { ?>
	<aside id="aside-scroll-top" class="scroll-top-wrap aside">

	<?php foreach ( $args['scroll_top_structure'] as $key => $value ) {
		switch ( $value ) {
			case has_action( 'aesthetix_scroll_top_structure_loop_' . $value ):
				do_action( 'aesthetix_scroll_top_structure_loop_' . $value, $post, $args );
				break;
			case 'telegram': ?>
				<?php if ( wp_http_validate_url( get_aesthetix_options( 'other_telegram_chat' ) ) ) { ?>
					<a <?php button_classes( 'button-telegram icon icon-brand icon-telegram', $args ); ?> href="<?php echo esc_url( get_aesthetix_options( 'other_telegram_chat' ) ); ?>" aria-label="<?php esc_attr_e( 'Telegram button', 'aesthetix' ); ?>" target="_blank">
						<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
							esc_html_e( 'Telegram', 'aesthetix' );
						} ?>
					</a>
				<?php } ?>
				<?php break;
			case 'whatsapp': ?>
				<?php if ( get_aesthetix_options( 'other_whatsapp' ) ) { ?>
					<a <?php button_classes( 'button-whatsapp icon icon-brand icon-whatsapp', $args ); ?> href="<?php echo esc_url( 'https://api.whatsapp.com/send?phone=' . preg_replace( '/(\D)/', '', get_aesthetix_options( 'other_whatsapp' ) ) ); ?>" aria-label="<?php esc_attr_e( 'WhatsApp button', 'aesthetix' ); ?>" target="_blank">
						<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
							esc_html_e( 'WhatsApp', 'aesthetix' );
						} ?>
					</a>
				<?php } ?>
				<?php break;
			case 'scroll-top':?>
				<button id="scroll-top" <?php button_classes( 'scroll-top icon icon-arrow-up', $args ); ?> aria-label="<?php esc_attr_e( 'Scroll top button', 'aesthetix' ); ?>" type="button">
					<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
						esc_html_e( 'Scroll up', 'aesthetix' );
					} ?>
				</button>
				<?php break;
			default:
				break;
		}
	} ?>

	</aside>
<?php }
