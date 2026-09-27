<?php
/**
 * Register post metadata schemas for 'book' CPT.
 *
 * @package SweetHill\Core\Meta
 */

defined('ABSPATH') || exit;

class SweetHill_Book_Meta {

    /**
     * Register post meta fields for the 'book' post type.
     */
    public static function register() {
        // Bridge between editorial Book and transactional WooCommerce Products.
        register_post_meta('book', 'linked_woo_product_ids', [
            'show_in_rest'      => [
                'schema' => [
                    'type'        => 'array',
                    'description' => __('Array of linked WooCommerce Product IDs', 'sweethill-core'),
                    'items'       => [
                        'type' => 'integer',
                    ],
                ],
            ],
            'single'            => true,
            'type'              => 'array',
            'description'       => __('Linked WooCommerce Product IDs for commercial editions/SKUs', 'sweethill-core'),
            'sanitize_callback' => 'sweethill_sanitize_int_array',
            'auth_callback'     => [__CLASS__, 'auth_callback'],
        ]);

        // Editorial Storymaker (Author/Illustrator) relationship.
        register_post_meta('book', 'storymaker_id', [
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'integer',
            'description'       => __('Linked primary Storymaker (Author/Illustrator) post ID', 'sweethill-core'),
            'sanitize_callback' => 'absint',
            'auth_callback'     => [__CLASS__, 'auth_callback'],
        ]);

        // Editorial Series relationship.
        register_post_meta('book', 'series_id', [
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'integer',
            'description'       => __('Linked publishing Series post ID', 'sweethill-core'),
            'sanitize_callback' => 'absint',
            'auth_callback'     => [__CLASS__, 'auth_callback'],
        ]);
    }

    /**
     * Authorization callback checking whether the current user has permission to edit posts.
     *
     * @return bool
     */
    public static function auth_callback() {
        return current_user_can('edit_posts');
    }
}
