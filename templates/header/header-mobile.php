<?php
/**
 * Template header mobile.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="header-mobile">
	<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
		<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
				<div class="col-6">
					<div <?php widgets_classes( '', 'header-mobile-left' ); ?>>

						<?php if ( is_active_sidebar( 'header-mobile-left' ) ) {
							dynamic_sidebar( 'header-mobile-left' );
						} else {
							aesthetix_widget_default( 'header-mobile-left' );
						} ?>

					</div>
				</div>
				<div class="col-6">
					<div <?php widgets_classes( '', 'header-mobile-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-mobile-right' ) ) {
							dynamic_sidebar( 'header-mobile-right' );
						} else {
							aesthetix_widget_default( 'header-mobile-right' );
						} ?>

						<?php
							if ( in_array( get_aesthetix_options( 'root_button_size' ), array( 'lg', 'xl' ), true ) ) {
								$args['button_size'] = 'md';
							}

							if ( in_array( get_aesthetix_options( 'root_menu_button_content' ), array( 'button-icon-text', 'button-text', 'button-icon' ), true ) ) {
								$args['button_content'] = 'button-icon';
							} else {
								$args['button_content'] = 'icon';
							}
						?>

						<div <?php widget_classes( '', 'header-mobile-right' ) ?>>
							<?php get_template_part( 'templates/widget/widget-menu-toggle', '', $args ); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>