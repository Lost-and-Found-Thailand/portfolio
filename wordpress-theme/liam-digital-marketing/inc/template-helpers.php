<?php
/**
 * Contact details + the icon/link markup repeated across the footer,
 * the homepage's Contact CTA, and the Contact page. Centralized here
 * once as constants + two render functions — the static site had
 * these SVGs duplicated verbatim in every one of the six HTML files,
 * which was fine for a hand-maintained static build but is exactly
 * the kind of repetition a template system exists to remove.
 */

defined( 'ABSPATH' ) || exit;

define( 'LDM_CONTACT_EMAIL', 'liam.digitalmarketing.ads@gmail.com' );
define( 'LDM_CONTACT_PHONE_DISPLAY', '+66 62 616 0129' );
define( 'LDM_CONTACT_PHONE_TEL', '+66626160129' );
define( 'LDM_CONTACT_WHATSAPP_URL', 'https://wa.me/66626160129' );
define( 'LDM_CONTACT_LINKEDIN_URL', 'https://www.linkedin.com/' );

/**
 * @param string $type One of 'email', 'phone', 'whatsapp', 'linkedin'.
 * @return string Raw SVG markup (each path is static, so echoing
 *                unescaped here is safe — nothing here is user input).
 */
function ldm_contact_icon( $type ) {
	$icons = array(
		'email'    => '<svg class="ldm-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"></rect><path d="m3 7 9 6 9-6"></path></svg>',
		'phone'    => '<svg class="ldm-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.6 10.8a15.5 15.5 0 0 0 6.6 6.6l2.2-2.2a1.5 1.5 0 0 1 1.5-.4 11 11 0 0 0 3.5.6A1.5 1.5 0 0 1 22 17.3V21a1.5 1.5 0 0 1-1.5 1.5A18.5 18.5 0 0 1 2.5 4.5 1.5 1.5 0 0 1 4 3h3.7a1.5 1.5 0 0 1 1.5 1.5 11 11 0 0 0 .6 3.5 1.5 1.5 0 0 1-.4 1.5z"></path></svg>',
		'whatsapp' => '<svg class="ldm-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.5a8.5 8.5 0 0 1-12.4 7.6L3 20l1-5.3A8.5 8.5 0 1 1 21 11.5z"></path><path d="M8.7 10.6c.3 2.4 2.3 4.4 4.7 4.7"></path></svg>',
		'linkedin' => '<svg class="ldm-contact-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="3"></rect><path d="M8 10.5V17M8 7.5v.01"></path><path d="M13 17v-4.2a2.3 2.3 0 0 1 4.5 0V17"></path></svg>',
	);

	return $icons[ $type ] ?? '';
}

/** The pill-style row with full email text — homepage + Contact page CTA sections. */
function ldm_render_contact_links() {
	?>
	<a href="mailto:<?php echo esc_attr( LDM_CONTACT_EMAIL ); ?>"><?php echo ldm_contact_icon( 'email' ); ?><?php echo esc_html( LDM_CONTACT_EMAIL ); ?></a>
	<a href="tel:<?php echo esc_attr( LDM_CONTACT_PHONE_TEL ); ?>"><?php echo ldm_contact_icon( 'phone' ); ?><?php echo esc_html( LDM_CONTACT_PHONE_DISPLAY ); ?></a>
	<a href="<?php echo esc_url( LDM_CONTACT_WHATSAPP_URL ); ?>" rel="noopener"><?php echo ldm_contact_icon( 'whatsapp' ); ?>WhatsApp</a>
	<a href="<?php echo esc_url( LDM_CONTACT_LINKEDIN_URL ); ?>" rel="noopener"><?php echo ldm_contact_icon( 'linkedin' ); ?>LinkedIn</a>
	<?php
}

/** The footer "Connect" column's short-label <li> links. */
function ldm_render_footer_connect_links() {
	?>
	<li><a href="mailto:<?php echo esc_attr( LDM_CONTACT_EMAIL ); ?>"><?php echo ldm_contact_icon( 'email' ); ?>Email</a></li>
	<li><a href="tel:<?php echo esc_attr( LDM_CONTACT_PHONE_TEL ); ?>"><?php echo ldm_contact_icon( 'phone' ); ?>Phone</a></li>
	<li><a href="<?php echo esc_url( LDM_CONTACT_WHATSAPP_URL ); ?>" rel="noopener"><?php echo ldm_contact_icon( 'whatsapp' ); ?>WhatsApp</a></li>
	<li><a href="<?php echo esc_url( LDM_CONTACT_LINKEDIN_URL ); ?>" rel="noopener"><?php echo ldm_contact_icon( 'linkedin' ); ?>LinkedIn</a></li>
	<?php
}

/**
 * Work page client grid — data-driven instead of 53 hand-copied
 * near-identical blocks (the static HTML's actual approach). Same
 * output, far less risk of a transcription slip in an image URL or
 * label somewhere in the middle of a long repetitive list.
 *
 * @param array $groups  [ 'Group Title' => [ ['name'=>, 'type'=>(optional), 'img'=>, 'alt'=>], ... ], ... ]
 */
function ldm_render_client_groups( $groups ) {
	foreach ( $groups as $title => $clients ) {
		?>
		<div class="ldm-client-group reveal">
			<h4><?php echo esc_html( $title ); ?></h4>
			<div class="ldm-client-photo-grid">
				<?php foreach ( $clients as $client ) :
					$fit = empty( $client['fit'] ) ? 'cover' : $client['fit'];
					$img_style = 'width:100%;height:100%;object-fit:' . esc_attr( $fit ) . ';';
					if ( 'contain' === $fit ) {
						$img_style .= 'background:var(--surface-1);';
					}
				?>
					<div class="ldm-client-card reveal">
						<div class="card-image" style="aspect-ratio:4/3;">
							<img src="<?php echo esc_url( $client['img'] ); ?>" alt="<?php echo esc_attr( $client['alt'] ); ?>" loading="lazy" width="500" height="375" style="<?php echo esc_attr( $img_style ); ?>">
						</div>
						<div class="name"><?php echo esc_html( $client['name'] ); ?></div>
						<?php if ( ! empty( $client['type'] ) ) : ?>
							<div class="type"><?php echo esc_html( $client['type'] ); ?></div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<?php
	}
}
