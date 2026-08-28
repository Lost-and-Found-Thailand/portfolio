<?php
/**
 * Work page — ported from work.html. WordPress auto-selects this
 * template for a Page whose slug is "work". The 53-card client grid
 * is data-driven (see ldm_render_client_groups() in
 * inc/template-helpers.php) rather than 53 hand-copied blocks.
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = 'Selected Work | Liam Digital Marketing — Performance Marketing Case Studies';
$ldm_meta_description = 'Case studies in paid media, lead generation, conversion tracking and marketing analytics — real campaign work from a performance marketing specialist and Google Ads & Meta Ads consultant.';

get_header();

$ldm_case_study_url = home_url( '/case-study/' );

$ldm_flagship_cases = array(
	array(
		'badge'    => 'Luxury Weddings',
		'img'      => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Tirtha Bali luxury wedding campaign creative',
		'title'    => 'Tirtha Bali',
		'industry' => 'Paid Media &middot; Lead Generation &middot; Conversion Tracking',
		'desc'     => 'Generating higher-quality international wedding enquiries through targeted paid media and full-funnel tracking.',
	),
	array(
		'badge'    => 'Hospitality',
		'img'      => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Ulu Cliffhouse performance marketing case study',
		'title'    => 'Ulu Cliffhouse',
		'industry' => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
		'desc'     => "Building a measurement system that connects ad spend directly to bookings across this cliffside resort's restaurant, pool club and beach club venues.",
	),
	array(
		'badge'    => 'Lifestyle &amp; Retail',
		'img'      => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'The Barrel wine merchant digital strategy case study',
		'title'    => 'The Barrel',
		'industry' => 'Conversion Optimization &middot; Digital Strategy',
		'desc'     => 'Rebuilding the online discovery and reservation journey for this wine merchant and restaurant across paid channels.',
	),
	array(
		'badge'    => 'E-commerce',
		'img'      => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Chalong Bay Rum e-commerce marketing analytics case study',
		'title'    => 'Chalong Bay Rum',
		'industry' => 'Meta Ads &middot; Google Shopping &middot; Marketing Analytics',
		'desc'     => 'Rebuilding the tracking foundation so every dollar of ad spend for this rum distillery could be traced to revenue, not just clicks.',
	),
	array(
		'badge'    => 'Fitness',
		'img'      => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Raw Uluwatu gym lead generation case study',
		'title'    => 'Raw Uluwatu',
		'industry' => 'Lead Generation &middot; Google Ads &middot; CRM Integration',
		'desc'     => "Replacing generic form-fills with a qualified-lead pipeline for gym memberships, synced directly into the studio's CRM.",
	),
	array(
		'badge'    => 'Wellness',
		'img'      => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Ours Spa wellness brand paid media case study',
		'title'    => 'Ours Spa',
		'industry' => 'Paid Media &middot; Landing Page Optimization',
		'desc'     => 'Turning a seasonal spike in interest into an always-on acquisition engine for treatment bookings.',
	),
);

$ldm_client_groups = array(
	'Hospitality & Nightlife' => array(
		array( 'name' => 'Noah Yacht Club', 'type' => 'Yacht Club', 'img' => get_template_directory_uri() . '/assets/img/clients/noah-yacht-thumb.jpg', 'alt' => 'Noah Yacht Club client work', 'fit' => 'contain' ),
		array( 'name' => 'Tabu Bali', 'type' => 'Restaurant & Supperclub', 'img' => get_template_directory_uri() . '/assets/img/clients/tabu.png', 'alt' => 'Tabu Bali client work', 'fit' => 'contain' ),
		array( 'name' => 'Carpe Diem', 'type' => 'Beach Restaurant, Beach Club, Pool Party', 'img' => get_template_directory_uri() . '/assets/img/clients/carpe-diem-beach-club.png', 'alt' => 'Carpe Diem client work', 'fit' => 'contain' ),
		array( 'name' => 'The Beach by Ours', 'type' => 'Beach Restaurant, Beach Club', 'img' => get_template_directory_uri() . '/assets/img/clients/the-beach-by-ours.png', 'alt' => 'The Beach by Ours client work', 'fit' => 'contain' ),
		array( 'name' => 'Soho Pool Club', 'type' => 'Pool Club', 'img' => get_template_directory_uri() . '/assets/img/clients/soho-pool-club.png', 'alt' => 'Soho Pool Club client work', 'fit' => 'contain' ),
		array( 'name' => 'Marbella Beach Goa', 'type' => 'Beach Club & Resort', 'img' => get_template_directory_uri() . '/assets/img/clients/marbela-beach.png', 'alt' => 'Marbella Beach Goa client work', 'fit' => 'contain' ),
		array( 'name' => 'Ama by Ours', 'type' => 'Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/ama.png', 'alt' => 'Ama by Ours client work', 'fit' => 'contain' ),
		array( 'name' => 'Rockfish The Uluwatu', 'type' => 'Cliffside Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/rockfish-uluwatu.png', 'alt' => 'Rockfish The Uluwatu client work', 'fit' => 'contain' ),
		array( 'name' => "Benny’s Cocktails & Grill", 'type' => 'Steakhouse, Cocktail Bar', 'img' => get_template_directory_uri() . '/assets/img/clients/bennys.png', 'alt' => "Benny's Cocktails & Grill client work", 'fit' => 'contain' ),
		array( 'name' => 'Ours Bali', 'type' => 'Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/o-ours.png', 'alt' => 'Ours Bali client work', 'fit' => 'contain' ),
		array( 'name' => 'Home by Ours', 'type' => 'Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/home-by-ours.png', 'alt' => 'Home by Ours client work', 'fit' => 'contain' ),
		array( 'name' => 'The Distillery Phuket', 'type' => 'Distillery & Fusion Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/the-distillery-phuket.png', 'alt' => 'The Distillery Phuket client work', 'fit' => 'contain' ),
		array( 'name' => 'Bartolo', 'type' => 'Restaurant, Cocktail', 'img' => get_template_directory_uri() . '/assets/img/clients/bartolo.png', 'alt' => 'Bartolo client work', 'fit' => 'contain' ),
		array( 'name' => 'Mood by Ours', 'type' => 'Restaurant, Minimart', 'img' => get_template_directory_uri() . '/assets/img/clients/mood-by-ours.png', 'alt' => 'Mood by Ours client work', 'fit' => 'contain' ),
		array( 'name' => 'Meso', 'type' => 'Beach Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/meso.png', 'alt' => 'Meso client work', 'fit' => 'contain' ),
		array( 'name' => 'The 9th Degree', 'type' => 'Lagoon Front Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/the-9th-degree.png', 'alt' => 'The 9th Degree client work', 'fit' => 'contain' ),
		array( 'name' => 'Tempo', 'type' => 'Lounge & KTV', 'img' => get_template_directory_uri() . '/assets/img/clients/tempo.png', 'alt' => 'Tempo client work', 'fit' => 'contain' ),
		array( 'name' => 'Penida Colada', 'type' => 'Beach Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/penida-colada.png', 'alt' => 'Penida Colada client work', 'fit' => 'contain' ),
		array( 'name' => 'Bollywood Phuket', 'type' => 'Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/bollywood-phuket.png', 'alt' => 'Bollywood Phuket client work', 'fit' => 'contain' ),
		array( 'name' => 'The Firefly Club', 'type' => 'Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/the-firefly-club.png', 'alt' => 'The Firefly Club client work', 'fit' => 'contain' ),
		array( 'name' => 'Lulu Bistrot', 'type' => 'Restaurant, Bistro, Cocktail Bar', 'img' => get_template_directory_uri() . '/assets/img/clients/lulu-bistrot.png', 'alt' => 'Lulu Bistrot client work', 'fit' => 'contain' ),
		array( 'name' => 'Babou', 'type' => 'Restaurant, Club', 'img' => get_template_directory_uri() . '/assets/img/clients/babou.png', 'alt' => 'Babou client work', 'fit' => 'contain' ),
		array( 'name' => 'Hug Samui', 'type' => 'Beachfront Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/hug-samui.png', 'alt' => 'Hug Samui client work', 'fit' => 'contain' ),
		array( 'name' => 'Burnt', 'type' => 'Beachfront Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/burnt.png', 'alt' => 'Burnt client work', 'fit' => 'contain' ),
		array( 'name' => 'Ulu Cliffhouse', 'type' => 'Beach Restaurant, Pool Club, Beach Club, Resort', 'img' => get_template_directory_uri() . '/assets/img/clients/ulu-cliffhouse.png', 'alt' => 'Ulu Cliffhouse client work', 'fit' => 'contain' ),
		array( 'name' => 'The Barrel', 'type' => 'Wine Merchant & Wine Stores, Restaurant', 'img' => get_template_directory_uri() . '/assets/img/clients/the-barrel-wine-merchant.png', 'alt' => 'The Barrel client work', 'fit' => 'contain' ),
	),
	'Weddings & Resorts'      => array(
		array( 'name' => 'Tirtha Bali', 'type' => 'Luxury Wedding Venue', 'img' => get_template_directory_uri() . '/assets/img/clients/tirtha-bali.png', 'alt' => 'Tirtha Bali client work', 'fit' => 'contain' ),
		array( 'name' => 'Muang Samui Resort', 'img' => get_template_directory_uri() . '/assets/img/clients/muang-samui-spa-resort.png', 'alt' => 'Muang Samui Resort client work', 'fit' => 'contain' ),
		array( 'name' => 'Mel Francis Villa', 'type' => 'Luxury Villas', 'img' => get_template_directory_uri() . '/assets/img/clients/mel-francis-villas.png', 'alt' => 'Mel Francis Villa client work', 'fit' => 'contain' ),
	),
	'Wellness & Fitness'      => array(
		array( 'name' => 'House of Om', 'type' => 'Yoga School', 'img' => get_template_directory_uri() . '/assets/img/clients/house-of-om.png', 'alt' => 'House of Om client work', 'fit' => 'contain' ),
		array( 'name' => 'Ours Spa', 'img' => get_template_directory_uri() . '/assets/img/clients/ourspa.png', 'alt' => 'Ours Spa client work', 'fit' => 'contain' ),
		array( 'name' => 'Shaz Aesthetic & Media Spa', 'img' => get_template_directory_uri() . '/assets/img/clients/shaz.png', 'alt' => 'Shaz Aesthetic & Media Spa client work', 'fit' => 'contain' ),
		array( 'name' => 'Arna Oceanic Wellness Spa', 'img' => get_template_directory_uri() . '/assets/img/clients/arna.png', 'alt' => 'Arna Oceanic Wellness Spa client work', 'fit' => 'contain' ),
		array( 'name' => 'Cave Rai Ra', 'type' => 'Wellness Spa', 'img' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Cave Rai Ra client work' ),
		array( 'name' => 'Raw Uluwatu', 'type' => 'Gym', 'img' => get_template_directory_uri() . '/assets/img/clients/raw-uluwatu.png', 'alt' => 'Raw Uluwatu client work', 'fit' => 'contain' ),
		array( 'name' => 'Athlean', 'type' => 'Gym', 'img' => get_template_directory_uri() . '/assets/img/clients/athlean.png', 'alt' => 'Athlean client work', 'fit' => 'contain' ),
		array( 'name' => 'Tribal Fitness', 'type' => 'Gym', 'img' => get_template_directory_uri() . '/assets/img/clients/tribal-fitness.png', 'alt' => 'Tribal Fitness client work', 'fit' => 'contain' ),
		array( 'name' => 'Raw Ubud', 'type' => 'Gym', 'img' => get_template_directory_uri() . '/assets/img/clients/raw-ubud.png', 'alt' => 'Raw Ubud client work', 'fit' => 'contain' ),
		array( 'name' => 'Nuhuman Raw', 'type' => 'Gym', 'img' => get_template_directory_uri() . '/assets/img/clients/nuhuman-raw.png', 'alt' => 'Nuhuman Raw client work', 'fit' => 'contain' ),
		array( 'name' => 'Kyzn', 'img' => get_template_directory_uri() . '/assets/img/clients/kyzn.png', 'alt' => 'Kyzn client work', 'fit' => 'contain' ),
	),
	'Finance'                 => array(
		array( 'name' => 'Royal Finances', 'img' => get_template_directory_uri() . '/assets/img/clients/royal-finances.png', 'alt' => 'Royal Finances client work', 'fit' => 'contain' ),
		array( 'name' => 'Simple Finances', 'img' => 'https://images.unsplash.com/photo-1531973576160-7125cd663d86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Simple Finances client work' ),
		array( 'name' => 'Simple Pret', 'img' => get_template_directory_uri() . '/assets/img/clients/simple-pret.png', 'alt' => 'Simple Pret client work', 'fit' => 'contain' ),
		array( 'name' => 'Cash Depot', 'img' => get_template_directory_uri() . '/assets/img/clients/cash-depot.png', 'alt' => 'Cash Depot client work', 'fit' => 'contain' ),
		array( 'name' => 'Trader2B', 'type' => 'Trading Simulator', 'img' => get_template_directory_uri() . '/assets/img/clients/trader2b.png', 'alt' => 'Trader2B client work', 'fit' => 'contain' ),
	),
	'Retail & Other Ventures' => array(
		array( 'name' => 'Natuurvlees.nl', 'type' => 'Meat Butcher', 'img' => get_template_directory_uri() . '/assets/img/clients/natuurvlees.png', 'alt' => 'Natuurvlees.nl client work', 'fit' => 'contain' ),
		array( 'name' => 'BB&B', 'type' => 'Beer & Beverage Import, Bangkok', 'img' => get_template_directory_uri() . '/assets/img/clients/bbb.png', 'alt' => 'BB&B client work', 'fit' => 'contain' ),
		array( 'name' => 'Chalong Bay Rum', 'type' => 'Rum Distillery', 'img' => get_template_directory_uri() . '/assets/img/clients/chalong-bay.png', 'alt' => 'Chalong Bay Rum client work', 'fit' => 'contain' ),
		array( 'name' => 'Simba Sea Trips', 'img' => get_template_directory_uri() . '/assets/img/clients/simba-sea-trips.png', 'alt' => 'Simba Sea Trips client work', 'fit' => 'contain' ),
		array( 'name' => 'Hug Ocean', 'type' => 'Scuba Diving', 'img' => get_template_directory_uri() . '/assets/img/clients/hug-ocean.png', 'alt' => 'Hug Ocean client work', 'fit' => 'contain' ),
		array( 'name' => 'Steam Cleaning', 'img' => get_template_directory_uri() . '/assets/img/clients/steam-cleaning-bangkok.png', 'alt' => 'Steam Cleaning client work', 'fit' => 'contain' ),
		array( 'name' => 'Dreamer Phuket', 'img' => get_template_directory_uri() . '/assets/img/clients/the-dreamer-phuket.png', 'alt' => 'Dreamer Phuket client work', 'fit' => 'contain' ),
		array( 'name' => 'Unity Festival Thailand', 'type' => 'Festival', 'img' => get_template_directory_uri() . '/assets/img/clients/unity.png', 'alt' => 'Unity Festival Thailand client work', 'fit' => 'contain' ),
	),
);
?>

  <!-- PAGE HEADER -->
  <section class="ldm-page-header container">
    <span class="eyebrow">Work</span>
    <h1 class="fs-h1">Selected Work</h1>
    <p class="lede">A closer look at the campaigns, growth systems and digital projects behind the numbers — how they were built, what they solved, and what they delivered.</p>
  </section>

  <!-- CASE LIST -->
  <section class="ldm-section container">
    <div class="ldm-case-list">
      <?php foreach ( $ldm_flagship_cases as $case ) : ?>
        <a href="<?php echo esc_url( $ldm_case_study_url ); ?>" class="ldm-case reveal">
          <div class="ldm-case-media">
            <span class="badge"><?php echo wp_kses( $case['badge'], array( 'amp' => array() ) ); ?></span>
            <img src="<?php echo esc_url( $case['img'] ); ?>" alt="<?php echo esc_attr( $case['alt'] ); ?>" loading="lazy" width="1200" height="900">
          </div>
          <div class="ldm-case-body">
            <div class="ldm-case-title"><span class="title-text"><?php echo esc_html( $case['title'] ); ?></span> <span class="arrow">&rarr;</span></div>
            <div class="ldm-case-industry"><?php echo wp_kses( $case['industry'], array( 'middot' => array() ) ); ?></div>
            <p class="ldm-case-desc"><?php echo esc_html( $case['desc'] ); ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- SELECTED CLIENTS -->
  <section class="ldm-section container">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">Selected Clients</span>
      <h2 class="fs-h2">100+ brands, one system.</h2>
      <p class="lede">Every brand I've built paid media, tracking and growth systems for — across hospitality, wellness, fitness, finance and beyond.</p>
    </div>

    <?php ldm_render_client_groups( $ldm_client_groups ); ?>
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
