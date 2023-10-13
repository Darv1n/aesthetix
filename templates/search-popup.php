<?php
/**
 * Template part for displaying search popup.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */
 ?>

<aside id="search-popup" class="search-popup popup mfp-hide" aria-label="<?php esc_attr_e( 'Search Popup', 'aesthetix' ); ?>">
	<?php get_search_form(); ?>
</aside>