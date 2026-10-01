<?php
/**
 * Closing call-to-action band.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="final-cta" aria-labelledby="final-title">
	<div class="final-cta__inner">
		<h2 class="final-cta__title" id="final-title"><?php echo esc_html( wavex_opt( 'cta_title' ) ); ?></h2>
		<p><?php echo esc_html( wavex_opt( 'cta_text' ) ); ?></p>
		<div class="hero__actions">
			<?php get_template_part( 'template-parts/components/contact-actions', null, array() ); ?>
			<?php wavex_button( __( 'Free Consultation', 'wavex' ), wavex_url( 'free-consultation' ), 'ghost' ); ?>
		</div>
		<?php $c = wavex_contact(); ?>
		<?php if ( $c['email'] || $c['whatsapp_label'] ) : ?>
			<p class="final-cta__direct">
				<?php if ( $c['email'] ) : ?><span><?php echo esc_html( antispambot( $c['email'] ) ); ?></span><?php endif; ?>
				<?php if ( $c['whatsapp_label'] ) : ?><span><?php echo esc_html( $c['whatsapp_label'] ); ?></span><?php endif; ?>
			</p>
		<?php endif; ?>
	</div>
</section>
