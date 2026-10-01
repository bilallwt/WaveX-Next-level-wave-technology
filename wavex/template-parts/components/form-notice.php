<?php
/**
 * Form status message.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status = isset( $args['status'] ) ? $args['status'] : '';
$map    = array(
	'sent'    => array( 'ok', __( 'Thank you. Your message has been sent and we will reply soon.', 'wavex' ) ),
	'error'   => array( 'bad', __( 'Please check the form: your name, a valid email, a message of at least 10 characters and the agreement box are required.', 'wavex' ) ),
	'invalid' => array( 'bad', __( 'The form could not be verified. Please reload the page and try again.', 'wavex' ) ),
	'limit'   => array( 'bad', __( 'Too many messages were sent from this connection. Please try again later or message us on WhatsApp or email.', 'wavex' ) ),
);
if ( ! isset( $map[ $status ] ) ) {
	return;
}
?>
<p class="form__notice form__notice--<?php echo esc_attr( $map[ $status ][0] ); ?>" role="status"><?php echo esc_html( $map[ $status ][1] ); ?></p>
