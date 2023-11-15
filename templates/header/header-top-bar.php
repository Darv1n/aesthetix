<?php
/**
 * Template header top bar.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="header-top-bar">
	<div <?php aesthetix_container_classes( 'container-outer' ); ?>>
		<div <?php aesthetix_container_classes( 'container-inner' ); ?>>
			<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
				<div class="col-12 col-xs-12 col-md-6">
					<div <?php widget_classes( '', 'header-top-left' ) ?>>
						<?php dynamic_sidebar( 'header-top-left' ); ?>
					</div>
				</div>
				<div class="col-12 col-xs-12 col-md-6">
					<div <?php widget_classes( '', 'header-top-right' ) ?>>
						<?php dynamic_sidebar( 'header-top-right' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>