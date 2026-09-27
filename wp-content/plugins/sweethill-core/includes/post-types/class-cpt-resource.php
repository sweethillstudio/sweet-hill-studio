<?php
/**
 * Custom Post Type: Resource
 *
 * Used for Educational Resources, Guides, Activities, and Downloads.
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Resource {

    /**
     * Register the 'resource' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Resources', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Resource', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Resources', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Resource', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Resource', 'sweethill-core'),
            'new_item'              => __('New Resource', 'sweethill-core'),
            'edit_item'             => __('Edit Resource', 'sweethill-core'),
            'view_item'             => __('View Resource', 'sweethill-core'),
            'all_items'             => __('All Resources', 'sweethill-core'),
            'search_items'          => __('Search Resources', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Resources:', 'sweethill-core'),
            'not_found'             => __('No resources found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No resources found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Resource Preview / Cover', 'Overrides the "Featured Image" phrase.', 'sweethill-core'),
            'set_featured_image'    => _x('Set resource preview', 'Overrides the "Set featured image" phrase.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove resource preview', 'Overrides the "Remove featured image" phrase.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as resource preview', 'Overrides the "Use as featured image" phrase.', 'sweethill-core'),
            'archives'              => _x('Resource Archives', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into resource', 'Overrides the "Insert into post" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this resource', 'Overrides the "Uploaded to this post" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter resources list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Resources list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Resources list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'resources',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'resources',
            'hierarchical'       => false,
            'menu_position'      => 24,
            'menu_icon'          => 'dashicons-media-document',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('resource', $args);
    }
}
