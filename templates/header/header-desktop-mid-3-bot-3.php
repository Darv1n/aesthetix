<?php
/**
 * Template header desktop 3 + 3 (six) columns.
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
					<?php if ( is_active_sidebar( 'header-main-left' ) ) { ?>
						<div <?php widgets_classes( '', 'header-main-left' ); ?>>
							<?php dynamic_sidebar( 'header-main-left' ); ?>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 col-md-4">
					<?php if ( is_active_sidebar( 'header-main-center' ) ) { ?>
						<div <?php widgets_classes( '', 'header-main-center' ); ?>>
							<?php dynamic_sidebar( 'header-main-center' ); ?>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 col-md-4">
					<?php if ( is_active_sidebar( 'header-main-right' ) ) { ?>
						<div <?php widgets_classes( '', 'header-main-right' ); ?>>
							<?php dynamic_sidebar( 'header-main-right' ); ?>
						</div>
					<?php } ?>
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
					<?php if ( is_active_sidebar( 'header-bottom-left' ) ) { ?>
						<div <?php widgets_classes( '', 'header-bottom-left' ); ?>>
							<?php dynamic_sidebar( 'header-bottom-left' ); ?>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 col-md-8">
					<div <?php widgets_classes( '', 'header-bottom-center' ); ?>>
						<div <?php widget_classes( 'widget-primary-menu', 'header-bottom-center' ); ?>>
							<?php get_template_part( 'templates/widget/widget-menu', '', array( 'theme_location' => 'primary' ) ); ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-2">
					<?php if ( is_active_sidebar( 'header-bottom-right' ) ) { ?>
						<div <?php widgets_classes( '', 'header-bottom-right' ); ?>>
							<?php dynamic_sidebar( 'header-bottom-right' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
