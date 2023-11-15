<?php
/**
 * Template part for displaying menu sidebar.
 * 
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */

$classes[] = 'aside';
$classes[] = 'aside-menu';

if ( is_admin_bar_showing() ) {
	$classes[] = 'has_wpadminbar';
} ?>

<aside id="aside-menu" class="<?php echo esc_attr( implode( ' ', $classes ) ) ?>" aria-label="<?php esc_attr_e( 'Menu aside', 'aesthetix' ); ?>">

	<div class="aside-header">
		<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
			<div class="col-6">
				<?php get_template_part( 'templates/widget/widget-logo' ); ?>
			</div>
			<div class="col-6">
				<div class="aside-menu-toggle">
					<?php get_template_part( 'templates/widget/widget-menu-toggle', '', array( 'button_classes' => 'menu-close' ) ); ?>
				</div>
			</div>
		</div>
	</div>

	<div class="aside-content">
		<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'mobile' ) ); ?>
	</div>

	<div class="aside-footer hidden">

	</div>

</aside>
