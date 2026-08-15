<?php
/**
 * Replaces the static site's placeholder `action="#"` (there was no
 * backend to submit to) with a real handler using only WordPress
 * core — no form-plugin dependency. Posts to admin-post.php, which
 * is the standard WP mechanism for a custom form action; nopriv is
 * registered too since visitors submitting this form are never
 * logged in.
 */

defined( 'ABSPATH' ) || exit;

function ldm_handle_contact_form() {
	if ( ! isset( $_POST['ldm_contact_nonce'] ) || ! wp_verify_nonce( $_POST['ldm_contact_nonce'], 'ldm_contact_form' ) ) {
		wp_die( esc_html__( 'Security check failed — please go back and try again.', 'liam-digital-marketing' ) );
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$company = isset( $_POST['company'] ) ? sanitize_text_field( wp_unslash( $_POST['company'] ) ) : '';
	$budget  = isset( $_POST['budget'] ) ? sanitize_text_field( wp_unslash( $_POST['budget'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$redirect_to = isset( $_POST['ldm_redirect'] )
		? esc_url_raw( wp_unslash( $_POST['ldm_redirect'] ) )
		: home_url( '/contact/' );

	if ( '' === $name || '' === $message || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'ldm_contact', 'error', $redirect_to ) );
		exit;
	}

	$budget_labels = array(
		'lt-2k'     => 'Under $2K / month',
		'2k-5k'     => '$2K – $5K / month',
		'5k-10k'    => '$5K – $10K / month',
		'10k-plus'  => '$10K+ / month',
		'not-sure'  => 'Not sure yet',
	);

	$body = array(
		"Name: {$name}",
		"Email: {$email}",
	);
	if ( '' !== $company ) {
		$body[] = "Company: {$company}";
	}
	if ( '' !== $budget && isset( $budget_labels[ $budget ] ) ) {
		$body[] = 'Budget: ' . $budget_labels[ $budget ];
	}
	$body[] = '';
	$body[] = 'Message:';
	$body[] = $message;

	/**
	 * Filter the recipient address — defaults to the site admin
	 * email. Add something like:
	 *   add_filter('ldm_contact_form_recipient', fn() => 'liam.digitalmarketing.ads@gmail.com');
	 * in a child theme / mu-plugin to send enquiries somewhere
	 * other than whatever address WordPress is configured with.
	 */
	$to      = apply_filters( 'ldm_contact_form_recipient', get_option( 'admin_email' ) );
	$subject = sprintf( '[Website Enquiry] %s', $name );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, $subject, implode( "\n", $body ), $headers );

	wp_safe_redirect( add_query_arg( 'ldm_contact', $sent ? 'success' : 'error', $redirect_to ) );
	exit;
}
add_action( 'admin_post_ldm_contact_form', 'ldm_handle_contact_form' );
add_action( 'admin_post_nopriv_ldm_contact_form', 'ldm_handle_contact_form' );
