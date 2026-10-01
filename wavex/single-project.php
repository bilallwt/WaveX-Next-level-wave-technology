<?php
/**
 * Single project at /our-work/{slug}/.
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
		'eyebrow' => __( 'Our Work', 'wavex' ),
		'title'   => get_the_title(),
		'text'    => has_excerpt() ? get_the_excerpt() : '',
	) );
	?>
	<div class="wrap wrap--narrow">
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-media"><?php the_post_thumbnail( 'large' ); ?></figure>
		<?php endif; ?>
		<div class="entry-content"><?php the_content(); ?></div>
		<p><a class="link-arrow" href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'All Client Projects', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</div>
	<?php
endwhile;

get_template_part( 'template-parts/sections/cta-bar' );
get_footer();
