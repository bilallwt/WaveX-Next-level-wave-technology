<?php
/**
 * Accordion list. Args: items (array of [question, answer]), open_first (bool).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$items = isset( $args['items'] ) ? $args['items'] : array();
$open  = ! empty( $args['open_first'] );
$link  = isset( $args['link_slug'] ) ? (string) $args['link_slug'] : null;
?>
<div class="faq__list">
	<?php foreach ( $items as $i => $faq ) : ?>
		<details class="faq__item"<?php echo ( $open && 0 === $i ) ? ' open' : ''; ?>>
			<summary><?php echo esc_html( $faq[0] ); ?><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></summary>
			<p><?php echo ( null !== $link ) ? wavex_autolink( esc_html( $faq[1] ), $link, 2 ) : esc_html( $faq[1] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		</details>
	<?php endforeach; ?>
</div>
