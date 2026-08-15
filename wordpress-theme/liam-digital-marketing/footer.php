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
      <div>
        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/brand-kit/logo/logo-lockup-white.svg' ); ?>" alt="Liam Digital Marketing" style="height:22px;">
        <p class="ldm-footer-tag">Digital Marketing &bull; Paid Media &bull; Analytics &bull; Growth</p>
      </div>
      <div class="ldm-footer-cols">
        <div class="ldm-footer-col">
          <h5><?php esc_html_e( 'Site', 'liam-digital-marketing' ); ?></h5>
          <ul>
            <li><a href="<?php echo esc_url( home_url( '/work/' ) ); ?>"><?php esc_html_e( 'Work', 'liam-digital-marketing' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>"><?php esc_html_e( 'About', 'liam-digital-marketing' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/skills/' ) ); ?>"><?php esc_html_e( 'Skills', 'liam-digital-marketing' ); ?></a></li>
            <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact', 'liam-digital-marketing' ); ?></a></li>
          </ul>
        </div>
        <div class="ldm-footer-col">
          <h5><?php esc_html_e( 'Connect', 'liam-digital-marketing' ); ?></h5>
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
