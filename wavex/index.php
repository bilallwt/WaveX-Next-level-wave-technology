<?php
/**
 * Main fallback template; also renders the blog index (Posts page).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'title' => is_home() && ! is_front_page() ? get_the_title( (int) get_option( 'page_for_posts' ) ) : __( 'Blog', 'wavex' ),
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
		<p><?php esc_html_e( 'Nothing to show yet.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
