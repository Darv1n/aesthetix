<?php
/**
 * WPML compatibility file.
 *
 * @link https://wpml.org/
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'wpml_widgets_init' ) ) {

	/**
	 * Register WPML widgets.
	 */
	function wpml_widgets_init() {
		if ( is_plugin_active( 'sitepress-multilingual-cms/sitepress.php' ) ) {
			register_widget( 'WPA_Widget_Language_Switcher' );
		}
	}
}
add_action( 'widgets_init', 'wpml_widgets_init' );
