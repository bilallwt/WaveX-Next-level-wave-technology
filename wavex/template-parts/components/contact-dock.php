<?php
/**
 * Floating quick-contact buttons (all pages).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact = wavex_contact();
?>
<div class="dock" aria-label="<?php esc_attr_e( 'Quick contact', 'wavex' ); ?>">
	<?php if ( $contact['whatsapp'] ) : ?>
		<a class="dock__btn dock__btn--wa" href="<?php echo esc_url( $contact['whatsapp'] ); ?>" target="_blank" rel="noopener">
			<?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span><?php esc_html_e( 'WhatsApp', 'wavex' ); ?></span>
		</a>
	<?php endif; ?>
	<a class="dock__btn dock__btn--mail" href="<?php echo esc_url( $contact['email_url'] ); ?>">
		<?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span><?php esc_html_e( 'Email', 'wavex' ); ?></span>
	</a>
</div>
