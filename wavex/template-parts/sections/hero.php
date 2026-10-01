<?php
/**
 * Home hero.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$image_id = (int) get_theme_mod( 'hero_image', 0 );
?>
<section class="hero" aria-labelledby="hero-title">
	<div class="hero__copy">
		<h1 class="hero__title" id="hero-title"><?php echo esc_html( wavex_opt( 'hero_title' ) ); ?></h1>
		<p class="hero__text"><?php echo esc_html( wavex_opt( 'hero_text' ) ); ?></p>
		<div class="hero__actions">
			<?php wavex_button( wavex_opt( 'hero_cta_label' ), wavex_url( 'free-consultation' ), 'primary' ); ?>
			<?php wavex_button( __( 'Our Services', 'wavex' ), wavex_url( 'services' ), 'ghost' ); ?>
		</div>
	</div>

	<div class="hero__visual">
		<span class="hero__blob" aria-hidden="true"></span>
		<span class="hero__panel" aria-hidden="true"></span>
		<?php
		if ( $image_id && wp_get_attachment_image_url( $image_id, 'large' ) ) {
			echo wp_get_attachment_image( $image_id, 'large', false, array(
				'class'         => 'hero__image',
				'fetchpriority' => 'high',
			) );
		} else {
			printf(
				'<img class="hero__image hero__image--art" src="%s" width="640" height="640" alt="" fetchpriority="high">',
				esc_url( WAVEX_URI . '/assets/img/hero-art.svg' )
			);
		}
		?>
	</div>
</section>
