<?php
/**
 * Custom Post Type: Journal (ETC.)
 *
 * Used for studio news, editorial essays, behind-the-scenes, and updates.
 * Route mapped to /etc/ per Information Architecture specification.
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Journal {

    /**
     * Register the 'journal' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Journal (ETC.)', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Journal Entry', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Journal (ETC.)', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Journal Entry', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Journal Entry', 'sweethill-core'),
            'new_item'              => __('New Journal Entry', 'sweethill-core'),
            'edit_item'             => __('Edit Journal Entry', 'sweethill-core'),
            'view_item'             => __('View Journal Entry', 'sweethill-core'),
            'all_items'             => __('All Journal Entries', 'sweethill-core'),
            'search_items'          => __('Search Journal', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Journal Entries:', 'sweethill-core'),
            'not_found'             => __('No journal entries found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No journal entries found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Entry Hero Image', 'Overrides the "Featured Image" phrase.', 'sweethill-core'),
            'set_featured_image'    => _x('Set entry hero image', 'Overrides the "Set featured image" phrase.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove entry hero image', 'Overrides the "Remove featured image" phrase.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as entry hero image', 'Overrides the "Use as featured image" phrase.', 'sweethill-core'),
            'archives'              => _x('ETC. Archives', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into journal entry', 'Overrides the "Insert into post" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this journal entry', 'Overrides the "Uploaded to this post" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter journal list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Journal list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Journal entries list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'etc',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'etc',
            'hierarchical'       => false,
            'menu_position'      => 25,
            'menu_icon'          => 'dashicons-welcome-write-blog',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('journal', $args);
    }
}
