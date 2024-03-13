<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * @since      1.0.0
 *
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Html_Dynamic_Load
 * @subpackage Html_Dynamic_Load/admin
 * @author     Mateus Nobre de Oliveira <mateusnobreoliveira@gmail.com>
 */
class Html_Dynamic_Load_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        $this->define_admin_hooks();
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     */
    private function define_admin_hooks() {

        add_action('admin_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));

        // Adiciona a página de opções ao menu administrativo
        add_action('admin_menu', array($this, 'add_admin_menu'));

        // Inicializa as configurações da página de opções
        add_action('admin_init', array($this, 'settings_init'));
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/html-dynamic-load-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/html-dynamic-load-admin.js', array('jquery'), $this->version, false);
    }

    public function add_admin_menu() {
        add_menu_page(
            'HTML Dynamic Load Settings',
            'HTML Dynamic Load',
            'manage_options',
            'html-dynamic-load',
            array($this, 'settings_page')
        );
    }

    public function settings_init() {
        register_setting('htmlDynamicLoad', 'html_dynamic_load_settings');

        add_settings_section(
            'html_dynamic_load_html_dynamic_load_section',
            __('Plugin de carregamento dinamico de conteúdo com base no scroll da página. Plugin de performance.', 'html-dynamic-load'),
            array($this, 'settings_section_callback'),
            'htmlDynamicLoad'
        );

        add_settings_field(
            'html_dynamic_load_text_field_0',
            __('Título da Publicação', 'html-dynamic-load'),
            array($this, 'text_field_0_render'),
            'htmlDynamicLoad',
            'html_dynamic_load_html_dynamic_load_section'
        );
    }

    public function text_field_0_render() {
        $options = get_option('html_dynamic_load_settings');
        ?>
        <input type='text' name='html_dynamic_load_settings[html_dynamic_load_text_field_0]' value='<?php echo esc_attr($options); ?>'>
        <?php
    }

    public function settings_section_callback() {
        echo __('Configure como o plugin deve se comportar.', 'html-dynamic-load');
    }

    public function settings_page() {
        ?>
        <form action='options.php' method='post'>
            <h2>HTML Dynamic Load</h2>
            <?php
            settings_fields('htmlDynamicLoad');
            do_settings_sections('htmlDynamicLoad');
            submit_button();
            ?>
        </form>
        <?php
    }

}
