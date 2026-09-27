<?php
/**
 * Custom Post Type: Book
 *
 * @package SweetHill\Core\PostTypes
 */

defined('ABSPATH') || exit;

class SweetHill_CPT_Book {

    /**
     * Register the 'book' custom post type.
     */
    public static function register() {
        $labels = [
            'name'                  => _x('Books', 'Post type general name', 'sweethill-core'),
            'singular_name'         => _x('Book', 'Post type singular name', 'sweethill-core'),
            'menu_name'             => _x('Books', 'Admin Menu text', 'sweethill-core'),
            'name_admin_bar'        => _x('Book', 'Add New on Toolbar', 'sweethill-core'),
            'add_new'               => __('Add New', 'sweethill-core'),
            'add_new_item'          => __('Add New Book', 'sweethill-core'),
            'new_item'              => __('New Book', 'sweethill-core'),
            'edit_item'             => __('Edit Book', 'sweethill-core'),
            'view_item'             => __('View Book', 'sweethill-core'),
            'all_items'             => __('All Books', 'sweethill-core'),
            'search_items'          => __('Search Books', 'sweethill-core'),
            'parent_item_colon'     => __('Parent Books:', 'sweethill-core'),
            'not_found'             => __('No books found.', 'sweethill-core'),
            'not_found_in_trash'    => __('No books found in Trash.', 'sweethill-core'),
            'featured_image'        => _x('Book Cover Image', 'Overrides the "Featured Image" phrase for this post type.', 'sweethill-core'),
            'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase for this post type.', 'sweethill-core'),
            'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase for this post type.', 'sweethill-core'),
            'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase for this post type.', 'sweethill-core'),
            'archives'              => _x('Book Archives', 'The post type archive label used in nav menus.', 'sweethill-core'),
            'insert_into_item'      => _x('Insert into book', 'Overrides the "Insert into post"/"Insert into page" phrase.', 'sweethill-core'),
            'uploaded_to_this_item' => _x('Uploaded to this book', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase.', 'sweethill-core'),
            'filter_items_list'     => _x('Filter books list', 'Screen reader text for the filter links.', 'sweethill-core'),
            'items_list_navigation' => _x('Books list navigation', 'Screen reader text for the pagination.', 'sweethill-core'),
            'items_list'            => _x('Books list', 'Screen reader text for the items list.', 'sweethill-core'),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [
                'slug'       => 'books',
                'with_front' => false,
            ],
            'capability_type'    => 'post',
            'has_archive'        => 'books',
            'hierarchical'       => false,
            'menu_position'      => 20,
            'menu_icon'          => 'dashicons-book-alt',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'],
            'show_in_rest'       => true,
        ];

        register_post_type('book', $args);
    }
}
