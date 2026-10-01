<?php
/**
 * One "how it works" console panel: command bar, title, animated scene next to
 * typed code, and a three-step pipeline. Used by the home Studio and service pages.
 *
 * Args: slug (service), gkey (web|mobile|seo), single (bool), first (bool).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug     = isset( $args['slug'] ) ? $args['slug'] : '';
$gkey     = isset( $args['gkey'] ) ? $args['gkey'] : 'web';
$single   = ! empty( $args['single'] );
$services = wavex_services();
$scenes   = wavex_studio_scenes();
$groups   = wavex_studio_groups();
if ( ! isset( $scenes[ $slug ] ) ) {
	return;
}
$scene = $scenes[ $slug ];
$svc   = $services[ $slug ];
?>
<div class="studio__panel gtheme gtheme--<?php echo esc_attr( $gkey ); ?>"<?php echo $single ? '' : ' id="panel-' . esc_attr( $slug ) . '" role="tabpanel" aria-labelledby="tab-' . esc_attr( $slug ) . '"'; ?><?php echo ( $single || ! empty( $args['first'] ) ) ? '' : ' hidden'; ?> data-code="<?php echo esc_attr( wp_json_encode( $scene['code'] ) ); ?>">
	<div class="sp__bar">
		<span class="sp__prompt"><i class="sp__dot"></i><i class="sp__dot"></i><i class="sp__dot"></i><code>$ wavex run <b><?php echo esc_html( $slug ); ?></b></code></span>
		<span class="sp__badge"><span class="sp__badge-icon"><?php echo wavex_icon( $svc['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><?php echo esc_html( $groups[ $gkey ]['label'] ); ?></span>
	</div>

	<div class="sp__head">
		<div>
			<h3 class="sp__title"><?php echo esc_html( $scene['title'] ); ?></h3>
			<p class="sp__text"><?php echo esc_html( $scene['text'] ); ?></p>
		</div>
		<?php if ( ! $single ) : ?>
			<a class="btn btn--primary btn--sm" href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>">
				<?php
				/* translators: %s: service name. */
				echo esc_html( sprintf( __( 'About %s', 'wavex' ), $svc['title'] ) );
				?>
				<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		<?php endif; ?>
	</div>

	<div class="sp__grid">
		<div class="stage"<?php echo ( 'wordpress' === $scene['scene'] ) ? '' : ' aria-hidden="true"'; ?>>
			<?php get_template_part( 'template-parts/studio/scene', $scene['scene'] ); ?>
		</div>
		<figure class="code code--live" aria-label="<?php esc_attr_e( 'Example code, illustrative', 'wavex' ); ?>">
			<figcaption class="code__bar"><span class="code__dot"></span><span class="code__dot"></span><span class="code__dot"></span><span class="code__file"><?php esc_html_e( 'example code', 'wavex' ); ?></span></figcaption>
			<pre class="code__body"><code class="studio__code" aria-hidden="true"></code><noscript><?php echo esc_html( implode( "\n", $scene['code'] ) ); ?></noscript></pre>
		</figure>
	</div>

	<ol class="sp__pipe">
		<?php foreach ( $scene['steps'] as $k => $step ) : ?>
			<li style="--k:<?php echo (int) $k; ?>"><span class="sp__pipe-n"><?php echo (int) ( $k + 1 ); ?></span><?php echo esc_html( $step ); ?></li>
		<?php endforeach; ?>
	</ol>
</div>
