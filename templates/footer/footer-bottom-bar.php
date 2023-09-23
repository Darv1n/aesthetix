<?php
/**
 * Template footer top bar
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.0.0
 */
 ?>

<div <?php aesthetix_archive_page_columns_wrapper_classes( 'align-items-center' ); ?>>
	<div class="col-12 col-md-6 footer-column"><?php dynamic_sidebar( 'sidebar-footer-bottom-left' ); ?></div>
	<div class="col-12 col-md-6 footer-column"><?php dynamic_sidebar( 'sidebar-footer-bottom-right' ); ?></div>
</div>
