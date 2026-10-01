<?php
/**
 * Home: Our Work bento grid from the Project post type.
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
<section class="worksec" aria-labelledby="work-title">
	<header class="worksec__head">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Our work', 'wavex' ); ?></p>
			<h2 class="section__title" id="work-title"><?php esc_html_e( 'Websites, platforms and apps we have built', 'wavex' ); ?></h2>
		</div>
		<a class="btn btn--ghost" href="<?php echo esc_url( wavex_url( 'our-work' ) ); ?>"><?php esc_html_e( 'All client projects', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
	</header>
	<div class="pj-grid">
		<?php
		$n = 0;
		while ( $projects->have_posts() ) :
			$projects->the_post();
			get_template_part( 'template-parts/components/project-card', null, array( 'size' => ( $n < 2 ) ? 'lg' : 'md', 'idx' => $n ) );
			++$n;
		endwhile;
		wp_reset_postdata();
		?>
	</div>
</section>
