<?php
/**
 * Loads the fonts, tokens.css and main.css as three properly chained
 * WP style dependencies instead of the static site's @import chain
 * (removed from assets/main.css) — @import blocks the browser from
 * fetching the imported file in parallel with the file that imports
 * it, which real <link> tags with a dependency order don't.
 */

defined( 'ABSPATH' ) || exit;

function ldm_enqueue_assets() {
	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'ldm-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'ldm-tokens',
		get_template_directory_uri() . '/assets/brand-kit/tokens.css',
		array( 'ldm-fonts' ),
		$version
	);

	wp_enqueue_style(
		'ldm-main',
		get_template_directory_uri() . '/assets/main.css',
		array( 'ldm-tokens' ),
		$version
	);

	wp_enqueue_script(
		'ldm-main',
		get_template_directory_uri() . '/assets/main.js',
		array(),
		$version,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ldm_enqueue_assets' );
