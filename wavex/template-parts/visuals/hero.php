<?php
/**
 * Home hero visual: browser, code card, phone and chart drawn in code.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="hv">
	<span class="hv__chip hv__chip--a"><?php echo wavex_icon( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>API</span>
	<span class="hv__chip hv__chip--b"><?php echo wavex_icon( 'code' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Web</span>
	<span class="hv__chip hv__chip--c"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>SEO</span>
	<div class="hv__code">
		<div class="hv__bar"><i></i><i></i><i></i></div>
		<p class="hv__ln" style="--n:19;--d:.4s"><b class="c1">const</b> site = <b class="c2">build</b>();</p>
		<p class="hv__ln" style="--n:22;--d:1.5s">site.<b class="c2">connect</b>( <b class="c3">api</b> );</p>
		<p class="hv__ln" style="--n:20;--d:2.7s">site.<b class="c2">launch</b>( <b class="c3">web</b> );</p>
		<p class="hv__ln" style="--n:18;--d:3.8s"><b class="c4">// live</b> <b class="c4">&#10003;</b></p>
	</div>
	<div class="hv__browser">
		<div class="hv__bar hv__bar--light"><i></i><i></i><i></i><span></span></div>
		<div class="hv__page">
			<div class="hv__nav mk-pop" style="--d:.8s"><b></b><span></span><span></span><span></span></div>
			<div class="hv__hero mk-pop" style="--d:1.6s"><i style="--w:58%"></i><i style="--w:84%"></i><em></em></div>
			<div class="hv__cards"><div class="mk-pop" style="--d:2.6s"></div><div class="mk-pop" style="--d:3s"></div><div class="mk-pop" style="--d:3.4s"></div></div>
		</div>
	</div>
	<div class="hv__phone mk-pop" style="--d:3.6s"><i class="hv__notch"></i><div class="hv__pl" style="--w:56%"></div><div class="hv__tile"></div><div class="hv__pl" style="--w:78%"></div><div class="hv__pl" style="--w:46%"></div></div>
	<div class="hv__chart mk-pop" style="--d:4.2s"><span class="hv__chart-title"></span><div class="hv__bars"><i style="--h:35%;--d:4.6s"></i><i style="--h:55%;--d:4.75s"></i><i style="--h:45%;--d:4.9s"></i><i style="--h:72%;--d:5.05s"></i><i style="--h:90%;--d:5.2s"></i></div></div>
</div>
