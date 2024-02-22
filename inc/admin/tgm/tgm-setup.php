<?php
/**
 * Register recommended plugins.
 *
 * @package Aesthetix
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aesthetix_register_recommended_plugins' ) ) {

	/**
	 * Register recommended plugins with TGM Plugin Activation (require class-tgm-plugin-activation.php in functions.php)
	 */
	function aesthetix_register_recommended_plugins() {
		$plugins = array(
			array(
				'name'     => 'Query Monitor',
				'slug'     => 'query-monitor',
				'required' => false,
			),
			array(
				'name'     => 'WP Super Cache',
				'slug'     => 'wp-super-cache',
				'required' => false,
			),
		);

		$config = array(
			'id'           => 'aesthetix',                 // ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'plugins.php',           // Parent menu slug.
			'capability'   => 'manage_options',        // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}
}
add_action( 'tgmpa_register', 'aesthetix_register_recommended_plugins' );
