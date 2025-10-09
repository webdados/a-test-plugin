<?php
/**
 * Plugin Name:          A Test Plugin
 * Description:          A test plugin for GitHub actions testing
 * Version:              0.0.7
 * Author:               Naked Cat Plugins (by Webdados)
 * Author URI:           https://nakedcatplugins.com
 * Text Domain:          a-test-plugin
 * Domain Path:          /languages
 * Requires at least:    5.6
 * Tested up to:         6.9
 * Requires PHP:         8.0
 * WC requires at least: 5.8
 * WC tested up to:      10.2
 * Update URI:           false
 */

namespace NakedCatPlugins\ATestPlugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants.
define( 'A_TEST_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


// Add plugin activation and deactivation hooks.
register_activation_hook( __FILE__, '\NakedCatPlugins\ATestPlugin\plugin_activation' );
register_deactivation_hook( __FILE__, '\NakedCatPlugins\ATestPlugin\plugin_deactivation' );

// Add plugin initialization hook.
add_action( 'init', '\NakedCatPlugins\ATestPlugin\init', 9 );

/**
 * Plugin initialization function.
 */
function init() {
	load_plugin_textdomain( 'a-test-plugin', false, A_TEST_PLUGIN_DIR . 'languages' );
	if ( ! function_exists( 'get_plugin_data' ) ) {
		include ABSPATH . '/wp-admin/includes/plugin.php';
	}
	$plugin_data = get_plugin_data( __FILE__ );
	// And so on...
}

/**
 * Plugin activation function.
 */
function plugin_activation() {
}

/**
 * Plugin deactivation function.
 */
function plugin_deactivation() {
}

/**
 * Declare WooCommerce HPOS compatibility
 */
add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
		}
	}
);
