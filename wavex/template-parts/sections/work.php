<?php
/**
 * Home: projects from the Project post type, in one row.
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
	<header class="section__head">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Our work', 'wavex' ); ?></p>
			<h2 class="section__title" id="work-title"><?php esc_html_e( 'Websites, platforms and apps we have built', 'wavex' ); ?></h2>
		</div>
		<a class="link-arrow" href="<?php echo esc_url( wavex_url( 'our-work' ) ); ?>">
			<?php esc_html_e( 'All client projects', 'wavex' ); ?>
			<?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</header>

	<ul class="work-row">
		<?php
		while ( $projects->have_posts() ) :
			$projects->the_post();
			$types = get_the_terms( get_the_ID(), 'project_type' );
			$type  = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : '';
			?>
			<li>
				<a class="work-chip" href="<?php the_permalink(); ?>">
					<span class="work-chip__cover">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'wavex-card', array( 'loading' => 'lazy' ) ); ?>
						<?php else : ?>
							<span class="work-card__mono" aria-hidden="true"><?php echo esc_html( mb_strtoupper( mb_substr( get_the_title(), 0, 2 ) ) ); ?></span>
						<?php endif; ?>
					</span>
					<span class="work-chip__body">
						<?php if ( $type ) : ?><span class="work-card__type"><?php echo esc_html( $type ); ?></span><?php endif; ?>
						<span class="work-chip__name"><?php the_title(); ?></span>
					</span>
				</a>
			</li>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
	</ul>
</section>
