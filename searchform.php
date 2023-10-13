<?php
/**
 * The template for disdisplaying searchform
 *
 * @package Aesthetix
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$button_color   = $args['button_color'] ?? get_aesthetix_options( 'general_searchform_form_button_color' );
$button_type    = $args['button_type'] ?? get_aesthetix_options( 'general_searchform_form_button_type' );
$button_content = $args['button_content'] ?? get_aesthetix_options( 'general_searchform_form_button_content' );

?>

<form class="search-form form" method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search for', 'aesthetix' ); ?>:</label>
	<input id="search-field" class="search-field" type="search" placeholder="<?php esc_attr_e( 'Search...', 'aesthetix' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for', 'aesthetix' ); ?>" />
	<button <?php button_classes( 'search-submit icon icon_magnifying-glass', $button_color, $button_type, $button_content ); ?> type="submit" value="<?php esc_attr_e( 'Search', 'aesthetix' ); ?>">
		<?php if ( ! in_array( $button_content, array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Search', 'aesthetix' );
		} ?>
	</button>
</form>
