<?php
/**
 * Project card with a ring-shape cover (or the featured image when set).
 * Args: size (lg|md).
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$size  = isset( $args['size'] ) ? $args['size'] : 'md';
$types = get_the_terms( get_the_ID(), 'project_type' );
$type  = ( $types && ! is_wp_error( $types ) ) ? $types[0]->name : '';
$is_app = ( false !== stripos( $type, 'mobile' ) || false !== stripos( $type, 'app' ) );
$icons  = $is_app ? array( 'mobile', 'chat', 'rocket' ) : array( 'layout', 'link', 'code' );
$items  = array();
foreach ( $icons as $ic ) {
	$items[] = array( 'icon' => $ic, 'label' => '' );
}
$mono = mb_strtoupper( mb_substr( get_the_title(), 0, 2 ) );
?>
<a class="pj pj--<?php echo esc_attr( $size ); ?> pj--<?php echo $is_app ? 'app' : 'web'; ?>" href="<?php the_permalink(); ?>">
	<span class="pj__cover">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'wavex-card', array( 'loading' => 'lazy' ) ); ?>
		<?php else : ?>
			<?php wavex_ring( $items, '<span class="pj__mono">' . esc_html( $mono ) . '</span>', 'rg--pj' ); ?>
		<?php endif; ?>
	</span>
	<span class="pj__body">
		<?php if ( $type ) : ?><span class="pj__type"><?php echo esc_html( $type ); ?></span><?php endif; ?>
		<span class="pj__title"><?php the_title(); ?></span>
		<span class="pj__go"><?php esc_html_e( 'View project', 'wavex' ); ?> <?php echo wavex_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
	</span>
</a>
