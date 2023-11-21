<?php
/**
 * Template part for displaying search popup toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']          = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']         = $args['button_color'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_color' );
$args['button_type']          = $args['button_type'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_type' );
$args['button_content']       = $args['button_content'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_content' );
$args['button_border_radius'] = $args['button_border_radius'] ?? get_aesthetix_options( 'root_button_border_radius' ); ?>

<button <?php button_classes( 'search-toggle popup-button icon icon-magnifying-glass', $args ); ?> data-mfp-src="#aside-search" aria-label="<?php esc_attr_e( 'Popup search button', 'aesthetix' ) ?>" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Search', 'aesthetix' );
	} ?>
</button>
