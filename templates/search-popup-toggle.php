<?php
/**
 * Template part for displaying search popup toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */

$button_color   = $args['button_color'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_color' );
$button_type    = $args['button_type'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_type' );
$button_content = $args['button_content'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_content' ); ?>

<button <?php button_classes( 'search-toggle popup-button icon icon_magnifying-glass', $button_color, $button_type, $button_content ); ?> data-mfp-src="#search-popup" aria-label="<?php esc_attr_e( 'Open Search Form', 'aesthetix' ) ?>" aria-controls="search-popup" aria-expanded="false">
	<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Search', 'aesthetix' );
	} ?>
</button>