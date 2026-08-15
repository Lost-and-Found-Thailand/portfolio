<?php
/**
 * Shared footer, used by every page template. Site/Connect links and
 * the copyright year are the only per-render dynamic pieces — the
 * rest mirrors the static site exactly.
 */

defined( 'ABSPATH' ) || exit;
?>
</main>

<footer class="ldm-footer">
  <div class="container">
    <div class="ldm-footer-top">
      <div class="ldm-footer-brand">
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/brand-kit/logo/logo-lockup-white.svg' ); ?>" alt="Liam Digital Marketing" style="height:22px;">
        <p class="ldm-footer-tag">Digital Marketing &bull; Paid Media &bull; Analytics &bull; Growth</p>
        <div class="ldm-footer-social">
          <a href="<?php echo esc_url( LDM_CONTACT_WHATSAPP_URL ); ?>" rel="noopener" aria-label="WhatsApp"><?php echo ldm_contact_icon( 'whatsapp' ); ?></a>
          <a href="<?php echo esc_url( LDM_CONTACT_LINKEDIN_URL ); ?>" rel="noopener" aria-label="LinkedIn"><?php echo ldm_contact_icon( 'linkedin' ); ?></a>
        </div>
      </div>
      <div class="ldm-footer-cols">
        <div class="ldm-footer-col">
          <h5><?php esc_html_e( 'Explore', 'liam-digital-marketing' ); ?></h5>
          <ul class="ldm-footer-explore-list">
            <?php ldm_render_footer_explore_links(); ?>
          </ul>
        </div>
        <div class="ldm-footer-col">
          <h5><?php esc_html_e( 'Contact', 'liam-digital-marketing' ); ?></h5>
          <ul>
            <?php ldm_render_footer_connect_links(); ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="ldm-footer-bottom">
      <span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Liam Digital Marketing. All rights reserved.</span>
      <span><?php esc_html_e( 'Built with strategy, media and data.', 'liam-digital-marketing' ); ?></span>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
