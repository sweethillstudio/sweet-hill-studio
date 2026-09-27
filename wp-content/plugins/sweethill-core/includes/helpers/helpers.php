<?php
/**
 * Global helper functions for Sweet Hill Core.
 *
 * @package SweetHill\Core
 */

defined('ABSPATH') || exit;

if (!function_exists('sweethill_sanitize_int_array')) {
    /**
     * Sanitizes an array of integer IDs, removing duplicates and invalid values.
     *
     * @param mixed $values Raw values.
     * @return int[] Sanitized array of positive integers.
     */
    function sweethill_sanitize_int_array($values) {
        if (!is_array($values)) {
            return [];
        }

        $clean = array_map('absint', $values);
        $clean = array_filter($clean, function($id) {
            return $id > 0;
        });

        return array_values(array_unique($clean));
    }
}

if (!function_exists('sweethill_get_linked_products')) {
    /**
     * Retrieves an array of WooCommerce WC_Product objects linked to a book.
     *
     * @param int|WP_Post|null $book Book post ID or object.
     * @return WC_Product[] Array of WooCommerce product objects.
     */
    function sweethill_get_linked_products($book = null) {
        $post = get_post($book);
        if (!$post || $post->post_type !== 'book') {
            return [];
        }

        $product_ids = get_post_meta($post->ID, 'linked_woo_product_ids', true);
        if (empty($product_ids) || !is_array($product_ids)) {
            return [];
        }

        if (!function_exists('wc_get_product')) {
            return [];
        }

        $products = [];
        foreach ($product_ids as $product_id) {
            $product = wc_get_product($product_id);
            if ($product && $product->is_visible()) {
                $products[] = $product;
            }
        }

        return $products;
    }
}

if (!function_exists('sweethill_get_book_storymaker')) {
    /**
     * Retrieves the primary storymaker (author/creator) linked to a book.
     *
     * @param int|WP_Post|null $book Book post ID or object.
     * @return WP_Post|null Storymaker post or null.
     */
    function sweethill_get_book_storymaker($book = null) {
        $post = get_post($book);
        if (!$post || $post->post_type !== 'book') {
            return null;
        }

        $storymaker_id = (int) get_post_meta($post->ID, 'storymaker_id', true);
        if ($storymaker_id <= 0) {
            return null;
        }

        $storymaker = get_post($storymaker_id);
        return ($storymaker && $storymaker->post_type === 'storymaker' && $storymaker->post_status === 'publish') ? $storymaker : null;
    }
}

if (!function_exists('sweethill_get_book_series')) {
    /**
     * Retrieves the series linked to a book.
     *
     * @param int|WP_Post|null $book Book post ID or object.
     * @return WP_Post|null Series post or null.
     */
    function sweethill_get_book_series($book = null) {
        $post = get_post($book);
        if (!$post || $post->post_type !== 'book') {
            return null;
        }

        $series_id = (int) get_post_meta($post->ID, 'series_id', true);
        if ($series_id <= 0) {
            return null;
        }

        $series = get_post($series_id);
        return ($series && $series->post_type === 'series' && $series->post_status === 'publish') ? $series : null;
    }
}
