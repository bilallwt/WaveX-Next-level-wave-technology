<?php
/**
 * Compact call-to-action strip: WhatsApp and email with the topic pre-filled.
 * Args: title, text, topic, tone (default|strip).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'title' => __( 'Want this for your business?', 'wavex' ),
		'text'  => __( 'Send us a short message. We reply with the next step.', 'wavex' ),
		'topic' => '',
		'tone'  => 'default',
	)
);
?>
<aside class="cta-band cta-band--<?php echo esc_attr( $args['tone'] ); ?>">
	<div class="cta-band__inner">
		<span class="cta-band__icon"><?php echo wavex_icon( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<div class="cta-band__copy">
			<strong><?php echo esc_html( $args['title'] ); ?></strong>
			<span><?php echo esc_html( $args['text'] ); ?></span>
		</div>
		<div class="cta-band__actions">
			<?php wavex_cta_button( __( 'Chat on WhatsApp', 'wavex' ), $args['topic'], 'whatsapp' ); ?>
			<?php wavex_cta_button( __( 'Email us', 'wavex' ), $args['topic'], 'email' ); ?>
		</div>
	</div>
</aside>
