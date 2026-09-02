<?php
/**
 * Work page — ported from work.html. WordPress auto-selects this
 * template for a Page whose slug is "work". Every project (all 53
 * clients, highest verified ROAS first) is data-driven from
 * ldm_get_case_studies() / ldm_render_case_list() in
 * inc/case-studies.php, which also powers each project's individual
 * /case-study/{slug}/ page.
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = 'Selected Work | Liam Digital Marketing — Performance Marketing Case Studies';
$ldm_meta_description = 'Case studies in paid media, lead generation, conversion tracking and marketing analytics — real campaign work from a performance marketing specialist and Google Ads & Meta Ads consultant.';

get_header();
?>

  <!-- PAGE HEADER -->
  <section class="ldm-page-header container">
    <span class="eyebrow">Work</span>
    <h1 class="fs-h1">Selected Work</h1>
    <p class="lede">A closer look at the campaigns, growth systems and digital projects behind the numbers — how they were built, what they solved, and what they delivered.</p>
  </section>

  <!-- CASE LIST -->
  <section class="ldm-section container">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">Selected Work</span>
      <h2 class="fs-h2">100+ brands, one system.</h2>
      <p class="lede">Every brand I've built paid media, tracking and growth systems for — across hospitality, wellness, fitness, finance and beyond.</p>
    </div>

    <div class="ldm-case-list">
      <?php ldm_render_case_list(); ?>
    </div>
  </section>

  <!-- CONTACT CTA -->
  <section class="ldm-section container ldm-contact">
    <div class="reveal">
      <span class="eyebrow">Contact</span>
      <h2 class="fs-h2" style="margin-top:16px;">Have a project like these?</h2>
      <p class="lede">Let's talk about what a connected paid media and tracking system could do for your brand.</p>
      <div class="ldm-contact-ctas">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Start a Conversation &rarr;</a>
      </div>
      <div class="ldm-contact-links">
        <?php ldm_render_contact_links(); ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
