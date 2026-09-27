<?php
/**
 * Master plugin orchestrator and loader.
 *
 * @package SweetHill\Core
 */

defined('ABSPATH') || exit;

class SweetHill_Core {

    /**
     * Singleton instance.
     *
     * @var SweetHill_Core|null
     */
    private static $instance = null;

    /**
     * Get singleton instance.
     *
     * @return SweetHill_Core
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     */
    private function __construct() {
        $this->load_dependencies();
    }

    /**
     * Load all required class files.
     */
    private function load_dependencies() {
        // Post Types
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-book.php';
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-series.php';
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-storymaker.php';
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-character.php';
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-resource.php';
        require_once SWEETHILL_CORE_DIR . 'includes/post-types/class-cpt-journal.php';

        // Taxonomies
        require_once SWEETHILL_CORE_DIR . 'includes/taxonomies/class-taxonomy-age-range.php';
        require_once SWEETHILL_CORE_DIR . 'includes/taxonomies/class-taxonomy-source-tradition.php';
        require_once SWEETHILL_CORE_DIR . 'includes/taxonomies/class-taxonomy-book-format.php';

        // Meta & Admin UI
        require_once SWEETHILL_CORE_DIR . 'includes/meta/class-book-meta.php';
        require_once SWEETHILL_CORE_DIR . 'includes/meta/class-meta-boxes.php';
    }

    /**
     * Initialize WordPress hooks.
     */
    public function init() {
        // Load internationalization.
        $i18n = new SweetHill_i18n();
        add_action('plugins_loaded', [$i18n, 'load_plugin_textdomain']);

        // Register custom taxonomies and post types on 'init'.
        add_action('init', [$this, 'register_taxonomies'], 5);
        add_action('init', [$this, 'register_post_types'], 10);
        add_action('init', [$this, 'register_meta'], 15);

        // Initialize admin meta boxes.
        if (is_admin()) {
            SweetHill_Meta_Boxes::init();
        }
    }

    /**
     * Register all custom post types.
     */
    public function register_post_types() {
        SweetHill_CPT_Book::register();
        SweetHill_CPT_Series::register();
        SweetHill_CPT_Storymaker::register();
        SweetHill_CPT_Character::register();
        SweetHill_CPT_Resource::register();
        SweetHill_CPT_Journal::register();
    }

    /**
     * Register all custom taxonomies.
     */
    public function register_taxonomies() {
        SweetHill_Taxonomy_Age_Range::register();
        SweetHill_Taxonomy_Source_Tradition::register();
        SweetHill_Taxonomy_Book_Format::register();
    }

    /**
     * Register post meta fields.
     */
    public function register_meta() {
        SweetHill_Book_Meta::register();
    }
}
