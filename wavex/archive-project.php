<?php
/**
 * Our Work: projects archive at /our-work/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'title' => __( 'Our Work', 'wavex' ),
) );
?>
<div class="wrap">
	<?php if ( have_posts() ) : ?>
		<div class="post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/components/card-post' );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No projects yet.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_template_part( 'template-parts/sections/cta-bar' );
get_footer();
