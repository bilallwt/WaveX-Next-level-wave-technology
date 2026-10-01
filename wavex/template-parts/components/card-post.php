<?php
/**
 * Post / page / project card used in archives and search results.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$type_obj = get_post_type_object( get_post_type() );
?>
<article <?php post_class( 'post-card' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
			<?php the_post_thumbnail( 'wavex-card', array( 'loading' => 'lazy' ) ); ?>
		</a>
	<?php endif; ?>
	<div class="post-card__body">
		<?php if ( $type_obj && 'post' !== get_post_type() ) : ?>
			<p class="post-card__type"><?php echo esc_html( $type_obj->labels->singular_name ); ?></p>
		<?php elseif ( 'post' === get_post_type() ) : ?>
			<p class="post-card__type"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
		<?php endif; ?>
		<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28 ) ); ?></p>
	</div>
</article>
