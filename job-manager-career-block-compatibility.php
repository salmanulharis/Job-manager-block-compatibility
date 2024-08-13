<?php
/**
 * Plugin Name: Job Manager & Career - Block Compatibility
 * Description: Integrates custom content into the block theme for a single job post type.
 * Version: 1.0
 * Author: Themehigh
 * Author URI:  https://www.themehigh.com
 * Plugin URI:  https://www.themehigh.com/job-manager
 * Text Domain: job-manager-career-block-compatibility
 * Domain Path: /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define('THJMBC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('THJMBC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('THJM_PLUGIN_URL', WP_PLUGIN_DIR . '/job-manager-career');

// Include necessary files
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-title.php';
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-feature.php';
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-apply.php';
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-form.php';
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-main-wrapper.php';
require_once THJMBC_PLUGIN_DIR . 'includes/class-thjmbc-job-notice.php';

// Initialize the plugin
add_action('after_setup_theme', 'thjmbc_init', 99);
function thjmbc_init(){
    if (wp_is_block_theme()) {
        // Remove existing action for single template
        remove_action('single_template', 'thjmf_single_job_template', 10);

        // Enqueue plugin styles
        add_action('wp_enqueue_scripts', 'thjmbc_enqueue_styles');
        function thjmbc_enqueue_styles() {
            $style_url = THJMBC_PLUGIN_URL . 'assets/css/thjmbc-styles.css';
            $script_url = THJMBC_PLUGIN_URL . 'assets/js/thjmbc-scripts.js';
            wp_register_script('my-custom-script', $script_url, array('jquery'), '1.0.0', true);
            wp_enqueue_script('my-custom-script');
            wp_enqueue_style('thjmbc-main-style', $style_url, [], '1.0.0', 'all');
        }

        // Initialize components
        new THJMBCC_Job_Title();
        new THJMBCC_Job_Feature();
        new THJMBCC_Job_Apply();
        new THJMBCC_Job_Form();
        new THJMBCC_Job_Main_Wrapper();
        new THJMBCC_Job_Notice();
    }
};
