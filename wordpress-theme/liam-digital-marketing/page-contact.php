<?php
/**
 * Contact page — ported from contact.html. WordPress auto-selects
 * this template for a Page whose slug is "contact".
 *
 * The static site's form posted to a literal `action="#"` placeholder
 * with a comment saying to wire it up in production. This does that:
 * posts to admin-post.php with a nonce, handled by
 * inc/contact-form.php, which redirects back here with
 * `?ldm_contact=success` or `?ldm_contact=error`.
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = 'Contact | Start a Project with a Digital Marketing Consultant';
$ldm_meta_description = 'Get in touch to discuss paid media, conversion tracking or marketing analytics for your brand. Liam Digital Marketing is a performance marketing specialist and paid media consultant taking on select projects.';

get_header();

$ldm_contact_status = isset( $_GET['ldm_contact'] ) ? sanitize_key( wp_unslash( $_GET['ldm_contact'] ) ) : '';
?>

  <!-- PAGE HEADER -->
  <section class="ldm-page-header container">
    <span class="eyebrow">Contact</span>
    <h1 class="fs-h1">Let's Build Something That Performs.</h1>
    <p class="lede">Have a project, campaign or growth challenge? Tell me about it — I read every enquiry personally.</p>
  </section>

  <!-- CONTACT FORM + DIRECT LINKS -->
  <section class="ldm-section container">
    <div class="grid grid-2 reveal" style="align-items:start;">

      <div class="card">
        <?php if ( 'success' === $ldm_contact_status ) : ?>
          <p class="lede" style="max-width:none;">Thanks — your message is on its way. I'll get back to you within one to two business days.</p>
        <?php else : ?>
          <?php if ( 'error' === $ldm_contact_status ) : ?>
            <p class="text-gray" style="margin-bottom:20px;">Something went wrong sending that — please check the form and try again, or reach out directly using the details on the right.</p>
          <?php endif; ?>
          <form class="ldm-contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
            <input type="hidden" name="action" value="ldm_contact_form">
            <input type="hidden" name="ldm_redirect" value="<?php echo esc_url( get_permalink() ); ?>">
            <?php wp_nonce_field( 'ldm_contact_form', 'ldm_contact_nonce' ); ?>
            <div class="ldm-form-row">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" required placeholder="Your full name" autocomplete="name">
            </div>
            <div class="ldm-form-row">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required placeholder="you@company.com" autocomplete="email">
            </div>
            <div class="ldm-form-row">
              <label for="company">Company <span class="text-gray">(optional)</span></label>
              <input type="text" id="company" name="company" placeholder="Company or brand name" autocomplete="organization">
            </div>
            <div class="ldm-form-row">
              <label for="budget">Project / Budget <span class="text-gray">(optional)</span></label>
              <select id="budget" name="budget">
                <option value="">Select a range</option>
                <option value="lt-2k">Under $2K / month</option>
                <option value="2k-5k">$2K &ndash; $5K / month</option>
                <option value="5k-10k">$5K &ndash; $10K / month</option>
                <option value="10k-plus">$10K+ / month</option>
                <option value="not-sure">Not sure yet</option>
              </select>
            </div>
            <div class="ldm-form-row">
              <label for="message">Message</label>
              <textarea id="message" name="message" rows="5" required placeholder="Tell me about your project, goals and timeline."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;">Send Message &rarr;</button>
          </form>
        <?php endif; ?>
      </div>

      <div>
        <span class="eyebrow">Direct</span>
        <h3 class="fs-h4" style="margin:16px 0 20px;">Prefer to reach out directly?</h3>
        <p class="text-gray" style="margin-bottom:32px;max-width:40ch;display:flex;align-items:center;gap:10px;"><span class="status-dot" aria-hidden="true"></span>I typically reply within one to two business days.</p>
        <div class="ldm-contact-links" style="justify-content:flex-start;flex-direction:column;align-items:flex-start;gap:16px;">
          <?php ldm_render_contact_links(); ?>
        </div>
      </div>

    </div>
  </section>

<?php get_footer(); ?>
