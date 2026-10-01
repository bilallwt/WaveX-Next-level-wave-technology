<?php
/**
 * WhatsApp + email buttons. Args: topic, size (md|sm), tone (default|light).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args    = wp_parse_args( isset( $args ) ? $args : array(), array(
	'topic' => '',
	'size'  => 'md',
	'tone'  => 'default',
) );
$contact = wavex_contact( $args['topic'] );
$size    = 'sm' === $args['size'] ? ' btn--sm' : '';
?>
<div class="contact-actions contact-actions--<?php echo esc_attr( $args['tone'] ); ?>">
	<?php if ( $contact['whatsapp'] ) : ?>
		<a class="btn btn--whatsapp<?php echo esc_attr( $size ); ?>" href="<?php echo esc_url( $contact['whatsapp'] ); ?>" target="_blank" rel="noopener">
			<?php echo wavex_icon( 'whatsapp' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php esc_html_e( 'Chat on WhatsApp', 'wavex' ); ?>
		</a>
	<?php endif; ?>
	<a class="btn <?php echo ( 'light' === $args['tone'] ) ? 'btn--light' : 'btn--primary'; ?><?php echo esc_attr( $size ); ?>" href="<?php echo esc_url( $contact['email_url'] ); ?>">
		<?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php esc_html_e( 'Email us', 'wavex' ); ?>
	</a>
</div>
