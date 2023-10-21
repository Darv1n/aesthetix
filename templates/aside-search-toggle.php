<?php
/**
 * Template part for displaying search popup toggle.
 * 
 * @since 1.1.1
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$args['button_size']    = $args['button_size'] ?? get_aesthetix_options( 'root_button_size' );
$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_color' );
$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_type' );
$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_content' );
$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'root_searchform_popup_form_button_rounded' ); ?>

<button <?php button_classes( 'search-toggle popup-button icon icon_magnifying-glass', $args ); ?> data-mfp-src="#aside-search" aria-label="<?php esc_attr_e( 'Popup search button', 'aesthetix' ) ?>" aria-haspopup="true" aria-controls="aside-search">
	<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
		esc_html_e( 'Search', 'aesthetix' );
	} ?>
</button>
