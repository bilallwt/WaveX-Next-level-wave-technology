<?php
/**
 * Search results: pages, posts and projects.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	/* translators: %s: search query. */
	'title' => sprintf( __( 'Search results for "%s"', 'wavex' ), get_search_query() ),
) );
?>
<div class="wrap">
	<?php get_search_form(); ?>
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
		<p><?php esc_html_e( 'Nothing matched your search. Try different keywords.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
