# Graph Report - .  (2026-05-20)

## Corpus Check
- 48 files · ~580,519 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 193 nodes · 246 edges · 55 communities (53 shown, 2 thin omitted)
- Extraction: 78% EXTRACTED · 22% INFERRED · 0% AMBIGUOUS · INFERRED: 55 edges (avg confidence: 0.86)
- Token cost: 222,481 input · 24,719 output

## Community Hubs (Navigation)
- [[_COMMUNITY_Site Config & Brand Constants|Site Config & Brand Constants]]
- [[_COMMUNITY_Page Routes & Templates|Page Routes & Templates]]
- [[_COMMUNITY_Lead Capture Forms|Lead Capture Forms]]
- [[_COMMUNITY_Frontend Animations & Libraries|Frontend Animations & Libraries]]
- [[_COMMUNITY_Trust Signals & Editorial Process|Trust Signals & Editorial Process]]
- [[_COMMUNITY_PHP Helper Functions|PHP Helper Functions]]
- [[_COMMUNITY_Portfolio Data & Crawler Directives|Portfolio Data & Crawler Directives]]
- [[_COMMUNITY_$PAGE_META registry (isolated)|$PAGE_META registry (isolated)]]
- [[_COMMUNITY_getBookCovers() helper (isolated)|getBookCovers() helper (isolated)]]

## God Nodes (most connected - your core abstractions)
1. `footer.php (Site footer)` - 19 edges
2. `header.php (Document head + SEO + body open)` - 16 edges
3. `config.php (Master Configuration)` - 14 edges
4. `Main JS (assets/js/main.js IIFE)` - 14 edges
5. `safe() helper` - 13 edges
6. `navbar.php (Primary + mobile nav)` - 11 edges
7. `Contact/Quote Conversion Funnel (contact.php#submit)` - 10 edges
8. `Page Banner Pattern (non-service inner pages)` - 10 edges
9. `Author Services Hub` - 9 edges
10. `Book Publishing Service Page` - 9 edges

## Surprising Connections (you probably didn't know these)
- `Book Publishing Service Page` --semantically_similar_to--> `Book Editing Service Page`  [INFERRED] [semantically similar]
  publishing.php → editing.php
- `Book Publishing Service Page` --semantically_similar_to--> `Book Marketing Service Page`  [INFERRED] [semantically similar]
  publishing.php → marketing.php
- `Book Editing Service Page` --semantically_similar_to--> `Ghostwriting Service Page`  [INFERRED] [semantically similar]
  editing.php → ghostwriting.php
- `Book Cover Design Service Page` --semantically_similar_to--> `Book Formatting Service Page`  [INFERRED] [semantically similar]
  design.php → formatting.php
- `Blog: Book Cover Design Cost in Europe` --semantically_similar_to--> `Blog: Top 10 Book Publishers in Europe`  [INFERRED] [semantically similar]
  blog-book-cover-design-cost.php → blog-top-publishers.php

## Hyperedges (group relationships)
- **Six service landing pages share the unified service template & contact funnel** — publishing_service, editing_service, ghostwriting_service, design_service, formatting_service, marketing_service [INFERRED 0.95]
- **Blog index + two long-form posts form the editorial content corpus** — blog_index, blog_book_cover_design_cost, blog_top_publishers [INFERRED 0.95]
- **All marketing-facing pages funnel into the contact/quote form** — index_homepage, about_page, services_page, publishing_service, editing_service, ghostwriting_service, design_service, formatting_service, marketing_service, faq_page, portfolios_page, testimonial_page, blog_book_cover_design_cost, blog_top_publishers [INFERRED 0.95]
- **Site chrome (header + navbar + footer)** — header_php, navbar_php, footer_php [INFERRED 0.95]
- **Conversion flow (hero -> cta -> contact)** — hero_php, cta_php, contact_section_php [INFERRED 0.85]
- **Publishing offering (genres + other-services + distribution)** — genres_php, other_services_php, distribution_php [INFERRED 0.75]
- **Trust signal components** — testimonials_php, stats_php, why_choose_php [INFERRED 0.95]
- **Lead-capture conversion forms system** — contact_form_php, quote_card_php, manuscript_popup_php, newsletter_php [INFERRED 0.95]
- **Informational / educational surfaces** — process_php, top_categories_php, why_choose_php [INFERRED 0.85]

## Communities (55 total, 2 thin omitted)

### Community 0 - "Site Config & Brand Constants"
Cohesion: 0.1
Nodes (40): about-snippet.php (Home About section), achievements.php (Awards/Stats section), ADDRESS constant, ASSETS_URL / IMG_URL / CSS_URL / JS_URL constants, Brand Color constants (BRAND_PRIMARY etc.), BRAND_NAME constant, BRAND_SITE_URL constant, EMAIL_ADDRESS constant (+32 more)

### Community 1 - "Page Routes & Templates"
Cohesion: 0.25
Nodes (24): About Us Page, Blog: Book Cover Design Cost in Europe, Blog Index, Long-form Blog Post Template (banner + feature card + body + post FAQ), Blog: Top 10 Book Publishers in Europe, Contact/Quote Conversion Funnel (contact.php#submit), Contact Us Page, Book Cover Design Service Page (+16 more)

### Community 2 - "Lead Capture Forms"
Cohesion: 0.15
Nodes (18): Lead Capture / Conversion Forms (concept), Service Surfacing (concept), Contact form action="#" method=POST, Contact form fields (first_name, last_name, email, phone, service, message), Contact Form (.contact-form), Global manuscript popup controller, #popupClose close button, #popupForm submission form (+10 more)

### Community 3 - "Frontend Animations & Libraries"
Cohesion: 0.14
Nodes (18): AOS library (animate-on-scroll), jQuery, Owl Carousel (jQuery plugin), Main JS (assets/js/main.js IIFE), AOS animations init, Desktop dropdown menus, Header shrink on scroll, Magnetic buttons (.magnetic) (+10 more)

### Community 4 - "Trust Signals & Editorial Process"
Cohesion: 0.14
Nodes (14): Informational / Educational Surfaces (concept), Trust Signals (concept), Count-up IntersectionObserver, Process / Editorial Journey section, $steps four-stage editorial journey, .count-up data-target markup, $stats array (800+ books, 25+ countries, 4.9 rating, 150+ authors), Stats Section (By the Numbers) (+6 more)

### Community 5 - "PHP Helper Functions"
Cohesion: 0.21
Nodes (5): activeIf(), getCurrentPage(), getMeta(), isActive(), navIsActiveTree()

### Community 6 - "Portfolio Data & Crawler Directives"
Cohesion: 0.2
Nodes (11): amazonCoverFromLink() helper, $portfolioItems book catalog, portfolio-data.php (referenced data source), $portfolioTabs genre tab list, Portfolio Slider (home page), Allow: /, Disallow: /admin/, Disallow: /config/ (+3 more)

## Knowledge Gaps
- **42 isolated node(s):** `BRAND_NAME constant`, `BRAND_SITE_URL constant`, `SOCIAL_INSTAGRAM constant`, `SOCIAL_LINKEDIN constant`, `SOCIAL_TWITTER constant` (+37 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **2 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Portfolio Slider (home page)` connect `Portfolio Data & Crawler Directives` to `Frontend Animations & Libraries`?**
  _High betweenness centrality (0.156) - this node is a cross-community bridge._
- **Why does `Owl carousel .portfolio-slider` connect `Frontend Animations & Libraries` to `Portfolio Data & Crawler Directives`?**
  _High betweenness centrality (0.140) - this node is a cross-community bridge._
- **Why does `portfolio-data.php (referenced data source)` connect `Portfolio Data & Crawler Directives` to `Site Config & Brand Constants`?**
  _High betweenness centrality (0.138) - this node is a cross-community bridge._
- **Are the 3 inferred relationships involving `footer.php (Site footer)` (e.g. with `navbar.php (Primary + mobile nav)` and `header.php (Document head + SEO + body open)`) actually correct?**
  _`footer.php (Site footer)` has 3 INFERRED edges - model-reasoned connections that need verification._
- **What connects `BRAND_NAME constant`, `BRAND_SITE_URL constant`, `SOCIAL_INSTAGRAM constant` to the rest of the system?**
  _42 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Site Config & Brand Constants` be split into smaller, more focused modules?**
  _Cohesion score 0.1 - nodes in this community are weakly interconnected._
- **Should `Frontend Animations & Libraries` be split into smaller, more focused modules?**
  _Cohesion score 0.14 - nodes in this community are weakly interconnected._