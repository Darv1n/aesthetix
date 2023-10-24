<?php
/**
 * Template header desktop 3 + 3 (six) columns.
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
				<div class="col-12 col-md-4">
					<div <?php widgets_classes( '', 'header-main-left' ); ?>>

						<?php if ( is_active_sidebar( 'header-main-left' ) ) {
							dynamic_sidebar( 'header-main-left' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_mid_3_bot_3_sidebar_main_left', array( 'adv-banner' ) ), 'header-main-left' );
						} ?>

					</div>
				</div>
				<div class="col-12 col-md-4">
					<div <?php widgets_classes( '', 'header-main-center' ); ?>>
						<?php if ( is_active_sidebar( 'header-main-center' ) ) {
							dynamic_sidebar( 'header-main-center' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_mid_3_bot_3_sidebar_main_center', array( 'logo' ) ), 'header-main-center' );
						} ?>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div <?php widgets_classes( '', 'header-main-right' ); ?>>
						<?php if ( is_active_sidebar( 'header-main-right' ) ) {
							ynamic_sidebar( 'header-main-right' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_mid_3_bot_3_sidebar_main_right', array( 'adv-banner' ) ), 'header-main-right' );
						} ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="header-desktop header-bottom">
	<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
		<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
				<div class="col-12 col-md-2">
					<div <?php widgets_classes( '', 'header-bottom-left' ); ?>>

						<?php if ( is_active_sidebar( 'header-bottom-left' ) ) {
							dynamic_sidebar( 'header-bottom-left' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_mid_3_bot_3_sidebar_bottom_left', array( 'aside-subscribe-toggle' ) ), 'header-bottom-left' );
						} ?>

					</div>
				</div>
				<div class="col-12 col-md-8">
					<div <?php widgets_classes( '', 'header-bottom-center' ); ?>>

						<div <?php widget_classes( '', 'header-bottom-center' ) ?>>
							<?php get_template_part( 'templates/main-menu' ); ?>
						</div>

					</div>
				</div>
				<div class="col-12 col-md-2">
					<div <?php widgets_classes( '', 'header-bottom-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-bottom-right' ) ) {
							dynamic_sidebar( 'header-bottom-right' );
						} else {
							the_default_sidebar( apply_filters( 'header_desktop_mid_3_bot_3_sidebar_bottom_right', array( 'aside-search-toggle' ) ), 'header-bottom-right' );
						} ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
