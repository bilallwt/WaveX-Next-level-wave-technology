<?php
/**
 * Our Approach (slug: our-approach).
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
		'text'  => has_excerpt() ? get_the_excerpt() : __( 'How we understand requirements, plan projects, develop solutions, launch products and support them afterwards.', 'wavex' ),
	) );
	if ( get_the_content() ) :
		?>
		<div class="wrap wrap--narrow"><div class="entry-content"><?php the_content(); ?></div></div>
		<?php
	endif;
endwhile;
?>
<section class="section" aria-label="<?php esc_attr_e( 'Our process', 'wavex' ); ?>">
	<ol class="timeline">
		<?php foreach ( wavex_approach_steps() as $i => $step ) : ?>
			<li class="timeline__item">
				<span class="timeline__marker"><?php echo wavex_icon( $step['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<div class="timeline__card">
					<p class="eyebrow">
						<?php
						/* translators: %d: step number. */
						echo esc_html( sprintf( __( 'Step %d', 'wavex' ), $i + 1 ) );
						?>
					</p>
					<h2 class="timeline__title"><?php echo esc_html( $step['title'] ); ?></h2>
					<p><?php echo esc_html( $step['text'] ); ?></p>
					<ul class="ticks ticks--one">
						<?php foreach ( $step['items'] as $item ) : ?>
							<li><span><?php echo wavex_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php echo esc_html( $item ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<p class="timeline__need"><?php echo esc_html( $step['need'] ); ?></p>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
</section>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
