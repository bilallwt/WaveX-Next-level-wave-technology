<?php
/**
 * Pill-shaped call-to-action bar (reusable).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="cta-bar" aria-label="<?php esc_attr_e( 'Get in touch', 'wavex' ); ?>">
	<div class="cta-bar__inner">
		<span class="cta-bar__brand"><?php bloginfo( 'name' ); ?></span>
		<p class="cta-bar__text"><?php echo esc_html( wavex_opt( 'cta_text' ) ); ?></p>
		<a class="pill" href="<?php echo esc_url( wavex_url( 'faq' ) ); ?>"><?php esc_html_e( 'Common questions', 'wavex' ); ?></a>
		<?php wavex_button( __( 'Contact Our Team', 'wavex' ), wavex_url( 'contact' ), 'primary' ); ?>
	</div>
</section>
