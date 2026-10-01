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
	<div class="hero__shapes" aria-hidden="true">
		<svg viewBox="0 0 1200 640" preserveAspectRatio="xMaxYMid slice" fill="none" focusable="false">
			<g class="sh-ring"><circle cx="1040" cy="150" r="190"/><circle cx="1040" cy="150" r="130"/><circle cx="1040" cy="150" r="70"/></g>
			<g class="sh-plus"><path d="M760 70v24M748 82h24"/><path d="M1140 430v24M1128 442h24"/></g>
			<g class="sh-hex"><path d="M930 540l22-13 22 13v26l-22 13-22-13z"/></g>
			<path class="sh-line sh-line--b" d="M1200 380H1010q-26 0-26 26v50"/><circle class="sh-dot sh-dot--b" cx="984" cy="464" r="7"/>
			<g class="sh-dots"><circle cx="690" cy="40" r="3"/><circle cx="714" cy="40" r="3"/><circle cx="738" cy="40" r="3"/><circle cx="690" cy="64" r="3"/><circle cx="714" cy="64" r="3"/></g>
		</svg>
	</div>
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
		<?php wavex_visual( 'hero_image', 'visuals', 'hero', 'hero__vis', array( 'fetchpriority' => 'high' ) ); ?>
	</div>
</section>
