# Liam Digital Marketing — Brand Kit & Website Design System

A premium, monochrome (+ lime-accent) brand system and portfolio website for **Liam Digital Marketing**, built around the existing LM logo. This repo contains two things:

1. **A working static prototype** (`/site`) — the full design, copy, layout, animation and responsive behavior, viewable in any browser with no build step.
2. **A WordPress/Elementor import package** (`/elementor`) — a Global Kit (colors + typography) and page/section templates built from real Elementor widgets, so the same design can be reproduced in Elementor without hand-coding.

```
brand-kit/            Design tokens, logo assets, style reference
  tokens.css           CSS variables + base component classes (source of truth for the design system)
  logo/                Logo lockups, monogram mark, favicon (SVG)
site/                 Static HTML/CSS/JS prototype (open directly in a browser)
  index.html, work.html, services.html, about.html, contact.html, case-study.html
  assets/main.css      Site-level component styles (nav, hero, cards, footer, etc.)
  assets/main.js       Sticky nav, mobile menu, scroll-reveal, animated counters
elementor/            WordPress/Elementor import package
  kit/                 Global Kit — colors, typography, button styles
  templates/           Elementor page/section templates (JSON)
```

## ⚠️ Before you go live

- **Logo:** `brand-kit/logo/*.svg` is a clean, on-brand **placeholder mark** built to match the structure described in the brief (LM monogram + "Liam Digital" / "MARKETING" wordmark). It is *not* a vector trace of the original file — I can't extract exact vector paths from a flattened image. Export the real logo from its original source file (AI/EPS/SVG) at `brand-kit/logo/` using the same filenames so every reference in the site and Elementor templates updates automatically.
- **Metrics:** Every stat (`+XX% ROAS`, `XXX+ Leads`, etc.) is a labeled placeholder ("sample data, replace with real results"). Swap in real numbers before launch — the brief explicitly says not to invent figures.
- **Case studies:** One example case study (Tirtha Bali) is filled in from the brief; the others are structural placeholders. Duplicate the pattern once real client work/photography is available.
- **Images:** Unsplash stock photography is used as a stand-in for real campaign screenshots and photography. Replace with actual creative/campaign assets.

## 1. Preview the static prototype

No build tools required.

```bash
cd site
python3 -m http.server 8080
# open http://localhost:8080
```

This is the design reference — use it to sanity-check colors, spacing, type scale and motion before rebuilding in Elementor, or ship it as-is on any static host.

## 2. Set up WordPress + Elementor

### Requirements
- WordPress 6.x
- **Elementor** (free) — the templates below use only free-tier widgets (Heading, Text Editor, Button, Spacer, Divider, Image, Image Box, Counter, Icon List). **Elementor Pro** is recommended for Theme Builder (to make the header/footer templates global across the site) but isn't required for the Home page template.
- A lightweight base theme: **Hello Elementor** (recommended, ships blank) or **Astra**.

### Step 1 — Fonts
Elementor's typography controls include Google Fonts natively — no plugin needed. The kit already references **Manrope** (display/headings) and **Inter** (body/UI) by name; Elementor will load them automatically once the kit's typography settings are applied.

### Step 2 — Import the Global Kit (colors + typography + buttons)
`elementor/kit/manifest.json` + `elementor/kit/site-settings.json` are a best-effort Elementor Kit export (colors, typography, button/theme styles). Elementor's Kit importer expects a single `.zip` containing both files at its root:

1. Zip the two files together (they must sit at the root of the archive, not inside a subfolder): `cd elementor/kit && zip liam-digital-kit.zip manifest.json site-settings.json`.
2. In wp-admin: **Templates → Kit Library → Import Kit** (or **Elementor → Tools → Import Kit** on older versions).
3. Upload the zip, select **Settings only**, and import.
4. Check **Site Settings → Global Colors** and **Global Fonts** — you should see the Obsidian Black / Pure White / Soft White / Neutral Gray / Dark Gray / Accent Lime palette and the Manrope/Inter type scale.

Kit file formats vary slightly between Elementor versions, so if the import doesn't fully apply, set it up manually in ~5 minutes — it's the guaranteed path:

**Global Colors** (Site Settings → Global Colors → Add):
| Name | Hex |
|---|---|
| Obsidian Black | `#020201` |
| Pure Black | `#000000` |
| Pure White | `#FFFFFF` |
| Soft White | `#F5F5F5` |
| Neutral Gray | `#A1A1A1` |
| Dark Gray | `#171717` |
| Accent Lime | `#C8FF00` |

**Global Fonts** (Site Settings → Global Fonts):
| Name | Family | Weight |
|---|---|---|
| Hero / H1 | Manrope | 800 |
| H2 / H3 / H4 | Manrope | 700 |
| Body | Inter | 400 |
| Labels / Buttons | Inter | 600 |

**Theme Style → Buttons:** white background, black text, `10px` radius, `16px/32px` padding, hover → black background / white text / white border (see `brand-kit/tokens.css` `.btn-primary`/`.btn-secondary` for exact values, or `elementor/kit/site-settings.json` for the raw values used to build the zip).

**Site Settings → Layout:** Content width `1280px`, widgets space `20px`.

### Step 3 — Load the design tokens as Custom CSS
Paste the full contents of `brand-kit/tokens.css` into **Elementor → Site Settings → Custom CSS** (or your theme's Additional CSS). This gives you the same CSS variables, spacing scale and motion/reduced-motion handling used in the static prototype, so any HTML widgets or custom classes you add stay on-system.

### Step 4 — Import page templates
`elementor/templates/` contains individually importable Elementor templates (Templates → Saved Templates → Import Templates):

| File | Type | Use |
|---|---|---|
| `home-page.json` | Page | Full homepage: hero, metrics, selected work, services, process, about teaser, contact CTA |
| `global-header.json` | Header | Sticky nav — logo, Work/Services/About/Results/Contact, "Let's Talk" CTA |
| `global-footer.json` | Footer | Logo, tagline, nav columns, copyright |
| `section-services.json` | Section | Standalone "What I Do" block — drop into the Services page for more depth |
| `section-process.json` | Section | Standalone 4-step process block |
| `section-contact-cta.json` | Section | Standalone "Let's Build Something That Performs" CTA — reuse on Services/About/Work pages |

Import order: Global Kit → `global-header.json` / `global-footer.json` (assign via **Elementor → Theme Builder → Header/Footer**, condition: *Entire Site*) → `home-page.json` onto your front page.

**Widget notes:**
- The header/footer templates place an empty **Image** widget where the logo goes — replace it with your real `brand-kit/logo/logo-lockup-white.svg` (uploaded to the Media Library) or swap it for Elementor's native **Site Logo** widget.
- The nav links and footer link columns import as **Icon List** widgets (plain text placeholders) — swap for Elementor Pro's **Nav Menu** widget wired to a real WordPress menu once you're editing live, or hand-link each item.
- Counter widgets on the metrics/results sections start at the placeholder numbers from the brief — update `ending_number` per widget once real data is available.

### Step 5 — Build the remaining pages
Use `home-page.json`'s sections as the pattern language (same column widths, padding, border/gap treatment) to assemble **Work**, **Services**, **About**, and **Contact** pages, referencing `site/work.html`, `site/services.html`, `site/about.html`, `site/contact.html` for copy and structure. For the Contact page, use Elementor Pro's **Form** widget (or WPForms/Fluent Forms) styled with the dark input treatment from `site/assets/main.css` (`.ldm-form` rules) instead of the static HTML `<form>` in the prototype.

For case studies, create a **Custom Post Type** ("Case Study") — via a lightweight plugin like **Custom Post Type UI** + **Advanced Custom Fields** (fields: Client, Industry, Objective, Strategy, Channels, Results, Key Metrics) — and build one Elementor **Single** template (Theme Builder → Single Post) using dynamic tags, so every case study you publish inherits the same premium layout automatically instead of manually duplicating pages.

### Step 6 — SEO & performance
- Install **Yoast SEO** or **Rank Math**; each page already has a clear single `<h1>` and logical heading order to map to.
- Serve images as WebP/AVIF (most SEO/media plugins or the **WP Rewrite/EWWW/ShortPixel** family handle this) and keep `loading="lazy"` on below-the-fold images, as in the prototype.
- Avoid extra animation/carousel plugins — the brief calls for restrained motion; Elementor's native scroll-effects and entrance animations (with **Reduce Motion** respected via `prefers-reduced-motion`, already handled in `tokens.css`) are enough.

## 3. Design tokens reference

See `brand-kit/tokens.css` for the full source of truth (colors, type scale, spacing, radius, motion). Summary:

- **Colors:** Obsidian Black `#020201` (primary bg), Pure Black `#000000`, Pure White `#FFFFFF` (primary text), Soft White `#F5F5F5`, Neutral Gray `#A1A1A1`, Dark Gray `#171717`, Accent Lime `#C8FF00` (sparing use only — hover states, small metrics, selected nav).
- **Type:** Manrope 700–800 for display/headings, Inter 400–600 for body/UI.
- **Radius:** 8px buttons/inputs, 12–16px cards/images.
- **Container:** max-width 1280px, 64px desktop / 20–24px mobile side padding.
- **Motion:** 300–700ms, premium easing, `prefers-reduced-motion` respected everywhere.

## 4. Accessibility & performance notes

- All interactive elements are keyboard-reachable; the mobile menu traps focus visually and closes on link activation.
- Color contrast: body copy uses Soft White/Neutral Gray on Obsidian Black, meeting WCAG AA for normal text; the lime accent is used only for large numerals/labels, not body copy, to avoid contrast issues.
- Motion is disabled site-wide under `prefers-reduced-motion: reduce`.
- No JS frameworks — the prototype is vanilla HTML/CSS/JS to keep payload minimal; Elementor's own runtime handles this on the WordPress build.
