<?php
/**
 * Template header simple desktop.
 *
 * @since 1.2.4
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="header-desktop header-middle"<?php echo has_custom_header() ? ' style="background: url( ' . esc_url( get_header_image() ) . ' ) center/cover no-repeat" role="img"' : ''; ?>>
	<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
		<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
				<div class="col-12 col-md-3">
					<div <?php widgets_classes( '', 'header-main-left' ); ?>>

						<?php if ( is_active_sidebar( 'header-main-left' ) ) {
							dynamic_sidebar( 'header-main-left' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_default_sidebar_main_left', array( 'logo' ) ), 'header-main-left' );
						} ?>

					</div>
				</div>
				<div class="col-12 col-md-9">
					<div <?php widgets_classes( '', 'header-main-right' ); ?>>

						<div <?php widget_classes( '', 'header-main-right' ) ?>>
							<?php get_template_part( 'templates/main-menu' ); ?>
						</div>

						<?php if ( is_active_sidebar( 'header-main-right' ) ) {
							dynamic_sidebar( 'header-main-right' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_default_sidebar_main_right', array( 'aside-search-toggle', 'aside-subscribe-toggle' ) ), 'header-main-right' );
						} ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
