<?php
/**
 * Single blog post.
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
		'eyebrow' => get_the_date(),
		'title'   => get_the_title(),
	) );
	?>
	<article <?php post_class( 'wrap wrap--narrow' ); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-media"><?php the_post_thumbnail( 'large' ); ?></figure>
		<?php endif; ?>
		<div class="entry-content"><?php the_content(); ?></div>
		<p class="entry-meta">
			<?php the_category( ', ' ); ?>
			<?php the_tags( ' &middot; ', ', ' ); ?>
		</p>
		<?php the_post_navigation(); ?>
		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</article>
	<?php
endwhile;

get_footer();
