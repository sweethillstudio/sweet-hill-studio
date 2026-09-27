<?php
/**
 * Custom Taxonomy: Age Range
 *
 * Attached to 'book' and 'resource'.
 *
 * @package SweetHill\Core\Taxonomies
 */

defined('ABSPATH') || exit;

class SweetHill_Taxonomy_Age_Range {

    /**
     * Register the 'age_range' custom taxonomy.
     */
    public static function register() {
        $labels = [
            'name'                       => _x('Age Ranges', 'Taxonomy general name', 'sweethill-core'),
            'singular_name'              => _x('Age Range', 'Taxonomy singular name', 'sweethill-core'),
            'search_items'               => __('Search Age Ranges', 'sweethill-core'),
            'popular_items'              => __('Popular Age Ranges', 'sweethill-core'),
            'all_items'                  => __('All Age Ranges', 'sweethill-core'),
            'parent_item'                => __('Parent Age Range', 'sweethill-core'),
            'parent_item_colon'          => __('Parent Age Range:', 'sweethill-core'),
            'edit_item'                  => __('Edit Age Range', 'sweethill-core'),
            'view_item'                  => __('View Age Range', 'sweethill-core'),
            'update_item'                => __('Update Age Range', 'sweethill-core'),
            'add_new_item'               => __('Add New Age Range', 'sweethill-core'),
            'new_item_name'              => __('New Age Range Name', 'sweethill-core'),
            'separate_items_with_commas' => __('Separate age ranges with commas', 'sweethill-core'),
            'add_or_remove_items'        => __('Add or remove age ranges', 'sweethill-core'),
            'choose_from_most_used'      => __('Choose from the most used age ranges', 'sweethill-core'),
            'not_found'                  => __('No age ranges found.', 'sweethill-core'),
            'no_terms'                   => __('No age ranges', 'sweethill-core'),
            'menu_name'                  => __('Age Ranges', 'sweethill-core'),
            'items_list_navigation'      => __('Age ranges list navigation', 'sweethill-core'),
            'items_list'                 => __('Age ranges list', 'sweethill-core'),
            'back_to_items'              => __('&larr; Go to Age Ranges', 'sweethill-core'),
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
                'slug'         => 'age-range',
                'with_front'   => false,
                'hierarchical' => true,
            ],
        ];

        register_taxonomy('age_range', ['book', 'resource'], $args);
    }
}
