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
		'result'   => 'Qualified Enquiries',
	),
	array(
		'badge'    => 'Hospitality',
		'img'      => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Ulu Cliffhouse performance marketing case study',
		'title'    => 'Ulu Cliffhouse',
		'industry' => 'Performance Marketing &middot; Analytics &middot; Conversion Tracking',
		'desc'     => "Building a measurement system that connects ad spend directly to bookings across this cliffside resort's restaurant, pool club and beach club venues.",
		'result'   => 'ROAS',
	),
	array(
		'badge'    => 'Lifestyle &amp; Retail',
		'img'      => 'https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'The Barrel wine merchant digital strategy case study',
		'title'    => 'The Barrel',
		'industry' => 'Conversion Optimization &middot; Digital Strategy',
		'desc'     => 'Rebuilding the online discovery and reservation journey for this wine merchant and restaurant across paid channels.',
		'result'   => 'Conversion Rate',
	),
	array(
		'badge'    => 'E-commerce',
		'img'      => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Chalong Bay Rum e-commerce marketing analytics case study',
		'title'    => 'Chalong Bay Rum',
		'industry' => 'Meta Ads &middot; Google Shopping &middot; Marketing Analytics',
		'desc'     => 'Rebuilding the tracking foundation so every dollar of ad spend for this rum distillery could be traced to revenue, not just clicks.',
		'result'   => 'Return on Ad Spend',
	),
	array(
		'badge'    => 'Fitness',
		'img'      => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Raw Uluwatu gym lead generation case study',
		'title'    => 'Raw Uluwatu',
		'industry' => 'Lead Generation &middot; Google Ads &middot; CRM Integration',
		'desc'     => "Replacing generic form-fills with a qualified-lead pipeline for gym memberships, synced directly into the studio's CRM.",
		'result'   => 'Qualified Leads',
	),
	array(
		'badge'    => 'Wellness',
		'img'      => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=1200&auto=format&fit=crop',
		'alt'      => 'Ours Spa wellness brand paid media case study',
		'title'    => 'Ours Spa',
		'industry' => 'Paid Media &middot; Landing Page Optimization',
		'desc'     => 'Turning a seasonal spike in interest into an always-on acquisition engine for treatment bookings.',
		'result'   => 'Booking Rate',
	),
);

$ldm_client_groups = array(
	'Hospitality & Nightlife' => array(
		array( 'name' => 'Noah Yacht Club', 'type' => 'Yacht Club', 'img' => get_template_directory_uri() . '/assets/img/clients/noah-yacht-thumb.jpg', 'alt' => 'Noah Yacht Club client work', 'fit' => 'contain' ),
		array( 'name' => 'Tabu Bali', 'type' => 'Restaurant & Supperclub', 'img' => 'https://images.unsplash.com/photo-1543007630-9710e4a00a20?q=80&w=500&auto=format&fit=crop', 'alt' => 'Tabu Bali client work' ),
		array( 'name' => 'Carpe Diem', 'type' => 'Beach Restaurant, Beach Club, Pool Party', 'img' => 'https://images.unsplash.com/photo-1436076863939-06870fe779c2?q=80&w=500&auto=format&fit=crop', 'alt' => 'Carpe Diem client work' ),
		array( 'name' => 'The Beach by Ours', 'type' => 'Beach Restaurant, Beach Club', 'img' => 'https://images.unsplash.com/photo-1508614999368-9260051292e5?q=80&w=500&auto=format&fit=crop', 'alt' => 'The Beach by Ours client work' ),
		array( 'name' => 'Soho Pool Club', 'type' => 'Pool Club', 'img' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=500&auto=format&fit=crop', 'alt' => 'Soho Pool Club client work' ),
		array( 'name' => 'Marbella Beach Goa', 'type' => 'Beach Club & Resort', 'img' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=500&auto=format&fit=crop', 'alt' => 'Marbella Beach Goa client work' ),
		array( 'name' => 'Ama by Ours', 'type' => 'Restaurant', 'img' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=500&auto=format&fit=crop', 'alt' => 'Ama by Ours client work' ),
		array( 'name' => 'Rockfish The Uluwatu', 'type' => 'Cliffside Restaurant', 'img' => 'https://images.unsplash.com/photo-1508614999368-9260051292e5?q=80&w=500&auto=format&fit=crop', 'alt' => 'Rockfish The Uluwatu client work' ),
		array( 'name' => "Benny’s Cocktails & Grill", 'type' => 'Steakhouse, Cocktail Bar', 'img' => 'https://images.unsplash.com/photo-1432139509613-5c4255815697?q=80&w=500&auto=format&fit=crop', 'alt' => "Benny's Cocktails & Grill client work" ),
		array( 'name' => 'Ours Bali', 'type' => 'Restaurant', 'img' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=500&auto=format&fit=crop', 'alt' => 'Ours Bali client work' ),
		array( 'name' => 'Home by Ours', 'type' => 'Restaurant', 'img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500&auto=format&fit=crop', 'alt' => 'Home by Ours client work' ),
		array( 'name' => 'The Distillery Phuket', 'type' => 'Distillery & Fusion Restaurant', 'img' => 'https://images.unsplash.com/photo-1470337458703-46ad1756a187?q=80&w=500&auto=format&fit=crop', 'alt' => 'The Distillery Phuket client work' ),
		array( 'name' => 'Bartolo', 'type' => 'Restaurant, Cocktail', 'img' => 'https://images.unsplash.com/photo-1546171753-97d7676e4602?q=80&w=500&auto=format&fit=crop', 'alt' => 'Bartolo client work' ),
		array( 'name' => 'Mood by Ours', 'type' => 'Restaurant, Minimart', 'img' => 'https://images.unsplash.com/photo-1520201163981-8cc95007dd2a?q=80&w=500&auto=format&fit=crop', 'alt' => 'Mood by Ours client work' ),
		array( 'name' => 'Meso', 'type' => 'Beach Restaurant', 'img' => 'https://images.unsplash.com/photo-1544148103-0773bf10d330?q=80&w=500&auto=format&fit=crop', 'alt' => 'Meso client work' ),
		array( 'name' => 'The 9th Degree', 'type' => 'Lagoon Front Restaurant', 'img' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=500&auto=format&fit=crop', 'alt' => 'The 9th Degree client work' ),
		array( 'name' => 'Tempo', 'type' => 'Lounge & KTV', 'img' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=500&auto=format&fit=crop', 'alt' => 'Tempo client work' ),
		array( 'name' => 'Penida Colada', 'type' => 'Beach Restaurant', 'img' => 'https://images.unsplash.com/photo-1436076863939-06870fe779c2?q=80&w=500&auto=format&fit=crop', 'alt' => 'Penida Colada client work' ),
		array( 'name' => 'Bollywood Phuket', 'type' => 'Restaurant', 'img' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?q=80&w=500&auto=format&fit=crop', 'alt' => 'Bollywood Phuket client work' ),
		array( 'name' => 'The Firefly Club', 'type' => 'Restaurant', 'img' => 'https://images.unsplash.com/photo-1543007630-9710e4a00a20?q=80&w=500&auto=format&fit=crop', 'alt' => 'The Firefly Club client work' ),
		array( 'name' => 'Lulu Bistrot', 'type' => 'Restaurant, Bistro, Cocktail Bar', 'img' => 'https://images.unsplash.com/photo-1481833761820-0509d3217039?q=80&w=500&auto=format&fit=crop', 'alt' => 'Lulu Bistrot client work' ),
		array( 'name' => 'Babou', 'type' => 'Restaurant, Club', 'img' => 'https://images.unsplash.com/photo-1544025162-d76694265947?q=80&w=500&auto=format&fit=crop', 'alt' => 'Babou client work' ),
		array( 'name' => 'Hug Samui', 'type' => 'Beachfront Restaurant', 'img' => 'https://images.unsplash.com/photo-1544148103-0773bf10d330?q=80&w=500&auto=format&fit=crop', 'alt' => 'Hug Samui client work' ),
		array( 'name' => 'Burnt', 'type' => 'Beachfront Restaurant', 'img' => 'https://images.unsplash.com/photo-1432139509613-5c4255815697?q=80&w=500&auto=format&fit=crop', 'alt' => 'Burnt client work' ),
		array( 'name' => 'Ulu Cliffhouse', 'type' => 'Beach Restaurant, Pool Club, Beach Club, Resort', 'img' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=500&auto=format&fit=crop', 'alt' => 'Ulu Cliffhouse client work' ),
		array( 'name' => 'The Barrel', 'type' => 'Wine Merchant & Wine Stores, Restaurant', 'img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=500&auto=format&fit=crop', 'alt' => 'The Barrel client work' ),
	),
	'Weddings & Resorts'      => array(
		array( 'name' => 'Tirtha Bali', 'type' => 'Luxury Wedding Venue', 'img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=500&auto=format&fit=crop', 'alt' => 'Tirtha Bali client work' ),
		array( 'name' => 'Muang Samui Resort', 'img' => 'https://images.unsplash.com/photo-1478146059778-26028b07395a?q=80&w=500&auto=format&fit=crop', 'alt' => 'Muang Samui Resort client work' ),
		array( 'name' => 'Mel Francis Villa', 'type' => 'Luxury Villas', 'img' => 'https://images.unsplash.com/photo-1508614999368-9260051292e5?q=80&w=500&auto=format&fit=crop', 'alt' => 'Mel Francis Villa client work' ),
	),
	'Wellness & Fitness'      => array(
		array( 'name' => 'House of Om', 'type' => 'Yoga School', 'img' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=500&auto=format&fit=crop', 'alt' => 'House of Om client work' ),
		array( 'name' => 'Ours Spa', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=500&auto=format&fit=crop', 'alt' => 'Ours Spa client work' ),
		array( 'name' => 'Shaz Aesthetic & Media Spa', 'img' => 'https://images.unsplash.com/photo-1544161515-4ab6ce6db874?q=80&w=500&auto=format&fit=crop', 'alt' => 'Shaz Aesthetic & Media Spa client work' ),
		array( 'name' => 'Arna Oceanic Wellness Spa', 'img' => 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=500&auto=format&fit=crop', 'alt' => 'Arna Oceanic Wellness Spa client work' ),
		array( 'name' => 'Cave Rai Ra', 'type' => 'Wellness Spa', 'img' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Cave Rai Ra client work' ),
		array( 'name' => 'Raw Uluwatu', 'type' => 'Gym', 'img' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=500&auto=format&fit=crop', 'alt' => 'Raw Uluwatu client work' ),
		array( 'name' => 'Athlean', 'type' => 'Gym', 'img' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=500&auto=format&fit=crop', 'alt' => 'Athlean client work' ),
		array( 'name' => 'Tribal Fitness', 'type' => 'Gym', 'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=500&auto=format&fit=crop', 'alt' => 'Tribal Fitness client work' ),
		array( 'name' => 'Raw Ubud', 'type' => 'Gym', 'img' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?q=80&w=500&auto=format&fit=crop', 'alt' => 'Raw Ubud client work' ),
		array( 'name' => 'Nuhuman Raw', 'type' => 'Gym', 'img' => 'https://images.unsplash.com/photo-1533777857889-4be7c70b33f7?q=80&w=500&auto=format&fit=crop', 'alt' => 'Nuhuman Raw client work' ),
		array( 'name' => 'Kyzn', 'img' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=500&auto=format&fit=crop', 'alt' => 'Kyzn client work' ),
	),
	'Finance'                 => array(
		array( 'name' => 'Royal Finances', 'img' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=500&auto=format&fit=crop', 'alt' => 'Royal Finances client work' ),
		array( 'name' => 'Simple Finances', 'img' => 'https://images.unsplash.com/photo-1531973576160-7125cd663d86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Simple Finances client work' ),
		array( 'name' => 'Simple Pret', 'img' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=500&auto=format&fit=crop', 'alt' => 'Simple Pret client work' ),
		array( 'name' => 'Chash Depot', 'img' => 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?q=80&w=500&auto=format&fit=crop', 'alt' => 'Chash Depot client work' ),
		array( 'name' => 'Trader2B', 'type' => 'Trading Simulator', 'img' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=500&auto=format&fit=crop', 'alt' => 'Trader2B client work' ),
	),
	'Retail & Other Ventures' => array(
		array( 'name' => 'Natuurvlees.nl', 'type' => 'Meat Butcher', 'img' => 'https://images.unsplash.com/photo-1432139509613-5c4255815697?q=80&w=500&auto=format&fit=crop', 'alt' => 'Natuurvlees.nl client work' ),
		array( 'name' => 'BB&B', 'type' => 'Beer & Beverage Import, Bangkok', 'img' => 'https://images.unsplash.com/photo-1436076863939-06870fe779c2?q=80&w=500&auto=format&fit=crop', 'alt' => 'BB&B client work' ),
		array( 'name' => 'Chalong Bay Rum', 'type' => 'Rum Distillery', 'img' => 'https://images.unsplash.com/photo-1441984904996-e0b6ba687e04?q=80&w=500&auto=format&fit=crop', 'alt' => 'Chalong Bay Rum client work' ),
		array( 'name' => 'Simba Sea Trips', 'img' => 'https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=500&auto=format&fit=crop', 'alt' => 'Simba Sea Trips client work' ),
		array( 'name' => 'Hug Ocean', 'type' => 'Scuba Diving', 'img' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=500&auto=format&fit=crop', 'alt' => 'Hug Ocean client work' ),
		array( 'name' => 'Steam Cleaning', 'img' => 'https://images.unsplash.com/photo-1517705008128-361805f42e86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Steam Cleaning client work' ),
		array( 'name' => 'Dreamer Phuket', 'img' => 'https://images.unsplash.com/photo-1531973576160-7125cd663d86?q=80&w=500&auto=format&fit=crop', 'alt' => 'Dreamer Phuket client work' ),
		array( 'name' => 'Unity Festival Thailand', 'type' => 'Festival', 'img' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?q=80&w=500&auto=format&fit=crop', 'alt' => 'Unity Festival Thailand client work' ),
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
            <div class="ldm-case-result">+XX% <span class="label"><?php echo esc_html( $case['result'] ); ?></span></div>
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
