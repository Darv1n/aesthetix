<?php
/**
 * Template part for displaying any menu.
 * 
 * @since 1.3.2
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$menus = get_registered_nav_menus();
unset( $menus['primary'] );
unset( $menus['mobile'] );

$args['columns']             = $args['columns'] ?? 2;
$args['menu_titles']         = $args['menu_titles'] ?? array();
$args['menu_structure']      = $args['menu_structure'] ?? implode( ',', array_keys( $menus ) );
$args['count_items_display'] = $args['count_items_display'] ?? get_aesthetix_options( 'general_menu_count_items_display' );

if ( (int) $args['columns'] === 4 ) {
	$col_class = 'col-xs col-12 col-sm-6 col-md-3';
} elseif ( (int) $args['columns'] === 3 ) {
	$col_class = 'col-xs col-12 col-sm-4';
} elseif ( (int) $args['columns'] === 2 ) {
	$col_class = 'col-xs col-12 col-sm-6';
} else {
	$col_class = 'col-xs col-12';
}

if ( is_string( $args['menu_structure'] ) && ! empty( $args['menu_structure'] ) ) {
	$args['menu_structure'] = array_map( 'trim', explode( ',', $args['menu_structure'] ) );
} ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'row-xs' ); ?>>
	<?php if ( is_array( $args['menu_structure'] ) && ! empty( $args['menu_structure'] ) ) { ?>
		<?php foreach ( $args['menu_structure'] as $key => $value ) { ?>
			<?php if ( has_menu_items( $value ) ) { ?>
				<div class="<?php echo esc_attr( $col_class ); ?>">
					<?php if ( isset( $args['menu_titles'][ $value ] ) ) { ?>
						<h3 class="widget-menu-title"><?php echo esc_html( $args['menu_titles'][ $value ] ); ?></h3>
					<?php } ?>
					<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => $value, 'count_items_display' => $args['count_items_display'] ) ); ?>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>
