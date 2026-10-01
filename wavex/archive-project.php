<?php
/**
 * Our Work: projects archive at /our-work/ (also used for project types).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/components/page-hero', null, array(
	'title' => is_tax() ? single_term_title( '', false ) : __( 'Our Work', 'wavex' ),
	'text'  => __( 'Websites, platforms and apps we have built. Select a project to learn more.', 'wavex' ),
) );

$terms   = get_terms( array( 'taxonomy' => 'project_type', 'hide_empty' => true ) );
$current = is_tax() ? get_queried_object_id() : 0;
?>
<div class="wrap">
	<?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
		<ul class="filters" aria-label="<?php esc_attr_e( 'Filter projects', 'wavex' ); ?>">
			<li><a href="<?php echo esc_url( wavex_url( 'our-work' ) ); ?>"<?php echo $current ? '' : ' aria-current="true"'; ?>><?php esc_html_e( 'All projects', 'wavex' ); ?></a></li>
			<?php foreach ( $terms as $term ) : ?>
				<li><a href="<?php echo esc_url( get_term_link( $term ) ); ?>"<?php echo ( $current === $term->term_id ) ? ' aria-current="true"' : ''; ?>><?php echo esc_html( $term->name ); ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if ( have_posts() ) : ?>
		<div class="pj-grid pj-grid--archive">
			<?php
			$n = 0;
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/components/project-card', null, array( 'size' => 'md', 'idx' => $n++ ) );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No projects yet.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
