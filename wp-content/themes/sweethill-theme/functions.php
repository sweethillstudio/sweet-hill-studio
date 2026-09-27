<?php
/**
 * Sweet Hill Studio Theme functions and definitions.
 *
 * Immersive Scroll Engine & Oryzo.ai Aesthetic Integration.
 *
 * @package SweetHill\Theme
 */

defined('ABSPATH') || exit;

// Define theme directory and URL constants.
define('SWEETHILL_THEME_DIR', get_template_directory());
define('SWEETHILL_THEME_URI', get_template_directory_uri());

// Load programmatic seed data routine.
require_once SWEETHILL_THEME_DIR . '/includes/seed-data.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sweethill_theme_setup() {
    // Add default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Add support for Full Site Editing block styles and editor styles.
    add_theme_support('wp-block-styles');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor.css');

    // Add post-thumbnail support.
    add_theme_support('post-thumbnails');

    // Add responsive embeds support.
    add_theme_support('responsive-embeds');

    // Add WooCommerce theme support.
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register custom navigation locations matching 03-INFORMATION-ARCHITECTURE.md.
    register_nav_menus([
        'primary-navigation' => __('Primary Header Navigation', 'sweethill-theme'),
        'utility-navigation' => __('Utility Header Navigation', 'sweethill-theme'),
        'footer-explore'     => __('Footer: Explore', 'sweethill-theme'),
        'footer-learn'       => __('Footer: Learn', 'sweethill-theme'),
        'footer-studio'      => __('Footer: The Studio', 'sweethill-theme'),
        'footer-support'     => __('Footer: Support & Legal', 'sweethill-theme'),
    ]);
}
add_action('after_setup_theme', 'sweethill_theme_setup');

/**
 * Enqueue theme stylesheets, fonts, Lenis smooth scrolling, GSAP & ScrollTrigger.
 */
function sweethill_theme_scripts() {
    $theme_version = wp_get_theme()->get('Version');

    // Enqueue main stylesheet.
    wp_enqueue_style(
        'sweethill-theme-style',
        get_stylesheet_uri(),
        [],
        $theme_version
    );

    // Enqueue 3D Parallax Hero & Oryzo styling.
    wp_enqueue_style(
        'sweethill-hero-3d-style',
        SWEETHILL_THEME_URI . '/assets/css/hero-3d.css',
        ['sweethill-theme-style'],
        $theme_version
    );

    // Enqueue web fonts from Google Fonts CDN as fallback when local font files are pending.
    wp_enqueue_style(
        'sweethill-theme-fonts',
        'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap',
        [],
        null
    );

    // -------------------------------------------------------------
    // Enqueue Lenis, GSAP & ScrollTrigger for Immersive 3D Scrolling
    // -------------------------------------------------------------
    // 1. Lenis Smooth Scroll Engine
    wp_enqueue_script(
        'lenis',
        'https://unpkg.com/lenis@1.1.18/dist/lenis.min.js',
        [],
        '1.1.18',
        true
    );

    // 2. GreenSock GSAP Core
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        [],
        '3.12.5',
        true
    );

    // 3. GSAP ScrollTrigger
    wp_enqueue_script(
        'scroll-trigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        ['gsap'],
        '3.12.5',
        true
    );

    // 4. Custom Animation Engine
    wp_enqueue_script(
        'sweethill-animations',
        SWEETHILL_THEME_URI . '/assets/js/animations.js',
        ['lenis', 'gsap', 'scroll-trigger'],
        $theme_version,
        true
    );
}
add_action('wp_enqueue_scripts', 'sweethill_theme_scripts');

/**
 * Register custom Sweet Hill block pattern categories.
 */
function sweethill_register_block_pattern_categories() {
    register_block_pattern_category('sweethill-editorial', [
        'label' => __('Sweet Hill: Editorial & Narrative', 'sweethill-theme'),
    ]);
    register_block_pattern_category('sweethill-commerce', [
        'label' => __('Sweet Hill: Commerce & Edition Selection', 'sweethill-theme'),
    ]);
}
add_action('init', 'sweethill_register_block_pattern_categories');
