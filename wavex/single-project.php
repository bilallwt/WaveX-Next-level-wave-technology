<?php
/**
 * Single project at /our-work/{slug}/.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$types = get_the_terms( get_the_ID(), 'project_type' );
	$type  = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : '';

	get_template_part( 'template-parts/components/page-hero', null, array(
		'eyebrow' => $type ? $type : __( 'Our Work', 'wavex' ),
		'title'   => get_the_title(),
		'text'    => has_excerpt() ? get_the_excerpt() : '',
	) );
	?>
	<div class="wrap">
		<div class="project">
			<div class="project__main">
				<figure class="project__cover">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large' ); ?>
					<?php else : ?>
						<span class="work-card__mono work-card__mono--xl" aria-hidden="true"><?php echo esc_html( mb_strtoupper( mb_substr( get_the_title(), 0, 2 ) ) ); ?></span>
					<?php endif; ?>
				</figure>
				<div class="entry-content">
					<?php
					if ( get_the_content() ) {
						the_content();
					} else {
						echo '<p>' . esc_html__( 'More about this project will be added here soon.', 'wavex' ) . '</p>';
					}
					?>
				</div>
			</div>
			<aside class="svc-card">
				<h3><?php esc_html_e( 'Planning something similar?', 'wavex' ); ?></h3>
				<p><?php esc_html_e( 'Tell us about your idea and we will talk it through.', 'wavex' ); ?></p>
				<?php get_template_part( 'template-parts/components/contact-actions', null, array( 'topic' => __( 'a project like', 'wavex' ) . ' ' . get_the_title() ) ); ?>
				<p class="svc-card__note"><a href="<?php echo esc_url( get_post_type_archive_link( 'project' ) ); ?>"><?php esc_html_e( 'All client projects', 'wavex' ); ?></a></p>
			</aside>
		</div>
		<?php the_post_navigation( array( 'prev_text' => '&larr; %title', 'next_text' => '%title &rarr;' ) ); ?>
	</div>
	<?php
endwhile;

get_template_part( 'template-parts/sections/contact-split' );
get_footer();
