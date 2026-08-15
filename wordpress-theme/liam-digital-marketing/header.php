<?php
/**
 * Shared <head> + nav + mobile menu, used by every page template.
 *
 * Each template sets a few plain variables *before* calling
 * get_header() to carry over the static site's per-page SEO meta
 * (title/description/canonical) without pulling in a full SEO
 * plugin just to reproduce six lines the static HTML already had:
 *
 *   $ldm_meta_title       (defaults to the theme's own title)
 *   $ldm_meta_description
 *   $ldm_meta_canonical   (defaults to the current URL)
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = $ldm_meta_title ?? get_bloginfo( 'name' ) . ' | Performance Marketing & Growth Systems';
$ldm_meta_description = $ldm_meta_description ?? 'Liam Digital Marketing helps ambitious brands turn paid media, data, creative and technology into measurable business growth.';
$ldm_meta_canonical   = $ldm_meta_canonical ?? ( is_front_page() ? home_url( '/' ) : get_permalink() );
$ldm_og_image         = get_template_directory_uri() . '/assets/brand-kit/logo/logo-lockup-white.svg';
?><!doctype html>
<html lang="<?php echo esc_attr( get_bloginfo( 'language' ) ); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo esc_html( $ldm_meta_title ); ?></title>
<meta name="description" content="<?php echo esc_attr( $ldm_meta_description ); ?>">
<link rel="canonical" href="<?php echo esc_url( $ldm_meta_canonical ); ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?php echo esc_attr( $ldm_meta_title ); ?>">
<meta property="og:description" content="<?php echo esc_attr( $ldm_meta_description ); ?>">
<meta property="og:image" content="<?php echo esc_url( $ldm_og_image ); ?>">
<meta name="twitter:card" content="summary_large_image">
<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/brand-kit/logo/favicon.svg' ); ?>" type="image/svg+xml">
<?php if ( is_front_page() ) : ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "Liam Khant",
  "alternateName": "Liam Digital Marketing",
  "jobTitle": "Digital Marketing Manager",
  "description": "Digital Marketing Manager with 6+ years managing $10M+ in ad spend and scaling 100+ brands through performance marketing, marketing technology and analytics.",
  "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
  "sameAs": []
}
</script>
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'ldm' ); ?>>
<?php wp_body_open(); ?>

<header class="ldm-nav">
  <div class="container ldm-nav-inner">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ldm-logo" aria-label="<?php esc_attr_e( 'Liam Digital Marketing home', 'liam-digital-marketing' ); ?>">
      <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/brand-kit/logo/logo-lockup-white.svg' ); ?>" alt="Liam Digital Marketing" style="height:24px;">
    </a>
    <nav aria-label="Primary">
      <ul class="ldm-nav-links">
        <?php ldm_render_nav_links(); ?>
      </ul>
    </nav>
    <a class="ldm-nav-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( "Let's Talk", 'liam-digital-marketing' ); ?> <span class="arrow">&rarr;</span></a>
    <button class="ldm-burger" aria-label="<?php esc_attr_e( 'Open menu', 'liam-digital-marketing' ); ?>" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
  <div class="ldm-mobile-menu" id="mobileMenu">
    <div class="ldm-mobile-menu-top">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ldm-logo" aria-label="<?php esc_attr_e( 'Liam Digital Marketing home', 'liam-digital-marketing' ); ?>">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/brand-kit/logo/logo-lockup-white.svg' ); ?>" alt="Liam Digital Marketing" style="height:22px;">
      </a>
      <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="ldm-mobile-menu-cta"><?php esc_html_e( "Let's Talk", 'liam-digital-marketing' ); ?> <span class="arrow">&rarr;</span></a>
      <button class="ldm-mobile-menu-close" type="button" aria-label="<?php esc_attr_e( 'Close menu', 'liam-digital-marketing' ); ?>"><span></span><span></span></button>
    </div>
    <div class="ldm-mobile-menu-utility">
      <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>"><?php esc_html_e( 'Case Study', 'liam-digital-marketing' ); ?> <span class="arrow">&rarr;</span></a>
      <span class="ldm-status"><span class="status-dot"></span><?php esc_html_e( 'Available for select projects', 'liam-digital-marketing' ); ?></span>
    </div>
    <nav class="ldm-mobile-menu-links" aria-label="<?php esc_attr_e( 'Mobile primary', 'liam-digital-marketing' ); ?>">
      <?php ldm_render_mobile_nav_links(); ?>
    </nav>
    <div class="ldm-mobile-menu-actions">
      <a href="tel:<?php echo esc_attr( LDM_CONTACT_PHONE_TEL ); ?>" class="ldm-mobile-menu-pill"><?php echo ldm_contact_icon( 'phone' ); ?><?php echo esc_html( LDM_CONTACT_PHONE_DISPLAY ); ?></a>
      <a href="<?php echo esc_url( LDM_CONTACT_WHATSAPP_URL ); ?>" rel="noopener" class="ldm-mobile-menu-pill ldm-mobile-menu-pill--accent"><?php echo ldm_contact_icon( 'whatsapp' ); ?><?php esc_html_e( 'Quick Chat via WhatsApp', 'liam-digital-marketing' ); ?></a>
    </div>
  </div>
</header>

<main>
