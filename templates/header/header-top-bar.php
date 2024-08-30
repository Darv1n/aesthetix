<?php
/**
 * Template header top bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div <?php aesthetix_section_classes( 'header-section header-top-bar', get_aesthetix_options( 'root_bg_header_top_bar' ) ); ?>>
	<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
		<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center row-block row-md-inline' ); ?>>
				<div class="col-12 col-md-6">
					<?php if ( is_active_sidebar( 'header-top-left' ) ) { ?>
						<div <?php widgets_classes( '', 'header-top-left' ); ?>>
							<?php dynamic_sidebar( 'header-top-left' ); ?>
						</div>
					<?php } ?>
				</div>
				<div class="col-12 col-md-6">
					<?php if ( is_active_sidebar( 'header-top-right' ) ) { ?>
						<div <?php widgets_classes( '', 'header-top-right' ); ?>>
							<?php dynamic_sidebar( 'header-top-right' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>