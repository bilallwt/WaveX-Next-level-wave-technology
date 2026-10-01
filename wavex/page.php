<?php
/**
 * Default page.
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
		'text'  => has_excerpt() ? get_the_excerpt() : '',
	) );
	?>
	<div class="wrap wrap--narrow">
		<div class="entry-content"><?php the_content(); ?></div>
	</div>
	<?php
endwhile;

get_template_part( 'template-parts/sections/cta-bar' );
get_footer();
