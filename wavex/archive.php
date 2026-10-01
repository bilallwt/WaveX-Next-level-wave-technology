<?php
/**
 * Category, tag, author and date archives.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'title' => get_the_archive_title(),
	'text'  => wp_strip_all_tags( get_the_archive_description() ),
) );
?>
<div class="wrap">
	<div class="blog-tools">
		<?php wavex_blog_filters(); ?>
		<?php get_search_form(); ?>
	</div>
	<?php if ( have_posts() ) : ?>
		<div class="post-grid post-grid--blog">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/components/card-post' );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '&larr;', 'next_text' => '&rarr;' ) ); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No articles found.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
