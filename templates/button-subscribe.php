<?php
/**
 * Template part for displaying button subscribe.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.8
 */

$button_color   = $args['button_color'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_color' );
$button_type    = $args['button_type'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_type' );
$button_content = $args['button_content'] ?? get_aesthetix_options( 'general_subscribe_popup_form_button_content' ); ?>

<?php if ( get_aesthetix_options( 'general_subscribe_form_type' ) !== 'none' ) { ?>
	<a <?php button_classes( 'search-submit icon icon_paper-plane', $button_color, $button_type, $button_content ); ?> href="#section-subscribe-from" aria-label="<?php esc_attr_e( 'Scroll subscribe Form', 'aesthetix' ) ?>" role="button">
		<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Subscribe', 'aesthetix' );
		} ?>
	</a>
<?php }
