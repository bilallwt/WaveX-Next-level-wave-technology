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
			<?php wavex_button( __( 'Free Consultation', 'wavex' ), wavex_url( 'free-consultation' ), 'light' ); ?>
			<?php wavex_button( __( 'Contact Our Team', 'wavex' ), wavex_url( 'contact' ), 'outline' ); ?>
		</div>
	</div>
</section>
