<?php
/**
 * Per-client case studies. Every project on the Work page gets its
 * own case-study URL instead of all of them pointing at the single
 * "case-study" Page (which historically only ever covered Tirtha
 * Bali). Rather than requiring a real WP Page per client, one
 * rewrite rule sends /case-study/{slug}/ through the existing
 * "case-study" Page's template (page-case-study.php), which reads
 * the slug from a query var and looks it up in ldm_get_case_studies().
 * Tirtha Bali (the only client with a full write-up) keeps rendering
 * its existing hardcoded content when the slug is empty or
 * "tirtha-bali", so /case-study/ on its own is unchanged.
 */

defined( 'ABSPATH' ) || exit;

function ldm_case_study_rewrite_rule() {
	add_rewrite_rule( '^case-study/([^/]+)/?$', 'index.php?pagename=case-study&ldm_case=$matches[1]', 'top' );
}
add_action( 'init', 'ldm_case_study_rewrite_rule' );

add_filter(
	'query_vars',
	function ( $vars ) {
		$vars[] = 'ldm_case';
		return $vars;
	}
);

/**
 * The rewrite rule above only takes effect once WordPress flushes
 * its rewrite rules (normally done by hand under Settings > Permalinks).
 * This flushes once automatically after a theme update introduces the
 * rule, keyed by a version bump rather than running on every request.
 */
function ldm_maybe_flush_case_study_rewrite() {
	if ( get_option( 'ldm_case_study_rewrite_version' ) !== '1' ) {
		ldm_case_study_rewrite_rule();
		flush_rewrite_rules();
		update_option( 'ldm_case_study_rewrite_version', '1' );
	}
}
add_action( 'init', 'ldm_maybe_flush_case_study_rewrite', 20 );

/**
 * Returns the slug requested via /case-study/{slug}/, or null for
 * the bare /case-study/ URL (which page-case-study.php treats as
 * an alias for "tirtha-bali").
 */
function ldm_get_current_case_slug() {
	$slug = get_query_var( 'ldm_case' );
	return $slug ? sanitize_title( $slug ) : null;
}

function ldm_find_case_study( $slug ) {
	foreach ( ldm_get_case_studies() as $case ) {
		if ( $case['slug'] === $slug ) {
			return $case;
		}
	}
	$extra = ldm_get_extra_case_studies();
	return $extra[ $slug ] ?? null;
}

function ldm_case_study_url( $slug ) {
	return home_url( '/case-study/' . $slug . '/' );
}

/** Every project this theme has real client data for, highest verified ROAS first. */
function ldm_get_case_studies() {
	return array(
		array(
			'slug'           => 'rockfish-the-uluwatu',
			'name'           => 'Rockfish The Uluwatu',
			'badge'          => 'Cliffside Restaurant',
			'industry'       => 'Paid Media &middot; Full-Funnel Marketing &middot; Conversion Rate Optimization',
			'type'           => null,
			'desc'           => 'Managing full-funnel paid media and conversion rate optimization for Rockfish since it opened, turning its iconic cliffside setting into a steady stream of qualified diner and event enquiries.',
			'result'         => '32,500%',
			'img'            => 'rockfish-uluwatu-photo.jpg',
			'alt'            => 'The clifftop dining deck at Rockfish The Uluwatu',
			'href'           => null,
			'hero_img'       => 'rockfish-uluwatu-hero.jpg',
			'challenge_title' => 'A landmark location doesn\'t fill the calendar on its own.',
			'challenge_body'  => 'Rockfish The Uluwatu draws attention as one of Bali\'s most recognizable cliffside dining destinations, but reputation and foot traffic alone don\'t convert into a steady stream of reservations and private event enquiries. The venue needed a paid media system that could turn its location into a measurable acquisition channel, with tracking built to prove which bookings actually came from the ad spend.',
			'strategy_title' => 'Full-funnel marketing, managed since the restaurant opened.',
			'strategy_intro' => 'Three connected workstreams built to turn Rockfish\'s cliffside profile into qualified diner and event enquiries.',
			'strategy_steps' => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Uluwatu\'s international dining and event crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation and private event enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified leads.' ),
			),
		),
		array( 'slug' => 'noah-yacht-club', 'name' => 'Noah Yacht Club', 'badge' => 'Yacht Club', 'industry' => 'Paid Media &middot; Lead Generation &middot; Analytics', 'type' => null, 'desc' => 'Building a full-funnel campaign system to fill charter and membership enquiries for this yacht club.', 'result' => '2,500%', 'img' => 'noah-yacht-case.jpg', 'alt' => 'Noah Yacht Club performance marketing case study', 'href' => null ),
		array( 'slug' => 'tirtha-bali', 'name' => 'Tirtha Bali', 'badge' => 'Luxury Weddings', 'industry' => 'Paid Media &middot; Lead Generation &middot; Conversion Tracking', 'type' => null, 'desc' => 'Generating higher-quality international wedding enquiries through targeted paid media and full-funnel tracking.', 'result' => '1,500%', 'img' => 'tirtha-bali.jpg', 'alt' => 'Aerial view of the Tirtha Bali clifftop wedding venue', 'href' => 'case-study.html' ),
		array( 'slug' => 'ulu-cliffhouse', 'name' => 'Ulu Cliffhouse', 'badge' => 'Hospitality', 'industry' => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking', 'type' => null, 'desc' => 'Building a measurement system that connects ad spend directly to bookings across this cliffside resort\'s restaurant, pool club and beach club venues.', 'result' => null, 'img' => 'ulu-cliffhouse-case.jpg', 'alt' => 'Ocean-view cliffside at Ulu Cliffhouse in Uluwatu', 'href' => null ),
		array( 'slug' => 'the-barrel', 'name' => 'The Barrel', 'badge' => 'Lifestyle &amp; Retail', 'industry' => 'Conversion Optimization &middot; Digital Strategy', 'type' => null, 'desc' => 'Rebuilding the online discovery and reservation journey for this wine merchant and restaurant across paid channels.', 'result' => null, 'img' => 'the-barrel-case.jpg', 'alt' => 'Wine display at The Barrel wine merchant', 'href' => null ),
		array( 'slug' => 'chalong-bay-rum', 'name' => 'Chalong Bay Rum', 'badge' => 'E-commerce', 'industry' => 'Meta Ads &middot; Google Shopping &middot; Marketing Analytics', 'type' => null, 'desc' => 'Rebuilding the tracking foundation so every dollar of ad spend for this rum distillery could be traced to revenue, not just clicks.', 'result' => null, 'img' => 'chalong-bay-rum-case.jpg', 'alt' => 'A Chalong Bay Rum cocktail served at the distillery', 'href' => null ),
		array( 'slug' => 'raw-uluwatu', 'name' => 'Raw Uluwatu', 'badge' => 'Fitness', 'industry' => 'Lead Generation &middot; Google Ads &middot; CRM Integration', 'type' => null, 'desc' => 'Replacing generic form-fills with a qualified-lead pipeline for gym memberships, synced directly into the studio\'s CRM.', 'result' => null, 'img' => 'raw-uluwatu-case.jpg', 'alt' => 'Training floor at Raw Uluwatu gym', 'href' => null ),
		array( 'slug' => 'ours-spa', 'name' => 'Ours Spa', 'badge' => 'Wellness', 'industry' => 'Paid Media &middot; Landing Page Optimization', 'type' => null, 'desc' => 'Turning a seasonal spike in interest into an always-on acquisition engine for treatment bookings.', 'result' => null, 'img' => 'ours-spa-case.jpg', 'alt' => 'A facial treatment in progress at Ours Spa', 'href' => null ),
		array(
			'slug'            => 'tabu-bali',
			'name'            => 'Tabu Bali',
			'badge'           => 'Restaurant & Supperclub',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Restaurant & Supperclub',
			'desc'            => 'Managing paid media and full-funnel tracking for Tabu Bali, turning its day-to-night concept into a steady stream of qualified reservations and event enquiries.',
			'result'          => null,
			'img'             => 'tabu-bali-photo.jpg',
			'alt'             => 'A real dish spread from Tabu Bali\'s menu',
			'href'            => null,
			'hero_img'        => 'tabu-bali-hero.jpg',
			'challenge_title' => 'A day-to-night concept needed marketing that could keep up with it.',
			'challenge_body'  => 'Tabu is a supper club in Uluwatu, Bali, part of the Ours Group, built around a concept that shifts from fine dining to late-night club energy across dinner, drinks and events. That kind of range doesn\'t fill tables on its own — the venue needed a paid media system built to turn its concept into a steady, trackable stream of reservations and event enquiries.',
			'strategy_title'  => 'Full-funnel marketing built for reservations and event enquiries, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Tabu Bali\'s reputation into qualified reservations and event enquiries.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Tabu\'s dinner-and-nightlife crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation or event enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations and event enquiries.' ),
			),
		),
		array(
			'slug'            => 'carpe-diem',
			'name'            => 'Carpe Diem',
			'badge'           => 'Beach Restaurant',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Beach Restaurant, Beach Club, Pool Party',
			'desc'            => 'Managing paid media and full-funnel tracking for Carpe Diem, turning its beachfront profile into a steady stream of qualified bookings.',
			'result'          => null,
			'img'             => 'carpe-diem-photo.jpg',
			'alt'             => 'The pool bar and sunbeds at Carpe Diem Beach Club',
			'href'            => null,
			'hero_img'        => 'carpe-diem-hero.jpg',
			'challenge_title' => 'A beachfront destination with real press coverage still needed a measurable booking system.',
			'challenge_body'  => 'Carpe Diem is a beachfront restaurant and beach club in Bang Tao, Phuket, serving Mediterranean cuisine and craft cocktails, part of the Carpe Diem Collective alongside Benny\'s Cocktails & Grill. Being featured in Forbes, CNA and AP News builds awareness, but it doesn\'t by itself convert into a steady, trackable stream of table and sunbed bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Carpe Diem\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Carpe Diem\'s beach-club and dining crowd in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to table or sunbed booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'            => 'the-beach-by-ours',
			'name'            => 'The Beach by Ours',
			'badge'           => 'Beach Restaurant',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Beach Restaurant, Beach Club',
			'desc'            => 'Managing paid media and full-funnel tracking for The Beach by Ours, turning its sunset beachfront setting into a steady stream of qualified reservations.',
			'result'          => null,
			'img'             => 'the-beach-by-ours-photo.jpg',
			'alt'             => 'A real dish spread from The Beach by Ours',
			'href'            => null,
			'hero_img'        => 'the-beach-by-ours-hero.jpg',
			'challenge_title' => 'A sunset-facing destination needed a way to prove which bookings its ads actually drove.',
			'challenge_body'  => 'The Beach by Ours is a beachfront dining venue on Bingin Beach, Uluwatu, part of the Ours Group, built around sunset-focused fine dining and cocktails. A striking location and menu don\'t automatically convert into a steady, trackable stream of reservations — the venue needed a paid media and tracking system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn The Beach by Ours\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to The Beach by Ours\' sunset-dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'            => 'soho-pool-club',
			'name'            => 'Soho Pool Club',
			'badge'           => 'Pool Club',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Pool Club',
			'desc'            => 'Managing paid media and full-funnel tracking for Soho Pool Club, turning its pool club setting into a steady stream of qualified bookings.',
			'result'          => null,
			'img'             => 'soho-pool-club-photo.jpg',
			'alt'             => 'The clubhouse and pool at Soho Pool Club',
			'href'            => null,
			'hero_img'        => 'soho-pool-club-hero.jpg',
			'challenge_title' => 'A pool club needed a way to turn its setting into trackable bookings, not just foot traffic.',
			'challenge_body'  => 'Soho Pool Club is a pool club built around its clubhouse and pool as the centerpiece of the guest experience. A striking space alone doesn\'t fill sunbeds and tables on a consistent basis — the venue needed a paid media system built to turn interest into a steady, trackable stream of bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Soho Pool Club\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Soho Pool Club\'s day-club crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'            => 'marbella-beach-goa',
			'name'            => 'Marbella Beach Goa',
			'badge'           => 'Beach Club & Resort',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Beach Club & Resort',
			'desc'            => 'Managing paid media and full-funnel tracking for Marbella Beach Goa, turning its established beachfront reputation into a steady stream of qualified booking enquiries.',
			'result'          => null,
			'img'             => 'marbella-beach-goa-photo.jpg',
			'alt'             => 'The pool deck at Marbella Beach Goa',
			'href'            => null,
			'hero_img'        => 'marbella-beach-goa-hero.jpg',
			'challenge_title' => 'A well-established resort still needed to prove which bookings its ads actually drove.',
			'challenge_body'  => 'Marbela Beach is a beachfront resort and beach club on Morjim Beach, North Goa, India, operating for over 17 years with beachfront pool, cabanas, an Ibiza-inspired beach club and its own Meso restaurant. Even an established, well-loved venue needs a paid media system that proves which channels are actually driving qualified stays and beach-club bookings, rather than relying on reputation alone.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Marbella Beach Goa\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Marbela Beach\'s resort guests and beach-club crowd in Goa.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to booking enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'            => 'ama-by-ours',
			'name'            => 'Ama by Ours',
			'badge'           => 'Restaurant',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Restaurant',
			'desc'            => 'Managing paid media and full-funnel tracking for Ama by Ours, turning its Mediterranean concept into a steady stream of qualified reservations.',
			'result'          => null,
			'img'             => 'ama-by-ours-photo.jpg',
			'alt'             => 'A dish spread from Ama by Ours',
			'href'            => null,
			'hero_img'        => 'ama-by-ours-hero.jpg',
			'challenge_title' => 'A Mediterranean concept needed a measurable way to fill tables in a crowded Uluwatu dining scene.',
			'challenge_body'  => 'Ama by Ours is a Mediterranean restaurant in Uluwatu, Bali, part of the Ours Group, serving Greek and Italian fusion cuisine in a space styled around olive trees and terracotta tones. In a dining scene this competitive, a distinctive concept alone doesn\'t guarantee a steady, trackable stream of reservations — the venue needed a paid media system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Ama by Ours\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Ama by Ours\' Mediterranean-dining crowd in Uluwatu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'            => 'bennys-cocktails-grill',
			'name'            => 'Benny’s Cocktails & Grill',
			'badge'           => 'Steakhouse',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Steakhouse, Cocktail Bar',
			'desc'            => 'Managing paid media and full-funnel tracking for Benny\'s Cocktails & Grill, turning its steakhouse reputation into a steady stream of qualified reservations.',
			'result'          => null,
			'img'             => 'bennys-cocktails-grill-photo.jpg',
			'alt'             => 'The dining room at Benny\'s Cocktails & Grill',
			'href'            => null,
			'hero_img'        => 'bennys-cocktails-grill-hero.jpg',
			'challenge_title' => 'A specialist steakhouse needed a system to turn its reputation into trackable bookings.',
			'challenge_body'  => 'Benny\'s Cocktails & Grill is a steakhouse and cocktail bar in Bang Tao, Phuket, founded in 2015 by restaurateur Benedikt De Bellis, specializing in Australian Angus, Wagyu and Japanese Wagyu with tableside preparations. A specialist menu like that deserves a paid media system built to convert interest into a steady, trackable stream of reservations, not just walk-ins.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Benny\'s Cocktails & Grill\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Benny\'s Cocktails & Grill\'s steak-and-cocktail crowd in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'            => 'ours-bali',
			'name'            => 'Ours Bali',
			'badge'           => 'Restaurant',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Restaurant',
			'desc'            => 'Managing paid media and full-funnel tracking for Ours Bali, turning its all-day dining concept into a steady stream of qualified reservations.',
			'result'          => null,
			'img'             => 'ours-bali-photo.jpg',
			'alt'             => 'A dish spread from Ours Bali',
			'href'            => null,
			'hero_img'        => 'ours-bali-hero.jpg',
			'challenge_title' => 'An all-day concept needed marketing that worked as hard across the whole day as the kitchen does.',
			'challenge_body'  => 'Ours Bali is an all-day restaurant in Uluwatu open from 8am to 11pm, part of the Ours Group, blending Balinese open-living interiors with Scandinavian and Mediterranean influences. Running from breakfast through to late dinner means the venue needed a paid media system that could turn that all-day concept into a steady, trackable stream of reservations across every part of the day.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Ours Bali\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Ours Bali\'s all-day dining crowd in Uluwatu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'            => 'home-by-ours',
			'name'            => 'Home by Ours',
			'badge'           => 'Restaurant',
			'industry'        => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'            => 'Restaurant',
			'desc'            => 'Managing paid media and full-funnel tracking for Home by Ours, turning its terrace dining concept into a steady stream of qualified reservations.',
			'result'          => null,
			'img'             => 'home-by-ours-photo.jpg',
			'alt'             => 'The outdoor dining terrace at Home by Ours',
			'href'            => null,
			'hero_img'        => 'home-by-ours-hero.jpg',
			'challenge_title' => 'A rustic-modern dining room needed a measurable way to compete for attention in Uluwatu.',
			'challenge_body'  => 'Home by Ours is an all-day dining spot in Uluwatu, part of the Ours Group, built around a rustic-modern outdoor terrace and a menu fusing Western and Asian dishes with local ingredients. A distinctive terrace and menu don\'t fill tables on their own — the venue needed a paid media system built to turn that into a steady, trackable stream of reservations.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Home by Ours\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Home by Ours\' terrace-dining crowd in Uluwatu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'the-distillery-phuket',
			'name'              => 'The Distillery Phuket',
			'badge'             => 'Distillery & Fusion Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Distillery & Fusion Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for The Distillery Phuket, turning its distillery-and-restaurant concept into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'the-distillery-phuket-photo.jpg',
			'alt'               => 'The garden pavilion at The Distillery Phuket',
			'href'              => null,
			'hero_img'          => 'the-distillery-phuket-hero.jpg',
			'challenge_title' => 'A working distillery needed marketing that could turn tours and reviews into bookings.',
			'challenge_body'  => 'The Distillery Phuket is a working craft-spirits distillery and restaurant in Chalong, Phuket, distilling Chalong Bay rum, Saneha gin and Lanna vodka on-site from Thai ingredients, alongside a Thai-fusion dining menu and distillery tours. A strong reputation — including TripAdvisor Travelers\' Choice Awards in 2023, 2024 and 2025 — doesn\'t by itself convert into a steady, trackable stream of tour and table bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn The Distillery Phuket\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to The Distillery Phuket\'s tour-and-dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to tour or table booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'bartolo',
			'name'              => 'Bartolo',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant, Cocktail',
			'desc'              => 'Managing paid media and full-funnel tracking for Bartolo, turning its bistro concept into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'bartolo-photo.jpg',
			'alt'               => 'A cocktail being poured at Bartolo',
			'href'              => null,
			'hero_img'          => 'bartolo-hero.jpg',
			'challenge_title' => 'A neighborhood bistro needed a way to prove which bookings its ads actually drove.',
			'challenge_body'  => 'Bartolo is a bistro and cocktail bar in Uluwatu, Bali, serving French and Italian cooking with a vermouth-focused cocktail program, open daily with a nightly happy hour. A loyal local following doesn\'t automatically show up as a steady, trackable stream of reservations — the venue needed a paid media system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Bartolo\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Bartolo\'s bistro-and-cocktail crowd in Uluwatu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'mood-by-ours',
			'name'              => 'Mood by Ours',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant, Minimart',
			'desc'              => 'Managing paid media and full-funnel tracking for Mood by Ours, turning its farm-to-table story into a steady stream of qualified orders and visits.',
			'result'            => null,
			'img'               => 'mood-by-ours-photo.jpg',
			'alt'               => 'Fresh market produce at Mood by Ours',
			'href'              => null,
			'hero_img'          => 'mood-by-ours-hero.jpg',
			'challenge_title' => 'A farm-to-table concept needed marketing that matched its supply chain story.',
			'challenge_body'  => 'Mood by Ours is a farm-to-table cafe and organic market in Uluwatu, Bali, part of the Ours Group, sourcing the majority of its produce from the group\'s own farm in Bedugul and making its pastas, sauces and pantry staples in-house. A real supply-chain story like that needed a paid media system built to turn it into a steady, trackable stream of cafe visits and market orders.',
			'strategy_title'  => 'Full-funnel marketing built for orders and visits, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Mood by Ours\'s reputation into qualified orders and visits.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Mood by Ours\' cafe-and-market crowd in Uluwatu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to order or reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified orders and visits.' ),
			),
		),
		array(
			'slug'              => 'meso',
			'name'              => 'Meso',
			'badge'             => 'Beach Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Beach Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for Meso, turning its beachfront setting into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'meso.png',
			'alt'               => 'Meso logo',
			'href'              => null,
			'challenge_title' => 'A resort restaurant needed a way to turn its setting into trackable bookings.',
			'challenge_body'  => 'Meso is a beach restaurant on the resort grounds of Marbela Beach on Morjim Beach, North Goa, India. Sitting inside an established beachfront resort brings passing interest, but it doesn\'t by itself convert into a steady, trackable stream of table bookings — the restaurant needed a paid media system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Meso\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Meso\'s beachfront dining crowd in Goa.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to table booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'the-9th-degree',
			'name'              => 'The 9th Degree',
			'badge'             => 'Lagoon Front Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Lagoon Front Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for The 9th Degree, turning its lagoon-front setting into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'the-9th-degree-photo.jpg',
			'alt'               => 'The lagoon-front boardwalk at The 9th Degree',
			'href'              => null,
			'hero_img'          => 'the-9th-degree-hero.jpg',
			'challenge_title' => 'A lagoon-front setting needed a way to turn its view into trackable bookings.',
			'challenge_body'  => 'The 9th Degree is a lagoon-front restaurant in Phuket, built around its waterfront boardwalk setting. A striking view alone doesn\'t convert into a steady, trackable stream of reservations — the venue needed a paid media system built to turn that setting into measurable, qualified bookings.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn The 9th Degree\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to The 9th Degree\'s lagoon-front dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'tempo',
			'name'              => 'Tempo',
			'badge'             => 'Lounge & KTV',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Lounge & KTV',
			'desc'              => 'Managing paid media and full-funnel tracking for Tempo, turning its restaurant, lounge and KTV concept into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'tempo-photo.jpg',
			'alt'               => 'The exterior of Tempo Restaurant, Lounge &amp; KTV',
			'href'              => null,
			'hero_img'          => 'tempo-hero.jpg',
			'hero_alt'          => 'A KTV lounge room at Tempo',
			'supporting_img'    => 'tempo-supporting.jpg',
			'supporting_alt'    => 'Guests singing karaoke at Tempo',
			'challenge_title' => 'A restaurant, lounge and KTV concept needed one system to fill three different rooms.',
			'challenge_body'  => 'Tempo Restaurant, Lounge & KTV is a multipurpose venue in Chalong, Phuket, combining a restaurant, a cocktail lounge and private karaoke rooms in three sizes. Running three distinct experiences under one roof meant the venue needed a paid media system built to turn interest in any of them into a steady, trackable stream of bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Tempo\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Tempo\'s restaurant, lounge and KTV crowd in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to table or room booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'penida-colada',
			'name'              => 'Penida Colada',
			'badge'             => 'Beach Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Beach Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for Penida Colada, turning its remote beachfront setting into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'penida-colada.png',
			'alt'               => 'Penida Colada logo',
			'href'              => null,
			'challenge_title' => 'A remote-island location made trackable marketing more important, not less.',
			'challenge_body'  => 'Penida Colada is a beachfront restaurant and bar on the north shore of Nusa Penida, Bali, serving a Modern Australian-Indonesian menu with nightly live music. Being off the main Bali tourist strip means the venue can\'t rely on passing foot traffic — it needed a paid media system built to turn its ocean-view setting into a steady, trackable stream of bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Penida Colada\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Penida Colada\'s beachfront dining crowd on Nusa Penida.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'bollywood-phuket',
			'name'              => 'Bollywood Phuket',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for Bollywood Phuket, turning its home-kitchen story into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'bollywood-phuket-photo.jpg',
			'alt'               => 'The entrance at Bollywood Phuket',
			'href'              => null,
			'hero_img'          => 'bollywood-phuket-hero.jpg',
			'challenge_title' => 'A home-kitchen story needed marketing that could carry it beyond word of mouth.',
			'challenge_body'  => 'Bollywood Phuket is an Indian bistro and bar in Phuket, built on a founding story that grew out of a home kitchen. A great origin story travels by word of mouth, but it doesn\'t by itself convert into a steady, trackable stream of reservations — the venue needed a paid media system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Bollywood Phuket\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Bollywood Phuket\'s dining crowd in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'the-firefly-club',
			'name'              => 'The Firefly Club',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for The Firefly Club, turning interest in its concept into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'the-firefly-club.png',
			'alt'               => 'The Firefly Club logo',
			'href'              => null,
			'challenge_title' => 'A restaurant needed a way to turn interest into trackable reservations.',
			'challenge_body'  => 'The Firefly Club is a restaurant built around its own concept and menu. A good concept alone doesn\'t convert into a steady, trackable stream of reservations — the venue needed a paid media system built to turn interest into measurable, qualified bookings.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn The Firefly Club\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to The Firefly Club\'s dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'lulu-bistrot',
			'name'              => 'Lulu Bistrot',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant, Bistro, Cocktail Bar',
			'desc'              => 'Managing paid media and full-funnel tracking for Lulu Bistrot, turning its bistro concept into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'lulu-bistrot-photo.jpg',
			'alt'               => 'A cocktail being poured at Lulu Bistrot',
			'href'              => null,
			'hero_img'          => 'lulu-bistrot-hero.jpg',
			'challenge_title' => 'A Parisian-inspired bistro needed a way to prove which reservations its ads actually drove.',
			'challenge_body'  => 'Lulu Bistrot is a French bistro and bar in Canggu, Bali, serving French classics with Indonesian influences, with a six-seat Chef\'s Counter tasting menu and a sister restaurant, Bartolo, in Uluwatu. A distinctive concept doesn\'t fill tables and the Chef\'s Counter on its own — the venue needed a paid media system built to turn interest into a steady, trackable stream of reservations.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Lulu Bistrot\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Lulu Bistrot\'s bistro-dining crowd in Canggu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'babou',
			'name'              => 'Babou',
			'badge'             => 'Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Restaurant, Club',
			'desc'              => 'Managing paid media and full-funnel tracking for Babou, turning its rebrand into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'babou-photo.jpg',
			'alt'               => 'The outdoor lounge at Babou',
			'href'              => null,
			'hero_img'          => 'babou-hero.jpg',
			'challenge_title' => 'A rebrand needed marketing that could carry three decades of history into a new identity.',
			'challenge_body'  => 'Babou is a supper club and nightlife venue within Muang Samui Spa Resort in Chaweng, Koh Samui, serving a raw bar, dry-aged fish and charcoal-grilled seafood, with roots tracing back three decades to Drop-In Samui before its rebrand. A rebrand like that needed a paid media system built to turn renewed interest into a steady, trackable stream of bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Babou\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Babou\'s supper-club-and-nightlife crowd in Koh Samui.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to table booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'hug-samui',
			'name'              => 'Hug Samui',
			'badge'             => 'Beachfront Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Beachfront Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for Hug Samui, turning its beachfront seafood concept into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'hug-samui-photo.jpg',
			'alt'               => 'A seafood platter at Hug Samui',
			'href'              => null,
			'hero_img'          => 'hug-samui-hero.jpg',
			'challenge_title' => 'A beachfront seafood spot needed a way to turn its setting into trackable bookings.',
			'challenge_body'  => 'Hug Samui is a beachfront restaurant on Koh Samui known for its seafood. A beachfront location and a strong menu don\'t automatically convert into a steady, trackable stream of reservations — the venue needed a paid media system built for exactly that.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Hug Samui\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Hug Samui\'s beachfront dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'burnt',
			'name'              => 'Burnt',
			'badge'             => 'Beachfront Restaurant',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Beachfront Restaurant',
			'desc'              => 'Managing paid media and full-funnel tracking for Burnt, turning its char-grill concept into a steady stream of qualified reservations.',
			'result'            => null,
			'img'               => 'burnt-photo.jpg',
			'alt'               => 'A char-grilled steak at Burnt',
			'href'              => null,
			'hero_img'          => 'burnt-hero.jpg',
			'challenge_title' => 'A char-grill concept needed a way to turn its menu into trackable bookings.',
			'challenge_body'  => 'Burnt is a beachfront restaurant built around char-grilled, live-fire cooking. A distinctive menu alone doesn\'t convert into a steady, trackable stream of reservations — the venue needed a paid media system built to turn interest in its food into measurable, qualified bookings.',
			'strategy_title'  => 'Full-funnel marketing built for reservations, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Burnt\'s reputation into qualified reservations.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Burnt\'s beachfront dining crowd.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to reservation, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified reservations.' ),
			),
		),
		array(
			'slug'              => 'muang-samui-resort',
			'name'              => 'Muang Samui Resort',
			'badge'             => 'Beachfront Resort',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Muang Samui Resort, turning its resort amenities into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'muang-samui-resort-photo.jpg',
			'alt'               => 'The beachfront loungers at Muang Samui Resort',
			'href'              => null,
			'hero_img'          => 'muang-samui-resort-hero.jpg',
			'challenge_title' => 'A resort with real amenities still needed proof that its ads were driving bookings.',
			'challenge_body'  => 'Muang Samui Spa Resort is a 53-suite beachfront resort on Chaweng Beach, Koh Samui, with a freeform beachfront pool, an on-site gym, a spa, and two in-house restaurants under the philosophy "Sleep Well, Move Well, Dine Well." A resort with amenities this complete needed a paid media system built to turn interest into a steady, trackable stream of room bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Muang Samui Resort\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Muang Samui Resort\'s guests in Koh Samui.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to room booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'mel-francis-villa',
			'name'              => 'Mel Francis Villa',
			'badge'             => 'Luxury Villas',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Luxury Villas',
			'desc'              => 'Managing paid media and full-funnel tracking for Mel Francis Villa, turning its villa investment offer into a steady stream of qualified buyer enquiries.',
			'result'            => null,
			'img'               => 'mel-francis-villa-photo.jpg',
			'alt'               => 'A villa bathroom at Mel Francis Villa',
			'href'              => null,
			'hero_img'          => 'mel-francis-villa-hero.jpg',
			'challenge_title' => 'A villa investment offer needed marketing built for serious buyers, not just browsers.',
			'challenge_body'  => 'Mel Francis Villas is a luxury villa design, construction and off-plan investment company based in Uluwatu, Bali, offering custom villa builds near Balangan and Nyang Nyang beaches with projected ROI figures and a five-year structural warranty. An investment offer like that needed a paid media system built to turn interest into a steady, trackable stream of qualified buyer enquiries, not just casual browsing.',
			'strategy_title'  => 'Full-funnel marketing built for buyer enquiries, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Mel Francis Villa\'s reputation into qualified buyer enquiries.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Mel Francis Villa\'s property-investor audience in Bali.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to buyer enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified buyer enquiries.' ),
			),
		),
		array(
			'slug'              => 'house-of-om',
			'name'              => 'House of Om',
			'badge'             => 'Yoga School',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Yoga School',
			'desc'              => 'Managing paid media and full-funnel tracking for House of Om, turning interest across its campuses into a steady stream of qualified enrollments.',
			'result'            => null,
			'img'               => 'house-of-om-photo.jpg',
			'alt'               => 'The pool walkway at House of Om',
			'href'              => null,
			'hero_img'          => 'house-of-om-hero.jpg',
			'challenge_title' => 'A multi-campus yoga school needed one system to fill every campus, not just the flagship.',
			'challenge_body'  => 'House of Om is a yoga teacher training organization founded in Dubai in 2016, now running multiple campuses across Bali, Rishikesh and Koh Phangan, with an online academy it states has educated over 10,000 students. Growing across that many locations meant the school needed a paid media system built to turn interest into a steady, trackable stream of enrollments at every campus.',
			'strategy_title'  => 'Full-funnel marketing built for enrollments, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn House of Om\'s reputation into qualified enrollments.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to House of Om\'s prospective yoga-teacher-training students.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to training enrollment, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified enrollments.' ),
			),
		),
		array(
			'slug'              => 'shaz-aesthetic-media-spa',
			'name'              => 'Shaz Aesthetic & Media Spa',
			'badge'             => 'Aesthetic Clinic',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Shaz Aesthetic & Media Spa, turning interest in its treatments into a steady stream of qualified appointment bookings.',
			'result'            => null,
			'img'               => 'shaz-spa-photo.jpg',
			'alt'               => 'The interior of Shaz Aesthetic & Media Spa',
			'href'              => null,
			'hero_img'          => 'shaz-spa-hero.jpg',
			'challenge_title' => 'A two-location clinic needed a way to prove which bookings its ads actually drove.',
			'challenge_body'  => 'Shaz is a medical aesthetic clinic and salon with locations in Seminyak and Canggu, Bali, offering facials, injectables, laser treatments and body contouring under a stated medical team. Two locations and a wide service menu meant the clinic needed a paid media system built to turn interest into a steady, trackable stream of appointment bookings.',
			'strategy_title'  => 'Full-funnel marketing built for appointment bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Shaz Aesthetic & Media Spa\'s reputation into qualified appointment bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Shaz\'s aesthetic-treatment clientele in Bali.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to appointment booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified appointment bookings.' ),
			),
		),
		array(
			'slug'              => 'arna-oceanic-wellness-spa',
			'name'              => 'Arna Oceanic Wellness Spa',
			'badge'             => 'Wellness Spa',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Arna Oceanic Wellness Spa, turning its spa concept into a steady stream of qualified bookings.',
			'result'            => null,
			'img'               => 'arna.png',
			'alt'               => 'Arna Oceanic Wellness Spa logo',
			'href'              => null,
			'challenge_title' => 'A spa built around a distinctive concept needed a way to turn that concept into trackable bookings.',
			'challenge_body'  => 'Arna Oceanic Wellness Spa is a spa within Muang Samui Spa Resort on Chaweng Beach, Koh Samui, built around onsen baths, Vichy showers, plunge pools, a Finnish sauna and Ayurvedic treatments. A concept this distinctive needed a paid media system built to turn interest into a steady, trackable stream of spa bookings.',
			'strategy_title'  => 'Full-funnel marketing built for spa bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Arna Oceanic Wellness Spa\'s reputation into qualified spa bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Arna Oceanic Wellness Spa\'s guests in Koh Samui.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to spa booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified spa bookings.' ),
			),
		),
		array(
			'slug'              => 'cave-rai-ra',
			'name'              => 'Cave Rai Ra',
			'badge'             => 'Wellness Spa',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Wellness Spa',
			'desc'              => 'Managing paid media and full-funnel tracking for Cave Rai Ra, turning its cave-themed concept into a steady stream of qualified treatment bookings.',
			'result'            => null,
			'img'               => 'cave-rai-ra.png',
			'alt'               => 'Cave Rai Ra logo',
			'href'              => null,
			'challenge_title' => 'A cave-themed spa needed marketing that could turn its concept into trackable bookings.',
			'challenge_body'  => 'Cave Rai-Ra is a cave-themed spa at Royal Muang Samui Villas on Choengmon Beach, Koh Samui, with five treatment rooms designed around the landscapes of Ang Thong Marine Park. A concept this distinctive doesn\'t fill an appointment book on its own — the spa needed a paid media system built to turn interest into a steady, trackable stream of treatment bookings.',
			'strategy_title'  => 'Full-funnel marketing built for treatment bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Cave Rai Ra\'s reputation into qualified treatment bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Cave Rai-Ra\'s spa guests in Koh Samui.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to treatment booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified treatment bookings.' ),
			),
		),
		array(
			'slug'              => 'athlean',
			'name'              => 'Athlean',
			'badge'             => 'Gym',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Gym',
			'desc'              => 'Managing paid media and full-funnel tracking for Athlean, turning interest into a steady stream of qualified membership sign-ups.',
			'result'            => null,
			'img'               => 'athlean-photo.jpg',
			'alt'               => 'The weights area at Athlean',
			'href'              => null,
			'hero_img'          => 'athlean-hero.jpg',
			'challenge_title' => 'A neighborhood gym needed a way to turn interest into trackable membership sign-ups.',
			'challenge_body'  => 'Athlean is a gym in Seminyak, Bali, part of the Raw Gym Bali network, offering modern equipment, personal training and group classes. In a neighborhood with plenty of gym options, Athlean needed a paid media system built to turn interest into a steady, trackable stream of trial visits and membership sign-ups.',
			'strategy_title'  => 'Full-funnel marketing built for membership sign-ups, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Athlean\'s reputation into qualified membership sign-ups.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Athlean\'s gym-goers in Seminyak.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to trial or membership sign-up, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified membership sign-ups.' ),
			),
		),
		array(
			'slug'              => 'tribal-fitness',
			'name'              => 'Tribal Fitness',
			'badge'             => 'Gym',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Gym',
			'desc'              => 'Managing paid media and full-funnel tracking for Tribal Fitness, turning its data-driven training story into a steady stream of qualified trial sign-ups.',
			'result'            => null,
			'img'               => 'tribal-fitness.png',
			'alt'               => 'Tribal Fitness logo',
			'href'              => null,
			'challenge_title' => 'A data-driven training method needed marketing that could explain it and still convert.',
			'challenge_body'  => 'Tribal Fitness is a community-focused gym in BSD, Jakarta, built around a science-based, data-driven training methodology developed by a 30-year fitness-industry veteran. A more technical pitch than a typical gym needed a paid media system built to turn that story into a steady, trackable stream of trial sign-ups.',
			'strategy_title'  => 'Full-funnel marketing built for trial sign-ups, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Tribal Fitness\'s reputation into qualified trial sign-ups.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Tribal Fitness\' members in BSD, Jakarta.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to trial sign-up, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified trial sign-ups.' ),
			),
		),
		array(
			'slug'              => 'raw-ubud',
			'name'              => 'Raw Ubud',
			'badge'             => 'Gym',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Gym',
			'desc'              => 'Managing paid media and full-funnel tracking for Raw Ubud, turning interest into a steady stream of qualified membership sign-ups.',
			'result'            => null,
			'img'               => 'raw-ubud.png',
			'alt'               => 'Raw Ubud logo',
			'href'              => null,
			'challenge_title' => 'A gym in a competitive wellness town needed proof of which sign-ups its ads drove.',
			'challenge_body'  => 'Raw Ubud is a gym in Ubud, Bali, part of the Raw Gym Bali chain, offering equipment, coaching, classes and recovery facilities. Ubud\'s wellness scene is crowded, so the gym needed a paid media system built to turn interest into a steady, trackable stream of trial and membership sign-ups.',
			'strategy_title'  => 'Full-funnel marketing built for membership sign-ups, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Raw Ubud\'s reputation into qualified membership sign-ups.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Raw Ubud\'s gym-goers in Ubud.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to trial or membership sign-up, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified membership sign-ups.' ),
			),
		),
		array(
			'slug'              => 'nuhuman-raw',
			'name'              => 'Nuhuman Raw',
			'badge'             => 'Gym',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Gym',
			'desc'              => 'Managing paid media and full-funnel tracking for Nuhuman Raw, turning interest into a steady stream of qualified membership applications.',
			'result'            => null,
			'img'               => 'nuhuman-raw.png',
			'alt'               => 'Nuhuman Raw logo',
			'href'              => null,
			'challenge_title' => 'A curated-membership model needed marketing built for qualified applicants, not just clicks.',
			'challenge_body'  => 'nuHuman by RAW is a beachfront performance and recovery facility in Canggu, Bali, combining strength training zones with cold/heat recovery protocols and an on-site nutrition cafe, using a curated membership application process. That kind of positioning needed a paid media system built to turn interest into a steady, trackable stream of qualified membership applications.',
			'strategy_title'  => 'Full-funnel marketing built for membership applications, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Nuhuman Raw\'s reputation into qualified membership applications.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to nuHuman by RAW\'s performance-focused audience in Canggu.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to membership application, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified membership applications.' ),
			),
		),
		array(
			'slug'              => 'kyzn',
			'name'              => 'Kyzn',
			'badge'             => 'Wellness Club',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Kyzn, turning interest across its clubs into a steady stream of qualified membership sign-ups.',
			'result'            => null,
			'img'               => 'kyzn-photo.jpg',
			'alt'               => 'The indoor basketball court at Kyzn',
			'href'              => null,
			'hero_img'          => 'kyzn-hero.jpg',
			'challenge_title' => 'A multi-club, all-ages concept needed one system to fill sign-ups across every location.',
			'challenge_body'  => 'KYZN is a family and social wellness club chain headquartered in Jakarta with clubs across Kuningan, BSD City, Surabaya and Bekasi, offering wellness, sports and lifestyle programs for all ages. Running programs across that many clubs and age groups meant KYZN needed a paid media system built to turn interest into a steady, trackable stream of membership sign-ups at every location.',
			'strategy_title'  => 'Full-funnel marketing built for membership sign-ups, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Kyzn\'s reputation into qualified membership sign-ups.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to KYZN\'s members across its Indonesian clubs.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to membership sign-up, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified membership sign-ups.' ),
			),
		),
		array(
			'slug'              => 'royal-finances',
			'name'              => 'Royal Finances',
			'badge'             => 'Short-Term Lending',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Royal Finances, turning ad interest into a steady stream of qualified loan applications.',
			'result'            => null,
			'img'               => 'royal-finances.png',
			'alt'               => 'Royal Finances logo',
			'href'              => null,
			'challenge_title' => 'A short-term lender needed a way to turn ad clicks into trackable, qualified applications.',
			'challenge_body'  => 'Royal Finances is a short-term lending service based in Rawdon, Quebec, Canada, offering fast loan approvals with funds sent by e-Transfer. In lending, a click means little without a completed, qualified application — the business needed a paid media system built to turn interest into a steady, trackable stream of loan applications.',
			'strategy_title'  => 'Full-funnel marketing built for loan applications, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Royal Finances\'s reputation into qualified loan applications.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Royal Finances\' loan applicants in Quebec.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to loan application, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified loan applications.' ),
			),
		),
		array(
			'slug'              => 'simple-financial',
			'name'              => 'Simple Financial',
			'badge'             => 'Short-Term Lending',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Simple Financial, turning ad traffic into a steady stream of qualified loan applications.',
			'result'            => null,
			'img'               => 'simple-financial.png',
			'alt'               => 'Simple Financial logo',
			'href'              => null,
			'challenge_title' => 'A licensed lender needed marketing built for qualified applicants, not just traffic.',
			'challenge_body'  => 'Simple Financial is a licensed online payday lender based in Mississauga, Ontario, Canada, offering short-term loans with e-Transfer funding. In a regulated lending category, the business needed a paid media and tracking system built to turn traffic into a steady, trackable stream of qualified loan applications.',
			'strategy_title'  => 'Full-funnel marketing built for loan applications, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Simple Financial\'s reputation into qualified loan applications.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Simple Financial\'s loan applicants in Ontario.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to loan application, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified loan applications.' ),
			),
		),
		array(
			'slug'              => 'simple-pret',
			'name'              => 'Simple Pret',
			'badge'             => 'Short-Term Lending',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Simple Pret, turning ad interest into a steady stream of qualified loan applications.',
			'result'            => null,
			'img'               => 'simple-pret.png',
			'alt'               => 'Simple Pret logo',
			'href'              => null,
			'challenge_title' => 'A Quebec lender needed proof of which applications its ad spend actually drove.',
			'challenge_body'  => 'Simple Pret is a short-term loan company licensed in Quebec, Canada, offering loans funded by e-Transfer with no credit checks. Operating in a regulated lending category meant the business needed a paid media and tracking system built to turn interest into a steady, trackable stream of qualified loan applications.',
			'strategy_title'  => 'Full-funnel marketing built for loan applications, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Simple Pret\'s reputation into qualified loan applications.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Simple Pret\'s loan applicants in Quebec.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to loan application, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified loan applications.' ),
			),
		),
		array(
			'slug'              => 'cash-depot',
			'name'              => 'Cash Depot',
			'badge'             => 'Consumer Finance',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Cash Depot, turning ad interest into a steady stream of qualified applications.',
			'result'            => null,
			'img'               => 'cash-depot-photo.jpg',
			'alt'               => 'The storefront of Cash Depot',
			'href'              => null,
			'hero_img'          => 'cash-depot-hero.jpg',
			'challenge_title' => 'A storefront lending business needed a way to prove which applications its ads drove.',
			'challenge_body'  => 'Cash Depot operates from a physical storefront. A storefront alone doesn\'t guarantee a steady, trackable stream of qualified applications — the business needed a paid media system built to turn interest into measurable, qualified leads.',
			'strategy_title'  => 'Full-funnel marketing built for applications, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Cash Depot\'s reputation into qualified applications.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Cash Depot\'s customers.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to application, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified applications.' ),
			),
		),
		array(
			'slug'              => 'trader2b',
			'name'              => 'Trader2B',
			'badge'             => 'Trading Simulator',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Trading Simulator',
			'desc'              => 'Managing paid media and full-funnel tracking for Trader2B, turning interest into a steady stream of qualified challenge sign-ups.',
			'result'            => null,
			'img'               => 'trader2b.png',
			'alt'               => 'Trader2B logo',
			'href'              => null,
			'challenge_title' => 'A trader-evaluation program needed marketing built for serious, qualified sign-ups.',
			'challenge_body'  => 'Trader2B is a US-based proprietary trading firm running the ToroChallenge, a paid trader-evaluation program across simulated $25K, $100K and $250K account tiers, with a profit split of up to 99% for traders who pass. A challenge like that needed a paid media system built to turn interest into a steady, trackable stream of qualified challenge sign-ups.',
			'strategy_title'  => 'Full-funnel marketing built for challenge sign-ups, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Trader2B\'s reputation into qualified challenge sign-ups.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Trader2B\'s prospective traders.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to challenge sign-up, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified challenge sign-ups.' ),
			),
		),
		array(
			'slug'              => 'natuurvlees-nl',
			'name'              => 'Natuurvlees.nl',
			'badge'             => 'Meat Butcher',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Meat Butcher',
			'desc'              => 'Managing paid media and full-funnel tracking for Natuurvlees.nl, turning its farm-direct story into a steady stream of qualified orders.',
			'result'            => null,
			'img'               => 'natuurvlees-photo.jpg',
			'alt'               => 'The Natuurvlees.nl delivery van',
			'href'              => null,
			'hero_img'          => 'natuurvlees-hero.jpg',
			'challenge_title' => 'A farm-direct butcher needed marketing that could carry its supply-chain story to online orders.',
			'challenge_body'  => 'Natuurvlees.nl is a Dutch online butcher tied to the farm Waterlant\'s Weelde in Drenthe, the Netherlands, sourcing meat directly from its own farmers and running its own in-house sausage-making operation, with home delivery. A direct-from-farm story like that needed a paid media system built to turn interest into a steady, trackable stream of online orders.',
			'strategy_title'  => 'Full-funnel marketing built for orders, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Natuurvlees.nl\'s reputation into qualified orders.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Natuurvlees.nl\'s customers in the Netherlands.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to order, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified orders.' ),
			),
		),
		array(
			'slug'              => 'bb-b',
			'name'              => 'BB&B',
			'badge'             => 'Beer & Beverage Import',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Beer & Beverage Import, Bangkok',
			'desc'              => 'Managing paid media and full-funnel tracking for BB&B, turning interest into a steady stream of qualified trade enquiries.',
			'result'            => null,
			'img'               => 'bbb-photo.jpg',
			'alt'               => 'The retail showroom at BB&B',
			'href'              => null,
			'hero_img'          => 'bbb-hero.jpg',
			'challenge_title' => 'A specialty beverage distributor needed marketing built for trade enquiries, not just awareness.',
			'challenge_body'  => 'BB&B (Bangkok Beer & Beverages Co., Ltd.) is a Bangkok-headquartered importer and distributor of specialty beers, wines, spirits, coffee and tea, with offices across Thailand and its own beverage training academy. A B2B distribution business like this needed a paid media system built to turn interest into a steady, trackable stream of trade enquiries.',
			'strategy_title'  => 'Full-funnel marketing built for trade enquiries, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn BB&B\'s reputation into qualified trade enquiries.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to BB&B\'s trade customers across Thailand.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to trade enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified trade enquiries.' ),
			),
		),
		array(
			'slug'              => 'simba-sea-trips',
			'name'              => 'Simba Sea Trips',
			'badge'             => 'Boat Tours',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Simba Sea Trips, turning its reputation into a steady stream of qualified tour bookings.',
			'result'            => null,
			'img'               => 'simba-sea-trips-photo.jpg',
			'alt'               => 'Snorkel gear aboard a Simba Sea Trips boat',
			'href'              => null,
			'hero_img'          => 'simba-sea-trips-hero.jpg',
			'challenge_title' => 'A multi-award tour operator still needed proof of which bookings its ads actually drove.',
			'challenge_body'  => 'Simba Sea Trips is an Australian-owned, family-run speedboat tour operator based at Boat Lagoon Marina in Phuket, running trips to Phi Phi Islands, Phang Nga Bay and Krabi since 2005, and a winner of the World Luxury Travel Awards 2025. Even with strong reviews and awards, the operator needed a paid media system built to turn interest into a steady, trackable stream of tour bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Simba Sea Trips\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Simba Sea Trips\' tour guests in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to tour booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'hug-ocean',
			'name'              => 'Hug Ocean',
			'badge'             => 'Scuba Diving',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Scuba Diving',
			'desc'              => 'Managing paid media and full-funnel tracking for Hug Ocean, turning interest into a steady stream of qualified course and trip bookings.',
			'result'            => null,
			'img'               => 'hug-ocean-photo.jpg',
			'alt'               => 'The Hug Ocean dive boat',
			'href'              => null,
			'hero_img'          => 'hug-ocean-hero.jpg',
			'challenge_title' => 'A dive center needed a way to turn interest into trackable course and trip bookings.',
			'challenge_body'  => 'Hug Ocean is a PADI 5 Star Dive Center in Rawai, Phuket, offering scuba courses, dive trips and equipment rental. A strong PADI rating alone doesn\'t fill a dive calendar — the center needed a paid media system built to turn interest into a steady, trackable stream of course and trip bookings.',
			'strategy_title'  => 'Full-funnel marketing built for bookings, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Hug Ocean\'s reputation into qualified bookings.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Hug Ocean\'s divers in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to course or dive-trip booking, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified bookings.' ),
			),
		),
		array(
			'slug'              => 'steam-cleaning',
			'name'              => 'Steam Cleaning',
			'badge'             => 'Cleaning Services',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Steam Cleaning, turning its certification into a steady stream of qualified commercial enquiries.',
			'result'            => null,
			'img'               => 'steam-cleaning-bangkok.png',
			'alt'               => 'Steam Cleaning logo',
			'href'              => null,
			'challenge_title' => 'A specialist certification needed marketing built for qualified commercial enquiries.',
			'challenge_body'  => 'Steam Cleaning Phuket is a decontamination and cleaning company serving yachts, hotels, resorts, condominiums and restaurants, stating it is Thailand\'s only AFNOR NF T72-110 certified operator using a chemical-free steam and enzymatic cleaning process. A specialist certification like that needed a paid media system built to turn interest into a steady, trackable stream of qualified commercial enquiries.',
			'strategy_title'  => 'Full-funnel marketing built for commercial enquiries, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Steam Cleaning\'s reputation into qualified commercial enquiries.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Steam Cleaning\'s commercial clients in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to commercial enquiry, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified commercial enquiries.' ),
			),
		),
		array(
			'slug'              => 'dreamer-phuket',
			'name'              => 'Dreamer Phuket',
			'badge'             => 'Cafe & Lifestyle Space',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => '',
			'desc'              => 'Managing paid media and full-funnel tracking for Dreamer Phuket, turning interest into a steady stream of qualified customer visits.',
			'result'            => null,
			'img'               => 'the-dreamer-phuket.png',
			'alt'               => 'Dreamer Phuket logo',
			'href'              => null,
			'challenge_title' => 'A multi-concept lifestyle space needed one system to turn interest into trackable visits.',
			'challenge_body'  => 'Dreamers Phuket is a lifestyle space in Kamala, Phuket, combining a cafe, a boutique and a co-working area under one roof. Running several concepts in one space meant the business needed a paid media system built to turn interest into a steady, trackable stream of customer visits.',
			'strategy_title'  => 'Full-funnel marketing built for visits, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Dreamer Phuket\'s reputation into qualified visits.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Dreamer Phuket\'s customers in Kamala.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to visit, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified visits.' ),
			),
		),
		array(
			'slug'              => 'unity-festival-thailand',
			'name'              => 'Unity Festival Thailand',
			'badge'             => 'Festival',
			'industry'          => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
			'type'              => 'Festival',
			'desc'              => 'Managing paid media and full-funnel tracking for Unity Festival Thailand, turning interest into a steady stream of qualified ticket sales.',
			'result'            => null,
			'img'               => 'unity.png',
			'alt'               => 'Unity Festival Thailand logo',
			'href'              => null,
			'challenge_title' => 'A first-year festival needed marketing built for ticket sales, not just buzz.',
			'challenge_body'  => 'Unity Festival Thailand is an electronic music festival on Paradise Beach, Patong, Phuket, whose first edition featured international trance acts and psychedelic art installations. A first-year event has no track record to lean on — it needed a paid media system built to turn interest into a steady, trackable stream of ticket sales.',
			'strategy_title'  => 'Full-funnel marketing built for ticket sales, not just clicks.',
			'strategy_intro'  => 'Three connected workstreams built to turn Unity Festival Thailand\'s reputation into qualified ticket sales.',
			'strategy_steps'  => array(
				array( 'title' => 'Paid Media', 'desc' => 'Campaigns built around real venue photography and audience targeting suited to Unity Festival Thailand\'s festival-goers in Phuket.' ),
				array( 'title' => 'Full-Funnel Marketing', 'desc' => 'Connecting every stage from first ad view through to ticket sale, not just optimizing for clicks.' ),
				array( 'title' => 'Conversion Rate Optimization', 'desc' => 'Ongoing testing of the enquiry and booking flow to convert more of that attention into qualified ticket sales.' ),
			),
		),
	);
}

function ldm_get_extra_case_studies() {
	return array(
		'ours-group' => array( 'slug' => 'ours-group', 'name' => 'Ours Group', 'badge' => 'Restaurant Group', 'industry' => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking', 'type' => null, 'desc' => 'Running paid media and a shared tracking system across five venues under one restaurant group — Ama, Home, Mood, The Beach and Ours Bali.', 'result' => null, 'img' => 'home-by-ours-photo.jpg', 'alt' => 'The outdoor dining terrace at Home by Ours, part of the Ours restaurant group', 'href' => null, 'hero_img' => 'home-by-ours-hero.jpg' ),
	);
}
/**
 * Renders one .ldm-case card. $entry comes from ldm_get_case_studies()
 * or ldm_get_extra_case_studies(); $href overrides the computed
 * /case-study/{slug}/ URL (used for Tirtha Bali's pre-existing Page).
 */
function ldm_render_case_card( $entry ) {
	$img_url  = get_template_directory_uri() . '/assets/img/clients/' . $entry['img'];
	$is_photo = (bool) preg_match( '/\.(jpg|jpeg)$/i', $entry['img'] );
	$img_style = $is_photo ? '' : ' style="object-fit:contain;background:var(--surface-1);"';
	$href = $entry['href'] ? home_url( '/case-study/' ) : ldm_case_study_url( $entry['slug'] );
	?>
	<a href="<?php echo esc_url( $href ); ?>" class="ldm-case reveal">
		<div class="ldm-case-media">
			<span class="badge"><?php echo wp_kses( $entry['badge'], array( 'amp' => array() ) ); ?></span>
			<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $entry['alt'] ); ?>" loading="lazy" width="1200" height="900"<?php echo $img_style; // phpcs:ignore -- static style string, not user input. ?>>
		</div>
		<div class="ldm-case-body">
			<div class="ldm-case-title"><span class="title-text"><?php echo esc_html( $entry['name'] ); ?></span> <span class="arrow">&rarr;</span></div>
			<?php if ( ! empty( $entry['industry'] ) ) : ?>
				<div class="ldm-case-industry"><?php echo wp_kses( $entry['industry'], array( 'middot' => array() ) ); ?></div>
			<?php elseif ( ! empty( $entry['type'] ) ) : ?>
				<div class="ldm-case-industry"><?php echo esc_html( $entry['type'] ); ?></div>
			<?php endif; ?>
			<?php if ( ! empty( $entry['desc'] ) ) : ?>
				<p class="ldm-case-desc"><?php echo esc_html( $entry['desc'] ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $entry['result'] ) ) : ?>
				<div class="ldm-case-result">+<?php echo esc_html( str_replace( ' ROAS', '', $entry['result'] ) ); ?> <span class="label">ROAS</span></div>
			<?php endif; ?>
		</div>
	</a>
	<?php
}

/** Renders the full Work-page case list — every project, highest verified ROAS first. */
function ldm_render_case_list() {
	foreach ( ldm_get_case_studies() as $entry ) {
		ldm_render_case_card( $entry );
	}
}

/**
 * Renders a full /case-study/{slug}/ page for any project other than
 * Tirtha Bali (which keeps its own hand-written page-case-study.php
 * content — it's the only one with a full Challenge/Strategy write-up
 * so far). Shows whatever real data exists (photo, tags, description,
 * verified result) and an honest "coming soon" note instead of an
 * invented narrative when there's no description yet.
 */
function ldm_render_generic_case_study( $entry ) {
	$hero_img  = $entry['hero_img'] ?? $entry['img'];
	$hero_alt  = $entry['hero_alt'] ?? $entry['alt'];
	$img_url   = get_template_directory_uri() . '/assets/img/clients/' . $hero_img;
	$is_photo  = (bool) preg_match( '/\.(jpg|jpeg)$/i', $hero_img );
	$img_style = $is_photo ? 'width:100%;height:100%;object-fit:cover;' : 'width:100%;height:100%;object-fit:contain;background:var(--surface-1);';
	?>
	<!-- PAGE HEADER -->
	<section class="ldm-page-header container">
		<span class="eyebrow">Case Study</span>
		<h1 class="fs-h1"><?php echo esc_html( $entry['name'] ); ?></h1>
		<div style="display:flex;gap:12px;flex-wrap:wrap;margin:20px 0 24px;">
			<span class="tag"><?php echo wp_kses( $entry['badge'], array( 'amp' => array() ) ); ?></span>
			<?php if ( ! empty( $entry['type'] ) && $entry['type'] !== $entry['badge'] ) : ?>
				<span class="tag"><?php echo esc_html( $entry['type'] ); ?></span>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $entry['desc'] ) ) : ?>
			<p class="lede"><?php echo esc_html( $entry['desc'] ); ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $entry['result'] ) ) : ?>
			<div class="ldm-case-result" style="margin-top:8px;">+<?php echo esc_html( str_replace( ' ROAS', '', $entry['result'] ) ); ?> <span class="label">ROAS</span></div>
		<?php endif; ?>
	</section>

	<!-- HERO IMAGE -->
	<section class="container">
		<div class="card-image reveal" style="aspect-ratio:16/9;">
			<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $hero_alt ); ?>" loading="lazy" width="1600" height="900" style="<?php echo esc_attr( $img_style ); ?>">
		</div>
	</section>

	<?php if ( ! empty( $entry['challenge_body'] ) ) : ?>
		<!-- CHALLENGE -->
		<section class="ldm-section container container-narrow">
			<div class="reveal">
				<span class="eyebrow">The Challenge</span>
				<h2 class="fs-h2" style="margin:16px 0 24px;"><?php echo esc_html( $entry['challenge_title'] ); ?></h2>
				<p class="lede" style="max-width:none;"><?php echo esc_html( $entry['challenge_body'] ); ?></p>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $entry['strategy_steps'] ) ) : ?>
		<!-- STRATEGY -->
		<section class="ldm-section container">
			<div class="ldm-section-head reveal">
				<span class="eyebrow">The Strategy</span>
				<h2 class="fs-h2"><?php echo esc_html( $entry['strategy_title'] ); ?></h2>
				<?php if ( ! empty( $entry['strategy_intro'] ) ) : ?>
					<p class="lede"><?php echo esc_html( $entry['strategy_intro'] ); ?></p>
				<?php endif; ?>
			</div>
			<div class="ldm-process cols-3 reveal">
				<?php foreach ( $entry['strategy_steps'] as $i => $step ) : ?>
					<div class="ldm-process-step">
						<div class="num"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></div>
						<h4><?php echo esc_html( $step['title'] ); ?></h4>
						<p><?php echo esc_html( $step['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( empty( $entry['desc'] ) ) : ?>
		<!-- COMING SOON NOTE -->
		<section class="ldm-section container container-narrow">
			<div class="reveal">
				<p class="lede" style="max-width:none;">The detailed write-up for this project is coming soon. In the meantime, feel free to get in touch to hear more about the work behind it.</p>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( ! empty( $entry['supporting_img'] ) ) : ?>
		<!-- SUPPORTING IMAGE -->
		<section class="ldm-section container container-narrow">
			<div class="card-image reveal" style="aspect-ratio:4/3;">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/clients/' . $entry['supporting_img'] ); ?>" alt="<?php echo esc_attr( $entry['supporting_alt'] ?? '' ); ?>" loading="lazy" width="1200" height="900" style="width:100%;height:100%;object-fit:cover;">
			</div>
		</section>
	<?php endif; ?>

	<!-- CONTACT CTA -->
	<section class="ldm-section container ldm-contact">
		<div class="reveal">
			<span class="eyebrow">Next Steps</span>
			<h2 class="fs-h2" style="margin-top:16px;">Have a similar project?</h2>
			<p class="lede">If your brand needs a paid media and tracking system built around qualified leads, not just clicks, let's talk.</p>
			<div class="ldm-contact-ctas">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Start a Conversation &rarr;</a>
			</div>
			<div class="ldm-contact-links">
				<?php ldm_render_contact_links(); ?>
			</div>
		</div>
	</section>
	<?php
}
