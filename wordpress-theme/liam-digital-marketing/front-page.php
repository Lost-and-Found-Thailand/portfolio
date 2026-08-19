<?php
/**
 * Homepage — ported from the static site's index.html. Structure,
 * classes and copy are unchanged; only internal links, asset paths
 * and the contact-info blocks now go through WordPress functions
 * and the shared helpers in inc/template-helpers.php.
 */

defined( 'ABSPATH' ) || exit;

$ldm_meta_title       = get_bloginfo( 'name' ) . ' | Performance Marketing & Growth Systems';
$ldm_meta_description = 'Liam Digital Marketing helps ambitious brands turn paid media, data, creative and technology into measurable business growth. Paid media, conversion tracking, marketing analytics.';
$ldm_meta_canonical   = home_url( '/' );

get_header();

$ldm_img = get_template_directory_uri();
?>

  <!-- 01 HERO -->
  <section class="ldm-hero" id="hero">
    <div class="ldm-hero-grid" aria-hidden="true"></div>
    <canvas class="ldm-network" data-network="hero" aria-hidden="true"></canvas>
    <div class="container ldm-hero-content">
      <div class="ldm-hero-center">
        <span class="eyebrow">Liam &middot; Digital Marketing</span>
        <h1 class="fs-hero">Hi, I&rsquo;m Liam.</h1>
        <p class="ldm-hero-role">Digital Marketing Manager</p>
      </div>
      <div class="ldm-hero-showcase">
        <div class="ldm-hero-side ldm-hero-side--left">
          <span class="ldm-status"><span class="status-dot"></span> Available for select projects</span>
        </div>
        <div class="ldm-hero-photo">
          <div class="ldm-hero-photo-glow" aria-hidden="true"></div>
          <img src="<?php echo esc_url( $ldm_img . '/assets/img/liam-cutout.png' ); ?>" alt="Liam, Digital Marketing Manager" width="640" height="582" loading="eager">
        </div>
        <div class="ldm-hero-side ldm-hero-side--right">
          <p class="lede">Paid media, analytics and conversion tracking that turn ad spend into measurable growth.</p>
          <div class="ldm-hero-ctas">
            <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="btn btn-primary">View My Work &rarr;</a>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-secondary">Let's Connect &rarr;</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- TRUSTED BY -->
  <section class="ldm-trustbar" id="trusted-by">
    <div class="container">
      <p class="ldm-trustbar-label"><?php esc_html_e( "A few of the brands I've worked with", 'liam-digital-marketing' ); ?></p>
    </div>
    <div class="ldm-trustbar-viewport">
      <div class="ldm-trustbar-track">
          <div class="ldm-trustbar-set">
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/carpe-diem-beach-club.png' ); ?>" alt="<?php esc_attr_e( 'Carpe Diem Beach Club', 'liam-digital-marketing' ); ?>" width="839" height="986" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/o-ours.png' ); ?>" alt="<?php esc_attr_e( 'O. Ours', 'liam-digital-marketing' ); ?>" width="337" height="193" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/rockfish-uluwatu.png' ); ?>" alt="<?php esc_attr_e( 'Rockfish The Uluwatu', 'liam-digital-marketing' ); ?>" width="362" height="192" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/muang-samui.png' ); ?>" alt="<?php esc_attr_e( 'Muang Samui Holistic Wellness Riviera', 'liam-digital-marketing' ); ?>" width="280" height="224" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/babou.png' ); ?>" alt="<?php esc_attr_e( 'Babou', 'liam-digital-marketing' ); ?>" width="401" height="134" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/noah.png' ); ?>" alt="<?php esc_attr_e( 'Noah', 'liam-digital-marketing' ); ?>" width="1400" height="238" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/tabu.png' ); ?>" alt="<?php esc_attr_e( 'Tabu', 'liam-digital-marketing' ); ?>" width="330" height="325" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ulu-cliffhouse.png' ); ?>" alt="<?php esc_attr_e( 'Ulu Cliffhouse', 'liam-digital-marketing' ); ?>" width="194" height="146" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/tirtha-bali.png' ); ?>" alt="<?php esc_attr_e( 'Tirtha Bali', 'liam-digital-marketing' ); ?>" width="378" height="396" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xxs"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/hug-ocean.png' ); ?>" alt="<?php esc_attr_e( 'Hug Ocean', 'liam-digital-marketing' ); ?>" width="1867" height="207" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-firefly-club.png' ); ?>" alt="<?php esc_attr_e( 'The Firefly Club', 'liam-digital-marketing' ); ?>" width="450" height="450" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bennys.png' ); ?>" alt="<?php esc_attr_e( 'Benny\'s Cocktails &amp; Grill', 'liam-digital-marketing' ); ?>" width="1024" height="576" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bartolo.png' ); ?>" alt="<?php esc_attr_e( 'Bartolo', 'liam-digital-marketing' ); ?>" width="600" height="367" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bollywood-phuket.png' ); ?>" alt="<?php esc_attr_e( 'Bollywood Phuket', 'liam-digital-marketing' ); ?>" width="733" height="367" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/hug-samui.png' ); ?>" alt="<?php esc_attr_e( 'Hug Samui', 'liam-digital-marketing' ); ?>" width="819" height="765" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/paracetamol-biogesic.png' ); ?>" alt="<?php esc_attr_e( 'Paracetamol Biogesic', 'liam-digital-marketing' ); ?>" width="926" height="333" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bbb.png' ); ?>" alt="<?php esc_attr_e( 'BB&amp;B', 'liam-digital-marketing' ); ?>" width="802" height="377" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ama.png' ); ?>" alt="<?php esc_attr_e( 'AMA', 'liam-digital-marketing' ); ?>" width="2000" height="698" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/arna.png' ); ?>" alt="<?php esc_attr_e( 'ARNA Oceanic Wellness Spa', 'liam-digital-marketing' ); ?>" width="711" height="240" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/united-pharma.png' ); ?>" alt="<?php esc_attr_e( 'United Pharma', 'liam-digital-marketing' ); ?>" width="2288" height="1726" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/house-of-om.png' ); ?>" alt="<?php esc_attr_e( 'House of Om', 'liam-digital-marketing' ); ?>" width="436" height="534" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/home-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'Home by Ours', 'liam-digital-marketing' ); ?>" width="279" height="106" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/lulu-bistrot.png' ); ?>" alt="<?php esc_attr_e( 'Lulu Bistrot', 'liam-digital-marketing' ); ?>" width="564" height="392" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/marbela-beach.png' ); ?>" alt="<?php esc_attr_e( 'Marbela Beach', 'liam-digital-marketing' ); ?>" width="696" height="586" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/kyzn.png' ); ?>" alt="<?php esc_attr_e( 'kyzn', 'liam-digital-marketing' ); ?>" width="1335" height="483" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/natuurvlees.png' ); ?>" alt="<?php esc_attr_e( 'natuurVlees.nl', 'liam-digital-marketing' ); ?>" width="858" height="205" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ourspa.png' ); ?>" alt="<?php esc_attr_e( 'Ourspa', 'liam-digital-marketing' ); ?>" width="828" height="173" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/penida-colada.png' ); ?>" alt="<?php esc_attr_e( 'Penida Colada Beach Bar', 'liam-digital-marketing' ); ?>" width="750" height="370" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/royal-finances.png' ); ?>" alt="<?php esc_attr_e( 'Royal Finances', 'liam-digital-marketing' ); ?>" width="724" height="331" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/raw-uluwatu.png' ); ?>" alt="<?php esc_attr_e( 'RAW Uluwatu', 'liam-digital-marketing' ); ?>" width="360" height="148" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/meso.png' ); ?>" alt="<?php esc_attr_e( 'Meso Mediterranean Grill Kitchen', 'liam-digital-marketing' ); ?>" width="1014" height="1014" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/muang-samui-spa-resort.png' ); ?>" alt="<?php esc_attr_e( 'Muang Samui Spa Resort', 'liam-digital-marketing' ); ?>" width="624" height="580" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/mood-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'Mood by Ours', 'liam-digital-marketing' ); ?>" width="275" height="107" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/mel-francis-villas.png' ); ?>" alt="<?php esc_attr_e( 'Mel Francis Villas', 'liam-digital-marketing' ); ?>" width="629" height="748" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/raw-ubud.png' ); ?>" alt="<?php esc_attr_e( 'RAW Ubud', 'liam-digital-marketing' ); ?>" width="288" height="116" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/chalong-bay.png' ); ?>" alt="<?php esc_attr_e( 'Chalong Bay', 'liam-digital-marketing' ); ?>" width="2016" height="546" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/athlean.png' ); ?>" alt="<?php esc_attr_e( 'Athlean', 'liam-digital-marketing' ); ?>" width="655" height="363" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xxs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/cash-depot.png' ); ?>" alt="<?php esc_attr_e( 'Cash-Depot', 'liam-digital-marketing' ); ?>" width="745" height="98" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/simple-pret.png' ); ?>" alt="<?php esc_attr_e( 'Simple Prêt', 'liam-digital-marketing' ); ?>" width="748" height="427" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/nuhuman-raw.png' ); ?>" alt="<?php esc_attr_e( 'nüHuman RAW', 'liam-digital-marketing' ); ?>" width="366" height="144" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/shaz.png' ); ?>" alt="<?php esc_attr_e( 'Shaz Aesthetic & Medi Spa', 'liam-digital-marketing' ); ?>" width="751" height="221" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/simba-sea-trips.png' ); ?>" alt="<?php esc_attr_e( 'Simba Sea Trips Phuket', 'liam-digital-marketing' ); ?>" width="1085" height="1108" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/soho-pool-club.png' ); ?>" alt="<?php esc_attr_e( 'Soho Pool Club Phuket', 'liam-digital-marketing' ); ?>" width="2858" height="2858" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/steam-cleaning-phuket.png' ); ?>" alt="<?php esc_attr_e( 'Steam Cleaning Phuket', 'liam-digital-marketing' ); ?>" width="886" height="667" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-barrel-wine-merchant.png' ); ?>" alt="<?php esc_attr_e( 'The Barrel Wine Merchant', 'liam-digital-marketing' ); ?>" width="926" height="944" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-beach-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'The Beach by Ours', 'liam-digital-marketing' ); ?>" width="603" height="429" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/steam-cleaning-bangkok.png' ); ?>" alt="<?php esc_attr_e( 'Steam Cleaning Bangkok', 'liam-digital-marketing' ); ?>" width="772" height="622" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/trader2b.png' ); ?>" alt="<?php esc_attr_e( 'trader2B', 'liam-digital-marketing' ); ?>" width="633" height="180" loading="lazy"></span>
          </div>
          <div class="ldm-trustbar-set" aria-hidden="true">
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/carpe-diem-beach-club.png' ); ?>" alt="<?php esc_attr_e( 'Carpe Diem Beach Club', 'liam-digital-marketing' ); ?>" width="839" height="986" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/o-ours.png' ); ?>" alt="<?php esc_attr_e( 'O. Ours', 'liam-digital-marketing' ); ?>" width="337" height="193" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/rockfish-uluwatu.png' ); ?>" alt="<?php esc_attr_e( 'Rockfish The Uluwatu', 'liam-digital-marketing' ); ?>" width="362" height="192" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/muang-samui.png' ); ?>" alt="<?php esc_attr_e( 'Muang Samui Holistic Wellness Riviera', 'liam-digital-marketing' ); ?>" width="280" height="224" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/babou.png' ); ?>" alt="<?php esc_attr_e( 'Babou', 'liam-digital-marketing' ); ?>" width="401" height="134" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/noah.png' ); ?>" alt="<?php esc_attr_e( 'Noah', 'liam-digital-marketing' ); ?>" width="1400" height="238" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/tabu.png' ); ?>" alt="<?php esc_attr_e( 'Tabu', 'liam-digital-marketing' ); ?>" width="330" height="325" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ulu-cliffhouse.png' ); ?>" alt="<?php esc_attr_e( 'Ulu Cliffhouse', 'liam-digital-marketing' ); ?>" width="194" height="146" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/tirtha-bali.png' ); ?>" alt="<?php esc_attr_e( 'Tirtha Bali', 'liam-digital-marketing' ); ?>" width="378" height="396" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xxs"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/hug-ocean.png' ); ?>" alt="<?php esc_attr_e( 'Hug Ocean', 'liam-digital-marketing' ); ?>" width="1867" height="207" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-firefly-club.png' ); ?>" alt="<?php esc_attr_e( 'The Firefly Club', 'liam-digital-marketing' ); ?>" width="450" height="450" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bennys.png' ); ?>" alt="<?php esc_attr_e( 'Benny\'s Cocktails &amp; Grill', 'liam-digital-marketing' ); ?>" width="1024" height="576" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bartolo.png' ); ?>" alt="<?php esc_attr_e( 'Bartolo', 'liam-digital-marketing' ); ?>" width="600" height="367" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bollywood-phuket.png' ); ?>" alt="<?php esc_attr_e( 'Bollywood Phuket', 'liam-digital-marketing' ); ?>" width="733" height="367" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/hug-samui.png' ); ?>" alt="<?php esc_attr_e( 'Hug Samui', 'liam-digital-marketing' ); ?>" width="819" height="765" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/paracetamol-biogesic.png' ); ?>" alt="<?php esc_attr_e( 'Paracetamol Biogesic', 'liam-digital-marketing' ); ?>" width="926" height="333" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/bbb.png' ); ?>" alt="<?php esc_attr_e( 'BB&amp;B', 'liam-digital-marketing' ); ?>" width="802" height="377" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ama.png' ); ?>" alt="<?php esc_attr_e( 'AMA', 'liam-digital-marketing' ); ?>" width="2000" height="698" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/arna.png' ); ?>" alt="<?php esc_attr_e( 'ARNA Oceanic Wellness Spa', 'liam-digital-marketing' ); ?>" width="711" height="240" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/united-pharma.png' ); ?>" alt="<?php esc_attr_e( 'United Pharma', 'liam-digital-marketing' ); ?>" width="2288" height="1726" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/house-of-om.png' ); ?>" alt="<?php esc_attr_e( 'House of Om', 'liam-digital-marketing' ); ?>" width="436" height="534" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/home-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'Home by Ours', 'liam-digital-marketing' ); ?>" width="279" height="106" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/lulu-bistrot.png' ); ?>" alt="<?php esc_attr_e( 'Lulu Bistrot', 'liam-digital-marketing' ); ?>" width="564" height="392" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/marbela-beach.png' ); ?>" alt="<?php esc_attr_e( 'Marbela Beach', 'liam-digital-marketing' ); ?>" width="696" height="586" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/kyzn.png' ); ?>" alt="<?php esc_attr_e( 'kyzn', 'liam-digital-marketing' ); ?>" width="1335" height="483" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/natuurvlees.png' ); ?>" alt="<?php esc_attr_e( 'natuurVlees.nl', 'liam-digital-marketing' ); ?>" width="858" height="205" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/ourspa.png' ); ?>" alt="<?php esc_attr_e( 'Ourspa', 'liam-digital-marketing' ); ?>" width="828" height="173" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/penida-colada.png' ); ?>" alt="<?php esc_attr_e( 'Penida Colada Beach Bar', 'liam-digital-marketing' ); ?>" width="750" height="370" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/royal-finances.png' ); ?>" alt="<?php esc_attr_e( 'Royal Finances', 'liam-digital-marketing' ); ?>" width="724" height="331" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/raw-uluwatu.png' ); ?>" alt="<?php esc_attr_e( 'RAW Uluwatu', 'liam-digital-marketing' ); ?>" width="360" height="148" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/meso.png' ); ?>" alt="<?php esc_attr_e( 'Meso Mediterranean Grill Kitchen', 'liam-digital-marketing' ); ?>" width="1014" height="1014" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/muang-samui-spa-resort.png' ); ?>" alt="<?php esc_attr_e( 'Muang Samui Spa Resort', 'liam-digital-marketing' ); ?>" width="624" height="580" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/mood-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'Mood by Ours', 'liam-digital-marketing' ); ?>" width="275" height="107" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--tall"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/mel-francis-villas.png' ); ?>" alt="<?php esc_attr_e( 'Mel Francis Villas', 'liam-digital-marketing' ); ?>" width="629" height="748" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/raw-ubud.png' ); ?>" alt="<?php esc_attr_e( 'RAW Ubud', 'liam-digital-marketing' ); ?>" width="288" height="116" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/chalong-bay.png' ); ?>" alt="<?php esc_attr_e( 'Chalong Bay', 'liam-digital-marketing' ); ?>" width="2016" height="546" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/athlean.png' ); ?>" alt="<?php esc_attr_e( 'Athlean', 'liam-digital-marketing' ); ?>" width="655" height="363" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xxs2"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/cash-depot.png' ); ?>" alt="<?php esc_attr_e( 'Cash-Depot', 'liam-digital-marketing' ); ?>" width="745" height="98" loading="lazy"></span>
            <span class="ldm-trustbar-logo"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/simple-pret.png' ); ?>" alt="<?php esc_attr_e( 'Simple Prêt', 'liam-digital-marketing' ); ?>" width="748" height="427" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--sm"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/nuhuman-raw.png' ); ?>" alt="<?php esc_attr_e( 'nüHuman RAW', 'liam-digital-marketing' ); ?>" width="366" height="144" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/shaz.png' ); ?>" alt="<?php esc_attr_e( 'Shaz Aesthetic & Medi Spa', 'liam-digital-marketing' ); ?>" width="751" height="221" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/simba-sea-trips.png' ); ?>" alt="<?php esc_attr_e( 'Simba Sea Trips Phuket', 'liam-digital-marketing' ); ?>" width="1085" height="1108" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/soho-pool-club.png' ); ?>" alt="<?php esc_attr_e( 'Soho Pool Club Phuket', 'liam-digital-marketing' ); ?>" width="2858" height="2858" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/steam-cleaning-phuket.png' ); ?>" alt="<?php esc_attr_e( 'Steam Cleaning Phuket', 'liam-digital-marketing' ); ?>" width="886" height="667" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--lg"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-barrel-wine-merchant.png' ); ?>" alt="<?php esc_attr_e( 'The Barrel Wine Merchant', 'liam-digital-marketing' ); ?>" width="926" height="944" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/the-beach-by-ours.png' ); ?>" alt="<?php esc_attr_e( 'The Beach by Ours', 'liam-digital-marketing' ); ?>" width="603" height="429" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--md"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/steam-cleaning-bangkok.png' ); ?>" alt="<?php esc_attr_e( 'Steam Cleaning Bangkok', 'liam-digital-marketing' ); ?>" width="772" height="622" loading="lazy"></span>
            <span class="ldm-trustbar-logo ldm-trustbar-logo--xs3"><img src="<?php echo esc_url( $ldm_img . '/assets/img/clients/trader2b.png' ); ?>" alt="<?php esc_attr_e( 'trader2B', 'liam-digital-marketing' ); ?>" width="633" height="180" loading="lazy"></span>
          </div>
      </div>
    </div>
  </section>

  <!-- 02 INTRODUCTION -->
  <section class="ldm-lens-host" id="intro" style="padding-top: var(--space-section);">
    <div class="ldm-lens-field container" aria-hidden="true">
      <div class="ldm-lens-layer ldm-lens-blurred">
        <span style="top:40%;left:3%;">Audience</span>
        <span style="top:80%;left:7%;">Signals</span>
        <span style="top:35%;left:91%;">Data</span>
        <span style="top:70%;left:93%;">Patterns</span>
        <span style="top:55%;left:1%;">Insight</span>
      </div>
    </div>
    <div class="container container-narrow">
      <div class="reveal">
        <span class="eyebrow">Introduction</span>
        <h2 class="fs-h2" style="margin:16px 0 24px;">Digital marketing, built around data.</h2>
        <p class="lede" style="max-width:none;">I'm a digital marketer who works across paid media, analytics, tracking and conversion optimization. I enjoy turning complex marketing data into clear strategies that produce measurable results — from 15x average ROAS to as high as 300x on top-performing campaigns.</p>
      </div>
    </div>
  </section>

  <!-- Capability marquee -->
  <div class="ldm-marquee-wrap" aria-hidden="true">
    <div class="ldm-marquee-track">
      <span>Paid Media</span><span>Lead Generation</span><span>Conversion Tracking</span><span>Performance Marketing</span><span>Analytics &amp; Attribution</span>
      <span>Paid Media</span><span>Lead Generation</span><span>Conversion Tracking</span><span>Performance Marketing</span><span>Analytics &amp; Attribution</span>
    </div>
  </div>

  <!-- 03 SELECTED WORK -->
  <section class="ldm-section container" id="work">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">Selected Work</span>
      <h2 class="fs-h2">Campaigns and growth systems built to perform.</h2>
      <p class="lede">A selection of campaigns, growth systems and digital projects built to deliver measurable results.</p>
    </div>

    <div class="ldm-case-list">
      <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>" class="ldm-case reveal">
        <div class="ldm-case-media">
          <span class="badge">Yacht Club</span>
          <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?q=80&w=1200&auto=format&fit=crop" alt="Noah Yacht Club performance marketing case study" loading="lazy" width="1200" height="900">
        </div>
        <div class="ldm-case-body">
          <div class="ldm-case-title">Noah Yacht Club <span class="arrow">&rarr;</span></div>
          <div class="ldm-case-industry">Paid Media &middot; Lead Generation &middot; Analytics</div>
          <p class="ldm-case-desc">Building a full-funnel campaign system to fill charter and membership enquiries for this yacht club.</p>
          <div class="ldm-case-result">+XX% <span class="label">Qualified Enquiries</span></div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>" class="ldm-case reveal">
        <div class="ldm-case-media">
          <span class="badge">Restaurant Group</span>
          <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1200&auto=format&fit=crop" alt="Ours Group multi-venue performance marketing case study" loading="lazy" width="1200" height="900">
        </div>
        <div class="ldm-case-body">
          <div class="ldm-case-title">Ours Group <span class="arrow">&rarr;</span></div>
          <div class="ldm-case-industry">Performance Marketing &middot; Analytics &middot; Conversion Tracking</div>
          <p class="ldm-case-desc">Running paid media and a shared tracking system across five venues under one restaurant group — Ama, Home, Mood, The Beach and Ours Bali.</p>
          <div class="ldm-case-result">+XX% <span class="label">ROAS</span></div>
        </div>
      </a>

      <a href="<?php echo esc_url( home_url( '/case-study/' ) ); ?>" class="ldm-case reveal">
        <div class="ldm-case-media">
          <span class="badge">Luxury Weddings</span>
          <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200&auto=format&fit=crop" alt="Tirtha Bali luxury wedding campaign creative" loading="lazy" width="1200" height="900">
        </div>
        <div class="ldm-case-body">
          <div class="ldm-case-title">Tirtha Bali <span class="arrow">&rarr;</span></div>
          <div class="ldm-case-industry">Paid Media &middot; Lead Generation &middot; Conversion Tracking</div>
          <p class="ldm-case-desc">Generating higher-quality international wedding enquiries through targeted paid media and full-funnel tracking.</p>
          <div class="ldm-case-result">+XX% <span class="label">Qualified Enquiries</span></div>
        </div>
      </a>
    </div>

    <div style="margin-top: var(--gap-lg); text-align:center;">
      <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="btn btn-secondary reveal">View All Work</a>
    </div>
  </section>

  <!-- 04 SERVICES -->
  <section class="ldm-section container" id="services">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">What I Do</span>
      <h2 class="fs-h2">Strategy, media and data working as one system.</h2>
    </div>
    <div class="ldm-services-grid reveal">
      <div class="ldm-service">
        <div class="index">01</div>
        <h3>Paid Media</h3>
        <p>Meta, Google, TikTok and LinkedIn Ads, plus Performance Max and Search campaigns built for efficiency.</p>
      </div>
      <div class="ldm-service">
        <div class="index">02</div>
        <h3>Lead Generation</h3>
        <p>Campaigns designed around qualified enquiries rather than vanity metrics.</p>
      </div>
      <div class="ldm-service">
        <div class="index">03</div>
        <h3>Conversion Tracking</h3>
        <p>GA4, Google Tag Manager, Meta Pixel, conversion APIs and event tracking.</p>
      </div>
      <div class="ldm-service">
        <div class="index">04</div>
        <h3>Marketing Analytics</h3>
        <p>Measurement systems, dashboards, attribution and campaign analysis.</p>
      </div>
      <div class="ldm-service">
        <div class="index">05</div>
        <h3>Conversion Optimization</h3>
        <p>Landing pages, forms, funnels and conversion journeys that perform.</p>
      </div>
      <div class="ldm-service">
        <div class="index">06</div>
        <h3>Growth &amp; Digital Strategy</h3>
        <p>SEO, SEM, social and email working alongside paid media in one growth plan.</p>
      </div>
    </div>
  </section>

  <!-- 05 TECH / SKILLS & TOOLS -->
  <section class="ldm-section container" id="skills-tools">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">Skills &amp; Tools</span>
      <h2 class="fs-h2">The technology stack behind the strategy.</h2>
    </div>
    <div class="ldm-tech-grid reveal">
      <div class="ldm-tech-cat">
        <h4>Advertising</h4>
        <ul><li>Meta Ads</li><li>Google Ads</li><li>TikTok Ads</li><li>LinkedIn Ads</li><li>Performance Max</li><li>Google Search</li></ul>
      </div>
      <div class="ldm-tech-cat">
        <h4>Analytics</h4>
        <ul><li>GA4</li><li>Looker Studio</li><li>Google Analytics</li><li>Attribution Modeling</li><li>Data Visualization</li></ul>
      </div>
      <div class="ldm-tech-cat">
        <h4>Tracking</h4>
        <ul><li>Google Tag Manager</li><li>Meta Pixel</li><li>Conversion Tracking</li><li>Server-side Tracking</li></ul>
      </div>
      <div class="ldm-tech-cat">
        <h4>CRM / Automation</h4>
        <ul><li>HubSpot</li><li>Lead Management</li><li>Marketing Automation</li><li>CRM Integration</li></ul>
      </div>
      <div class="ldm-tech-cat">
        <h4>Websites</h4>
        <ul><li>WordPress</li><li>Landing Pages</li><li>Conversion Optimization</li></ul>
      </div>
    </div>
  </section>

  <!-- 06 TRUST / METRICS (Results) -->
  <section class="ldm-section container" id="results">
    <div class="ldm-metrics reveal">
      <div class="ldm-metric">
        <div class="ldm-metric-ring">
          <svg viewBox="0 0 120 120" aria-hidden="true">
            <circle class="ring-track" cx="60" cy="60" r="52"></circle>
            <circle class="ring-progress" cx="60" cy="60" r="52" pathLength="100"></circle>
          </svg>
          <div class="num"><span data-counter="10" data-prefix="$" data-suffix="M+" class="accent">$0M+</span></div>
        </div>
        <div class="label">Ad spend managed</div>
      </div>
      <div class="ldm-metric">
        <div class="ldm-metric-ring">
          <svg viewBox="0 0 120 120" aria-hidden="true">
            <circle class="ring-track" cx="60" cy="60" r="52"></circle>
            <circle class="ring-progress" cx="60" cy="60" r="52" pathLength="100"></circle>
          </svg>
          <div class="num"><span data-counter="100" data-suffix="+" class="accent">0</span></div>
        </div>
        <div class="label">Brands scaled</div>
      </div>
      <div class="ldm-metric">
        <div class="ldm-metric-ring">
          <svg viewBox="0 0 120 120" aria-hidden="true">
            <circle class="ring-track" cx="60" cy="60" r="52"></circle>
            <circle class="ring-progress" cx="60" cy="60" r="52" pathLength="100"></circle>
          </svg>
          <div class="num"><span data-counter="15" data-suffix="x" class="accent">0x</span></div>
        </div>
        <div class="label">Average ROAS</div>
      </div>
      <div class="ldm-metric">
        <div class="ldm-metric-ring">
          <svg viewBox="0 0 120 120" aria-hidden="true">
            <circle class="ring-track" cx="60" cy="60" r="52"></circle>
            <circle class="ring-progress" cx="60" cy="60" r="52" pathLength="100"></circle>
          </svg>
          <div class="num"><span data-counter="300" data-suffix="x" class="accent">0x</span></div>
        </div>
        <div class="label">Peak ROAS on top campaigns</div>
      </div>
    </div>
  </section>

  <!-- 07 ABOUT TEASER -->
  <section class="ldm-section container" id="about-teaser">
    <div class="ldm-about reveal">
      <div>
        <span class="eyebrow">About</span>
        <h2 class="fs-h2" style="margin-top:16px;">I work at the intersection of marketing, technology and data.</h2>
      </div>
      <div>
        <p class="lede" style="max-width:56ch;">Digital Marketing Manager with 6+ years managing multi-million-dollar ad budgets across hospitality, e-commerce and professional services — building paid media, tracking and analytics systems that connect ad spend to real business outcomes.</p>
        <div class="ldm-about-stats">
          <div><div class="num"><span data-counter="6" data-suffix="+">0+</span></div><div class="label">Years in performance marketing</div></div>
          <div><div class="num"><span data-counter="100" data-suffix="+">0+</span></div><div class="label">Brands scaled</div></div>
        </div>
        <a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-secondary" style="margin-top:32px;">More About Me &rarr;</a>
      </div>
    </div>
  </section>

  <!-- 08 PROCESS (Approach) -->
  <section class="ldm-section container" id="process">
    <div class="ldm-section-head reveal">
      <span class="eyebrow">How I Work</span>
      <h2 class="fs-h2">A simple, disciplined process.</h2>
    </div>
    <div class="ldm-process reveal">
      <div class="ldm-process-step">
        <div class="num">01</div>
        <h4>Discover</h4>
        <p>Understand the business, audience and objectives.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">02</div>
        <h4>Build</h4>
        <p>Develop the campaign, tracking and creative strategy.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">03</div>
        <h4>Optimize</h4>
        <p>Analyze performance and continuously improve.</p>
      </div>
      <div class="ldm-process-step">
        <div class="num">04</div>
        <h4>Scale</h4>
        <p>Increase what works and eliminate what doesn't.</p>
      </div>
    </div>
  </section>

  <!-- 09 CONTACT CTA -->
  <section class="ldm-section container ldm-contact" id="contact-cta">
    <div class="reveal">
      <svg class="ldm-thread-accent ldm-thread-accent--single" viewBox="0 0 200 22" aria-hidden="true">
        <path pathLength="1" d="M4,16 C55,20 90,3 138,5 C158,6 176,9 194,7"></path>
        <circle cx="194" cy="7" r="2.6"></circle>
      </svg>
      <span class="eyebrow">Contact</span>
      <h2 class="fs-h2" style="margin-top:16px;">Let's Build Something That Performs.</h2>
      <p class="lede">Have a project, campaign or growth challenge? Let's talk.</p>
      <div class="ldm-contact-ctas">
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">Start a Conversation &rarr;</a>
      </div>
      <div class="ldm-contact-links">
        <?php ldm_render_contact_links(); ?>
      </div>
    </div>
  </section>

<?php get_footer(); ?>
