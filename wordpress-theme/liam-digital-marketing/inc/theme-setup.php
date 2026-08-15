<?php
/**
 * Core theme support, plus the nav links shared by header.php's
 * desktop <ul> and its mobile menu (a flat list of <a> tags —
 * assets/main.js specifically walks `.ldm-mobile-menu > a`, so this
 * intentionally does NOT go through wp_nav_menu()/a custom Walker
 * just to make the six links "manageable" from Appearance > Menus.
 * That would add real complexity (a custom Walker to get flat <a>
 * tags instead of wp_nav_menu()'s default <li><a>) for a set of
 * links that mirrors the site's own six page templates one-to-one
 * and isn't expected to change without a code change alongside it.
 */

defined( 'ABSPATH' ) || exit;

function ldm_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
}
add_action( 'after_setup_theme', 'ldm_theme_setup' );

/**
 * Single source of truth for the six nav links, each with a
 * WordPress conditional-tag callback so "current page" is computed
 * the reliable way (is_front_page(), is_page($slug)) instead of by
 * comparing URL strings.
 */
function ldm_nav_links() {
	return array(
		array(
			'url'     => home_url( '/' ),
			'label'   => __( 'Home', 'liam-digital-marketing' ),
			'current' => function () {
				return is_front_page();
			},
		),
		array(
			'url'     => home_url( '/work/' ),
			'label'   => __( 'Work', 'liam-digital-marketing' ),
			'current' => function () {
				return is_page( 'work' );
			},
		),
		array(
			'url'     => home_url( '/about/' ),
			'label'   => __( 'About', 'liam-digital-marketing' ),
			'current' => function () {
				return is_page( 'about' );
			},
		),
		array(
			'url'     => home_url( '/skills/' ),
			'label'   => __( 'Skills', 'liam-digital-marketing' ),
			'current' => function () {
				return is_page( 'skills' );
			},
		),
		array(
			'url'     => home_url( '/#results' ),
			'label'   => __( 'Results', 'liam-digital-marketing' ),
			'current' => '__return_false',
		),
		array(
			'url'     => home_url( '/contact/' ),
			'label'   => __( 'Contact', 'liam-digital-marketing' ),
			'current' => function () {
				return is_page( 'contact' );
			},
		),
	);
}

/** Desktop nav: <li><a>…</a></li> list, matches .ldm-nav-links. */
function ldm_render_nav_links() {
	foreach ( ldm_nav_links() as $link ) {
		printf(
			'<li><a href="%1$s"%2$s>%3$s</a></li>',
			esc_url( $link['url'] ),
			call_user_func( $link['current'] ) ? ' aria-current="page"' : '',
			esc_html( $link['label'] )
		);
	}
}

/** Mobile menu overlay's main link list — one row per link, with a trailing chevron. */
function ldm_render_mobile_nav_links() {
	$chevron = '<svg class="ldm-mobile-menu-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 6 6 6-6 6"></path></svg>';
	foreach ( ldm_nav_links() as $link ) {
		printf(
			'<a href="%1$s"%2$s>%3$s%4$s</a>',
			esc_url( $link['url'] ),
			call_user_func( $link['current'] ) ? ' aria-current="page"' : '',
			esc_html( $link['label'] ),
			$chevron // phpcs:ignore -- static markup, not user input.
		);
	}
}
