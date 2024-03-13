<?php

/**
 *
 * @link              https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * @since             0.0.1
 * @package           Html_Dynamic_Load
 *
 * @wordpress-plugin
 * Plugin Name:       HTML Dynamic Load
 * Plugin URI:        https://kekoworks.com.br
 * Description:       Dynamic content loading plugin based on page scroll. Performance plugin.
 * Version:           0.0.1
 * Author:            Mateus Nobre de Oliveira
 * Author URI:        https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * Text Domain:       html-dynamic-load
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 0.0.1
 */
define( 'HTML_DYNAMIC_LOAD_VERSION', '0.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-html-dynamic-load-activator.php
 */
function activate_html_dynamic_load() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-html-dynamic-load-activator.php';
	Html_Dynamic_Load_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-html-dynamic-load-deactivator.php
 */
function deactivate_html_dynamic_load() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-html-dynamic-load-deactivator.php';
	Html_Dynamic_Load_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_html_dynamic_load' );
register_deactivation_hook( __FILE__, 'deactivate_html_dynamic_load' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-html-dynamic-load.php';

/**
 * 
 * @since    0.0.1
 */
function run_html_dynamic_load() {

	$plugin = new Html_Dynamic_Load();
	$plugin->run();

}
run_html_dynamic_load();
