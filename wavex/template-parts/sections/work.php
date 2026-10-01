<?php
/**
 * Home: projects from the Project post type.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$projects = new WP_Query( array(
	'post_type'           => 'project',
	'posts_per_page'      => 5,
	'orderby'             => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
	'no_found_rows'       => true,
	'ignore_sticky_posts' => true,
) );

if ( ! $projects->have_posts() ) {
	return;
}
?>
<section class="section section--accent" aria-labelledby="work-title">
	<div class="work-band">
		<div class="work-band__intro">
			<h2 class="section__title" id="work-title"><?php esc_html_e( 'Our work', 'wavex' ); ?></h2>
			<p><?php esc_html_e( 'A look at websites, platforms and apps we have built.', 'wavex' ); ?></p>
			<?php wavex_button( __( 'All Client Projects', 'wavex' ), wavex_url( 'our-work' ), 'primary' ); ?>
		</div>

		<ul class="work-band__list">
			<?php
			while ( $projects->have_posts() ) :
				$projects->the_post();
				?>
				<li>
					<a class="project-tile" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'wavex-card', array( 'class' => 'project-tile__img', 'loading' => 'lazy' ) ); ?>
						<?php endif; ?>
						<span class="project-tile__name"><?php the_title(); ?></span>
						<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
				</li>
				<?php
			endwhile;
			wp_reset_postdata();
			?>
		</ul>
	</div>
</section>
