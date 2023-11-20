<?php
/**
 * Template header desktop 3 + 0 (three) columns.
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
				<div class="col-12 col-md-2">
					<div <?php widgets_classes( '', 'header-main-left' ); ?>>

						<?php if ( is_active_sidebar( 'header-main-left' ) ) {
							dynamic_sidebar( 'header-main-left' );
						} else {
							aesthetix_widget_default( 'header-main-left' );
						} ?>

					</div>
				</div>
				<div class="col-12 col-md-8">
					<div <?php widgets_classes( '', 'header-main-center' ); ?>>

						<div <?php widget_classes( 'widget-primary-menu', 'header-main-center' ) ?>>
							<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'primary' ) ); ?>
						</div>

					</div>
				</div>
				<div class="col-12 col-md-2">
					<div <?php widgets_classes( '', 'header-main-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-main-right' ) ) {
							dynamic_sidebar( 'header-main-right' );
						} else {
							aesthetix_widget_default( 'header-main-right' );
						} ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
