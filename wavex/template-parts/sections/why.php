<?php
/**
 * Home: what to expect (drawn from the services and process only).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$points = array(
	array( 'layers', __( 'Web, mobile and marketing together', 'wavex' ), __( 'Websites, apps, SEO and digital marketing are handled by one team, so your pieces fit together.', 'wavex' ) ),
	array( 'compass', __( 'Built around your requirements', 'wavex' ), __( 'Every project starts by understanding what you need, then planning the work before development begins.', 'wavex' ) ),
	array( 'wrench', __( 'Support after launch', 'wavex' ), __( 'Website and app maintenance are available once your product is live.', 'wavex' ) ),
);
?>
<section class="section section--accent" aria-labelledby="why-title">
	<div class="why">
		<div class="why__intro">
			<p class="eyebrow"><?php esc_html_e( 'Why WaveX', 'wavex' ); ?></p>
			<h2 class="section__title" id="why-title"><?php esc_html_e( 'What you can expect from us', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'A technology partner for businesses and organizations that want to build, improve, launch and grow online.', 'wavex' ); ?></p>
			<?php wavex_button( __( 'Why WaveX', 'wavex' ), wavex_url( 'why-wavex' ), 'ghost' ); ?>
		</div>
		<ul class="why__list">
			<?php foreach ( $points as $point ) : ?>
				<li class="why__item">
					<span class="why__icon"><?php echo wavex_icon( $point[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					<div>
						<h3><?php echo esc_html( $point[1] ); ?></h3>
						<p><?php echo esc_html( $point[2] ); ?></p>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
