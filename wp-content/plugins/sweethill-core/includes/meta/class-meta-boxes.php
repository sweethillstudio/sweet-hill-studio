<?php
/**
 * Admin Meta Boxes for Book post type.
 *
 * @package SweetHill\Core\Meta
 */

defined('ABSPATH') || exit;

class SweetHill_Meta_Boxes {

    /**
     * Hook into WordPress admin actions.
     */
    public static function init() {
        add_action('add_meta_boxes_book', [__CLASS__, 'register_meta_boxes']);
        add_action('save_post_book', [__CLASS__, 'save_meta_boxes'], 10, 2);
    }

    /**
     * Register meta boxes for Book CPT.
     */
    public static function register_meta_boxes() {
        // Commerce Bridge: WooCommerce Products
        add_meta_box(
            'sweethill_book_woo_products',
            __('Commerce Bridge: Linked WooCommerce Products', 'sweethill-core'),
            [__CLASS__, 'render_woo_products_meta_box'],
            'book',
            'side',
            'high'
        );

        // Editorial Relationships: Storymaker & Series
        add_meta_box(
            'sweethill_book_relationships',
            __('Editorial Relationships', 'sweethill-core'),
            [__CLASS__, 'render_relationships_meta_box'],
            'book',
            'side',
            'default'
        );
    }

    /**
     * Render the WooCommerce product linking meta box.
     *
     * @param WP_Post $post Current post object.
     */
    public static function render_woo_products_meta_box($post) {
        wp_nonce_field('sweethill_book_meta_action', 'sweethill_book_meta_nonce');

        $selected_ids = (array) get_post_meta($post->ID, 'linked_woo_product_ids', true);
        if (!is_array($selected_ids)) {
            $selected_ids = [];
        }

        // Fetch published WooCommerce products.
        $products = [];
        if (function_exists('wc_get_products')) {
            $products = wc_get_products([
                'status' => 'publish',
                'limit'  => 100,
                'orderby' => 'title',
                'order'   => 'ASC',
            ]);
        } else {
            // Fallback if WooCommerce is inactive.
            $raw_posts = get_posts([
                'post_type'      => 'product',
                'post_status'    => 'publish',
                'posts_per_page' => 100,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ]);
            foreach ($raw_posts as $p) {
                $products[] = $p;
            }
        }

        ?>
        <div class="sweethill-meta-box-wrap" style="padding: 6px 0;">
            <p class="description" style="margin-bottom: 12px;">
                <?php esc_html_e('Select one or more WooCommerce commercial products (editions/SKUs) to connect to this editorial book page.', 'sweethill-core'); ?>
            </p>

            <?php if (empty($products)) : ?>
                <p style="color: #666; font-style: italic;">
                    <?php esc_html_e('No published WooCommerce products found. Create products in WooCommerce to link them here.', 'sweethill-core'); ?>
                </p>
            <?php else : ?>
                <div style="max-height: 220px; overflow-y: auto; border: 1px solid #ccd0d4; padding: 8px 10px; background: #fafafa; border-radius: 4px;">
                    <?php foreach ($products as $prod) : 
                        $prod_id = is_a($prod, 'WC_Product') ? $prod->get_id() : $prod->ID;
                        $title   = is_a($prod, 'WC_Product') ? $prod->get_name() : $prod->post_title;
                        $sku     = (is_a($prod, 'WC_Product') && $prod->get_sku()) ? ' (SKU: ' . $prod->get_sku() . ')' : '';
                        $price   = (is_a($prod, 'WC_Product') && $prod->get_price()) ? ' — ' . wc_price($prod->get_price()) : '';
                        $checked = in_array($prod_id, $selected_ids, true) ? 'checked="checked"' : '';
                    ?>
                        <label style="display: block; margin-bottom: 6px; font-size: 13px; line-height: 1.4;">
                            <input type="checkbox" name="sweethill_linked_woo_product_ids[]" value="<?php echo esc_attr($prod_id); ?>" <?php echo $checked; ?> />
                            <strong><?php echo esc_html($title); ?></strong><?php echo esc_html($sku); ?><small><?php echo wp_kses_post($price); ?></small>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render the editorial relationships (Storymaker & Series) meta box.
     *
     * @param WP_Post $post Current post object.
     */
    public static function render_relationships_meta_box($post) {
        $current_storymaker = (int) get_post_meta($post->ID, 'storymaker_id', true);
        $current_series     = (int) get_post_meta($post->ID, 'series_id', true);

        $storymakers = get_posts([
            'post_type'      => 'storymaker',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);

        $series_list = get_posts([
            'post_type'      => 'series',
            'post_status'    => 'publish',
            'posts_per_page' => 100,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ]);
        ?>
        <div class="sweethill-meta-box-wrap" style="padding: 6px 0;">
            <p style="margin-bottom: 6px;">
                <label for="sweethill_storymaker_id" style="font-weight: 600; display: block;">
                    <?php esc_html_e('Primary Storymaker (Author):', 'sweethill-core'); ?>
                </label>
                <select name="sweethill_storymaker_id" id="sweethill_storymaker_id" style="width: 100%;">
                    <option value="0"><?php esc_html_e('— None / Select Storymaker —', 'sweethill-core'); ?></option>
                    <?php foreach ($storymakers as $author) : ?>
                        <option value="<?php echo esc_attr($author->ID); ?>" <?php selected($current_storymaker, $author->ID); ?>>
                            <?php echo esc_html($author->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>

            <p style="margin-top: 12px; margin-bottom: 6px;">
                <label for="sweethill_series_id" style="font-weight: 600; display: block;">
                    <?php esc_html_e('Publishing Series:', 'sweethill-core'); ?>
                </label>
                <select name="sweethill_series_id" id="sweethill_series_id" style="width: 100%;">
                    <option value="0"><?php esc_html_e('— Standalone / No Series —', 'sweethill-core'); ?></option>
                    <?php foreach ($series_list as $ser) : ?>
                        <option value="<?php echo esc_attr($ser->ID); ?>" <?php selected($current_series, $ser->ID); ?>>
                            <?php echo esc_html($ser->post_title); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
        </div>
        <?php
    }

    /**
     * Save metadata when Book post is saved.
     *
     * @param int     $post_id Post ID.
     * @param WP_Post $post    Post object.
     */
    public static function save_meta_boxes($post_id, $post) {
        // Prevent saving during autosave.
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Verify nonce.
        if (!isset($_POST['sweethill_book_meta_nonce']) || !wp_verify_nonce($_POST['sweethill_book_meta_nonce'], 'sweethill_book_meta_action')) {
            return;
        }

        // Check user capabilities.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save linked WooCommerce products.
        if (isset($_POST['sweethill_linked_woo_product_ids']) && is_array($_POST['sweethill_linked_woo_product_ids'])) {
            $clean_ids = sweethill_sanitize_int_array($_POST['sweethill_linked_woo_product_ids']);
            update_post_meta($post_id, 'linked_woo_product_ids', $clean_ids);
        } else {
            delete_post_meta($post_id, 'linked_woo_product_ids');
        }

        // Save Storymaker relationship.
        if (isset($_POST['sweethill_storymaker_id'])) {
            $storymaker_id = absint($_POST['sweethill_storymaker_id']);
            if ($storymaker_id > 0) {
                update_post_meta($post_id, 'storymaker_id', $storymaker_id);
            } else {
                delete_post_meta($post_id, 'storymaker_id');
            }
        }

        // Save Series relationship.
        if (isset($_POST['sweethill_series_id'])) {
            $series_id = absint($_POST['sweethill_series_id']);
            if ($series_id > 0) {
                update_post_meta($post_id, 'series_id', $series_id);
            } else {
                delete_post_meta($post_id, 'series_id');
            }
        }
    }
}
