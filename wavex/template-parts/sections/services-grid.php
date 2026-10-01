<?php
/**
 * Home: featured services grid.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
?>
<section class="section" aria-labelledby="services-title">
	<header class="section__head">
		<h2 class="section__title" id="services-title"><?php esc_html_e( 'What we do', 'wavex' ); ?></h2>
		<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services' ) ); ?>">
			<?php esc_html_e( 'All services', 'wavex' ); ?>
			<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</header>

	<div class="card-grid">
		<?php
		foreach ( wavex_featured_services() as $i => $slug ) :
			if ( ! isset( $services[ $slug ] ) ) {
				continue;
			}
			$service = $services[ $slug ];
			$dark    = in_array( $i, array( 1, 6 ), true );
			?>
			<a class="service-card<?php echo $dark ? ' service-card--dark' : ''; ?>" href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
				<span class="service-card__icon"><?php echo wavex_icon( $service['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="service-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
				<p class="service-card__text"><?php echo esc_html( $service['text'] ); ?></p>
			</a>
		<?php endforeach; ?>
	</div>
</section>
