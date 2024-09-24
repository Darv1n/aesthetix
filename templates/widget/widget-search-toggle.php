<?php
/**
 * Template part for displaying widget search popup toggle.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$defaults = array(
	'input_size'           => get_aesthetix_options( 'root_button_size' ),
	'button_size'          => get_aesthetix_options( 'root_button_size' ),
	'button_color'         => get_aesthetix_options( 'root_searchform_popup_form_button_color' ),
	'button_type'          => get_aesthetix_options( 'root_searchform_popup_form_button_type' ),
	'button_content'       => get_aesthetix_options( 'root_searchform_popup_form_button_content' ),
	'button_border_width'  => get_aesthetix_options( 'root_button_border_width' ),
	'button_border_radius' => get_aesthetix_options( 'root_button_border_radius' ),
);

$args = array_merge( apply_filters( 'get_aesthetix_widget_search_toggle_default_args', $defaults, $args ), $args ); ?>

<button <?php button_classes( 'search-toggle popup-button icon icon-magnifying-glass', $args ); ?> data-mfp-src="#aside-search" aria-label="<?php esc_attr_e( 'Popup search button', 'aesthetix' ); ?>" type="button">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Search', 'aesthetix' );
	} ?>
</button>
