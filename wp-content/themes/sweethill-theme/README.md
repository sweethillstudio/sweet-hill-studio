# Sweet Hill Studio Theme (`sweethill-theme`)

The **Sweet Hill Studio Theme** is a native Full Site Editing (FSE) block theme architected for **Sweet Hill Studio**. It embodies the **"Contemporary Editorial Wonder"** design philosophy defined in `docs/04-DESIGN-SYSTEM-AND-DIGITAL-EXPERIENCE.md`.

---

## 1. Design System & Design Tokens (`theme.json`)

The theme relies entirely on `theme.json` (version 3) for design token declaration, block styling, and fluid layout scaling.

### Color Palette
- **Warm Ivory (`#FDFBF7`):** Foundational canvas / background.
- **Soft Parchment (`#F4EFEA`):** Surface contrast, cards, footer background.
- **Off White (`#FAF8F5`):** Secondary section tint.
- **Ink (`#121316`):** High-contrast editorial typography and primary buttons.
- **Deep Charcoal (`#2C2D30`):** Secondary text and border accents.
- **Muted Earth (`#7C756E`):** Captions, metadata, and subtle dividers.
- **Terracotta Accent (`#B8532F`):** Warm CTA and badge highlights.
- **Gold Ochre (`#C9944A`):** Literary accent marker.

### Typography System
- **Editorial Serif:** `Newsreader` / `Cormorant Garamond` / `Georgia`  
  *Optical sizing and full Unicode coverage for Sanskrit IAST diacritics (`ā`, `ī`, `ū`, `ṛ`, `ṝ`, `ṃ`, `ṅ`, `ñ`, `ṭ`, `ḍ`, `ṇ`, `ś`, `ṣ`).*
- **Interface Sans-serif:** `Plus Jakarta Sans` / System Sans  
  *Tabular figures (`tnum`) for pricing, specs, and crisp small-screen legibility.*

### Fluid Scale
- **Typography:** `display`, `h1`, `h2`, `h3`, `h4`, `body`, `small`, `caption` scaled with fluid `clamp()`.
- **Spacing:** Scale steps `20`, `30`, `40`, `50`, `60`, `70`, `80` with fluid `clamp()`.
- **Layout:** Content width `840px`, Wide width `1320px`.

---

## 2. Template Hierarchy & Parts

```text
wp-content/themes/sweethill-theme/
├── style.css                           # Theme headers and CSS baseline
├── theme.json                          # Global design tokens (v3)
├── functions.php                       # Theme supports, asset enqueuing, pattern categories
├── parts/
│   ├── header.html                     # Global header with primary and utility navigation
│   └── footer.html                     # 4-column editorial footer with colophon
└── templates/
    ├── index.html                      # Fallback universal template
    ├── front-page.html                 # Cinematic Homepage experience
    ├── single-book.html                # Editorial Book page (narrative deep scroll)
    ├── archive-book.html               # "On The Shelf" book catalogue grid
    └── 404.html                        # 404 error page
```

---

## 3. Best Practices
- **No Inline Hardcoded CSS:** All styling leverages standard WordPress block attributes, classes, and `var(--wp--preset--*)` CSS custom properties.
- **WooCommerce Ready:** Declares native WooCommerce theme supports (`woocommerce`, `wc-product-gallery-*`) in `functions.php`.
- **Accessibility:** High contrast ratios between `ink` and `warm-ivory` / `soft-parchment` meeting WCAG 2.2 AA standards.
