<?php
/** Scene: technical SEO. @package WaveX */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="mk-seo">
	<div class="mk-seo__bar"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span class="mk-url">Site check</span></div>
	<ul class="mk-checks">
		<li class="mk-pop" style="--d:.3s"><i><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i>Crawlable pages</li>
		<li class="mk-pop" style="--d:1s"><i><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i>XML sitemap</li>
		<li class="mk-pop" style="--d:1.7s"><i><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i>Structured data</li>
		<li class="mk-pop" style="--d:2.4s"><i><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i>Mobile friendly</li>
		<li class="mk-pop" style="--d:3.1s"><i><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></i>Clean page titles</li>
	</ul>
	<div class="mk-progress"><span></span></div>
</div>
