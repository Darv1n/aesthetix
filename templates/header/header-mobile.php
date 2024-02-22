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
					<?php if ( is_active_sidebar( 'header-mobile-left' ) ) { ?>
						<div <?php widgets_classes( '', 'header-mobile-left' ); ?>>
							<?php dynamic_sidebar( 'header-mobile-left' ); ?>
						</div>
					<?php } ?>
				</div>
				<div class="col-6">
					<div <?php widgets_classes( '', 'header-mobile-right' ); ?>>

						<?php if ( is_active_sidebar( 'header-mobile-right' ) ) { ?>
							<?php dynamic_sidebar( 'header-mobile-right' ); ?>
						<?php } ?>

						<div <?php widget_classes( '', 'header-mobile-right' ); ?>>
							<?php get_template_part( 'templates/widget/widget-menu-toggle', '', $args ); ?>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>