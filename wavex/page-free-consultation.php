<?php
/**
 * Free Consultation (slug: free-consultation).
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
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'Talk through your project with us. Tell us what you need and we will discuss the options with you.', 'wavex' ),
	) );
endwhile;

$steps = array(
	array( __( 'Tell us about your project', 'wavex' ), __( 'Send a short description, or message us on WhatsApp or email.', 'wavex' ) ),
	array( __( 'We talk it through', 'wavex' ), __( 'We reply, ask the right questions and discuss what is possible.', 'wavex' ) ),
	array( __( 'You decide the next step', 'wavex' ), __( 'If it feels right, we outline how a project would work. There is no obligation to continue.', 'wavex' ) ),
);
?>
<div class="wrap">
	<div class="contact-layout">
		<aside class="contact-layout__side">
			<h2 class="contact-layout__title"><?php esc_html_e( 'How it works', 'wavex' ); ?></h2>
			<ol class="studio__steps studio__steps--tall">
				<?php foreach ( $steps as $step ) : ?>
					<li><span><strong><?php echo esc_html( $step[0] ); ?></strong><?php echo esc_html( $step[1] ); ?></span></li>
				<?php endforeach; ?>
			</ol>
			<h3 class="contact-layout__sub"><?php esc_html_e( 'Prefer to message us?', 'wavex' ); ?></h3>
			<?php get_template_part( 'template-parts/components/contact-cards' ); ?>
		</aside>
		<section class="contact-layout__form" aria-labelledby="consult-form-title">
			<h2 class="contact-layout__title" id="consult-form-title"><?php esc_html_e( 'Request your free consultation', 'wavex' ); ?></h2>
			<?php get_template_part( 'template-parts/components/form-consult' ); ?>
		</section>
	</div>
</div>
<?php
get_footer();
