<?php
/**
 * Direct contact options (WhatsApp, email, phone).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$c = wavex_contact();
?>
<ul class="contact-cards">
	<?php if ( $c['whatsapp'] ) : ?>
		<li>
			<a class="contact-card contact-card--wa" href="<?php echo esc_url( $c['whatsapp'] ); ?>" target="_blank" rel="noopener">
				<span class="contact-card__icon"><?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span><strong><?php esc_html_e( 'WhatsApp', 'wavex' ); ?></strong><span><?php echo esc_html( $c['whatsapp_label'] ? $c['whatsapp_label'] : __( 'Chat with us directly', 'wavex' ) ); ?></span></span>
			</a>
		</li>
	<?php endif; ?>
	<li>
		<a class="contact-card" href="<?php echo esc_url( $c['email_url'] ); ?>">
			<span class="contact-card__icon"><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
			<span><strong><?php esc_html_e( 'Email', 'wavex' ); ?></strong><span><?php echo esc_html( $c['email'] ? antispambot( $c['email'] ) : __( 'Send us a message', 'wavex' ) ); ?></span></span>
		</a>
	</li>
	<?php if ( $c['phone'] ) : ?>
		<li>
			<a class="contact-card" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $c['phone'] ) ); ?>">
				<span class="contact-card__icon"><?php echo wavex_icon( 'chat' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<span><strong><?php esc_html_e( 'Phone', 'wavex' ); ?></strong><span><?php echo esc_html( $c['phone'] ); ?></span></span>
			</a>
		</li>
	<?php endif; ?>
</ul>
