<?php
/**
 * Custom Taxonomy: Source Tradition
 *
 * Attached to 'book' and 'character'.
 *
 * @package SweetHill\Core\Taxonomies
 */

defined('ABSPATH') || exit;

class SweetHill_Taxonomy_Source_Tradition {

    /**
     * Register the 'source_tradition' custom taxonomy.
     */
    public static function register() {
        $labels = [
            'name'                       => _x('Source Traditions', 'Taxonomy general name', 'sweethill-core'),
            'singular_name'              => _x('Source Tradition', 'Taxonomy singular name', 'sweethill-core'),
            'search_items'               => __('Search Source Traditions', 'sweethill-core'),
            'popular_items'              => __('Popular Source Traditions', 'sweethill-core'),
            'all_items'                  => __('All Source Traditions', 'sweethill-core'),
            'parent_item'                => __('Parent Source Tradition', 'sweethill-core'),
            'parent_item_colon'          => __('Parent Source Tradition:', 'sweethill-core'),
            'edit_item'                  => __('Edit Source Tradition', 'sweethill-core'),
            'view_item'                  => __('View Source Tradition', 'sweethill-core'),
            'update_item'                => __('Update Source Tradition', 'sweethill-core'),
            'add_new_item'               => __('Add New Source Tradition', 'sweethill-core'),
            'new_item_name'              => __('New Source Tradition Name', 'sweethill-core'),
            'separate_items_with_commas' => __('Separate source traditions with commas', 'sweethill-core'),
            'add_or_remove_items'        => __('Add or remove source traditions', 'sweethill-core'),
            'choose_from_most_used'      => __('Choose from the most used source traditions', 'sweethill-core'),
            'not_found'                  => __('No source traditions found.', 'sweethill-core'),
            'no_terms'                   => __('No source traditions', 'sweethill-core'),
            'menu_name'                  => __('Source Traditions', 'sweethill-core'),
            'items_list_navigation'      => __('Source traditions list navigation', 'sweethill-core'),
            'items_list'                 => __('Source traditions list', 'sweethill-core'),
            'back_to_items'              => __('&larr; Go to Source Traditions', 'sweethill-core'),
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
                'slug'         => 'source-tradition',
                'with_front'   => false,
                'hierarchical' => true,
            ],
        ];

        register_taxonomy('source_tradition', ['book', 'character'], $args);
    }
}
