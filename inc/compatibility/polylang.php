<?php
/**
 * Polylang compatibility file.
 *
 * @link https://polylang.pro/
 * @link https://ru.wordpress.org/plugins/polylang/
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'polylang_widgets_init' ) ) {

	/**
	 * Register polylang widgets.
	 */
	function polylang_widgets_init() {
		if ( is_language_switcher_active() ) {
			register_widget( 'WPA_Widget_Language_Switcher' );
		}
	}
}
add_action( 'widgets_init', 'polylang_widgets_init' );
