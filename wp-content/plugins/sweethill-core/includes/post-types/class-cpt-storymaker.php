<?php
/**
 * Custom Post Type: Storymaker
 *
 * Used for Authors, Illustrators, and Creators.
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Storymaker {

    /**
     * Register the 'storymaker' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Storymakers', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Storymaker', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Storymakers', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Storymaker', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Storymaker', 'sweethill-core'),
            'new_item'              => __('New Storymaker', 'sweethill-core'),
            'edit_item'             => __('Edit Storymaker', 'sweethill-core'),
            'view_item'             => __('View Storymaker', 'sweethill-core'),
            'all_items'             => __('All Storymakers', 'sweethill-core'),
            'search_items'          => __('Search Storymakers', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Storymakers:', 'sweethill-core'),
            'not_found'             => __('No storymakers found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No storymakers found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Storymaker Portrait', 'Overrides the "Featured Image" phrase.', 'sweethill-core'),
            'set_featured_image'    => _x('Set portrait', 'Overrides the "Set featured image" phrase.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove portrait', 'Overrides the "Remove featured image" phrase.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as portrait', 'Overrides the "Use as featured image" phrase.', 'sweethill-core'),
            'archives'              => _x('Storymaker Profiles', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into storymaker profile', 'Overrides the "Insert into post" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this storymaker profile', 'Overrides the "Uploaded to this post" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter storymakers list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Storymakers list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Storymakers list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'storymakers',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'storymakers',
            'hierarchical'       => false,
            'menu_position'      => 22,
            'menu_icon'          => 'dashicons-admin-users',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('storymaker', $args);
    }
}
