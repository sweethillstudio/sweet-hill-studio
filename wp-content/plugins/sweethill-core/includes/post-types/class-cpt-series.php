<?php
/**
 * Custom Post Type: Series
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Series {

    /**
     * Register the 'series' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Series', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Series', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Series', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Series', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Series', 'sweethill-core'),
            'new_item'              => __('New Series', 'sweethill-core'),
            'edit_item'             => __('Edit Series', 'sweethill-core'),
            'view_item'             => __('View Series', 'sweethill-core'),
            'all_items'             => __('All Series', 'sweethill-core'),
            'search_items'          => __('Search Series', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Series:', 'sweethill-core'),
            'not_found'             => __('No series found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No series found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Series Banner / Artwork', 'Overrides the "Featured Image" phrase.', 'sweethill-core'),
            'set_featured_image'    => _x('Set series artwork', 'Overrides the "Set featured image" phrase.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove series artwork', 'Overrides the "Remove featured image" phrase.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as series artwork', 'Overrides the "Use as featured image" phrase.', 'sweethill-core'),
            'archives'              => _x('Series Archives', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into series', 'Overrides the "Insert into post" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this series', 'Overrides the "Uploaded to this post" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter series list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Series list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Series list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'series',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'series',
            'hierarchical'       => false,
            'menu_position'      => 21,
            'menu_icon'          => 'dashicons-category',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('series', $args);
    }
}
