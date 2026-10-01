<?php
/**
 * Home hero.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="hero" aria-labelledby="hero-title">
	<div class="hero__copy">
		<p class="eyebrow eyebrow--pill"><?php esc_html_e( 'Technology & digital services', 'wavex' ); ?></p>
		<h1 class="hero__title" id="hero-title"><?php echo esc_html( wavex_opt( 'hero_title' ) ); ?></h1>
		<p class="hero__text"><?php echo esc_html( wavex_opt( 'hero_text' ) ); ?></p>
		<div class="hero__actions">
			<?php wavex_button( wavex_opt( 'hero_cta_label' ), wavex_url( 'free-consultation' ), 'primary' ); ?>
			<?php wavex_button( __( 'Our Services', 'wavex' ), wavex_url( 'services' ), 'ghost' ); ?>
		</div>
		<ul class="chips" aria-label="<?php esc_attr_e( 'Service areas', 'wavex' ); ?>">
			<li><a href="<?php echo esc_url( wavex_url( 'services#web-wordpress' ) ); ?>"><?php esc_html_e( 'Web & WordPress', 'wavex' ); ?></a></li>
			<li><a href="<?php echo esc_url( wavex_url( 'services#mobile-apps' ) ); ?>"><?php esc_html_e( 'Mobile Apps', 'wavex' ); ?></a></li>
			<li><a href="<?php echo esc_url( wavex_url( 'services#seo-marketing' ) ); ?>"><?php esc_html_e( 'SEO & Marketing', 'wavex' ); ?></a></li>
		</ul>
	</div>

	<div class="hero__visual">
		<span class="hero__blob" aria-hidden="true"></span>
		<span class="hero__panel" aria-hidden="true"></span>
		<?php wavex_theme_image( 'hero_image', 'hero-art.svg', __( 'Illustration of a website and a mobile app', 'wavex' ), 'hero__image', array( 'fetchpriority' => 'high' ) ); ?>
		<span class="float float--a"><?php echo wavex_icon( 'code' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Web', 'wavex' ); ?></span>
		<span class="float float--b"><?php echo wavex_icon( 'mobile' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Mobile', 'wavex' ); ?></span>
		<span class="float float--c"><?php echo wavex_icon( 'search' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'SEO', 'wavex' ); ?></span>
	</div>
</section>
