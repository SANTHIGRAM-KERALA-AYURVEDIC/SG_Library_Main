<?php
namespace AcademixCoreElementor;

use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
    exit; } // Exit if accessed directly

/**
 * Main class plugin
 */
class AcademixCorePlugin {

    const MINIMUM_ELEMENTOR_VERSION = '2.5.0';
    const MINIMUM_PHP_VERSION = '5.4';
    /**
     * @var Plugin
     */
    private static $_instance;

    /**
     * @var Manager
     */
    private $_extensions_manager;

    /**
     * @var Manager
     */
    public $modules_manager;

    /**
     * @var array
     */
    private $_localize_settings = [];

    /**
     * @return string
     */
    public function get_version() {
        return ACADEMIX_CORE_ELEMENTOR_VERSION;
    }

    /**
     * Throw error on object clone
     *
     * The whole idea of the singleton design pattern is that there is a single
     * object therefore, we don't want the object to be cloned.
     *
     * @since 1.0.0
     * @return void
     */
    public function __clone() {
        // Cloning instances of the class is forbidden
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'academix-core-elementor' ), '1.0.0' );
    }

    /**
     * Disable unserializing of the class
     *
     * @since 1.0.0
     * @return void
     */
    public function __wakeup() {
        // Unserializing instances of the class is forbidden
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'academix-core-elementor' ), '1.0.0' );
    }

    /**
     * @return Plugin
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function _includes() {
        require ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'includes/modules-manager.php';
        // Theme Settings
        require_once( ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'libs/AcademixCorePermalink.php');

        // Theme custom posts
        require_once( ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-posts/team.php');
        require_once( ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-posts/event.php');
        require_once( ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-posts/book.php');
        require_once( ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-posts/journal-article.php');

       //Load Custom widgets
        require ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-widgets/academix-latest-events-widget.php';
        require ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-widgets/academix-social-widget.php';
        require ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'custom-widgets/academix-recent-post-widget.php';
    }

    public function autoload( $class ) {
        if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
            return;
        }

        $filename = strtolower(
            preg_replace(
                [ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
                [ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
                $class
            )
        );
        $filename = ACADEMIX_CORE_ELEMENTOR_DIR_PATH . $filename . '.php';

        if ( is_readable( $filename ) ) {
            include $filename;
        }
    }

    public function get_localize_settings() {
        return $this->_localize_settings;
    }

    public function add_localize_settings( $setting_key, $setting_value = null ) {
        if ( is_array( $setting_key ) ) {
            $this->_localize_settings = array_replace_recursive( $this->_localize_settings, $setting_key );

            return;
        }

        if ( ! is_array( $setting_value ) || ! isset( $this->_localize_settings[ $setting_key ] ) || ! is_array( $this->_localize_settings[ $setting_key ] ) ) {
            $this->_localize_settings[ $setting_key ] = $setting_value;

            return;
        }

        $this->_localize_settings[ $setting_key ] = array_replace_recursive( $this->_localize_settings[ $setting_key ], $setting_value );
    }

    /**
     * Enqueue frontend styles
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style( 'sequence-theme-basic', plugin_dir_url( __FILE__ ) . 'assets/css/sequence-theme.basic.min.css' );
    }

    /**
     * Enqueue frontend scripts
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function enqueue_frontend_scripts() {
        wp_register_script( 'hammer-min', plugin_dir_url( __FILE__ ) . 'assets/js/hammer.min.js', array('jquery'), ACADEMIX_CORE_ELEMENTOR_VERSION, true );
        wp_register_script( 'sequence-min', plugin_dir_url( __FILE__ ) . 'assets/js/sequence.min.js', array('jquery'), ACADEMIX_CORE_ELEMENTOR_VERSION, true );
        wp_register_script( 'academix-core-elementor', plugin_dir_url( __FILE__ ) . 'assets/js/academix-core-elementor.js', array('jquery'), ACADEMIX_CORE_ELEMENTOR_VERSION, true );
    }

    /**
     * Enqueue editor styles
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function enqueue_editor_styles() {}

    /**
     * Enqueue editor scripts
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function enqueue_editor_scripts() {}

    public function enqueue_panel_scripts() {}

    public function enqueue_editor_preview_styles() {}

    public function is_plugins_active( $plugin_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$plugin_file_path] );
    }

    public function admin_notice_missing_elementor_plugin() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $elementor = 'elementor/elementor.php';
        if( $this->is_plugins_active( $elementor ) ) {
            if( ! current_user_can( 'activate_plugins' ) ) { return; }

            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

            $message = '<p>' . __( 'Academix Core Elementor not working because you need to activate the Elementor plugin.', 'academix-core-elementor' ) . '</p>';
            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Elementor Activate Now', 'academix-core-elementor' ) ) . '</p>';
        } else {
            if ( ! current_user_can( 'install_plugins' ) ) { return; }

            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

            $message = '<p>' . __( 'Academix Core Elementor not working because you need to install the Elementor plugin', 'academix-core-elementor' ) . '</p>';

            $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Elementor Install Now', 'academix-core-elementor' ) ) . '</p>';
        }
        echo '<div class="error"><p>' . $message . '</p></div>';

    }

    public function admin_notice_minimum_elementor_version(){
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            __( '"%1$s" requires "%2$s" version %3$s or greater.', 'academix-core-elementor' ),
            '<strong>' . __( 'Academix Core Elementor', 'academix-core-elementor' ) . '</strong>',
            '<strong>' . __( 'Elementor', 'academix-core-elementor' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }

    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
        $message = sprintf(
            __( '"%1$s" requires "%2$s" version %3$s or greater.', 'academix-core-elementor' ),
            '<strong>' . __( 'Academix Core Elementor', 'academix-core-elementor' ) . '</strong>',
            '<strong>' . __( 'PHP', 'academix-core-elementor' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }


    public function elementor_init() {
        $this->modules_manager = new Modules_Manager();
    }

    /**
     * Register Elementor widget category
     *
     * @since 1.0.0
     * @access public
     *
     * @param ElementorElements_Manager $manager Elements manager.
     */
    public function register_category( $manager ) {
        // Add element category in panel
        $manager->add_category(
            'academix-widgets', // This is the name of your addon's category and will be used to group your widgets/elements in the Edit sidebar pane!
            array(
                'title' => __( 'Academix Widgets', 'academix-core-elementor' ), // The title of your modules category - keep it simple and short!
                'icon'  => 'font',
            ),
            1
        );
    }


    protected function add_actions() {
        add_action( 'elementor/init', [ $this, 'elementor_init' ] );

            // Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_elementor_plugin' ] );
            return;
        }

        // Check required Elementor version
        if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
            return;
        }

        // Check required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            return;
        }

        add_action( 'elementor/elements/categories_registered', array( $this, 'register_category' ) );

        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );

        add_action( 'elementor/preview/enqueue_styles', [ $this, 'enqueue_editor_preview_styles' ] );

        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );
    }

    /**
     * Plugin constructor.
     */
    private function __construct() {
        spl_autoload_register( [ $this, 'autoload' ] );

        $this->_includes();
        $this->add_actions();
    }

}

if ( ! defined( 'ACADEMIX_CORE_ELEMENTOR_TESTS' ) ) {
    // In tests we run the instance manually.
    AcademixCorePlugin::instance();
}
