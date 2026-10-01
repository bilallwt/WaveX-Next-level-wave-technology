<?php
/** Scene: API integration. @package WaveX */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-api">
	<div class="mk-node mk-node--a mk-pop" style="--d:.1s"><?php echo wavex_icon( 'layout' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span>Website</span></div>
	<div class="mk-node mk-node--b mk-pop" style="--d:.3s"><?php echo wavex_icon( 'mobile' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span>App</span></div>
	<div class="mk-node mk-node--hub mk-pop" style="--d:.8s"><?php echo wavex_icon( 'link' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span>API</span></div>
	<div class="mk-node mk-node--c mk-pop" style="--d:1.2s"><?php echo wavex_icon( 'grid' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span>Other platform</span></div>
	<span class="mk-wire mk-wire--a"><i class="mk-packet" style="--d:1.4s"></i></span>
	<span class="mk-wire mk-wire--b"><i class="mk-packet" style="--d:1.9s"></i></span>
	<span class="mk-wire mk-wire--c"><i class="mk-packet" style="--d:2.4s"></i></span>
	<span class="mk-tag mk-tag--g mk-json mk-pop" style="--d:2.6s">{ "status": "ok" }</span>
</div>
