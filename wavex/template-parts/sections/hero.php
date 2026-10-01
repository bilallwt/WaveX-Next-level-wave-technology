<?php
/**
 * Home hero: headline and direct-contact actions on the left, image on the right.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Highlight the last word of the heading.
$title_words = preg_split( '/\s+/', trim( wavex_opt( 'hero_title' ) ) );
if ( count( $title_words ) >= 4 ) {
	$tail  = implode( ' ', array_splice( $title_words, -1 ) );
	$title = esc_html( implode( ' ', $title_words ) ) . ' <span class="grad-text">' . esc_html( $tail ) . '</span>';
} else {
	$title = esc_html( wavex_opt( 'hero_title' ) );
}
?>
<section class="hero" aria-labelledby="hero-title">
	<div class="hero__copy">
		<p class="eyebrow"><?php esc_html_e( 'Technology & digital services', 'wavex' ); ?></p>
		<h1 class="hero__title" id="hero-title"><?php echo wp_kses( $title, array( 'span' => array( 'class' => array() ) ) ); ?></h1>
		<p class="hero__text"><?php echo esc_html( wavex_opt( 'hero_text' ) ); ?></p>
		<div class="hero__actions">
			<?php get_template_part( 'template-parts/components/contact-actions' ); ?>
			<?php wavex_button( wavex_opt( 'hero_cta_label' ), wavex_url( 'free-consultation' ), 'ghost' ); ?>
		</div>
		<p class="hero__note"><?php esc_html_e( 'Send us a message with your idea. No forms to fill in first.', 'wavex' ); ?></p>
	</div>

	<div class="hero__visual">
		<?php wavex_theme_image( 'hero_image', 'hero-photo.jpg', __( 'A laptop and a smartphone showing a website and an analytics dashboard', 'wavex' ), 'hero__image', array( 'fetchpriority' => 'high', 'width' => 1024, 'height' => 434 ) ); ?>
	</div>
</section>
