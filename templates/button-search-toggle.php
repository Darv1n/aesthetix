<?php
/**
 * Template part for displaying button search toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */

$button_color   = $args['button_color'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_color' );
$button_type    = $args['button_type'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_type' );
$button_content = $args['button_content'] ?? get_aesthetix_options( 'general_searchform_popup_form_button_content' ); ?>

<button <?php button_classes( 'search-sidebar-open icon icon_magnifying-glass', $button_color, $button_type, $button_content ); ?> aria-label="<?php esc_attr_e( 'Open Search Button', 'aesthetix' ) ?>" aria-controls="search-sidebar" aria-expanded="false">
	<?php if ( ! in_array( (string) $button_content, array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Search', 'aesthetix' );
	} ?>
</button>