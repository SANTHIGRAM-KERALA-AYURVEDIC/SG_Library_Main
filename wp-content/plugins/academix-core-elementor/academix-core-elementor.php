<?php
/*
Plugin Name: Academix Core Elementor
Plugin URI: https://themeforest.net/user/webtechtoday/
Description: After installing the Academix - Multipurpose Researcher and Professor WordPress Theme, you must need to install this "Academix Core Elementor" first to get all functions of Academix WP Theme.
Author: webtechtoday
Author URI: https://themeforest.net/user/webtechtoday/
Devs: Utpol Deb Nath
Devs URI: https://www.facebook.com/utpol.mitu
Version: 1.0.0
Text Domain: academix-core-elementor
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
define('ACADEMIX_CORE_ELEMENTOR_VERSION', '1.0.0');
define('ACADEMIX_CORE_ELEMENTOR_MAIN_FILE', __FILE__);
define('ACADEMIX_CORE_ELEMENTOR_BASENAME', plugin_basename(__FILE__));
define('ACADEMIX_CORE_ELEMENTOR_URL', plugin_dir_url(__FILE__));
define('ACADEMIX_CORE_ELEMENTOR_DIR_PATH', plugin_dir_path(__FILE__));
function ace_load_plugin(){
    require_once ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'plugin.php';
    require_once ACADEMIX_CORE_ELEMENTOR_DIR_PATH . 'includes/helper.php';
}
add_action('plugins_loaded', 'ace_load_plugin');


// modify page featured image title
add_action( 'admin_head', 'academix_page_replace_default_featured_image_meta_box_title', 100 );
function academix_page_replace_default_featured_image_meta_box_title() {
    remove_meta_box( 'postimagediv', 'page', 'side' );
    add_meta_box('postimagediv', esc_html__('Upload Banner Image', 'academix'), 'post_thumbnail_meta_box', 'page', 'side', 'default');
}







