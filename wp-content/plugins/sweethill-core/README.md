# Sweet Hill Core Plugin (`sweethill-core`)

The **Sweet Hill Core** plugin establishes the core structured data architecture, publishing post types, taxonomy schemas, and commerce relationship bridges for **Sweet Hill Studio**.

Per the architecture defined in `docs/00-MASTER-SPECIFICATION.md` and `docs/03-INFORMATION-ARCHITECTURE.md`, this plugin cleanly separates **Editorial Entities** from **WooCommerce Commercial Entities**.

---

## 1. Directory Structure

```text
wp-content/plugins/sweethill-core/
├── sweethill-core.php                          # Main plugin bootstrap & activation hooks
├── README.md                                   # Plugin technical documentation
└── includes/
    ├── class-sweethill-core.php                # Master orchestrator class
    ├── class-sweethill-i18n.php                # Text domain loader
    ├── helpers/
    │   └── helpers.php                         # Global template helpers and sanitizers
    ├── post-types/
    │   ├── class-cpt-book.php                  # CPT: 'book' (Archive: /books/)
    │   ├── class-cpt-series.php                # CPT: 'series' (Archive: /series/)
    │   ├── class-cpt-storymaker.php            # CPT: 'storymaker' (Archive: /storymakers/)
    │   ├── class-cpt-character.php             # CPT: 'character' (Archive: /characters/)
    │   ├── class-cpt-resource.php              # CPT: 'resource' (Archive: /resources/)
    │   └── class-cpt-journal.php               # CPT: 'journal' (Archive: /etc/)
    ├── taxonomies/
    │   ├── class-taxonomy-age-range.php        # Taxonomy: 'age_range' (book, resource)
    │   ├── class-taxonomy-source-tradition.php # Taxonomy: 'source_tradition' (book, character)
    │   └── class-taxonomy-book-format.php      # Taxonomy: 'book_format' (book)
    └── meta/
        ├── class-book-meta.php                 # Schema registration (register_post_meta)
        └── class-meta-boxes.php                # Admin UI meta boxes and save handler
```

---

## 2. Custom Post Types (CPTs)

| Post Type | Archive URL | Single URL | Supports |
| :--- | :--- | :--- | :--- |
| `book` | `/books/` | `/books/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `custom-fields`, `revisions` |
| `series` | `/series/` | `/series/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `revisions` |
| `storymaker` | `/storymakers/` | `/storymakers/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `revisions` |
| `character` | `/characters/` | `/characters/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `revisions` |
| `resource` | `/resources/` | `/resources/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `revisions` |
| `journal` | `/etc/` | `/etc/%postname%/` | `title`, `editor`, `thumbnail`, `excerpt`, `revisions` |

*All post types support `show_in_rest => true` for Gutenberg Block Editor and FSE compatibility.*

---

## 3. Custom Taxonomies

| Taxonomy | Object Types | Hierarchical | Rewrite Slug |
| :--- | :--- | :--- | :--- |
| `age_range` | `book`, `resource` | Yes | `age-range` |
| `source_tradition` | `book`, `character` | Yes | `source-tradition` |
| `book_format` | `book` | Yes | `book-format` |

---

## 4. Commerce & Editorial Relationships

### Metadata Fields on `book`:
- **`linked_woo_product_ids`** (`array` of integers): Bridges an editorial book record to one or more WooCommerce commercial SKUs/products (e.g. Hardcover, Paperback, Hindi Edition, Ebook).
- **`storymaker_id`** (`integer`): Post ID of the primary author/creator.
- **`series_id`** (`integer`): Post ID of the publishing series.

### Helper Functions:
- `sweethill_get_linked_products( $book_id )`: Returns array of active `WC_Product` objects.
- `sweethill_get_book_storymaker( $book_id )`: Returns primary storymaker `WP_Post` object.
- `sweethill_get_book_series( $book_id )`: Returns series `WP_Post` object.
- `sweethill_sanitize_int_array( $values )`: Returns unique array of sanitized positive integers.
