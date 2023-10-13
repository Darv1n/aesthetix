<?php
/**
 * Template part for displaying button subscribe.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.8
 */

$button_color   = $args['button-color'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_color' );
$button_type    = $args['button-type'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_type' );
$button_content = $args['button-content'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_content' ); ?>

<?php if ( get_aesthetix_options( 'general_subscription_form_type' ) !== 'none' ) { ?>
	<a <?php button_classes( 'search-submit icon icon_paper-plane', $button_color, $button_type, $button_content ); ?> href="#section-subscription-from" aria-label="<?php esc_attr_e( 'Scroll Subscription Form', 'aesthetix' ) ?>" role="button">
		<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Subscribe', 'aesthetix' );
		} ?>
	</a>
<?php }
