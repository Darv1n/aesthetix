<?php
/**
 * Main functions.
 * 
 * @since 1.0.0
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once ABSPATH . '/wp-admin/includes/taxonomy.php';

// Setup.
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/register-post-types.php';
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/template-filters.php';
require_once get_template_directory() . '/inc/template-actions.php';
require_once get_template_directory() . '/inc/template-wrappers.php';
require_once get_template_directory() . '/inc/handlers.php';
require_once get_template_directory() . '/inc/shortcodes.php';

// Customizer.
require_once get_template_directory() . '/inc/customizer/customizer.php';
require_once get_template_directory() . '/inc/customizer/customizer-sections.php';
require_once get_template_directory() . '/inc/customizer/customizer-controls.php';
require_once get_template_directory() . '/inc/customizer/customizer-defaults.php';
require_once get_template_directory() . '/inc/customizer/customizer-functions.php';
require_once get_template_directory() . '/inc/customizer/customizer-selects.php';
require_once get_template_directory() . '/inc/customizer/customizer-converters.php';

// Widgets.
require_once get_template_directory() . '/inc/widgets/widgets-init.php';
require_once get_template_directory() . '/inc/widgets/abstract-widget.php';
require_once get_template_directory() . '/inc/widgets/class-widget-search-popup-form.php';
require_once get_template_directory() . '/inc/widgets/class-widget-subscribe-form.php';
require_once get_template_directory() . '/inc/widgets/class-widget-subscribe-popup-form.php';
require_once get_template_directory() . '/inc/widgets/class-widget-adv-banner.php';

// TGM Plugin Activation.
require_once get_template_directory() . '/inc/addons/tgm/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/addons/tgm/tgm-setup.php';
require_once get_template_directory() . '/inc/compatibility/gutenberg.php';

// WooCommerce.
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/woocommerce/woocommerce-setup.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/woocommerce-functions.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/woocommerce-actions.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/woocommerce-filters.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/woocommerce-wrappers.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/customizer/customizer-functions.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/customizer/customizer-sections.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/customizer/customizer-controls.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/customizer/customizer-selects.php';
	require_once get_template_directory() . '/inc/compatibility/woocommerce/customizer/customizer-defaults.php';
}

// Yoast SEO.
if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/yoast.php';
}

// Breadcrumb NavXT.
if ( is_plugin_active( 'breadcrumb-navxt/breadcrumb-navxt.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/breadcrumb-navxt.php';
}

// Load Kama Postviews compatibility file.
if ( is_plugin_active( 'kama-postviews/kama-postviews.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/kama-postviews.php';
}

// Load Rate my Post compatibility file.
if ( is_plugin_active( 'rate-my-post/rate-my-post.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/rate-my-post.php';
}

// Load Mailchimp compatibility file.
if ( is_plugin_active( 'mailchimp-for-wp/mailchimp-for-wp.php' ) ) {
	require_once get_template_directory() . '/inc/compatibility/mailchimp.php';
}

// Libs.
require_once get_template_directory() . '/inc/libs/minifier.php';
require_once get_template_directory() . '/inc/libs/kama-breadcrumb.php';

// Lib for DOM parsing https://simplehtmldom.sourceforge.io/
if ( ! class_exists( 'simple_html_dom_node' ) ) {
	require_once get_template_directory() . '/inc/libs/simplehtmldom.php';
}

// Lib for Excel import https://github.com/shuchkin/simplexlsx/
if ( ! class_exists( 'SimpleXLSX' ) ) {
	require_once get_template_directory() . '/inc/libs/SimpleXLSX.php';
}

// Lib for Excel export https://github.com/shuchkin/simplexlsxgen/
if ( ! class_exists( 'SimpleXLSXGen' ) ) {
	require_once get_template_directory() . '/inc/libs/SimpleXLSXGen.php';
}
