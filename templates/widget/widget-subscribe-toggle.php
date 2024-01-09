<?php
/**
 * Template part for displaying widget subscribe popup toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => get_aesthetix_options( 'root_subscribe_popup_form_button_color' ),
	'button_type'          => get_aesthetix_options( 'root_subscribe_popup_form_button_type' ),
	'button_content'       => get_aesthetix_options( 'root_subscribe_popup_form_button_content' ),
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
);

$args = array_merge( $defaults, $args ); ?>

<button <?php button_classes( 'subscribe-toggle popup-button icon icon-paper-plane', $args ); ?> data-mfp-src="#aside-subscribe" aria-label="<?php esc_attr_e( 'Popup subscribe button', 'aesthetix' ); ?>" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Subscribe', 'aesthetix' );
	} ?>
</button>
