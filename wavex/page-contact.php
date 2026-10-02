<?php
/**
 * Contact (slug: contact).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'title'   => get_the_title(),
		'eyebrow' => __( 'Get in touch', 'wavex' ),
		'text'    => has_excerpt() ? get_the_excerpt() : __( 'Questions, a new project or something to fix? Message us directly or use the form.', 'wavex' ),
	) );
endwhile;
?>
<div class="ct">
	<div class="ct__inner">
		<aside class="ct__side">
			<h2 class="ct__title"><?php esc_html_e( 'Message us directly', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'The quickest way to reach us is WhatsApp or email.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-cards' ); ?>
			<h3 class="ct__sub"><?php esc_html_e( 'We can help with', 'wavex' ); ?></h3>
			<ul class="chips chips--left">
				<?php foreach ( wavex_contact_topics() as $label ) : ?>
					<li><span><?php echo esc_html( $label ); ?></span></li>
				<?php endforeach; ?>
			</ul>
			<p class="ct__note"><a class="link-arrow" href="<?php echo esc_url( wavex_url( 'free-consultation' ) ); ?>"><?php esc_html_e( 'Prefer a free consultation?', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
		</aside>
		<section class="ct__form" aria-labelledby="contact-form-title">
			<header class="ct__form-head"><span><?php echo wavex_icon( 'mail' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span><div><h2 id="contact-form-title"><?php esc_html_e( 'Send a message', 'wavex' ); ?></h2><p><?php esc_html_e( 'Prefer a form? Fill it in and we will get back to you.', 'wavex' ); ?></p></div></header>
			<?php get_template_part( 'template-parts/components/form-contact' ); ?>
		</section>
	</div>
</div>
<?php
get_footer();
