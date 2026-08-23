<?php
/**
 * About page — ported from about.html. WordPress auto-selects this
 * template for a Page whose slug is "about" (no explicit
 * "Template Name" header needed for that convention to apply).
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = 'About | Digital Marketing Manager — $10M+ Ad Spend, 100+ Brands Scaled';
$ldm_meta_description = 'Meet Liam — a Digital Marketing Manager with 6+ years managing $10M+ in ad spend and scaling 100+ brands through performance marketing, marketing technology and analytics.';

get_header();
?>

  <!-- PAGE HEADER -->
  <section class="ldm-page-header container">
    <span class="eyebrow">About</span>
    <h1 class="fs-h1">I build marketing systems, not just campaigns.</h1>
    <p class="lede">I'm Liam, a Digital Marketing Manager working at the intersection of performance marketing, growth and marketing technology. Over 6+ years I've managed $10M+ in ad spend and helped scale 100+ brands — turning ad spend into measurable outcomes, not impressions.</p>
  </section>

  <!-- INTRO STATEMENT -->
  <section class="container container-narrow">
    <p class="lede reveal" style="max-width:none;">Most marketing work stops at the campaign. Mine starts there. I care as much about how a lead gets tracked, scored and reported on as I do about the creative that brought them in — because a beautiful ad that nobody can measure isn't a strategy, it's a guess.</p>
  </section>

  <!-- BACKGROUND -->
  <section class="ldm-section container">
    <div class="ldm-about reveal">
      <div class="card-image" style="aspect-ratio:4/5;">
        <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?q=80&w=1200&auto=format&fit=crop" alt="Workspace setup used for campaign strategy and analytics work" loading="lazy" width="1200" height="1500" style="width:100%;height:100%;object-fit:cover;">
      </div>
      <div>
        <span class="eyebrow">Background</span>
        <h2 class="fs-h2" style="margin:16px 0 24px;">From hospitality floors to performance dashboards.</h2>
        <p style="color:var(--color-off-white);margin-bottom:20px;">Over six-plus years, I've managed and optimized multi-million-dollar advertising budgets — more than $10M in ad spend to date — across 100+ brands spanning hospitality, e-commerce, professional services and beyond. That range is deliberate: it's taught me that a performance system built for one industry rarely survives contact with another, so I build for the fundamentals — audience, offer, tracking — rather than for a template.</p>
        <p style="color:var(--color-off-white);margin-bottom:20px;">My work spans the full paid and organic mix — Meta, Google, TikTok and LinkedIn Ads, alongside SEO, SEM, social and email marketing — plus the measurement layer underneath it, from GA4 and Google Tag Manager to server-side tracking, attribution modeling and Looker Studio reporting. I'm as comfortable inside an ad account as I am inside a GTM container or a data visualization dashboard, which is the point. Paid media without tracking is a black box. Tracking without strategy is just data.</p>
        <p style="color:var(--color-off-white);">On the conversion side, I map the full customer journey and rebuild landing pages, forms and funnels around how people actually decide — testing changes rather than assuming them. And because none of this works in isolation, I spend real time in the martech layer: CRM integrations, marketing automation, and the WordPress/Elementor stack most of my clients' sites run on.</p>
        <div class="ldm-about-stats">
          <div><div class="num"><span data-counter="6" data-suffix="+">0+</span></div><div class="label">Years in performance marketing</div></div>
          <div><div class="num"><span data-counter="100" data-suffix="+">0+</span></div><div class="label">Brands scaled</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- TOOLSET -->
  <section class="ldm-section container">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">Toolset</span>
      <h2 class="fs-h2">The technology stack behind the strategy.</h2>
    </div>
    <div class="ldm-tech-grid reveal">
      <div class="ldm-tech-cat">
        <h4>Advertising</h4>
        <div class="ldm-tech-pills"><span class="tag">Meta Ads</span><span class="tag">Google Ads</span><span class="tag">TikTok Ads</span><span class="tag">LinkedIn Ads</span><span class="tag">Performance Max</span><span class="tag">Google Search</span></div>
      </div>
      <div class="ldm-tech-cat">
        <h4>Analytics</h4>
        <div class="ldm-tech-pills"><span class="tag">GA4</span><span class="tag">Looker Studio</span><span class="tag">Google Analytics</span><span class="tag">Attribution Modeling</span><span class="tag">Data Visualization</span></div>
      </div>
      <div class="ldm-tech-cat">
        <h4>Tracking</h4>
        <div class="ldm-tech-pills"><span class="tag">Google Tag Manager</span><span class="tag">Meta Pixel</span><span class="tag">Conversion Tracking</span><span class="tag">Server-side Tracking</span></div>
      </div>
      <div class="ldm-tech-cat">
        <h4>CRM / Automation</h4>
        <div class="ldm-tech-pills"><span class="tag">HubSpot</span><span class="tag">Lead Management</span><span class="tag">Marketing Automation</span><span class="tag">CRM Integration</span></div>
      </div>
      <div class="ldm-tech-cat">
        <h4>Websites</h4>
        <div class="ldm-tech-pills"><span class="tag">WordPress</span><span class="tag">Landing Pages</span><span class="tag">Conversion Optimization</span></div>
      </div>
    </div>
  </section>

  <!-- HOW I WORK -->
  <section class="ldm-section container">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">How I Work</span>
      <h2 class="fs-h2">A simple, disciplined process.</h2>
    </div>
    <div class="ldm-process reveal">
      <div class="ldm-process-step">
        <div class="num">01</div>
        <h4>Discover</h4>
        <p>I start by understanding the business, the audience and what "success" actually needs to mean.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">02</div>
        <h4>Build</h4>
        <p>I develop the campaign, tracking and creative strategy together, not as separate workstreams.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">03</div>
        <h4>Optimize</h4>
        <p>I analyze real performance data and make deliberate, tested improvements.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">04</div>
        <h4>Scale</h4>
        <p>I increase what's proven to work and cut what isn't, without sentimentality.</p>
      </div>
    </div>
  </section>

  <!-- CONTACT CTA -->
  <section class="ldm-section container ldm-contact">
    <div class="reveal">
      <span class="eyebrow">Contact</span>
      <h2 class="fs-h2" style="margin-top:16px;">Let's Build Something That Performs.</h2>
      <p class="lede">Have a project, campaign or growth challenge? Let's talk.</p>
      <div class="ldm-contact-ctas">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Start a Conversation &rarr;</a>
      </div>
      <div class="ldm-contact-links">
        <?php ldm_render_contact_links(); ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
