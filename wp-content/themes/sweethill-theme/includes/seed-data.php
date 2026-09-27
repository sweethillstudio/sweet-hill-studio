<?php
/**
 * Programmatic Content Seeder for Sweet Hill Studio.
 *
 * Populates initial Books, Storymakers, and Series from 02-WEBSITE-CONTENT-MASTER.md.
 * Runs on theme activation or via admin trigger.
 *
 * @package SweetHill\Theme
 */

defined('ABSPATH') || exit;

/**
 * Attaches a local image from the theme's assets/images/ directory to a post as its featured image.
 *
 * @param string $filename Filename relative to assets/images/.
 * @param int    $post_id  Target post ID.
 * @return int|false Attachment ID or false on failure.
 */
function sweethill_attach_theme_image($filename, $post_id) {
    if (empty($filename) || empty($post_id)) {
        return false;
    }

    if (has_post_thumbnail($post_id)) {
        return get_post_thumbnail_id($post_id);
    }

    $source_path = get_template_directory() . '/assets/images/' . $filename;
    if (!file_exists($source_path)) {
        return false;
    }

    // Require WordPress administration media libraries.
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload_dir = wp_upload_dir();
    $target_filename = wp_unique_filename($upload_dir['path'], basename($source_path));
    $destination = $upload_dir['path'] . '/' . $target_filename;

    if (!copy($source_path, $destination)) {
        return false;
    }

    $filetype = wp_check_filetype($target_filename, null);
    $attachment = [
        'post_mime_type' => $filetype['type'],
        'post_title'     => sanitize_file_name(pathinfo($target_filename, PATHINFO_FILENAME)),
        'post_content'   => '',
        'post_status'    => 'inherit',
    ];

    $attachment_id = wp_insert_attachment($attachment, $destination, $post_id);
    if (!is_wp_error($attachment_id) && $attachment_id > 0) {
        $attachment_data = wp_generate_attachment_metadata($attachment_id, $destination);
        wp_update_attachment_metadata($attachment_id, $attachment_data);
        set_post_thumbnail($post_id, $attachment_id);
        return $attachment_id;
    }

    return false;
}

/**
 * Main routine to seed books, authors, and series data.
 */
function sweethill_seed_initial_content() {
    // Only run if user has permission to manage options.
    if (is_admin() && !current_user_can('manage_options') && !doing_action('after_switch_theme')) {
        return;
    }

    // Prevent redundant execution unless forced via URL parameter.
    $forced = isset($_GET['sweethill_reseed']) && $_GET['sweethill_reseed'] === '1';
    if (get_option('sweethill_data_seeded_v1') && !$forced) {
        return;
    }

    // -------------------------------------------------------------
    // 1. Seed Storymakers (Authors & Creative Directors)
    // -------------------------------------------------------------
    $kirti_id = 0;
    $kirti_post = get_page_by_path('kirti-kumari-dasi', OBJECT, 'storymaker');
    if (!$kirti_post) {
        $kirti_id = wp_insert_post([
            'post_title'   => 'Kirti-kumārī dāsī',
            'post_name'    => 'kirti-kumari-dasi',
            'post_type'    => 'storymaker',
            'post_status'  => 'publish',
            'post_excerpt' => 'Author & Editorial Lead at Sweet Hill Studio.',
            'post_content' => '<p>Kirti-kumārī is an educator, curriculum designer, and children’s author based in Aotearoa New Zealand. With over 15 years of teaching experience, she has dedicated her life to creating meaningful, values-based education that nurtures curiosity, creativity, compassion, and spiritual understanding.</p><p>For nine years, Kirti-kumārī served as a teacher at the International School in Māyāpur, West Bengal, India, before continuing her teaching journey at the Hare Krishna School in Auckland, New Zealand. Her experiences living and teaching in India and New Zealand have shaped her appreciation for diverse cultures, traditions, and approaches to education.</p><p>She holds a Master of Laws and a Master of Teaching and Learning. Inspired by the teachings of His Divine Grace A.C. Bhaktivedanta Swami Prabhupāda and the tradition of Gauḍīya Vaiṣṇavism, Kirti-kumārī believes education and storytelling have the power to cultivate not only knowledge but also kindness, character, and a deeper understanding of our connection with the world and the Supreme.</p>',
        ]);
        if ($kirti_id && !is_wp_error($kirti_id)) {
            sweethill_attach_theme_image('Kirti.png', $kirti_id);
        }
    } else {
        $kirti_id = $kirti_post->ID;
    }

    $sridama_id = 0;
    $sridama_post = get_page_by_path('sridama-dasa', OBJECT, 'storymaker');
    if (!$sridama_post) {
        $sridama_id = wp_insert_post([
            'post_title'   => 'Sridāma dāsa',
            'post_name'    => 'sridama-dasa',
            'post_type'    => 'storymaker',
            'post_status'  => 'publish',
            'post_excerpt' => 'CEO, Creative Director & Author at Sweet Hill Studio.',
            'post_content' => '<p>Sridāma dāsa (Sridhar Kallidai) is the CEO of Sweet Hill Studio and the author of the forthcoming series, The Dvārakā Chronicles, which begins with The Dream Princess of Śoṇitapura. With over 35 years of experience in the film and media industry, he guides the studio’s creative technology, digital production, and global publishing vision.</p><p>As the operational and creative anchor of Sweet Hill Studio, Sridhar bridges the gap between ancient traditions and future-facing digital storytelling. He is a seasoned Director, Producer, Editor, and Cinematographer whose work spans broadcast television, digital product development, and immersive 360-degree fulldome films.</p>',
        ]);
        if ($sridama_id && !is_wp_error($sridama_id)) {
            sweethill_attach_theme_image('Sri.png', $sridama_id);
        }
    } else {
        $sridama_id = $sridama_post->ID;
    }

    // -------------------------------------------------------------
    // 2. Seed Series
    // -------------------------------------------------------------
    $series_id = 0;
    $series_post = get_page_by_path('sri-brhad-bhagavatamrta', OBJECT, 'series');
    if (!$series_post) {
        $series_id = wp_insert_post([
            'post_title'   => 'Śrī Bṛhad-Bhāgavatāmṛta',
            'post_name'    => 'sri-brhad-bhagavatamrta',
            'post_type'    => 'series',
            'post_status'  => 'publish',
            'post_excerpt' => 'An epic cosmic journey exploring the depths of devotional love across the universe.',
            'post_content' => '<p>Adapted from Śrī Sanātana Gosvāmī’s timeless masterpiece, this series follows the beloved sage Nārada as he journeys across the material, heavenly, and spiritual realms searching for the Supreme Lord’s greatest devotee.</p>',
        ]);
        if ($series_id && !is_wp_error($series_id)) {
            sweethill_attach_theme_image('BACK-3.png_2K_202607162349.jpeg', $series_id);
        }
    } else {
        $series_id = $series_post->ID;
    }

    // -------------------------------------------------------------
    // 3. Seed Book 01: Nārada's Quest
    // -------------------------------------------------------------
    $narada_post = get_page_by_path('naradas-quest', OBJECT, 'book');
    if (!$narada_post) {
        $narada_content = '<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|body","lineHeight":"1.8"}}} -->
<p>Beautifully adapted from Śrī Sanātana Gosvāmī’s timeless masterpiece, <em>Śrī Bṛhad-Bhāgavatāmṛta</em>, this wonder-filled adventure follows Nārada as he meets extraordinary devotees, each teaching him a deeper truth about love for Krishna. Travel alongside Nārada Muni as he follows a trail of pure devotion. What he discovers at the end of his journey reveals the sweetest secret in the universe—and transforms our understanding of love forever.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2>Praise &amp; Endorsements</h2>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>“This book is unique in its approach—it brings the profound teachings of the Śrī Bṛhad Bhāgavatāmṛta to children in a way that is engaging, accessible, and deeply devotional. Kirti-kumārī has crafted this story with exceptional care, blending chastity, creativity, and fidelity to the original teachings.”</p><cite>— S.B. Keśava Swami (Foreword)</cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><p>“Nārada’s Quest is a captivating retelling that brings one of our tradition’s most treasured classics to life with warmth, beauty, and heart... Perfect for reading aloud or independent exploration, this book is a versatile, timeless resource, helping children experience the joy of devotion, perfectly aligned with Śrīla Prabhupāda’s mission.”</p><cite>— Vimala Devī Dāsī</cite></blockquote>
<!-- /wp:quote -->';

        $narada_id = wp_insert_post([
            'post_title'   => 'Nārada\'s Quest for the greatest devotee',
            'post_name'    => 'naradas-quest',
            'post_type'    => 'book',
            'post_status'  => 'publish',
            'post_excerpt' => 'THE UNIVERSE IS VAST, BUT WHERE DOES THE HEART BELONG? With his magical vīṇā in hand, the beloved sage Nārada sets out on an epic quest. From the glowing cloud-palaces of the demigods to a glittering golden island in the sea, he journeys across the universe searching for the answer to one extraordinary question: Who is the Lord\'s greatest devotee?',
            'post_content' => $narada_content,
        ]);

        if ($narada_id && !is_wp_error($narada_id)) {
            // Assign metadata
            update_post_meta($narada_id, 'storymaker_id', $kirti_id);
            update_post_meta($narada_id, 'series_id', $series_id);
            update_post_meta($narada_id, 'page_count', '200');
            update_post_meta($narada_id, 'dimensions', '8.5 × 8.5 inches');
            update_post_meta($narada_id, 'isbn_kdp', '978-1-7386179-7-5');
            update_post_meta($narada_id, 'isbn_ingram', '978-1-7386179-5-1');
            update_post_meta($narada_id, 'publication_date', 'July 2026');

            // Assign taxonomies
            wp_set_object_terms($narada_id, ['4-7 Years', '8-12 Years'], 'age_range');
            wp_set_object_terms($narada_id, ['Gauḍīya Vaiṣṇava', 'Bhāgavata'], 'source_tradition');
            wp_set_object_terms($narada_id, ['Paperback', 'Hardcover'], 'book_format');

            // Attach featured image
            sweethill_attach_theme_image('Narada\'s Quest_COVER_Digital.jpg', $narada_id);
        }
    }

    // -------------------------------------------------------------
    // 4. Seed Book 02: Me & Mr Puri
    // -------------------------------------------------------------
    $puri_post = get_page_by_path('me-and-mr-puri', OBJECT, 'book');
    if (!$puri_post) {
        $puri_content = '<!-- wp:paragraph {"style":{"typography":{"fontSize":"var:preset|font-size|body","lineHeight":"1.8"}}} -->
<p>Join Gopāla and Mister Puri to discover how pure devotion conquers the Lord’s heart—sparking a beautiful festival the world celebrates to this very day! The beautiful story of Śrīpāda Mādhavendra Purī is told from the perspective of the dark cowherd boy, Krishna, bringing the qualities of devotion, humility, compassion, and divine friendship to life through storytelling and art.</p>
<!-- /wp:paragraph -->';

        $puri_id = wp_insert_post([
            'post_title'   => 'Me & Mr Puri',
            'post_name'    => 'me-and-mr-puri',
            'post_type'    => 'book',
            'post_status'  => 'publish',
            'post_excerpt' => 'Lord Krishna Himself tells the enchanting tale of His dear friend, Mister Puri (Śrī Mādhavendra Purī). It all starts with a surprise dream! What follows is an amazing adventure: unearthing a lost forest treasure, a blazing summer trek, and the grand mystery of a stolen pot of sweet khīra.',
            'post_content' => $puri_content,
        ]);

        if ($puri_id && !is_wp_error($puri_id)) {
            // Assign metadata
            update_post_meta($puri_id, 'storymaker_id', $kirti_id);
            update_post_meta($puri_id, 'dimensions', '8.5 × 8.5 inches');
            update_post_meta($puri_id, 'isbn', '978-1-7386179-6-8');
            update_post_meta($puri_id, 'publication_date', 'July 2026');

            // Assign taxonomies
            wp_set_object_terms($puri_id, ['4-7 Years', 'All Ages'], 'age_range');
            wp_set_object_terms($puri_id, ['Gauḍīya Vaiṣṇava'], 'source_tradition');
            wp_set_object_terms($puri_id, ['Paperback'], 'book_format');

            // Attach featured image
            sweethill_attach_theme_image('Change_the_image_2k_202512202116.jpg', $puri_id);
        }
    }

    // Mark as seeded.
    update_option('sweethill_data_seeded_v1', true);
}

// Hook to theme activation and admin_init for safe one-time execution.
add_action('after_switch_theme', 'sweethill_seed_initial_content');
add_action('admin_init', 'sweethill_seed_initial_content');
