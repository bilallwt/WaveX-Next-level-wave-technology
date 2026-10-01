<?php
/**
 * One card beside the ring. Expects $key, $groups and $services from ring.php.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$g = $groups[ $key ];
?>
<article class="rcard rcard--<?php echo esc_attr( $key ); ?>">
	<header class="rcard__head">
		<span class="rcard__icon"><?php echo wavex_icon( $g['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
		<div>
			<h3><?php echo esc_html( $g['label'] ); ?></h3>
			<p><?php echo esc_html( $g['blurb'] ); ?></p>
		</div>
	</header>
	<ul class="rcard__list">
		<?php foreach ( $g['list'] as $slug ) : ?>
			<li><a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>"><?php echo esc_html( $services[ $slug ]['title'] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</article>
