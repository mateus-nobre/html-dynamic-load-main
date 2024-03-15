<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.linkedin.com/in/mateus-nobre-de-oliveira-23a29b12b/
 * @since      0.0.1
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
     * @since    0.0.1
     */
    public function enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/html-dynamic-load-admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    0.0.1
     */
    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/html-dynamic-load-admin.js', array('jquery'), $this->version, false);
    }

    public function add_admin_menu() {
        // Obtém a URL base do diretório do seu plugin e concatena o caminho para o ícone SVG
        $icon_url = plugin_dir_url(__FILE__) . 'assets/icons/html-dynamic-load.svg';
    
        add_menu_page(
            'HTML Dynamic Load Settings',
            'HTML D. Load',
            'manage_options',
            'html-dynamic-load',
            array($this, 'settings_page'),
            $icon_url
        );
    }
    
    

    public function settings_init() {
        register_setting('htmlDynamicLoad', 'html_dynamic_load_settings');

        add_settings_section(
            'html_dynamic_load_html_dynamic_load_section',
            __('Plugin de carregamento dinamico de conteúdo com base no scroll da página.', 'html-dynamic-load'),
            array($this, 'settings_section_callback'),
            'htmlDynamicLoad'
        );

        add_settings_field(
            'class_name_lazy',
            __('Título da Publicação', 'html-dynamic-load'),
            array($this, 'class_name_lazy'),
            'htmlDynamicLoad',
            'html_dynamic_load_html_dynamic_load_section'
        );

        add_settings_field(
            'mobile_sections_started',
            __('Seções exibidas inicialmente - Mobile', 'html-dynamic-load'),
            array($this, 'mobile_sections_started'),
            'htmlDynamicLoad',
            'html_dynamic_load_html_dynamic_load_section'
        );

        add_settings_field(
            'tablet_sections_started',
            __('Seções exibidas inicialmente - Tablet', 'html-dynamic-load'),
            array($this, 'tablet_sections_started'),
            'htmlDynamicLoad',
            'html_dynamic_load_html_dynamic_load_section'
        );

        add_settings_field(
            'desktop_sections_started',
            __('Seções exibidas inicialmente - Desktop', 'html-dynamic-load'),
            array($this, 'desktop_sections_started'),
            'htmlDynamicLoad',
            'html_dynamic_load_html_dynamic_load_section'
        );
    }

    public function class_name_lazy() {
        $options = get_option('html_dynamic_load_settings');
        // Acessa especificamente o valor de 'class_name_lazy' dentro do array de opções
        $value = '';
        if (isset($options['class_name_lazy'])) {
            $value = esc_attr($options['class_name_lazy']);
        }
        ?>
        <div>Defina a classe que o HTML Dynamic Load usará para mapear o conteúdo. Clique (aqui) para visualizar exemplo. <br/>
        <span class="lazy-admin-observ">Caso nenhuma seja definida, o item default é: ".lazy-html".</span>
        </div>
        <input type='text' name='html_dynamic_load_settings[class_name_lazy]' value='<?php echo $value; ?>'>
        <hr/>
        <?php
    }

    public function mobile_sections_started() {
        $options = get_option('html_dynamic_load_settings');
        // Acessa especificamente o valor de 'mobile_sections_started' dentro do array de opções
        $value = '';
        if (isset($options['mobile_sections_started'])) {
            $value = esc_attr($options['mobile_sections_started']);
        }
        ?>
        <div>Para que o plugin funcione corretamente, cite aqui quantas sections devem já ser apresentadas no primeiro load (demais seções devem ter lazy load aplicado.)<br/>
            <span class="lazy-admin-observ"> Regra mobile.</span>
        </div>
        <input type='text' name='html_dynamic_load_settings[mobile_sections_started]' value='<?php echo $value; ?>'>
        <hr/>
        <?php
    }

    public function tablet_sections_started() {
        $options = get_option('html_dynamic_load_settings');
        // Acessa especificamente o valor de 'tablet_sections_started' dentro do array de opções
        $value = '';
        if (isset($options['tablet_sections_started'])) {
            $value = esc_attr($options['tablet_sections_started']);
        }
        ?>
        <div>Para que o plugin funcione corretamente, cite aqui quantas sections devem já ser apresentadas no primeiro load (demais seções devem ter lazy load aplicado.)<br/>
            <span class="lazy-admin-observ"> Regra Tablet.</span>
        </div>
        <input type='text' name='html_dynamic_load_settings[tablet_sections_started]' value='<?php echo $value; ?>'>
        <hr/>
        <?php
    }

    public function desktop_sections_started() {
        $options = get_option('html_dynamic_load_settings');
        // Acessa especificamente o valor de 'desktop_sections_started' dentro do array de opções
        $value = '';
        if (isset($options['desktop_sections_started'])) {
            $value = esc_attr($options['desktop_sections_started']);
        }
        ?>
        <div>Para que o plugin funcione corretamente, cite aqui quantas sections devem ser apresentadas no primeiro load (demais seções devem ter lazy load aplicado.)<br/>
            <span class="lazy-admin-observ"> Regra Desktop.</span>
        </div>
        <input type='text' name='html_dynamic_load_settings[desktop_sections_started]' value='<?php echo $value; ?>'>
        <hr/>
        <?php
    }
    

    public function settings_section_callback() {
        echo __('Configure como o plugin deve se comportar.', 'html-dynamic-load');
    }

    public function settings_page() {
        ?>
        <form class="lazy-html-admin-form" action='options.php' method='post'>
            <h2 class="lazy-html-admin-title">HTML Dynamic Load</h2>
            <hr/>
            <?php
            settings_fields('htmlDynamicLoad');
            do_settings_sections('htmlDynamicLoad');
            submit_button();
            ?>
        </form>
        <?php
    }
}
