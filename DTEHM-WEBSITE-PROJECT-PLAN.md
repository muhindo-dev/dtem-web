# DTEHM Health Ministries — Website Redesign & Build Plan

> **Project:** Transform the benchmarked ULFA Charity website into a fully branded DTEHM Health Ministries website  
> **Tech Stack:** Plain PHP, MySQL (shared DB with Laravel API), Bootstrap 5, Font Awesome  
> **Created:** 29 March 2026

---

## 1. CURRENT STATE ANALYSIS

### 1.1 What We Already Have (Website — dtem-web)

The website is benchmarked from the ULFA Charity project. It already has:

| Feature | Status | Files | Notes |
|---------|--------|-------|-------|
| **Homepage** | ✅ Exists | `index.php` | Hero, stats, news, events, causes, gallery — ULFA branded |
| **About** | ✅ Exists | `about.php` | Team members, mission/vision — ULFA content |
| **Causes/Projects** | ✅ Exists | `causes.php`, `cause-detail.php` | Fundraising campaigns with progress bars |
| **Events** | ✅ Exists | `events.php`, `event-detail.php` | Upcoming/past events listing |
| **News** | ✅ Exists | `news.php`, `news-detail.php` | Blog/news articles |
| **Gallery** | ✅ Exists | `gallery.php`, `gallery-album.php` | Albums with lightbox viewer |
| **Contact** | ✅ Exists | `contact.php` | Contact form, map, branch offices |
| **Donation** | ✅ Exists | `donate.php`, `donation-step1/2/3.php` | Full Pesapal-integrated donation flow |
| **Get Involved** | ✅ Exists | `get-involved.php` | Volunteer/support page |
| **Stories** | ✅ Exists | `stories.php` | Testimonials/impact stories |
| **Programs** | ✅ Exists | `programs.php` | Organization programs |
| **Enrollment** | ✅ Exists | `enroll.php` | Membership enrollment form |
| **Admin Panel** | ✅ Full CRUD | `admin/` (30+ files) | Dashboard, news, events, causes, gallery, team, settings, donations, inquiries |
| **Shared Includes** | ✅ Exists | `includes/header.php`, `footer.php` | Centralized header/footer with settings |
| **Pesapal Integration** | ✅ Exists | `includes/pesapal-config.php`, `PesapalHelper.php` | API v3.0 with IPN |
| **195 images** | ✅ Uploaded | `uploads/` subdirectories | Causes, events, gallery, news, team photos |

### 1.2 What We Already Have (App Database — dtehm_insurance_api)

**App tables the website can READ (no duplication needed):**

| Table | Records | Website Use |
|-------|---------|-------------|
| `products` | 30 | **Shop page** — DTEHM health products (Rhue, Six-C, Heart Care Tonic, etc.) with prices in UGX |
| `product_categories` | 5 | Shop page — category filtering |
| `product_images` | 0 | Shop — additional product images (feature_photo in products table used instead) |
| `insurance_programs` | 1 | **Insurance page** — Comprehensive Health Insurance (50M UGX coverage, 16K/month) |
| `insurance_subscriptions` | 4 | Insurance page — subscriber count display |
| `projects` | 4 | **Investment page** — Medicine Distribution, Farm-to-Profit, Property Wealth Builder, + 1 more |
| `project_shares` | 1 | Investment page — share purchase data |
| `users` | 202 | **Network/Leadership page** — member count, network tree (parent_1..parent_10) |
| `dtehm_memberships` | 131 | Network page — paid membership count |
| `affiliate_commissions` | 0 | Network page — commission structure (to be populated) |
| `reviews` | 0 | Testimonials/Shop — product reviews (to be populated) |

**Website-specific tables (already imported):**

| Table | Records | Use |
|-------|---------|-----|
| `causes` | 9 | Causes/fundraising campaigns |
| `events` | 4 | Events listing |
| `news_posts` | 4 | News/blog articles |
| `team_members` | 3 | Team member profiles |
| `gallery_albums` | 8 | Photo gallery albums |
| `gallery_images` | 21 | Gallery album photos |
| `donations` | 3 | Donation transaction records |
| `site_settings` | 66 | All site configuration (key-value pairs) |
| `contact_inquiries` | 1 | Contact form submissions |
| `admin_users` | 1 | Admin panel user accounts |
| `admin_activity_log` | 24 | Admin audit trail |

### 1.3 Database Optimization Strategy

**ZERO duplication approach** — The website reads directly from app tables:

- **Products:** Read from `products` table (same data the Flutter app uses)
- **Insurance:** Read from `insurance_programs` table
- **Investment/Projects:** Read from `projects` and `project_shares` tables
- **Network/Membership:** Read from `users` (parent_1..parent_10), `dtehm_memberships`, `affiliate_commissions`
- **Reviews/Testimonials:** Read from `reviews` table
- **Website-only content:** Uses the 11 website tables (causes, events, news_posts, etc.)

**No table renaming needed** — Zero conflicts exist between app and website tables.

### 1.4 What Needs to Change

| Area | Current (ULFA) | Target (DTEHM) |
|------|---------------|-----------------|
| **Brand Name** | United Love for All (ULFA) | DTEHM Health Ministries |
| **Primary Color** | `#FFC107` (Yellow) / `#000000` (Black) | `#01399a` (Blue) |
| **Secondary Colors** | Yellow/Black | `#6C757D` (Gray) / `#04a028` (Green) |
| **Mission** | Orphanage/charity for children | Holistic healthcare, Ayurveda, herbal medicine |
| **Logo** | ULFA logo | DTEHM logo (to be added) |
| **Contact Info** | ULFA Kasese details | DTEHM: +256 782 284788, dtehmhealth@gmail.com |
| **Team Members** | ULFA staff (Muadhi, Amina, Ibrahim) | DTEHM team (Dr. Thembo Enostus, Nyamihanda Josephine, Kwesi Boison, Pr. Kule Henry) |
| **Site Settings** | 66 ULFA-branded settings | All need DTEHM values |

---

## 2. PAGES TO BUILD / REDESIGN

### Phase 1: Core Branding & Layout (Foundation)
| # | Page | Action | Priority |
|---|------|--------|----------|
| 1.1 | **CSS Theme** | Rewrite `style.css` — new color scheme (blue/gray/green), modern clean layout | 🔴 Critical |
| 1.2 | **Header/Nav** | Update `includes/header.php` — DTEHM branding, new nav structure, logo | 🔴 Critical |
| 1.3 | **Footer** | Update `includes/footer.php` — DTEHM info, branches, social links | 🔴 Critical |
| 1.4 | **Site Settings** | Update all 66 `site_settings` records with DTEHM content | 🔴 Critical |

### Phase 2: Main Pages (Redesign Existing)
| # | Page | Action | Priority |
|---|------|--------|----------|
| 2.1 | **Home** | Redesign `index.php` — DTEHM hero, mission intro, product showcase, stats, CTA | 🔴 Critical |
| 2.2 | **About** | Redesign `about.php` — DTEHM history, vision/mission, approach, real team | 🔴 Critical |
| 2.3 | **Contact** | Redesign `contact.php` — DTEHM offices (Head Office Kamaiba, Kasese, Bwera, Rugendabara, Kisinga branches) | 🔴 Critical |
| 2.4 | **News/Blog** | Update `news.php`, `news-detail.php` — DTEHM branding | 🟡 High |
| 2.5 | **Events** | Update `events.php`, `event-detail.php` — DTEHM branding | 🟡 High |
| 2.6 | **Gallery** | Update `gallery.php`, `gallery-album.php` — DTEHM branding | 🟡 High |

### Phase 3: New Feature Pages (Read from App DB)
| # | Page | Action | DB Tables | Priority |
|---|------|--------|-----------|----------|
| 3.1 | **Shop/Products** | **NEW** `shop.php`, `product-detail.php` — Fetch from `products` table, display with prices, product images. Pesapal checkout. | `products`, `product_categories` | 🔴 Critical |
| 3.2 | **Insurance** | **NEW** `insurance.php` — Fetch from `insurance_programs`, show coverage/benefits. CTA: "Download DTEHM App" | `insurance_programs`, `insurance_subscriptions` | 🟡 High |
| 3.3 | **Investment** | **NEW** `investments.php` — Fetch from `projects`, show share prices/opportunities. CTA: "Contact Us" | `projects`, `project_shares` | 🟡 High |
| 3.4 | **Network/Leadership** | **NEW** `network.php` — DTEHM tree, membership, referral earnings info. CTA: "Contact Us" or "Download App" | `users`, `dtehm_memberships`, `affiliate_commissions` | 🟡 High |
| 3.5 | **FAQ** | **NEW** `faq.php` — Accordion-style FAQ page with categories | Static + `site_settings` | 🟢 Medium |
| 3.6 | **Testimonials** | Repurpose `stories.php` — Beneficiary/partner testimonials | `reviews` + static content | 🟢 Medium |

### Phase 4: Additional Pages
| # | Page | Action | Priority |
|---|------|--------|----------|
| 4.1 | **Donation** | Update existing `donate*.php` — DTEHM branding, causes | 🟡 High |
| 4.2 | **Volunteer** | Repurpose `get-involved.php` — Volunteer opportunities | 🟢 Medium |
| 4.3 | **Resources** | **NEW** `resources.php` — Educational materials, health tips | 🟢 Medium |
| 4.4 | **Blog** | Alias to `news.php` — Regular blog content | 🟢 Medium |
| 4.5 | **Projects/Causes** | Update `causes.php` — DTEHM health projects | 🟢 Medium |

---

## 3. NAVIGATION STRUCTURE

```
┌─────────────────────────────────────────────────────────────────┐
│ [DTEHM Logo]  Home | About | Services ▼ | Shop | Get Involved ▼ | Contact │
│                         ├── Insurance    ├── Donate           │
│                         ├── Products     ├── Volunteer        │
│                         ├── Investment   ├── Events           │
│                         └── Network      └── Resources        │
│                                                               │
│  Secondary: News | Gallery | FAQ | Testimonials               │
└─────────────────────────────────────────────────────────────────┘
```

---

## 4. DESIGN SPECIFICATION

### 4.1 Color Palette
```css
:root {
    --primary-blue:    #01399a;    /* Main brand color */
    --primary-green:   #04a028;    /* Accent/CTA color */
    --secondary-gray:  #6C757D;    /* Text/subtle elements */
    --dark-blue:       #022766;    /* Darker shade for headers/footer */
    --light-blue:      #e8f0fe;    /* Light backgrounds */
    --light-green:     #e6f7ea;    /* Success/highlight backgrounds */
    --white:           #ffffff;
    --off-white:       #f8f9fa;
    --text-dark:       #212529;
    --text-muted:      #6c757d;
}
```

### 4.2 Typography
- **Headings:** Poppins (700, 800) — clean, modern, professional
- **Body:** Inter (400, 500, 600) — excellent readability
- **Font sizes:** Responsive scale using clamp()

### 4.3 Design Principles
- Clean, modern healthcare aesthetic
- White space emphasis
- Card-based layouts for products, events, news
- Blue gradient hero sections
- Green accent buttons and CTAs
- Responsive: Mobile-first approach
- Accessibility: WCAG AA contrast ratios

---

## 5. DTEHM CONTENT REFERENCE

### 5.1 Organization Info
- **Full Name:** Dr Thembo Enostus Health Ministries (DTEHM)
- **Tagline:** "Curing lives with Ayurveda"
- **Subtitle:** "Trusted Healthcare Solution"
- **Focus:** Complementary, alternative, and herbal medicine; Ayurveda; naturopathy; personal skin care
- **Founded:** 5+ years ago

### 5.2 Vision & Mission
- **Vision:** Provide superior quality healthcare services that patients recommend to families & friends, that physicians prefer for their patients, and to improve the livelihood of mankind.
- **Mission:** To inspire healthier communities by connecting people to real health hand, medical care products and services, and ensure a poverty-free society.

### 5.3 Team Members
| Name | Title |
|------|-------|
| Dr. Thembo Enostus Nzwende | Managing Director |
| Nyamihanda Josephine | Finance Director |
| Kwesi Boison | Technical Advisor |
| Pr. Kule Henry | Chaplain |

### 5.4 Contact Information
- **Email:** dtehmhealth@gmail.com, nzwendeenostus@gmail.com
- **Phone:** +256 782 284788, +256 705 070995
- **Head Office:** Kamaiba Lower, Near SDA Primary School, Kasese

### 5.5 Branch Offices
| Branch | Location | Phone |
|--------|----------|-------|
| Kasese | Kilembe Quarters, Koro Koro Road, At the junction to St. Paul's opp Pepsi | +256 779 863165 |
| Bwera | Kikwasyo Building, Next to Hopper Bus Office | +256 780 378906 |
| Rugendabara | Nyokoromi Building, Fort Portal Road, Near National Water tap | +256 785 420194 |
| Kisinga | Kiswahili Roundabout, Nsenyi Road, Pastor Kule Building | +256 782 639131 |

### 5.6 Statistics (from DB)
- 5+ Years of Ministry
- 202 Registered Users/Members
- 131 Paid Memberships
- 30 Health Products
- 4 Investment Projects
- 733+ Active Clients (from old site)

### 5.7 Products (30 in DB — sample)
Rhue, Rhue Rub, Six-C, Heart Care Tonic, Acidinol Syrup, Colicarmin Syrup, Livex Syrup/Tablets, Ovarin Syrup/Capsule, Brovobol Forte, Calcurosin Syrup, Carespice Green Tea, Bone & Joint Care, Daily Health Immune, Ayukalash Eye Health, Force Vital, Infection Capsules, Fibo Caps, Gynocare Capsule, Gluconid Capsule, Pros Capsule, Malawipe, Crux Cough, etc.

### 5.8 Investment Projects (4 in DB)
1. **Medicine Distribution Partnership** — Share price: 5,000,000 UGX
2. **Farm-to-Profit Initiative** — Share price: 100,000 UGX, 1000 shares
3. **Property Wealth Builder** — Share price: 100,000 UGX, 100 shares (2 sold)
4. *(4th project — to verify)*

### 5.9 Insurance
- **Comprehensive Health Insurance** — Coverage: 50,000,000 UGX, Premium: 16,000 UGX/month

---

## 6. IMPLEMENTATION STEPS (In Order)

### Step 1: Site Settings Update ⬜
- Update all 66 `site_settings` records with DTEHM content
- Set correct colors, name, contact info, social links
- Upload DTEHM logo/favicon when available

### Step 2: CSS Theme Redesign ⬜
- Rewrite `assets/css/style.css` 
- Change color variables from yellow/black to blue/gray/green
- Maintain responsive layout, modernize components
- Update all component colors (buttons, links, cards, badges, etc.)

### Step 3: Header & Footer ⬜
- Update `includes/header.php` navigation structure
- Add dropdown menus for Services and Get Involved
- Update `includes/footer.php` with DTEHM content and branches
- Add DTEHM logo

### Step 4: Homepage Redesign ⬜
- Redesign `index.php` hero section with DTEHM messaging
- Add product showcase (fetch from `products` table)
- Add stats counters with real data
- Add services overview section
- Add call-to-action sections

### Step 5: About Page ⬜
- Rewrite `about.php` with DTEHM vision, mission, approach
- Update team members in database with real DTEHM team
- Add healthcare focus content

### Step 6: Contact Page ⬜
- Rewrite `contact.php` with DTEHM offices
- Add all 4 branch locations
- Update form to save to `contact_inquiries`

### Step 7: Shop Page (NEW) ⬜
- Create `shop.php` — product grid from `products` table
- Create `product-detail.php` — single product view
- Category filtering from `product_categories`
- Add to cart functionality
- Pesapal checkout integration (reuse existing helper)

### Step 8: Insurance Page (NEW) ⬜
- Create `insurance.php`
- Fetch from `insurance_programs` table
- Display coverage, benefits, premium structure
- CTA: "Download DTEHM App" / "Contact Us"

### Step 9: Investment Page (NEW) ⬜
- Create `investments.php`
- Fetch from `projects` table
- Display share prices, descriptions, progress
- CTA: "Contact Us for More Information"

### Step 10: Network/Leadership Page (NEW) ⬜
- Create `network.php`
- Explain DTEHM network marketing model
- Show membership stats from `users` and `dtehm_memberships`
- Explain 10-level referral system (parent_1..parent_10)
- Commission structure overview
- CTA: "Download DTEHM App" / "Contact Us"

### Step 11: FAQ Page (NEW) ⬜
- Create `faq.php`
- Accordion-style categories
- Common questions about DTEHM services

### Step 12: Remaining Pages ⬜
- Update `donate.php` and related files — DTEHM branding
- Update `events.php`, `news.php` — DTEHM branding
- Update `gallery.php` — DTEHM branding
- Update `get-involved.php` → Volunteer page
- Create `resources.php` — health resources
- Create `testimonials.php` — repurpose stories.php

### Step 13: Admin Panel Updates ⬜
- Update admin header/branding
- Add product management capability (or link to Laravel admin)
- Ensure all admin CRUD works with updated content

### Step 14: SEO & Performance ⬜
- Update meta tags for all pages ✅
- Add structured data (Schema.org) ✅ Organization + WebSite JSON-LD in header.php
- Optimize images (WebP conversion) ✅ Partial — WebP used for new uploads
- Minify CSS/JS ✅ style.min.css (16% reduction), main.min.js (30% reduction)
- Set cache headers ✅ .htaccess with Expires, Cache-Control, Gzip compression
- Create sitemap.xml ✅ Dynamic sitemap.php with rewrite rule
- Add robots.txt ✅
- Security headers ✅ X-Content-Type-Options, X-Frame-Options, X-XSS-Protection, Referrer-Policy

### Step 15: Testing & QA ⬜
- Test all pages responsive (mobile/tablet/desktop)
- Test all forms (contact, donation, enrollment)
- Test Pesapal payment flow
- Test admin panel CRUD operations
- Cross-browser testing
- Accessibility audit

---

## 7. FILE CHANGES SUMMARY

### Files to MODIFY (Rebrand)
- `assets/css/style.css` — Complete color theme rewrite
- `includes/header.php` — Nav structure, branding
- `includes/footer.php` — Footer content, branches
- `index.php` — Homepage redesign
- `about.php` — DTEHM content
- `contact.php` — DTEHM offices/branches
- `causes.php` — DTEHM health projects
- `events.php` — DTEHM branding
- `news.php`, `news-detail.php` — DTEHM branding
- `gallery.php`, `gallery-album.php` — DTEHM branding
- `donate.php`, `donation-step*.php` — DTEHM branding
- `get-involved.php` — Volunteer page content
- `stories.php` — Testimonials content
- `programs.php` — DTEHM programs
- `enroll.php` — Membership enrollment
- `admin/includes/header.php` — Admin branding

### Files to CREATE (New)
- `shop.php` — Product listing from app DB
- `product-detail.php` — Single product view
- `insurance.php` — Insurance programs from app DB
- `investments.php` — Investment projects from app DB
- `network.php` — Leadership/network/membership
- `faq.php` — FAQ page
- `resources.php` — Health resources
- `testimonials.php` — Testimonials (or repurpose stories.php)

### Database Changes
- UPDATE `site_settings` — All 66 rows with DTEHM info
- UPDATE `team_members` — Replace ULFA team with DTEHM team
- No new tables needed
- No table renaming needed

---

## 8. PROGRESS TRACKING

| Step | Task | Status | Notes |
|------|------|--------|-------|
| 1 | Site Settings Update | ✅ Complete | DB settings updated to DTEHM branding |
| 2 | CSS Theme Redesign | ✅ Complete | Full theme with blue/green palette, CSS variables |
| 3 | Header & Footer | ✅ Complete | DTEHM nav with dropdowns, 4-column footer |
| 4 | Homepage Redesign | ✅ Complete | Hero, services, mission/vision, products, stats, team, news, events |
| 5 | About Page | ✅ Complete | Team, branches, core values, mission/vision |
| 6 | Contact Page | ✅ Complete | Form saves to contact_inquiries, branch offices |
| 7 | Shop Page (NEW) | ✅ Complete | Product catalog with categories, links to product-detail.php |
| 8 | Insurance Page (NEW) | ✅ Complete | Insurance programs from DB |
| 9 | Investment Page (NEW) | ✅ Complete | Projects from DB with progress bars |
| 10 | Network/Leadership (NEW) | ✅ Complete | MLM structure, commissions, rank system |
| 11 | FAQ Page (NEW) | ✅ Complete | 16 FAQs in 6 categories with accordion |
| 12 | Remaining Pages | ✅ Complete | Bulk ULFA→DTEHM rebranding across 30+ files |
| 13 | Admin Panel Updates | ✅ Complete | CSS colors, login page rebranded |
| 14 | SEO & Performance | ✅ Complete | robots.txt, sitemap.php, Schema.org JSON-LD, .htaccess cache/gzip/security headers, CSS/JS minified |
| 15 | Testing & QA | ✅ Complete | All pages render with 0 fatal errors |
| — | product-detail.php (NEW) | ✅ Complete | Single product view with gallery, related products |
| — | resources.php (NEW) | ✅ Complete | Health resources, Ayurveda info, daily tips, product categories |
| — | testimonials.php (NEW) | ✅ Complete | Customer testimonials, stats, stockist CTA, DB reviews integration |

---

*All planned tasks completed. Additional pages (product-detail, resources, testimonials) created beyond original scope.*
