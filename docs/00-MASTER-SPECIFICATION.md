# SWEET HILL STUDIO
# AI DEVELOPMENT MASTER SPECIFICATION
## Version 0.1 — Foundation Architecture

**Project:** Sweet Hill Studio Global Publishing Website  
**Domain:** www.sweethillstudio.com  
**Primary objective:** Build a sophisticated global publishing, discovery and commerce platform for Sweet Hill Studio using AI-assisted development.

---

# 1. PURPOSE OF THIS DOCUMENT

This document is the single source of truth for the development of the Sweet Hill Studio website.

It is intended to guide AI coding agents, human developers, designers, technical contractors and future maintainers.

The website must be designed as a premium global publishing ecosystem with integrated commerce, not as a generic children's website, generic WordPress site, generic religious bookstore or AI-generated website.

Major architectural decisions must not be made silently by an AI coding agent. Conflicts with this specification must be identified before implementation.

# 2. CORE BUSINESS PURPOSE

Sweet Hill Studio is intended to become a global children's publishing brand focused initially on Vedic, Vaiṣṇava and Indic storytelling, while remaining capable of expanding into a broader publishing/IP ecosystem.

The website must support:

- books
- authors
- illustrators
- series
- characters
- stories
- educational resources
- articles
- source traditions
- multiple languages
- direct-to-consumer commerce
- international sales
- educator/institutional use
- wholesale enquiries
- future licensing and media opportunities

The website must communicate that Sweet Hill Studio is a publishing house in development, not simply an online store.

# 3. CORE DESIGN PHILOSOPHY

The site is **not a generic kids website**.

Avoid childish UI, excessive rounded cards, pastel-everything, generic cartoon motifs, rainbow palettes, nursery-style typography, excessive stickers, visual clutter, generic religious-bookstore aesthetics and generic AI-generated website aesthetics.

The children's nature of the publishing should come primarily from illustration, storytelling, characters, colour, typography, editorial composition and moments of delight.

Desired perception:

**modern, editorial, premium, quietly sophisticated, culturally intelligent, technology-aware, highly organised, international, fast and future-facing.**

Conceptual positioning:

> A contemporary global publishing house that happens to create extraordinary books for children.

# 4. PRIMARY USERS

The site must serve several audiences without becoming confusing.

## Parents and grandparents

Primary purchase decision-makers. They need beauty, trust, suitability, age guidance, cultural confidence, quality and clear purchasing information.

## Children

An important emotional audience, but the commercial interface is primarily designed for adults. Children should encounter wonder, characters, visual richness, stories, exploration and discovery.

## Educators

Schools, gurukulas, homeschoolers, temple education, teachers and parents using books educationally. They need age guidance, discussion material, activities, teaching resources, group ordering and source information.

## Vaiṣṇava / ISKCON / Vedic communities

Need confidence in cultural and scriptural authenticity, appropriate terminology, respect for sampradāya context and clarity about sources and adaptations.

## General global families

The site must explain concepts without assuming prior knowledge or reducing traditional material to generic mythology. Cultural depth and accessibility must coexist.

## Booksellers / distributors / institutions

Need professional publisher information, bibliographic data, formats, ISBNs, ordering information, contact pathways and wholesale information.

# 5. PLATFORM ARCHITECTURE

## Primary platform

**WordPress + WooCommerce**

This remains the preferred architecture unless subsequent technical research identifies a compelling reason to change it.

## Front-end architecture

Preferred:

**Custom native WordPress block/FSE theme**

The Sweet Hill design system must belong to the brand, not to a commercial theme.

## Page builders

Default: **no page builder**.

Avoid unnecessary dependency on Elementor, WPBakery, Divi or other heavyweight builders unless a specific requirement justifies one.

## Custom functionality

Create a lightweight plugin:

**Sweet Hill Core**

This owns Sweet Hill-specific structured publishing data and functionality. The theme owns presentation.

# 6. RESPONSIBILITY BOUNDARIES

## WordPress

Responsible for content, pages, publishing, users, media, taxonomies, editorial workflow and structured publishing records.

## Sweet Hill Core

Responsible for Books, Authors, Series, Characters, Stories, Source Texts, Resources, Educator Resources and Sweet Hill-specific relationships.

## WooCommerce

Responsible for commercial products, prices, stock, product variations, orders, customers, coupons, checkout, refunds and transactional commerce.

## Theme

Responsible for visual design, layout, typography, responsive behaviour, interaction, navigation, templates and component styling.

This separation must remain clear.

# 7. CONTENT MODEL

The site must not treat every book as simply a product.

A **Book** is an editorial entity.

A **WooCommerce Product** is a commercial entity.

Example:

BOOK: Śrī Bāla Bhāgavatāmṛta – Nārada's Quest

may connect to:

- English Hardcover
- Hindi Hardcover
- English Paperback
- Digital Edition
- Educational Bundle

The Book record therefore connects to one or more WooCommerce products.

# 8. CORE CONTENT ENTITIES

Create structured entities for:

## BOOK

Title, subtitle, short description, full description, author, illustrator, publisher, series, age range, reading level where applicable, page count, dimensions, format, ISBN, language, publication date, edition, source tradition, source text, themes, characters, related stories, sample pages, cover artwork, interior artwork, author notes, educational information, reviews, related books and WooCommerce product relationships.

## AUTHOR

Name, biography, photograph, books, series, editorial information and appropriate links.

## SERIES

Title, description, books, characters, stories, artwork and series order.

## CHARACTER

Name, description, associated stories, associated books and visual references where appropriate.

## STORY

Title, summary, characters, books, source texts and related resources.

## SOURCE TEXT

Title, Sanskrit title where applicable, transliteration, source tradition, author, related books, related stories and explanatory notes.

## RESOURCE

General supplementary material.

## EDUCATOR RESOURCE

Material for teachers, gurukulas, schools, homeschooling and temple education.

# 9. SWEET HILL KNOWLEDGE GRAPH

Content relationships should be structural rather than merely hyperlinks.

**Book → Author → Series → Characters → Stories → Source Texts → Themes → Educational Resources → Related Books**

This architecture should support search, discovery, recommendations, internal linking, structured data, AI-readable semantic relationships, future apps, animation/media development, licensing and educational products.

# 10. DESIGN SYSTEM

The detailed design system and immersive experience strategy is maintained separately in:

`04-DESIGN-SYSTEM-AND-DIGITAL-EXPERIENCE.md`

That document is part of this specification and must be read before significant front-end implementation.

# 11. RESPONSIVE DESIGN

Responsive design is first-class. Do not simply shrink desktop layouts.

Design explicitly for large desktop, standard desktop/laptop, tablet and mobile.

Mobile must remain a genuinely excellent shopping and discovery experience.

# 12. COMMERCE

WooCommerce should manage products, variations, prices, stock, orders, coupons, checkout, customer accounts and refunds.

The architecture should support future hardcover, paperback, ebook, multiple languages, editions, bundles, series bundles, educational packs, gifts, institutional ordering and wholesale.

# 13. NZ + INDIA

Sweet Hill Studio is intended to operate through a connected NZ + India model while presenting one global brand.

### New Zealand

Potential responsibilities include global creative direction, publishing leadership, authors, editorial, international relationships, website, global brand and international markets.

### India

Potential responsibilities include printing, production, inventory, warehousing, Indian distribution, export coordination and vendor management.

Future regional differences may include currencies, payments, tax, inventory, fulfilment and shipping without requiring separate public websites.

# 14. PAYMENTS

Initial NZ configuration should evaluate WooPayments and Stripe.

Indian commerce should later evaluate Razorpay and other appropriate India-specific providers.

Never store payment-card information directly within Sweet Hill's own application.

# 15. DEVELOPMENT ENVIRONMENT

Recommended workflow:

```text
LOCAL DEVELOPMENT
       ↓
GitHub
       ↓
STAGING
       ↓
USER REVIEW
       ↓
PRODUCTION
```

The live website must never be the AI's experimentation environment.

# 16. GITHUB

Create a private repository:

**sweet-hill-studio**

The repository should contain the theme, Sweet Hill Core plugin, documentation, configuration, build scripts, testing information and deployment documentation.

No passwords, API keys or secrets may be committed.

# 17. AI DEVELOPMENT PRINCIPLES

AI coding agents must:

- inspect the repository before making changes
- preserve functioning systems
- make the smallest coherent change necessary
- minimise dependencies
- use native WordPress/WooCommerce capability where appropriate
- never expose secrets
- never deploy directly to production
- test before claiming completion
- document major architectural changes
- never invent publishing, scriptural, authorial, bibliographic or commercial facts

# 18. AI PROVIDER INDEPENDENCE

The project must remain portable between competent coding agents, including Google Antigravity, OpenAI Codex, Cursor and future tools.

The GitHub repository and project documentation are permanent assets. An AI subscription is replaceable.

# 19. PERFORMANCE

Performance is a design requirement.

Target current Core Web Vitals "Good" thresholds:

- LCP ≤ 2.5 seconds
- INP ≤ 200 ms
- CLS ≤ 0.1

at the 75th percentile.

Consider responsive images, AVIF/WebP, lazy loading, font optimisation, caching, CDN, script reduction, plugin reduction, database efficiency and third-party-script control.

# 20. ACCESSIBILITY

Build toward **WCAG 2.2 AA**.

Consider keyboard navigation, focus states, semantic HTML, colour contrast, alt text, screen readers, reduced motion, form labels, accessible error states and accessible checkout.

# 21. SEO AND DISCOVERY

Use technically strong SEO fundamentals:

- semantic HTML
- clean URLs
- crawlable content
- internal linking
- canonical URLs
- XML sitemap
- metadata
- Open Graph
- structured data
- clean headings
- image alt text
- fast pages
- mobile usability

AI search should be addressed through excellent content structure, entity relationships and technical SEO rather than speculative gimmicks.

# 22. SECURITY

Before launch, review authentication, authorisation, nonces, escaping, sanitisation, SQL injection, XSS, CSRF, file uploads, REST API permissions, plugin/theme vulnerabilities, admin exposure, secrets and backups.

Distinguish between “security reviewed” and “security independently tested.”

# 23. BACKUPS

Maintain automated off-site backups, database backups, file backups, pre-deployment backups and a tested restore procedure.

# 24. PHASED DEVELOPMENT

## Phase 1 — Foundation

GitHub, hosting, WordPress, WooCommerce, staging, Sweet Hill Core, custom theme foundation and design tokens.

## Phase 2 — Brand shell

Header, navigation, footer, typography, responsive framework and homepage.

## Phase 3 — Publishing architecture

Books, Authors, Series, Characters, Stories and Resources.

## Phase 4 — Commerce

Shop, product pages, cart, checkout, customer accounts and payment.

## Phase 5 — Education

Educator area, resources and institutional enquiries.

## Phase 6 — International

Currencies, shipping, region handling and India architecture preparation.

## Phase 7 — Search / discovery

SEO, schema, internal linking, search and related content.

## Phase 8 — Hardening

Performance, security, accessibility, testing and backups.

## Phase 9 — Launch

Production deployment, domain connection, analytics, monitoring and post-launch corrections.

# 25. WHAT NOT TO BUILD YET

Do not initially build:

- mobile app
- headless frontend
- custom CRM
- custom payment processor
- custom inventory system
- complex recommendation engine
- AI chatbot
- elaborate membership platform
- elaborate loyalty system
- unnecessary animations
- WebGL merely for visual novelty

# 26. FUTURE EXTENSIBILITY

The architecture should anticipate 50–100+ books, multiple authors, multiple series, multiple languages, educational products, audiobooks, animation, digital products, licensing, international distribution, wholesale and regional fulfilment.

Do not implement these prematurely. Build the architecture so they can be added later.

# 27. PROJECT COMPLETION CRITERIA

Version 1 is not complete merely because the homepage looks good.

It must demonstrate:

- distinctive Sweet Hill Studio visual identity
- structured Books, Authors and Series
- functioning WooCommerce products, cart, checkout and orders
- non-developer content management
- excellent mobile usability
- performance monitoring
- accessibility
- security review
- technical SEO and structured content
- working staging-to-production deployment
- tested backup restoration

# 28. DECISION REGISTER

| Decision | Current position |
|---|---|
| Domain | Spaceship / sweethillstudio.com |
| CMS | WordPress |
| Commerce | WooCommerce |
| Front-end | Custom block/FSE theme |
| Page builder | Avoid initially |
| Custom publishing plugin | Sweet Hill Core |
| Repository | GitHub |
| Development model | AI-assisted |
| Staging | Required |
| Headless | Defer |
| NZ payments | WooPayments/Stripe evaluation |
| India payments | Razorpay/equivalent evaluation |
| Hosting | MilesWeb vs Hostinger final selection pending |
| AI development tool | Existing Google AI Pro / Antigravity initially |
| Long-term AI subscription | Not required |
| Plugin philosophy | Minimal |
| Performance | First-class requirement |
| Accessibility | WCAG 2.2 AA target |
| SEO | Technical excellence + structured entities |

# 29. LINKED PROJECT DOCUMENTS

- `01-BRAND-AND-POSITIONING.md`
- `02-WEBSITE-CONTENT-MASTER.md`
- `03-INFORMATION-ARCHITECTURE.md`
- `04-DESIGN-SYSTEM-AND-DIGITAL-EXPERIENCE.md`
- `05-COMMERCE-SPECIFICATION.md`
- `06-TECHNICAL-ARCHITECTURE.md`
- `07-SEO-AND-DISCOVERY.md`
- `08-CONTENT-VOICE-GUIDE.md`
- `09-LAUNCH-AND-MAINTENANCE.md`

# 30. GOLDEN RULE

The Sweet Hill Studio website is not an AI-generated website.

It is a professionally architected publishing platform developed with AI assistance.

AI is the development accelerator.

It is not the architect.

The architecture, publishing model, design philosophy, cultural standards, business logic and final quality remain under Sweet Hill Studio's control.

# END OF MASTER SPECIFICATION v0.1
