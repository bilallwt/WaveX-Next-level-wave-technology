<?php
/**
 * Service hero visual: the elements that belong to this service, shown in one of
 * eight layouts (picked per service so neighbouring services look different).
 * Args: slug.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug     = isset( $args['slug'] ) ? $args['slug'] : '';
$services = wavex_services();
$all      = wavex_service_elements();
if ( ! isset( $all[ $slug ] ) ) {
	return;
}
$els   = $all[ $slug ];
$svc   = $services[ $slug ];
$index = array_search( $slug, array_keys( $services ), true );
$archs = array( 'cloud', 'orbit', 'flow', 'stack', 'grid', 'ticks', 'thin', 'radial' );
$arch  = $archs[ ( (int) $index ) % 8 ];
$core  = '<span class="rg__core-icon">' . wavex_icon( $svc['icon'] ) . '</span><span class="rg__core-name">' . esc_html( $svc['title'] ) . '</span>';

if ( in_array( $arch, array( 'orbit', 'ticks', 'thin', 'radial' ), true ) ) {
	$items = array();
	foreach ( $els as $el ) {
		$items[] = array( 'icon' => $el[0], 'label' => $el[1] );
	}
	wavex_ring_v( $arch, $items, $core, 'rg--svc' );
	return;
}
?>
<?php if ( 'cloud' === $arch ) : ?>
	<div class="sa sa-cloud">
		<svg class="sa-cloud__lines" viewBox="0 0 400 400" aria-hidden="true"><path d="M200 200L70 70M200 200L330 70M200 200L70 330M200 200L330 330"/></svg>
		<span class="sa-core"><?php echo wavex_icon( $svc['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<?php foreach ( $els as $i => $el ) : ?>
			<span class="sa-chip sa-chip--<?php echo (int) $i; ?>"><?php echo wavex_icon( $el[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $el[1] ); ?></span>
		<?php endforeach; ?>
	</div>
<?php elseif ( 'flow' === $arch ) : ?>
	<div class="sa sa-flow">
		<p class="sa-flow__title"><?php echo wavex_icon( $svc['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $svc['title'] ); ?></p>
		<ol>
			<?php foreach ( $els as $i => $el ) : ?>
				<li style="--k:<?php echo (int) $i; ?>"><span class="sa-flow__node"><?php echo wavex_icon( $el[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><span class="sa-flow__label"><?php echo esc_html( $el[1] ); ?></span></li>
			<?php endforeach; ?>
		</ol>
	</div>
<?php elseif ( 'stack' === $arch ) : ?>
	<div class="sa sa-stack">
		<?php foreach ( $els as $i => $el ) : ?>
			<div class="sa-stack__card sa-stack__card--<?php echo (int) $i; ?>"><span class="sa-stack__icon"><?php echo wavex_icon( $el[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><strong><?php echo esc_html( $el[1] ); ?></strong><i></i></div>
		<?php endforeach; ?>
	</div>
<?php else : ?>
	<div class="sa sa-grid">
		<?php foreach ( $els as $i => $el ) : ?>
			<div class="sa-grid__tile sa-grid__tile--<?php echo (int) $i; ?>"><?php echo wavex_icon( $el[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><strong><?php echo esc_html( $el[1] ); ?></strong></div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
