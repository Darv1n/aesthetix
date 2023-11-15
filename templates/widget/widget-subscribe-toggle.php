<?php
/**
 * Template part for displaying subscribe popup toggle.
 * 
 * @since 1.1.8
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? get_aesthetix_options( 'root_subscribe_popup_form_button_color' );
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_subscribe_popup_form_button_type' );
$args['button_content']       = $args['button_content'] ?? get_aesthetix_options( 'root_subscribe_popup_form_button_content' );
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' ); ?>

<button <?php icon_classes( 'subscribe-toggle popup-button icon icon-paper-plane', $args ); ?> data-mfp-src="#aside-subscribe" aria-label="<?php esc_attr_e( 'Popup subscribe button', 'aesthetix' ) ?>" aria-haspopup="true" aria-controls="aside-subscribe" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Subscribe', 'aesthetix' );
	} ?>
</button>
