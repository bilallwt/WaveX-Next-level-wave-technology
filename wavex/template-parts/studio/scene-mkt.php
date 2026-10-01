<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-mkt">
	<ul class="mk-mkt__ch">
		<li class="mk-pop" style="--d:.2s"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Search</li>
		<li class="mk-pop" style="--d:.5s"><?php echo wavex_icon( 'share' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Social</li>
		<li class="mk-pop" style="--d:.8s"><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Email</li>
		<li class="mk-pop" style="--d:1.1s"><?php echo wavex_icon( 'pen' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>Content</li>
	</ul>
	<div class="mk-mkt__funnel mk-pop" style="--d:1.4s"><span>Audience</span><span>Interest</span><span>Enquiry</span></div>
	<div class="mk-mkt__chart"><i style="--h:30%;--d:2s"></i><i style="--h:45%;--d:2.15s"></i><i style="--h:40%;--d:2.3s"></i><i style="--h:62%;--d:2.45s"></i><i style="--h:78%;--d:2.6s"></i><i style="--h:90%;--d:2.75s"></i></div>
</div>
