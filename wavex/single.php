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
	$cats = get_the_category();
	get_template_part( 'template-parts/components/page-hero', null, array(
		'eyebrow' => $cats ? $cats[0]->name : __( 'Blog', 'wavex' ),
		'title'   => get_the_title(),
	) );
	?>
	<article <?php post_class( 'wrap wrap--narrow' ); ?>>
		<p class="entry-byline">
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-hidden="true">&middot;</span>
			<?php
			/* translators: %d: minutes. */
			echo esc_html( sprintf( _n( '%d min read', '%d min read', wavex_reading_time(), 'wavex' ), wavex_reading_time() ) );
			?>
			<span aria-hidden="true">&middot;</span>
			<?php the_author(); ?>
		</p>
		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-media"><?php the_post_thumbnail( 'large' ); ?></figure>
		<?php endif; ?>
		<div class="entry-content prose"><?php the_content(); ?></div>
		<?php wp_link_pages(); ?>
		<p class="entry-meta">
			<?php the_category( ', ' ); ?>
			<?php the_tags( ' &middot; ', ', ' ); ?>
		</p>
		<aside class="svc-card svc-card--inline">
			<h3><?php esc_html_e( 'Have a project in mind?', 'wavex' ); ?></h3>
			<?php get_template_part( 'template-parts/components/contact-actions' ); ?>
		</aside>
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
