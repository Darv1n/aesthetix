<?php
/**
 * Template part for displaying subscribe popup toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.8
 */

$button_color   = $args['button_color'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_color' );
$button_type    = $args['button_type'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_type' );
$button_content = $args['button_content'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_content' ); ?>

<button <?php button_classes( 'subscribe-toggle popup-button icon icon_paper-plane', $button_color, $button_type, $button_content ); ?> data-mfp-src="#subscribe-popup" aria-label="<?php esc_attr_e( 'Open Subscribe Form', 'aesthetix' ) ?>" role="button">
	<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Subscribe', 'aesthetix' );
	} ?>
</button>
