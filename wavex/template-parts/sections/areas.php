<?php
/**
 * Home: the three service areas, each listing its services once.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$areas    = array(
	'web-wordpress' => array( 'layout', __( 'Websites, WordPress, e-commerce and the software that connects them.', 'wavex' ) ),
	'mobile-apps'   => array( 'mobile', __( 'Mobile apps from first idea through launch and ongoing support.', 'wavex' ) ),
	'seo-marketing' => array( 'megaphone', __( 'Search visibility, content and a clear digital strategy.', 'wavex' ) ),
);
?>
<section class="section section--tint" aria-labelledby="areas-title">
	<header class="section__head section__head--stack">
		<p class="eyebrow"><?php esc_html_e( 'Services', 'wavex' ); ?></p>
		<h2 class="section__title" id="areas-title"><?php esc_html_e( 'One team for your whole digital presence', 'wavex' ); ?></h2>
	</header>

	<div class="areas">
		<?php
		foreach ( wavex_service_groups() as $group_slug => $group_label ) :
			$area = $areas[ $group_slug ];
			?>
			<article class="area">
				<span class="area__icon"><?php echo wavex_icon( $area[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h3 class="area__title"><?php echo esc_html( $group_label ); ?></h3>
				<p class="area__text"><?php echo esc_html( $area[1] ); ?></p>
				<ul class="area__list">
					<?php
					foreach ( $services as $slug => $service ) :
						if ( in_array( $group_slug, $service['groups'], true ) ) :
							?>
							<li><a href="<?php echo esc_url( wavex_url( 'services/' . $slug ) ); ?>"><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $service['title'] ); ?></a></li>
							<?php
						endif;
					endforeach;
					?>
				</ul>
				<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services#' . $group_slug ) ); ?>">
					<?php esc_html_e( 'View all', 'wavex' ); ?>
					<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</article>
		<?php endforeach; ?>
	</div>
</section>
