<?php
/**
 * Template part for displaying breadcrumbs.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aesthetix
 * @since 1.1.1
 */

if ( ! is_front_page() && ! is_home() && get_aesthetix_options( 'general_breadcrumbs_display' ) ) {

	$before = '<section id="section-breadcrumbs" class="' . esc_attr( implode( ' ', get_aesthetix_section_classes( 'section_breadcrumbs' ) ) ) . '">';
		$before .= '<div class="' . esc_attr( implode( ' ', get_aesthetix_container_classes() ) ) . '">';
			$before .= '<div class="row">';
				$before .= '<div class="col-12 align-items-center">';

				$after = '</div>';
			$after .= '</div>';
		$after .= '</div>';
	$after .= '</section>';

	if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {

		$before .= '<nav id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '" typeof="BreadcrumbList" vocab="https://schema.org/" aria-label="breadcrumb">';
			$before .= '<ol class="list-inline list-unstyled">';
			$after  .= '</ol>';
		$after  .= '</nav>';
	} else {
		$before .= '<div id="breadcrumbs" class="breadcrumbs breadcrumbs_' . esc_attr( get_aesthetix_options( 'general_breadcrumbs_type' ) ) . '">';
		$after  .= '</div>';
	}

	if ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'navxt' && is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {
		echo $before;
			bcn_display_list();
		echo $after;
	} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'kama' && class_exists( 'Kama_Breadcrumbs' ) ) {
		echo $before;
			kama_breadcrumbs();
		echo $after;
	} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'yoast' && is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
		echo $before;
			yoast_breadcrumb( '<nav class="breadcrumbs__navigation">', '</nav>' );
		echo $after;
	} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'rankmath' && is_plugin_active( 'seo-by-rank-math/rank-math.php' ) ) {
		echo $before;
			rank_math_the_breadcrumbs();
		echo $after;
	} elseif ( get_aesthetix_options( 'general_breadcrumbs_type' ) === 'seopress' && is_plugin_active( 'wp-seopress/seopress.php' ) ) {
		echo $before;
			seopress_display_breadcrumbs();
		echo $after;
	} elseif ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		echo $before;
			woocommerce_breadcrumb();
		echo $after;
	}
}
