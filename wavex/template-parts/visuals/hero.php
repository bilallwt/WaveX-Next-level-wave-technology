<?php
/**
 * Home hero visual: a ring of the four service areas with floating tech cards.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$core = '<svg class="hr__mark" viewBox="0 0 30 30" fill="none" aria-hidden="true"><path d="M2 9c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#fff" stroke-width="3" stroke-linecap="round"/><path d="M2 16c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#7ee8f2" stroke-width="3" stroke-linecap="round"/><path d="M2 23c3-5 6-5 9 0s6 5 9 0 5-4 8-1" stroke="#fff" stroke-opacity=".5" stroke-width="3" stroke-linecap="round"/></svg><span>WaveX</span><em>' . esc_html__( 'Technology', 'wavex' ) . '</em>';
?>
<div class="hr">
	<div class="hr__ring">
		<?php
		wavex_ring(
			array(
				array( 'icon' => 'layout', 'label' => 'Web' ),
				array( 'icon' => 'cube', 'label' => 'Software' ),
				array( 'icon' => 'megaphone', 'label' => 'Marketing' ),
				array( 'icon' => 'mobile', 'label' => 'Mobile' ),
			),
			$core,
			'rg--hero'
		);
		?>
	</div>
	<div class="hr__card hr__card--code">
		<div class="hv__bar"><i></i><i></i><i></i></div>
		<p class="hv__ln" style="--n:21;--d:.5s"><b class="c1">const</b> site = <b class="c2">build</b>();</p>
		<p class="hv__ln" style="--n:22;--d:1.6s">site.<b class="c2">connect</b>( <b class="c3">api</b> );</p>
		<p class="hv__ln" style="--n:15;--d:2.8s"><b class="c4">// live &#10003;</b></p>
	</div>
	<div class="hr__card hr__card--chart">
		<span class="hv__chart-title"></span>
		<div class="hv__bars"><i style="--h:35%;--d:2s"></i><i style="--h:55%;--d:2.15s"></i><i style="--h:45%;--d:2.3s"></i><i style="--h:72%;--d:2.45s"></i><i style="--h:92%;--d:2.6s"></i></div>
	</div>
	<div class="hr__card hr__card--phone"><i class="hv__notch"></i><div class="hv__pl" style="--w:60%"></div><div class="hv__tile"></div><div class="hv__pl" style="--w:80%"></div></div>
	<span class="hr__chip hr__chip--a"><?php echo wavex_icon( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>API</span>
	<span class="hr__chip hr__chip--b"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>SEO</span>
</div>
