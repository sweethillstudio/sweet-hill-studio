<?php
/**
 * Sweet Hill Studio Theme functions and definitions.
 *
 * @package SweetHill\Theme
 */

defined('ABSPATH') || exit;

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
 * Enqueue theme stylesheets and fonts.
 */
function sweethill_theme_scripts() {
    // Enqueue main stylesheet.
    wp_enqueue_style(
        'sweethill-theme-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // Enqueue web fonts from Google Fonts CDN as fallback when local font files are pending.
    wp_enqueue_style(
        'sweethill-theme-fonts',
        'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,400..700;1,6..72,400..700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap',
        [],
        null
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
