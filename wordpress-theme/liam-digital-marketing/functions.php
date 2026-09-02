<?php
/**
 * Theme bootstrap. Keeps functions.php itself tiny — everything it
 * does lives in inc/, split by concern (asset loading, theme
 * support/menus, the contact form handler) so each piece stays easy
 * to find and change independently.
 */

defined( 'ABSPATH' ) || exit;

require get_template_directory() . '/inc/theme-setup.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/contact-form.php';
require get_template_directory() . '/inc/template-helpers.php';
require get_template_directory() . '/inc/case-studies.php';
