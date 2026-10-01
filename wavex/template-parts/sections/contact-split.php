<?php
/**
 * Closing split section: heading + consultation links.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="split" aria-labelledby="split-title">
	<div class="split__art" aria-hidden="true">
		<?php echo wavex_icon( 'mail', 'split__icon' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</div>
	<div class="split__copy">
		<h2 class="section__title" id="split-title"><?php echo esc_html( wavex_opt( 'cta_title' ) ); ?></h2>
		<p><?php echo esc_html( wavex_opt( 'cta_text' ) ); ?></p>
		<div class="hero__actions">
			<?php wavex_button( __( 'Free Consultation', 'wavex' ), wavex_url( 'free-consultation' ), 'primary' ); ?>
			<?php wavex_button( __( 'Why WaveX', 'wavex' ), wavex_url( 'why-wavex' ), 'ghost' ); ?>
		</div>
	</div>
</section>
