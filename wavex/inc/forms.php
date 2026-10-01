<?php
/**
 * Contact and consultation forms. No plugin: nonce, honeypot, time check,
 * rate limit, sanitisation, email, and a private "Enquiries" record so
 * nothing is lost if email delivery fails.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Private post type that stores enquiries (admin only).
 */
function wavex_register_enquiry_type() {
	register_post_type( 'enquiry', array(
		'labels'              => array(
			'name'          => __( 'Enquiries', 'wavex' ),
			'singular_name' => __( 'Enquiry', 'wavex' ),
			'menu_name'     => __( 'Enquiries', 'wavex' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-email-alt',
		'menu_position'       => 22,
		'supports'            => array( 'title', 'editor' ),
		'capability_type'     => 'post',
		'capabilities'        => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'        => true,
		'exclude_from_search' => true,
	) );
}
add_action( 'init', 'wavex_register_enquiry_type' );

/**
 * Redirect back to the form page with a status flag.
 *
 * @param string $status sent|error|invalid|limit.
 */
function wavex_form_redirect( $status ) {
	$back = wp_get_referer();
	if ( ! $back ) {
		$back = home_url( '/' );
	}
	$back = remove_query_arg( 'wavex_form', $back );
	wp_safe_redirect( add_query_arg( 'wavex_form', $status, $back ) . '#form' );
	exit;
}

/**
 * Handle both forms (action wavex_enquiry).
 */
function wavex_handle_enquiry() {
	if ( ! isset( $_POST['wavex_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['wavex_nonce'] ) ), 'wavex_enquiry' ) ) {
		wavex_form_redirect( 'invalid' );
	}

	// Honeypot and minimum fill time (bots).
	if ( ! empty( $_POST['wavex_website'] ) ) {
		wavex_form_redirect( 'sent' ); // Pretend success.
	}
	$rendered = isset( $_POST['wavex_t'] ) ? (int) $_POST['wavex_t'] : 0;
	if ( $rendered && ( time() - $rendered ) < 3 ) {
		wavex_form_redirect( 'invalid' );
	}

	// Rate limit: 5 enquiries per hour per visitor.
	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
	$key = 'wavex_rl_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		wavex_form_redirect( 'limit' );
	}

	$type    = ( isset( $_POST['form_type'] ) && 'consultation' === $_POST['form_type'] ) ? 'consultation' : 'contact';
	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$consent = ! empty( $_POST['consent'] );

	$topics = wavex_contact_topics();
	$topic  = isset( $_POST['topic'] ) ? sanitize_key( wp_unslash( $_POST['topic'] ) ) : '';
	$topic  = isset( $topics[ $topic ] ) ? $topics[ $topic ] : '';

	$services_all = wavex_services();
	$chosen       = array();
	if ( isset( $_POST['services'] ) && is_array( $_POST['services'] ) ) {
		foreach ( wp_unslash( $_POST['services'] ) as $slug ) {
			$slug = sanitize_key( $slug );
			if ( isset( $services_all[ $slug ] ) ) {
				$chosen[] = $services_all[ $slug ]['title'];
			}
		}
	}
	$prefer = ( isset( $_POST['prefer'] ) && 'whatsapp' === $_POST['prefer'] ) ? 'WhatsApp' : 'Email';

	if ( '' === $name || ! is_email( $email ) || strlen( $message ) < 10 || ! $consent ) {
		wavex_form_redirect( 'error' );
	}

	$lines = array(
		'Type: ' . $type,
		'Name: ' . $name,
		'Email: ' . $email,
		'Phone / WhatsApp: ' . ( $phone ? $phone : '-' ),
	);
	if ( 'consultation' === $type ) {
		$lines[] = 'Services of interest: ' . ( $chosen ? implode( ', ', $chosen ) : '-' );
		$lines[] = 'Preferred contact: ' . $prefer;
	} else {
		$lines[] = 'Topic: ' . ( $topic ? $topic : '-' );
	}
	$lines[] = '';
	$lines[] = $message;
	$body    = implode( "\n", $lines );

	$subject = ( 'consultation' === $type )
		/* translators: %s: sender name. */
		? sprintf( __( 'Free consultation request from %s', 'wavex' ), $name )
		/* translators: %s: sender name. */
		: sprintf( __( 'Website enquiry from %s', 'wavex' ), $name );

	// Always keep a private copy.
	wp_insert_post( array(
		'post_type'    => 'enquiry',
		'post_status'  => 'private',
		'post_title'   => $subject,
		'post_content' => $body,
	) );

	$to      = wavex_opt( 'contact_email' );
	$to      = is_email( $to ) ? $to : get_option( 'admin_email' );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
	wp_mail( $to, $subject, $body, $headers );

	set_transient( $key, $hit + 1, HOUR_IN_SECONDS );
	wavex_form_redirect( 'sent' );
}
add_action( 'admin_post_nopriv_wavex_enquiry', 'wavex_handle_enquiry' );
add_action( 'admin_post_wavex_enquiry', 'wavex_handle_enquiry' );

/**
 * Current form status from the query string (display only).
 *
 * @return string
 */
function wavex_form_status() {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- display flag only.
	$status = isset( $_GET['wavex_form'] ) ? sanitize_key( wp_unslash( $_GET['wavex_form'] ) ) : '';
	return in_array( $status, array( 'sent', 'error', 'invalid', 'limit' ), true ) ? $status : '';
}
