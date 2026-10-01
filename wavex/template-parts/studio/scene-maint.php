<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-maint">
	<div class="mk-maint__head"><span>Site care</span><em class="mk-pop" style="--d:4.4s">All tasks done</em></div>
	<ul class="mk-maint__list">
		<li><span>Core updates</span><b style="--d:.3s"></b><i class="mk-pop" style="--d:1.6s"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i></li>
		<li><span>Plugin updates</span><b style="--d:1.2s"></b><i class="mk-pop" style="--d:2.5s"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i></li>
		<li><span>Backups</span><b style="--d:2.1s"></b><i class="mk-pop" style="--d:3.4s"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i></li>
		<li><span>Security checks</span><b style="--d:3s"></b><i class="mk-pop" style="--d:4.3s"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i></li>
	</ul>
</div>
