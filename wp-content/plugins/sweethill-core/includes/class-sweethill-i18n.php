<?php
/**
 * Internationalization functionality for the plugin.
 *
 * @package SweetHill\Core
 */

defined('ABSPATH') || exit;

class SweetHill_i18n {

    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'sweethill-core',
            false,
            dirname(dirname(plugin_basename(SWEETHILL_CORE_FILE))) . '/languages/'
        );
    }
}
