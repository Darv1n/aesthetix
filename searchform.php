<?php
/**
 * The template for disdisplaying searchform.
 *
 * @since 1.0.0
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args['input_size']     = $args['input_size'] ?? get_aesthetix_options( 'root_input_size' );
$args['button_size']    = $args['button_size'] ?? get_aesthetix_options( 'root_input_size' );
$args['button_color']   = $args['button_color'] ?? get_aesthetix_options( 'general_searchform_form_button_color' );
$args['button_type']    = $args['button_type'] ?? get_aesthetix_options( 'general_searchform_form_button_type' );
$args['button_content'] = $args['button_content'] ?? get_aesthetix_options( 'general_searchform_form_button_content' );
$args['button_rounded'] = $args['button_rounded'] ?? get_aesthetix_options( 'general_searchform_form_button_rounded' );

?>

<form class="search-form form" method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search for', 'aesthetix' ); ?>:</label>
	<input <?php input_classes( 'search-field', $args['input_size'] ); ?> type="search" placeholder="<?php esc_attr_e( 'Search...', 'aesthetix' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for', 'aesthetix' ); ?>" />
	<button <?php button_classes( 'search-submit icon icon_magnifying-glass', $args ); ?> type="submit" value="<?php esc_attr_e( 'Search', 'aesthetix' ); ?>">
		<?php if ( ! in_array( $args['button_content'], array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Search', 'aesthetix' );
		} ?>
	</button>
</form>
