<?php
/**
 * Template part for displaying widget contacts list.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'address'  => get_aesthetix_options( 'other_address' ),
	'phone'    => get_aesthetix_options( 'other_phone' ),
	'email'    => get_aesthetix_options( 'other_email' ),
	'whatsapp' => get_aesthetix_options( 'other_whatsapp' ),
	'telegram' => get_aesthetix_options( 'other_telegram_chat' ),
	'style'    => 'block', // inline, block.
);

$args      = array_merge( $defaults, $args );
$classes[] = 'social-list';

if ( $args['style'] === 'block' ) {
	$classes[] = 'social-list-block';
} else {
	$classes[] = 'social-list-inline';
}

if ( $args['address'] || $args['phone'] || $args['email'] ) { ?>
	<ul class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">

		<?php if ( $args['phone'] ) { ?>
			<li class="contacts-list-item icon icon-before icon-phone icon-gray">
				<a <?php link_classes( 'link-phone' ); ?> href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $args['phone'] ) ); ?>"><?php echo esc_html( $args['phone'] ); ?></a>
			</li>
		<?php } ?>

		<?php if ( $args['address'] ) { ?>
			<li class="contacts-list-item icon icon-before icon-location-dot icon-top icon-gray">
				<address><?php echo esc_html( $args['address'] ); ?></address>
			</li>
		<?php } ?>

		<?php if ( $args['email'] ) { ?>
			<li class="contacts-list-item icon icon-before icon-envelope icon-top icon-gray">
				<a <?php link_classes( 'link-email' ); ?> href="mailto:<?php echo esc_attr( $args['email'] ); ?>"><?php echo esc_html( $args['email'] ); ?></a>
			</li>
		<?php } ?>

		<?php if ( $args['whatsapp'] ) { ?>
			<li class="contacts-list-item icon icon-before icon-brand icon-whatsapp icon-top icon-gray">
				<a <?php link_classes( 'link-email' ); ?> href="<?php echo esc_url( 'https://api.whatsapp.com/send?phone=' . preg_replace( '/(\D)/', '', $args['whatsapp'] ) ); ?>"><?php esc_html_e( 'Write to WhatsApp', 'aesthetix' ); ?></a>
			</li>
		<?php } ?>

		<?php if ( $args['telegram'] ) { ?>
			<li class="contacts-list-item icon icon-before icon-brand icon-telegram icon-top icon-gray">
				<a <?php link_classes( 'link-email' ); ?> href="<?php echo esc_url( $args['telegram'] ); ?>"><?php esc_html_e( 'Write to Telegram', 'aesthetix' ); ?></a>
			</li>
		<?php } ?>

	</ul>
<?php }
