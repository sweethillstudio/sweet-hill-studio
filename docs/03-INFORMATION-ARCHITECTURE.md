# 03-INFORMATION-ARCHITECTURE.md
### Version 0.1 — Site Structure & Database Routing

## 1. PURPOSE OF THIS DOCUMENT
This document defines the exact URL routing, WordPress Custom Post Types (CPTs), custom taxonomies, and navigational hierarchy for Sweet Hill Studio. AI coding agents must use this to configure the `Sweet Hill Core` custom plugin and set up the WordPress permalink structure.

## 2. WORDPRESS DATA MODEL (SWEET HILL CORE)

The architecture deliberately separates **Editorial Entities** (Books, Authors, Series) from **Commercial Entities** (WooCommerce Products) to allow the publishing catalogue to scale independently of the shop.

### 2.1 Custom Post Types (CPTs)
The AI must register the following CPTs in the `sweethill-core` plugin:

1.  `book` (Has Archive: True, Hierarchical: False)
2.  `series` (Has Archive: True, Hierarchical: False)
3.  `storymaker` (Has Archive: True, Hierarchical: False) *Used for Authors/Illustrators*
4.  `character` (Has Archive: True, Hierarchical: False)
5.  `resource` (Has Archive: True, Hierarchical: False)
6.  `journal` (Has Archive: True, Hierarchical: False) *Used for ETC. editorial news*

### 2.2 Custom Taxonomies
The AI must register the following taxonomies to organize the CPTs:

1.  `age_range` (Applies to: `book`, `resource`)
2.  `source_tradition` (Applies to: `book`, `character`)
3.  `book_format` (Applies to: `book`)

### 2.3 Post-to-Post Relationships (Metadata bindings)
*   A `book` must be able to link to a `storymaker` (Author).
*   A `book` must be able to link to a `series`.
*   A `book` must contain a custom meta field for `linked_woo_product_ids` (connecting the editorial book page to the purchasable WooCommerce SKUs).

## 3. URL ROUTING & PERMALINK STRUCTURE

To maintain clean, semantic SEO, URLs must follow this exact structure.

### 3.1 Primary Editorial Routes
*   **Homepage:** `https://www.sweethillstudio.com/`
*   **About (The Studio):** `/the-studio/`
*   **All Books:** `/books/`
*   **Single Book:** `/books/naradas-quest/`
*   **All Series:** `/series/`
*   **Single Series:** `/series/sri-brhad-bhagavatamrta/`
*   **Storymakers:** `/storymakers/`
*   **Single Storymaker:** `/storymakers/kirti-kumari-dasi/`
*   **Educators:** `/for-educators/`
*   **Resources:** `/resources/`
*   **Journal (ETC.):** `/etc/`

### 3.2 Commerce Routes (WooCommerce Native)
*   **Shop Archive:** `/shop/`
*   **Single Product:** `/product/naradas-quest-hardcover/`
*   **Cart/Bag:** `/bag/`
*   **Checkout:** `/checkout/`
*   **My Account:** `/account/`

### 3.3 Utility & Legal Routes
*   **FAQ:** `/faq/`
*   **Shipping & Returns:** `/shipping-returns/`
*   **Contact:** `/contact/`
*   **Privacy Policy:** `/privacy-policy/`
*   **Terms of Service:** `/terms/`

## 4. NAVIGATION HIERARCHY

The navigation must be implemented as distinct WordPress menu locations to allow non-technical management.

### 4.1 Primary Header Navigation
*   BOOKS
*   SERIES
*   BEYOND THE BOOK *(Dropdown linking to Characters, Themes, Stories)*
*   FOR EDUCATORS
*   THE STUDIO
*   SHOP

### 4.2 Utility Header Navigation (Right-aligned)
*   SEARCH *(Triggers overlay or modal)*
*   BAG *(Triggers WooCommerce Mini-Cart slide-out)*

### 4.3 Global Footer Navigation
*   **Explore:** Books | Series | Beyond the Book
*   **Learn:** For Educators | Resources | ETC. (Journal)
*   **The Studio:** Why Sweet Hill? | The Storymakers | How We Create
*   **Support:** FAQ | Shipping | Returns | Contact
*   **Legal:** Privacy Policy | Terms of Service | Copyright

## 5. PAGE TEMPLATE MAPPING (BLOCK THEME)

The AI must generate the following Full Site Editing (FSE) block templates inside the custom theme (`sweethill-theme`):

1.  `front-page.html`: The cinematic homepage.
2.  `single-book.html`: Editorial layout for the `book` CPT (Cover left, metadata/purchase right, deep scroll narrative below).
3.  `single-storymaker.html`: Author profile layout.
4.  `archive-book.html`: The "On The Shelf" grid.
5.  `single-product.html`: WooCommerce default override for standalone SKUs.
6.  `page-the-studio.html`: Custom layout for the About page.