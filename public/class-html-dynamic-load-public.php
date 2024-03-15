<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * @since      0.0.1
 *
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/public
 * @author     Mateus Nobre de Oliveira <mateusnobreoliveira@gmail.com>
 */
class Html_Dynamic_Load_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Html_Dynamic_Load_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Html_Dynamic_Load_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/html-dynamic-load-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Html_Dynamic_Load_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Html_Dynamic_Load_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		 wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/html-dynamic-load-public.js', array( 'jquery' ), $this->version, true );

		 $options = get_option('html_dynamic_load_settings');
	 
		 wp_localize_script( $this->plugin_name, 'dadosHtmlDynamicLoad', $options );
	}
}
