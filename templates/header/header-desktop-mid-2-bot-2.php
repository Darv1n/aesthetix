<?php
/**
 * Template header desktop 2 + 2 (four) columns.
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

						<?php if ( is_active_sidebar( 'header-main-left' ) ) { ?>
							<?php dynamic_sidebar( 'header-main-left' ); ?>
						<?php } else { ?>
							<?php default_sidebar( 'header-main-left' ); ?>
						<?php } ?>

					</div>
				</div>
				<div class="col-12 col-md-9">
					<div <?php widgets_classes( '', 'header-main-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-main-right' ) ) { ?>
							<?php dynamic_sidebar( 'header-main-right' ); ?>
						<?php } else { ?>
							<?php default_sidebar( 'header-main-right' ); ?>
						<?php } ?>

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
				<div class="col-12 col-md-9">
					<div <?php widgets_classes( '', 'header-bottom-left' ); ?>>

						<div <?php widget_classes( '', 'header-bottom-left' ) ?>>
							<?php get_template_part( 'templates/main-menu' ); ?>
						</div>

					</div>
				</div>
				<div class="col-12 col-md-3">
					<div <?php widgets_classes( '', 'header-bottom-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-bottom-right' ) ) { ?>
							<?php dynamic_sidebar( 'header-bottom-right' ); ?>
						<?php } else { ?>
							<?php default_sidebar( 'header-bottom-right' ); ?>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>