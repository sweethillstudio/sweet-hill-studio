<?php
/**
 * Custom Taxonomy: Book Format
 *
 * Attached to 'book'.
 *
 * @package SweetHill\Core\Taxonomies
 */

defined('ABSPATH') || exit;

class SweetHill_Taxonomy_Book_Format {

    /**
     * Register the 'book_format' custom taxonomy.
     */
    public static function register() {
        $labels = [
            'name'                       => _x('Book Formats', 'Taxonomy general name', 'sweethill-core'),
            'singular_name'              => _x('Book Format', 'Taxonomy singular name', 'sweethill-core'),
            'search_items'               => __('Search Book Formats', 'sweethill-core'),
            'popular_items'              => __('Popular Book Formats', 'sweethill-core'),
            'all_items'                  => __('All Book Formats', 'sweethill-core'),
            'parent_item'                => __('Parent Book Format', 'sweethill-core'),
            'parent_item_colon'          => __('Parent Book Format:', 'sweethill-core'),
            'edit_item'                  => __('Edit Book Format', 'sweethill-core'),
            'view_item'                  => __('View Book Format', 'sweethill-core'),
            'update_item'                => __('Update Book Format', 'sweethill-core'),
            'add_new_item'               => __('Add New Book Format', 'sweethill-core'),
            'new_item_name'              => __('New Book Format Name', 'sweethill-core'),
            'separate_items_with_commas' => __('Separate book formats with commas', 'sweethill-core'),
            'add_or_remove_items'        => __('Add or remove book formats', 'sweethill-core'),
            'choose_from_most_used'      => __('Choose from the most used book formats', 'sweethill-core'),
            'not_found'                  => __('No book formats found.', 'sweethill-core'),
            'no_terms'                   => __('No book formats', 'sweethill-core'),
            'menu_name'                  => __('Book Formats', 'sweethill-core'),
            'items_list_navigation'      => __('Book formats list navigation', 'sweethill-core'),
            'items_list'                 => __('Book formats list', 'sweethill-core'),
            'back_to_items'              => __('&larr; Go to Book Formats', 'sweethill-core'),
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => false,
            'show_in_rest'      => true,
            'rewrite'           => [
                'slug'         => 'book-format',
                'with_front'   => false,
                'hierarchical' => true,
            ],
        ];

        register_taxonomy('book_format', ['book'], $args);
    }
}
