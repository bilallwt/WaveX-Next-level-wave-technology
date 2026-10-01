<?php
/**
 * Why WaveX (slug: why-wavex).
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
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'What you can expect when you work with WaveX Technology.', 'wavex' ),
	) );
	if ( get_the_content() ) :
		?>
		<div class="wrap wrap--narrow"><div class="entry-content"><?php the_content(); ?></div></div>
		<?php
	endif;
endwhile;
?>
<section class="section section--accent" aria-label="<?php esc_attr_e( 'What to expect', 'wavex' ); ?>">
	<div class="expect">
		<?php foreach ( wavex_expectations() as $point ) : ?>
			<article class="expect__card">
				<span class="why__icon"><?php echo wavex_icon( $point[0] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<h2><?php echo esc_html( $point[1] ); ?></h2>
				<p><?php echo esc_html( $point[2] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="section" aria-labelledby="why-next">
	<div class="split-note">
		<div>
			<h2 class="section__title" id="why-next"><?php esc_html_e( 'See it for yourself', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'Read how we work, look at the projects we have built, or just send us a message about your idea.', 'wavex' ); ?></p>
		</div>
		<div class="hero__actions">
			<?php wavex_button( __( 'Our Approach', 'wavex' ), wavex_url( 'our-approach' ), 'ghost' ); ?>
			<?php wavex_button( __( 'Our Work', 'wavex' ), wavex_url( 'our-work' ), 'ghost' ); ?>
		</div>
	</div>
</section>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
