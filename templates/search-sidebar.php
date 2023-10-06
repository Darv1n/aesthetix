<?php
/**
 * Template part for displaying search sidebar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */

$structure = get_aesthetix_options( 'general_mobile_menu_structure' );

if ( is_string( $structure ) && ! empty( $structure ) ) {
	$structure = array_map( 'trim', explode( ',', $structure ) );
}

if ( in_array( 'search', $structure, true ) ) { ?>
	<aside id="search-sidebar" class="sidebar search-sidebar off" aria-label="<?php esc_attr_e( 'Search Sidebar', 'aesthetix' ); ?>">
		<div class="search-sidebar-wrap">

			<button id="search-sidebar-toggle" <?php button_classes( 'search-sidebar-close button-reset button-icon icon icon_center icon_xmark' ); ?>>
				<span class="screen-reader-text"><?php esc_html_e( 'Close', 'aesthetix' ); ?></span>
			</button>

			<?php get_search_form(); ?>
		</div>	
	</aside>
<?php }
