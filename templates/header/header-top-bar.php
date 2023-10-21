<?php
/**
 * Template header top bar.
 *
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 */
 ?>

<div class="header-top-bar">
	<div <?php aesthetix_container_classes( 'container-header' ); ?>>
		<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
			<div class="col-12 col-xs-12 col-md-6"><?php dynamic_sidebar( 'header-top-left' ); ?></div>
			<div class="col-12 col-xs-12 col-md-6"><?php dynamic_sidebar( 'header-top-right' ); ?></div>
		</div>
	</div>
</div>