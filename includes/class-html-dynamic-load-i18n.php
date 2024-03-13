<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * @since      0.0.1
 *
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      0.0.1
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/includes
 * @author     Mateus Nobre de Oliveira <mateusnobreoliveira@gmail.com>
 */
class Html_Dynamic_Load_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    0.0.1
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'html-dynamic-load',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
