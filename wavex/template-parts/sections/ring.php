<?php
/**
 * Home: segmented ring diagram showing how the services group together.
 * Every number comes from the services data, nothing is invented.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$groups   = array(
	'web'      => array(
		'label' => __( 'Web & WordPress', 'wavex' ),
		'blurb' => __( 'Websites, WordPress, e-commerce and the care they need.', 'wavex' ),
		'icon'  => 'layout',
		'list'  => array( 'web-development', 'responsive-web-design', 'website-redesign', 'ecommerce-development', 'wordpress-development', 'wordpress-design', 'website-maintenance' ),
	),
	'mobile'   => array(
		'label' => __( 'Mobile Apps', 'wavex' ),
		'blurb' => __( 'Apps from first idea to launch and ongoing support.', 'wavex' ),
		'icon'  => 'mobile',
		'list'  => array( 'mobile-app-development', 'mobile-app-design', 'mvp-development', 'app-modernization', 'app-maintenance' ),
	),
	'software' => array(
		'label' => __( 'Software & Integration', 'wavex' ),
		'blurb' => __( 'Custom software and the APIs that connect your tools.', 'wavex' ),
		'icon'  => 'cube',
		'list'  => array( 'custom-software-development', 'api-integration' ),
	),
	'seo'      => array(
		'label' => __( 'SEO & Marketing', 'wavex' ),
		'blurb' => __( 'Search visibility, content, social media and strategy.', 'wavex' ),
		'icon'  => 'megaphone',
		'list'  => array( 'technical-seo', 'search-engine-optimization', 'on-page-seo', 'digital-marketing', 'content-marketing', 'social-media-marketing', 'digital-strategy' ),
	),
);

// Ring geometry: four rounded arcs around a centre circle.
$cx    = 220;
$cy    = 220;
$r     = 164;
$gap   = 14; // Degrees trimmed from each end so the arcs do not touch.
$spans = array(
	'web'      => array( 180, 270 ),
	'software' => array( 270, 360 ),
	'seo'      => array( 0, 90 ),
	'mobile'   => array( 90, 180 ),
);
$pt    = function ( $deg ) use ( $cx, $cy, $r ) {
	$rad = deg2rad( $deg );
	return round( $cx + $r * cos( $rad ), 2 ) . ' ' . round( $cy + $r * sin( $rad ), 2 );
};
$badge = array(
	'web'      => array( 23.6, 23.6 ),
	'software' => array( 76.4, 23.6 ),
	'seo'      => array( 76.4, 76.4 ),
	'mobile'   => array( 23.6, 76.4 ),
);
$total = count( $services );
?>
<section class="ringsec" aria-labelledby="ring-title">
	<header class="ringsec__head">
		<p class="eyebrow"><?php esc_html_e( 'Services', 'wavex' ); ?></p>
		<h2 class="section__title" id="ring-title">
			<?php
			/* translators: %d: number of services. */
			echo esc_html( sprintf( __( 'One connected team across %d services', 'wavex' ), $total ) );
			?>
		</h2>
		<p><?php esc_html_e( 'Websites, apps, software and search work best when they are planned together. Hover a segment to see what sits inside it.', 'wavex' ); ?></p>
	</header>

	<div class="ring-layout">
		<div class="ring-col ring-col--l">
			<?php foreach ( array( 'web', 'mobile' ) as $key ) : ?>
				<?php include locate_template( 'template-parts/sections/ring-card.php' ); ?>
			<?php endforeach; ?>
		</div>

		<div class="ring" role="img" aria-label="<?php esc_attr_e( 'Diagram of the four service groups around WaveX', 'wavex' ); ?>">
			<svg viewBox="0 0 440 440" class="ring__svg" aria-hidden="true" focusable="false">
				<?php foreach ( $spans as $key => $span ) : ?>
					<a class="rg__link" href="<?php echo esc_url( wavex_url( 'services#' . ( 'web' === $key ? 'web-wordpress' : ( 'mobile' === $key ? 'mobile-apps' : ( 'seo' === $key ? 'seo-marketing' : 'web-wordpress' ) ) ) ) ); ?>"><title><?php echo esc_html( $groups[ $key ]['label'] ); ?></title><path class="seg seg--<?php echo esc_attr( $key ); ?>" d="M <?php echo esc_attr( $pt( $span[0] + $gap ) ); ?> A <?php echo (int) $r; ?> <?php echo (int) $r; ?> 0 0 1 <?php echo esc_attr( $pt( $span[1] - $gap ) ); ?>"/></a>
				<?php endforeach; ?>
				<circle class="ring__core" cx="220" cy="220" r="104"/>
				<circle class="ring__orbit" cx="220" cy="220" r="118" fill="none"/>
			</svg>
			<div class="ring__center">
				<strong><?php echo (int) $total; ?></strong>
				<span><?php esc_html_e( 'services', 'wavex' ); ?></span>
				<em><?php esc_html_e( 'one team', 'wavex' ); ?></em>
			</div>
			<?php foreach ( $badge as $key => $pos ) : ?>
				<a class="ring__badge ring__badge--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( wavex_url( 'services#' . ( 'web' === $key ? 'web-wordpress' : ( 'mobile' === $key ? 'mobile-apps' : ( 'seo' === $key ? 'seo-marketing' : 'web-wordpress' ) ) ) ) ); ?>" title="<?php echo esc_attr( $groups[ $key ]['label'] ); ?>" style="left:<?php echo esc_attr( $pos[0] ); ?>%;top:<?php echo esc_attr( $pos[1] ); ?>%"><?php echo wavex_icon( $groups[ $key ]['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
			<?php endforeach; ?>
		</div>

		<div class="ring-col ring-col--r">
			<?php foreach ( array( 'software', 'seo' ) as $key ) : ?>
				<?php include locate_template( 'template-parts/sections/ring-card.php' ); ?>
			<?php endforeach; ?>
		</div>
	</div>
</section>
