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
		<div class="work-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				$types = get_the_terms( get_the_ID(), 'project_type' );
				$type  = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : '';
				?>
				<a class="work-card" href="<?php the_permalink(); ?>">
					<span class="work-card__cover">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'wavex-card', array( 'loading' => 'lazy' ) ); ?>
						<?php else : ?>
							<span class="work-card__mono" aria-hidden="true"><?php echo esc_html( mb_strtoupper( mb_substr( get_the_title(), 0, 2 ) ) ); ?></span>
						<?php endif; ?>
					</span>
					<span class="work-card__body">
						<?php if ( $type ) : ?><span class="work-card__type"><?php echo esc_html( $type ); ?></span><?php endif; ?>
						<span class="work-card__title"><?php the_title(); ?></span>
						<span class="work-card__go"><?php esc_html_e( 'View project', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
					</span>
				</a>
			<?php endwhile; ?>
		</div>
		<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No projects yet.', 'wavex' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_template_part( 'template-parts/sections/contact-split' );
get_footer();
