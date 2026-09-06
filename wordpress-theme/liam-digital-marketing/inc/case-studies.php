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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
			'badge'           => 'Hospitality',
			'industry'        => null,
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
		array( 'slug' => 'the-distillery-phuket', 'name' => 'The Distillery Phuket', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Distillery & Fusion Restaurant', 'desc' => null, 'result' => null, 'img' => 'the-distillery-phuket-photo.jpg', 'alt' => 'The garden pavilion at The Distillery Phuket', 'href' => null, 'hero_img' => 'the-distillery-phuket-hero.jpg' ),
		array( 'slug' => 'bartolo', 'name' => 'Bartolo', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant, Cocktail', 'desc' => null, 'result' => null, 'img' => 'bartolo-photo.jpg', 'alt' => 'A cocktail being poured at Bartolo', 'href' => null, 'hero_img' => 'bartolo-hero.jpg' ),
		array( 'slug' => 'mood-by-ours', 'name' => 'Mood by Ours', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant, Minimart', 'desc' => null, 'result' => null, 'img' => 'mood-by-ours-photo.jpg', 'alt' => 'Fresh market produce at Mood by Ours', 'href' => null, 'hero_img' => 'mood-by-ours-hero.jpg' ),
		array( 'slug' => 'meso', 'name' => 'Meso', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Beach Restaurant', 'desc' => null, 'result' => null, 'img' => 'meso.png', 'alt' => 'Meso logo', 'href' => null ),
		array( 'slug' => 'the-9th-degree', 'name' => 'The 9th Degree', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Lagoon Front Restaurant', 'desc' => null, 'result' => null, 'img' => 'the-9th-degree-photo.jpg', 'alt' => 'The lagoon-front boardwalk at The 9th Degree', 'href' => null, 'hero_img' => 'the-9th-degree-hero.jpg' ),
		array( 'slug' => 'tempo', 'name' => 'Tempo', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Lounge & KTV', 'desc' => null, 'result' => null, 'img' => 'tempo-photo.jpg', 'alt' => 'The exterior of Tempo Restaurant, Lounge &amp; KTV', 'href' => null, 'hero_img' => 'tempo-hero.jpg', 'hero_alt' => 'A KTV lounge room at Tempo', 'supporting_img' => 'tempo-supporting.jpg', 'supporting_alt' => 'Guests singing karaoke at Tempo' ),
		array( 'slug' => 'penida-colada', 'name' => 'Penida Colada', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Beach Restaurant', 'desc' => null, 'result' => null, 'img' => 'penida-colada.png', 'alt' => 'Penida Colada logo', 'href' => null ),
		array( 'slug' => 'bollywood-phuket', 'name' => 'Bollywood Phuket', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant', 'desc' => null, 'result' => null, 'img' => 'bollywood-phuket-photo.jpg', 'alt' => 'The entrance at Bollywood Phuket', 'href' => null, 'hero_img' => 'bollywood-phuket-hero.jpg' ),
		array( 'slug' => 'the-firefly-club', 'name' => 'The Firefly Club', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant', 'desc' => null, 'result' => null, 'img' => 'the-firefly-club.png', 'alt' => 'The Firefly Club logo', 'href' => null ),
		array( 'slug' => 'lulu-bistrot', 'name' => 'Lulu Bistrot', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant, Bistro, Cocktail Bar', 'desc' => null, 'result' => null, 'img' => 'lulu-bistrot-photo.jpg', 'alt' => 'A cocktail being poured at Lulu Bistrot', 'href' => null, 'hero_img' => 'lulu-bistrot-hero.jpg' ),
		array( 'slug' => 'babou', 'name' => 'Babou', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Restaurant, Club', 'desc' => null, 'result' => null, 'img' => 'babou-photo.jpg', 'alt' => 'The outdoor lounge at Babou', 'href' => null, 'hero_img' => 'babou-hero.jpg' ),
		array( 'slug' => 'hug-samui', 'name' => 'Hug Samui', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Beachfront Restaurant', 'desc' => null, 'result' => null, 'img' => 'hug-samui-photo.jpg', 'alt' => 'A seafood platter at Hug Samui', 'href' => null, 'hero_img' => 'hug-samui-hero.jpg' ),
		array( 'slug' => 'burnt', 'name' => 'Burnt', 'badge' => 'Hospitality', 'industry' => null, 'type' => 'Beachfront Restaurant', 'desc' => null, 'result' => null, 'img' => 'burnt-photo.jpg', 'alt' => 'A char-grilled steak at Burnt', 'href' => null, 'hero_img' => 'burnt-hero.jpg' ),
		array( 'slug' => 'muang-samui-resort', 'name' => 'Muang Samui Resort', 'badge' => 'Weddings &amp; Resorts', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'muang-samui-resort-photo.jpg', 'alt' => 'The beachfront loungers at Muang Samui Resort', 'href' => null, 'hero_img' => 'muang-samui-resort-hero.jpg' ),
		array( 'slug' => 'mel-francis-villa', 'name' => 'Mel Francis Villa', 'badge' => 'Weddings &amp; Resorts', 'industry' => null, 'type' => 'Luxury Villas', 'desc' => null, 'result' => null, 'img' => 'mel-francis-villa-photo.jpg', 'alt' => 'A villa bathroom at Mel Francis Villa', 'href' => null, 'hero_img' => 'mel-francis-villa-hero.jpg' ),
		array( 'slug' => 'house-of-om', 'name' => 'House of Om', 'badge' => 'Wellness', 'industry' => null, 'type' => 'Yoga School', 'desc' => null, 'result' => null, 'img' => 'house-of-om-photo.jpg', 'alt' => 'The pool walkway at House of Om', 'href' => null, 'hero_img' => 'house-of-om-hero.jpg' ),
		array( 'slug' => 'shaz-aesthetic-media-spa', 'name' => 'Shaz Aesthetic & Media Spa', 'badge' => 'Wellness', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'shaz-spa-photo.jpg', 'alt' => 'The interior of Shaz Aesthetic & Media Spa', 'href' => null, 'hero_img' => 'shaz-spa-hero.jpg' ),
		array( 'slug' => 'arna-oceanic-wellness-spa', 'name' => 'Arna Oceanic Wellness Spa', 'badge' => 'Wellness', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'arna.png', 'alt' => 'Arna Oceanic Wellness Spa logo', 'href' => null ),
		array( 'slug' => 'cave-rai-ra', 'name' => 'Cave Rai Ra', 'badge' => 'Wellness', 'industry' => null, 'type' => 'Wellness Spa', 'desc' => null, 'result' => null, 'img' => 'cave-rai-ra.png', 'alt' => 'Cave Rai Ra logo', 'href' => null ),
		array( 'slug' => 'athlean', 'name' => 'Athlean', 'badge' => 'Fitness', 'industry' => null, 'type' => 'Gym', 'desc' => null, 'result' => null, 'img' => 'athlean-photo.jpg', 'alt' => 'The weights area at Athlean', 'href' => null, 'hero_img' => 'athlean-hero.jpg' ),
		array( 'slug' => 'tribal-fitness', 'name' => 'Tribal Fitness', 'badge' => 'Fitness', 'industry' => null, 'type' => 'Gym', 'desc' => null, 'result' => null, 'img' => 'tribal-fitness.png', 'alt' => 'Tribal Fitness logo', 'href' => null ),
		array( 'slug' => 'raw-ubud', 'name' => 'Raw Ubud', 'badge' => 'Fitness', 'industry' => null, 'type' => 'Gym', 'desc' => null, 'result' => null, 'img' => 'raw-ubud.png', 'alt' => 'Raw Ubud logo', 'href' => null ),
		array( 'slug' => 'nuhuman-raw', 'name' => 'Nuhuman Raw', 'badge' => 'Fitness', 'industry' => null, 'type' => 'Gym', 'desc' => null, 'result' => null, 'img' => 'nuhuman-raw.png', 'alt' => 'Nuhuman Raw logo', 'href' => null ),
		array( 'slug' => 'kyzn', 'name' => 'Kyzn', 'badge' => 'Wellness', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'kyzn-photo.jpg', 'alt' => 'The indoor basketball court at Kyzn', 'href' => null, 'hero_img' => 'kyzn-hero.jpg' ),
		array( 'slug' => 'royal-finances', 'name' => 'Royal Finances', 'badge' => 'Finance', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'royal-finances.png', 'alt' => 'Royal Finances logo', 'href' => null ),
		array( 'slug' => 'simple-financial', 'name' => 'Simple Financial', 'badge' => 'Finance', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'simple-financial.png', 'alt' => 'Simple Financial logo', 'href' => null ),
		array( 'slug' => 'simple-pret', 'name' => 'Simple Pret', 'badge' => 'Finance', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'simple-pret.png', 'alt' => 'Simple Pret logo', 'href' => null ),
		array( 'slug' => 'cash-depot', 'name' => 'Cash Depot', 'badge' => 'Finance', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'cash-depot-photo.jpg', 'alt' => 'The storefront of Cash Depot', 'href' => null, 'hero_img' => 'cash-depot-hero.jpg' ),
		array( 'slug' => 'trader2b', 'name' => 'Trader2B', 'badge' => 'Finance', 'industry' => null, 'type' => 'Trading Simulator', 'desc' => null, 'result' => null, 'img' => 'trader2b.png', 'alt' => 'Trader2B logo', 'href' => null ),
		array( 'slug' => 'natuurvlees-nl', 'name' => 'Natuurvlees.nl', 'badge' => 'Retail', 'industry' => null, 'type' => 'Meat Butcher', 'desc' => null, 'result' => null, 'img' => 'natuurvlees-photo.jpg', 'alt' => 'The Natuurvlees.nl delivery van', 'href' => null, 'hero_img' => 'natuurvlees-hero.jpg' ),
		array( 'slug' => 'bb-b', 'name' => 'BB&B', 'badge' => 'Retail', 'industry' => null, 'type' => 'Beer & Beverage Import, Bangkok', 'desc' => null, 'result' => null, 'img' => 'bbb-photo.jpg', 'alt' => 'The retail showroom at BB&B', 'href' => null, 'hero_img' => 'bbb-hero.jpg' ),
		array( 'slug' => 'simba-sea-trips', 'name' => 'Simba Sea Trips', 'badge' => 'Retail', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'simba-sea-trips-photo.jpg', 'alt' => 'Snorkel gear aboard a Simba Sea Trips boat', 'href' => null, 'hero_img' => 'simba-sea-trips-hero.jpg' ),
		array( 'slug' => 'hug-ocean', 'name' => 'Hug Ocean', 'badge' => 'Retail', 'industry' => null, 'type' => 'Scuba Diving', 'desc' => null, 'result' => null, 'img' => 'hug-ocean-photo.jpg', 'alt' => 'The Hug Ocean dive boat', 'href' => null, 'hero_img' => 'hug-ocean-hero.jpg' ),
		array( 'slug' => 'steam-cleaning', 'name' => 'Steam Cleaning', 'badge' => 'Retail', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'steam-cleaning-bangkok.png', 'alt' => 'Steam Cleaning logo', 'href' => null ),
		array( 'slug' => 'dreamer-phuket', 'name' => 'Dreamer Phuket', 'badge' => 'Retail', 'industry' => null, 'type' => '', 'desc' => null, 'result' => null, 'img' => 'the-dreamer-phuket.png', 'alt' => 'Dreamer Phuket logo', 'href' => null ),
		array( 'slug' => 'unity-festival-thailand', 'name' => 'Unity Festival Thailand', 'badge' => 'Retail', 'industry' => null, 'type' => 'Festival', 'desc' => null, 'result' => null, 'img' => 'unity.png', 'alt' => 'Unity Festival Thailand logo', 'href' => null ),
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
