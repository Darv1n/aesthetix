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

?>

<form class="search-form" method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="search-field"><?php esc_html_e( 'Search for', 'aesthetix' ); ?>:</label>
	<input id="search-field" class="search-field" type="search" placeholder="<?php esc_attr_e( 'Search...', 'aesthetix' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php esc_attr_e( 'Search for', 'aesthetix' ); ?>" />
	<button <?php the_aesthetix_searchform_button_classes(); ?> type="submit" value="<?php esc_attr_e( 'Search', 'aesthetix' ); ?>">
		<?php if ( ! in_array( get_aesthetix_options( 'general_searchform_button_type' ), array( 'icon', 'button-icon' ), true ) ) {
			esc_html_e( 'Search', 'aesthetix' );
		} ?>
	</button>
</form>
