<?php
/**
 * Plugin Name:       Sweet Hill Core
 * Plugin URI:        https://www.sweethillstudio.com/
 * Description:       Core publishing data architecture, custom post types, taxonomies, and commerce metadata bindings for Sweet Hill Studio.
 * Version:           1.0.0
 * Author:            Sweet Hill Studio
 * Author URI:        https://www.sweethillstudio.com/
 * Text Domain:       sweethill-core
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * License:           Proprietary
 * License URI:       https://www.sweethillstudio.com/
 *
 * @package SweetHill\Core
 */

defined('ABSPATH') || exit;

// Define plugin version and directory constants.
define('SWEETHILL_CORE_VERSION', '1.0.0');
define('SWEETHILL_CORE_FILE', __FILE__);
define('SWEETHILL_CORE_DIR', plugin_dir_path(__FILE__));
define('SWEETHILL_CORE_URL', plugin_dir_url(__FILE__));

// Require the master orchestrator class and helpers.
require_once SWEETHILL_CORE_DIR . 'includes/helpers/helpers.php';
require_once SWEETHILL_CORE_DIR . 'includes/class-sweethill-i18n.php';
require_once SWEETHILL_CORE_DIR . 'includes/class-sweethill-core.php';

/**
 * Plugin activation hook.
 * Registers post types and taxonomies immediately so rewrite rules can be cleanly flushed.
 */
function sweethill_core_activate() {
    $core = SweetHill_Core::get_instance();
    $core->register_post_types();
    $core->register_taxonomies();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'sweethill_core_activate');

/**
 * Plugin deactivation hook.
 * Flushes rewrite rules upon deactivation to remove CPT routes cleanly.
 */
function sweethill_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'sweethill_core_deactivate');

/**
 * Bootstrap the plugin orchestrator.
 */
function sweethill_core_init() {
    SweetHill_Core::get_instance()->init();
}
add_action('plugins_loaded', 'sweethill_core_init');
