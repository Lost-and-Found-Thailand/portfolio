# Liam Digital Marketing — WordPress Theme

A custom WordPress theme that wraps the static portfolio site (the
`site/` folder at the root of this repo) so it can run on WordPress
core with no page builder or plugin dependency. All visual design,
CSS and JS is carried over as-is — this theme only adds the templating
layer WordPress needs.

## What this is (and isn't)

- **Is:** a classic PHP template theme (`header.php` / `footer.php` /
  per-page templates), using only WordPress core APIs. No Elementor,
  no page-builder markup, no third-party form plugin.
- **Isn't:** an Elementor theme, a block theme, or a drag-and-drop
  editable layout. Content changes (copy, images, case studies) are
  made by editing the PHP templates directly, the same way the
  original static HTML was edited. This was a deliberate trade-off —
  see "Why not Elementor" below.

## Requirements

- WordPress 6.0+
- PHP 7.4+
- No plugins required. The contact form uses WordPress core
  (`admin-post.php` + `wp_mail()`) instead of a forms plugin.

## Installation

1. Copy this folder (`wordpress-theme/liam-digital-marketing/`) into
   your WordPress install's `wp-content/themes/` directory, keeping
   the folder name `liam-digital-marketing`.
2. In **wp-admin → Appearance → Themes**, activate **Liam Digital
   Marketing**.
3. In **wp-admin → Settings → Permalinks**, choose any pretty
   permalink structure (e.g. "Post name"). The nav and footer links
   are built with `home_url('/slug/')`, which needs pretty permalinks
   to resolve to a real page.

## Required Pages setup

This theme relies on WordPress's built-in convention that a Page with
slug `{slug}` automatically uses `page-{slug}.php` if that file exists
in the theme — no manual "Page Attributes → Template" selection
needed. Create these five Pages in **wp-admin → Pages → Add New**,
each with the exact slug shown (the title can be anything; the slug
is what matters):

| Page title (suggested) | Slug         | Template used         |
|-------------------------|--------------|------------------------|
| Home                    | (front page) | `front-page.php`       |
| About                   | `about`      | `page-about.php`       |
| Skills                  | `skills`     | `page-skills.php`      |
| Work                    | `work`       | `page-work.php`        |
| Contact                 | `contact`    | `page-contact.php`     |
| Tirtha Bali Case Study  | `case-study` | `page-case-study.php`  |

The Page content field itself can be left blank — every template
renders its own hard-coded content, the same way the static HTML
files did. WordPress's editor content is not used.

### Setting the homepage

By default WordPress shows a reverse-chronological blog on `/`.
For `front-page.php` to be used instead:

1. Go to **Settings → Reading**.
2. Set "Your homepage displays" to **A static page**.
3. Set "Homepage" to the **Home** page you created above.

### Any other Page (or a 404 / search result)

Falls back to `index.php`, a plain template — this theme doesn't
expect Pages beyond the five above, so it isn't styled to match the
custom designs.

## Contact form

`page-contact.php` posts to `admin-post.php` (WordPress's standard
mechanism for handling a custom form submission without a plugin).
The handler lives in `inc/contact-form.php`:

- Verifies a nonce, sanitizes every field, and requires name + a
  valid email + message.
- Sends the enquiry via `wp_mail()` to the site's admin email
  (**Settings → General → Administration Email Address**) by default.
- Redirects back to the Contact page with `?ldm_contact=success` or
  `?ldm_contact=error`, which `page-contact.php` reads to show a
  confirmation or an error message in place of the form.

To send enquiries to a different address than the WordPress admin
email, add this to a child theme or a small must-use plugin rather
than editing the parent theme:

```php
add_filter( 'ldm_contact_form_recipient', function () {
    return 'liam.digitalmarketing.ads@gmail.com';
} );
```

`wp_mail()` uses PHP's `mail()` by default, which many hosts block or
mark as spam. For reliable delivery, install an SMTP plugin (e.g. WP
Mail SMTP) configured against a real mailbox/transactional provider —
this is a hosting-level concern, not something the theme can fix.

## Editing content

There's no visual editor for this theme's page content — each
`page-{slug}.php` (and `front-page.php`) is plain PHP + HTML mirroring
the original static site markup. To change copy, swap an image, or
add a case study/client logo, edit the relevant template directly:

- `front-page.php` — homepage (hero, results, services teaser, etc.)
- `page-about.php`, `page-skills.php`, `page-work.php`,
  `page-contact.php`, `page-case-study.php` — one per page
- `inc/template-helpers.php` — shared contact-info constants/icons,
  plus the `ldm_render_client_groups()` helper `page-work.php` uses
  for its 53-logo client grid (edit the arrays passed into it there
  rather than the helper itself)
- `header.php` / `footer.php` — nav, mobile menu, footer columns
  (shared by every page)

## Assets

`assets/main.css`, `assets/main.js`, `assets/brand-kit/` and
`assets/img/` are the same files from `site/assets/` and
`brand-kit/` in the static build, loaded via `wp_enqueue_style()` /
`wp_enqueue_script()` in `inc/enqueue.php` (rather than the static
site's `<link>`/`<script>` tags) so WordPress can version and
dependency-chain them correctly. If you update the static site later,
copy the changed files into this theme's `assets/` folder to keep
them in sync — there is currently no automated link between the two.

## Why not Elementor

Elementor stores page layout as JSON page-builder data, not plain
HTML/CSS — porting this design in would mean rebuilding every section
as Elementor widgets and losing the hand-tuned CSS (scroll-driven
animations, the story rail, the growth-ring counters, the concept
network canvas) that doesn't map to Elementor's widget model without
custom widget development. This theme instead keeps the exact
existing HTML/CSS/JS and only adds the minimal PHP templating layer
needed to serve it from WordPress. The trade-off: content edits are
made in code (a template file), not a drag-and-drop editor.

## Testing limitations

This theme has been checked with `php -l` (PHP syntax lint) on every
file, and manually reviewed against WordPress template/hook
conventions. There is **no live WordPress + MySQL environment
available in this environment**, so it has not been installed and
exercised end-to-end (activating it, creating the Pages above,
submitting the contact form against a real mail transport, etc.).
Before going live, test on a staging WordPress install:

- Activate the theme and confirm all six pages render without PHP
  warnings/notices (enable `WP_DEBUG` on staging to catch any).
- Create the Pages/slugs above and confirm each loads its intended
  template (check page source or Query Monitor's template tab).
- Submit the contact form and confirm both the success message and
  an actual email arrival (test with a deliberately invalid email to
  confirm the error path too).
- Click through the nav, mobile menu, and every footer/CTA link.
