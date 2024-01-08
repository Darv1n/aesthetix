<?php
/**
 * Template part for displaying menu sidebar.
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

<aside id="aside-menu" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" aria-label="<?php esc_attr_e( 'Menu aside', 'aesthetix' ); ?>">

	<div class="aside-menu-header">
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

	<div class="aside-menu-content">
		<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'mobile' ) ); ?>
	</div>

	<?php if ( is_active_sidebar( 'aside-menu' ) ) { ?>
		<div <?php widgets_classes( 'aside-menu-footer', 'aside-menu' ); ?>>
			<?php dynamic_sidebar( 'aside-menu' ); ?>
		</div>
	<?php } ?>

</aside>
