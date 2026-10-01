<?php
/**
 * Template Name: Service Page
 * Template Post Type: page
 *
 * Individual service page under /services/.
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
		'eyebrow' => __( 'Services', 'wavex' ),
		'title'   => get_the_title(),
		'text'    => has_excerpt() ? get_the_excerpt() : '',
	) );
	?>
	<div class="wrap wrap--narrow">
		<div class="entry-content"><?php the_content(); ?></div>
		<p><a class="link-arrow" href="<?php echo esc_url( wavex_url( 'services' ) ); ?>"><?php esc_html_e( 'All services', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a></p>
	</div>
	<?php
endwhile;

get_template_part( 'template-parts/sections/cta-bar' );
get_footer();
