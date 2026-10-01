<?php
/**
 * Home / Why WaveX page: ring with the three promises, connected to a list.
 * Only statements supported by the services and process.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$points = array(
	array( 'layers', __( 'Web, mobile and marketing together', 'wavex' ), __( 'Websites, apps, SEO and digital marketing are handled by one team, so your pieces fit together.', 'wavex' ), 'services' ),
	array( 'compass', __( 'Built around your requirements', 'wavex' ), __( 'Every project starts by understanding what you need, then planning the work before development begins.', 'wavex' ), 'our-approach' ),
	array( 'wrench', __( 'Support after launch', 'wavex' ), __( 'Website and app maintenance are available once your product is live.', 'wavex' ), 'services/website-maintenance' ),
);
?>
<section class="whysec" aria-labelledby="why-title">
	<div class="whysec__inner">
		<div class="whysec__vis" data-vis>
			<?php
			$ring_items = array();
			foreach ( $points as $pt ) {
				$ring_items[] = array( 'icon' => $pt[0], 'label' => $pt[1], 'url' => wavex_url( $pt[3] ) );
			}
			wavex_ring_v( 'gauge', $ring_items, '<span class="rg__q">' . esc_html__( 'Why', 'wavex' ) . '</span><span class="rg__core-name">WaveX</span>', 'rg--why' );
			?>
		</div>
		<div class="whysec__copy">
			<p class="eyebrow"><?php esc_html_e( 'Why WaveX', 'wavex' ); ?></p>
			<h2 class="section__title" id="why-title"><?php esc_html_e( 'What you can expect from us', 'wavex' ); ?></h2>
			<p class="whysec__lead"><?php esc_html_e( 'A technology partner for businesses and organizations that want to build, improve, launch and grow online.', 'wavex' ); ?></p>
			<ol class="whylist">
				<?php foreach ( $points as $i => $p ) : ?>
					<li class="whylist__item whylist__item--<?php echo (int) $i; ?>">
						<span class="whylist__icon"><?php echo wavex_icon( $p[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
						<div><h3><?php echo esc_html( $p[1] ); ?></h3><p><?php echo esc_html( $p[2] ); ?></p></div>
					</li>
				<?php endforeach; ?>
			</ol>
			<?php wavex_button( __( 'Why WaveX', 'wavex' ), wavex_url( 'why-wavex' ), 'ghost' ); ?>
		</div>
	</div>
</section>
