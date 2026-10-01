<?php
/**
 * Blog index (Posts page) and fallback template.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'title' => ( is_home() && ! is_front_page() ) ? get_the_title( (int) get_option( 'page_for_posts' ) ) : __( 'Blog', 'wavex' ),
	'text'  => __( 'Articles about websites, apps, software, SEO and digital marketing.', 'wavex' ),
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
		<div class="empty">
			<h2><?php esc_html_e( 'Articles are coming soon', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'In the meantime, explore our services or message us with a question.', 'wavex' ); ?></p>
			<div class="hero__actions hero__actions--left">
				<?php wavex_button( __( 'Our Services', 'wavex' ), wavex_url( 'services' ), 'primary' ); ?>
				<?php wavex_button( __( 'Contact', 'wavex' ), wavex_url( 'contact' ), 'ghost' ); ?>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
