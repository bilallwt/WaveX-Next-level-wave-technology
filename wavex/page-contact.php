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
		'title' => get_the_title(),
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'Questions, a new project or something to fix? Message us directly or use the form.', 'wavex' ),
	) );
endwhile;
?>
<div class="wrap">
	<div class="contact-layout">
		<aside class="contact-layout__side">
			<h2 class="contact-layout__title"><?php esc_html_e( 'Message us directly', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'The quickest way to reach us is WhatsApp or email.', 'wavex' ); ?></p>
			<?php get_template_part( 'template-parts/components/contact-cards' ); ?>
			<h3 class="contact-layout__sub"><?php esc_html_e( 'We can help with', 'wavex' ); ?></h3>
			<ul class="chips chips--left">
				<?php foreach ( wavex_contact_topics() as $label ) : ?>
					<li><span><?php echo esc_html( $label ); ?></span></li>
				<?php endforeach; ?>
			</ul>
			<p class="contact-layout__note"><a class="link-arrow" href="<?php echo esc_url( wavex_url( 'free-consultation' ) ); ?>"><?php esc_html_e( 'Prefer a free consultation?', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
		</aside>
		<section class="contact-layout__form" aria-labelledby="contact-form-title">
			<h2 class="contact-layout__title" id="contact-form-title"><?php esc_html_e( 'Send a message', 'wavex' ); ?></h2>
			<?php get_template_part( 'template-parts/components/form-contact' ); ?>
		</section>
	</div>
</div>
<?php
get_footer();
