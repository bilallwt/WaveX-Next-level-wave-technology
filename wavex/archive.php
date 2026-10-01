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
		<p><?php esc_html_e( 'No posts found.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
