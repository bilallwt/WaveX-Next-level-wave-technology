<?php
/**
 * Home: short FAQ (no pricing or timelines).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faqs = array(
	array( __( 'What does WaveX Technology do?', 'wavex' ), __( 'We provide web development, WordPress, e-commerce, mobile app, custom software, SEO and digital marketing services.', 'wavex' ) ),
	array( __( 'Can you improve a website or app I already have?', 'wavex' ), __( 'Yes. We offer website redesign and app modernization for existing products.', 'wavex' ) ),
	array( __( 'Do you provide support after launch?', 'wavex' ), __( 'Yes. Website maintenance and app maintenance are part of our services.', 'wavex' ) ),
	array( __( 'How do I start a project?', 'wavex' ), __( 'Book a free consultation and tell us about your requirements. We will take it from there.', 'wavex' ) ),
);
?>
<section class="section section--mix" aria-labelledby="faq-title">
	<div class="faq">
		<div class="faq__intro">
			<p class="eyebrow"><?php esc_html_e( 'FAQ', 'wavex' ); ?></p>
			<h2 class="section__title" id="faq-title"><?php esc_html_e( 'Common questions', 'wavex' ); ?></h2>
			<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'faq' ) ); ?>">
				<?php esc_html_e( 'All questions', 'wavex' ); ?>
				<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</a>
		</div>
		<div class="faq__list">
			<?php foreach ( $faqs as $i => $faq ) : ?>
				<details class="faq__item"<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><?php echo esc_html( $faq[0] ); ?><?php echo wavex_icon( 'chevron' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></summary>
					<p><?php echo esc_html( $faq[1] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
