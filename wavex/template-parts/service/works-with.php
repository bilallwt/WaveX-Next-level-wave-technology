<?php
/**
 * "Works well with" links to related services (internal linking). Args: slug.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$slug     = isset( $args['slug'] ) ? $args['slug'] : '';
$map      = wavex_related_services();
$services = wavex_services();
if ( empty( $map[ $slug ] ) ) {
	return;
}
?>
<nav class="works-with" aria-label="<?php esc_attr_e( 'Related services', 'wavex' ); ?>">
	<span class="works-with__label"><?php esc_html_e( 'Often combined with', 'wavex' ); ?></span>
	<ul>
		<?php foreach ( $map[ $slug ] as $other ) : ?>
			<?php
			if ( ! isset( $services[ $other ] ) ) {
				continue;
			}
			?>
			<li><a href="<?php echo esc_url( wavex_url( 'services/' . $other ) ); ?>"><?php echo wavex_icon( $services[ $other ]['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $services[ $other ]['title'] ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
