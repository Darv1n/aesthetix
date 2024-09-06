<?php
/**
 * Template part for displaying widget all menus.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$menus = get_registered_nav_menus();
unset( $menus['primary'] );
unset( $menus['mobile'] );

$defaults = array(
	'columns'             => 2,
	'menu_structure'      => implode( ',', array_keys( $menus ) ),
	'count_items_display' => get_aesthetix_options( 'general_menu_count_items_display' ),
);

$args      = array_merge( apply_filters( 'get_aesthetix_widget_menus_default_args', $defaults, $args ), $args );
$locations = get_nav_menu_locations();

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
					<?php $menu_object = wp_get_nav_menu_object( $locations[ $value ] ); ?>
					<h3 class="widget-menu-title"><?php echo esc_html( $menu_object->name ); ?></h3>
					<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => $value, 'count_items_display' => $args['count_items_display'] ) ); ?>
				</div>
			<?php } ?>
		<?php } ?>
	<?php } ?>
</div>
