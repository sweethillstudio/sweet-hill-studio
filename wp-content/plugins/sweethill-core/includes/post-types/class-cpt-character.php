<?php
/**
 * Custom Post Type: Character
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Character {

    /**
     * Register the 'character' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Characters', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Character', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Characters', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Character', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Character', 'sweethill-core'),
            'new_item'              => __('New Character', 'sweethill-core'),
            'edit_item'             => __('Edit Character', 'sweethill-core'),
            'view_item'             => __('View Character', 'sweethill-core'),
            'all_items'             => __('All Characters', 'sweethill-core'),
            'search_items'          => __('Search Characters', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Characters:', 'sweethill-core'),
            'not_found'             => __('No characters found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No characters found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Character Portrait / Artwork', 'Overrides the "Featured Image" phrase.', 'sweethill-core'),
            'set_featured_image'    => _x('Set character portrait', 'Overrides the "Set featured image" phrase.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove character portrait', 'Overrides the "Remove featured image" phrase.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as character portrait', 'Overrides the "Use as featured image" phrase.', 'sweethill-core'),
            'archives'              => _x('Character Archives', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into character', 'Overrides the "Insert into post" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this character', 'Overrides the "Uploaded to this post" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter characters list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Characters list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Characters list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'characters',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'characters',
            'hierarchical'       => false,
            'menu_position'      => 23,
            'menu_icon'          => 'dashicons-buddies',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('character', $args);
    }
}
