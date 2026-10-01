<?php
/**
 * Home: scrolling strip of service names (decorative duplicate hidden from assistive tech).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$services = wavex_services();
$names    = array();
foreach ( array( 'web-development', 'wordpress-development', 'ecommerce-development', 'api-integration', 'custom-software-development', 'mobile-app-development', 'mvp-development', 'technical-seo', 'digital-marketing', 'digital-strategy' ) as $slug ) {
	$names[] = $services[ $slug ]['title'];
}
?>
<section class="ticker" aria-label="<?php esc_attr_e( 'Services', 'wavex' ); ?>">
	<div class="ticker__track">
		<ul class="ticker__set">
			<?php foreach ( $names as $name ) : ?>
				<li><?php echo esc_html( $name ); ?></li>
			<?php endforeach; ?>
		</ul>
		<ul class="ticker__set" aria-hidden="true">
			<?php foreach ( $names as $name ) : ?>
				<li><?php echo esc_html( $name ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
