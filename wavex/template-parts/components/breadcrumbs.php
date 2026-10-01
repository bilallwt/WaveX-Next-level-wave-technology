<?php
/**
 * Breadcrumb trail for inner pages.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$crumbs = array( array( __( 'Home', 'wavex' ), home_url( '/' ) ) );

if ( is_singular( 'project' ) ) {
	$crumbs[] = array( __( 'Our Work', 'wavex' ), wavex_url( 'our-work' ) );
	$crumbs[] = array( get_the_title(), '' );
} elseif ( is_post_type_archive( 'project' ) ) {
	$crumbs[] = array( __( 'Our Work', 'wavex' ), '' );
} elseif ( is_tax( 'project_type' ) ) {
	$crumbs[] = array( __( 'Our Work', 'wavex' ), wavex_url( 'our-work' ) );
	$crumbs[] = array( single_term_title( '', false ), '' );
} elseif ( is_page() ) {
	$ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
	foreach ( $ancestors as $ancestor ) {
		$crumbs[] = array( get_the_title( $ancestor ), get_permalink( $ancestor ) );
	}
	$crumbs[] = array( get_the_title(), '' );
} elseif ( is_singular( 'post' ) ) {
	$crumbs[] = array( __( 'Blog', 'wavex' ), wavex_url( 'blog' ) );
	$crumbs[] = array( get_the_title(), '' );
} elseif ( is_home() || is_category() || is_tag() || is_archive() ) {
	$crumbs[] = array( __( 'Blog', 'wavex' ), is_home() ? '' : wavex_url( 'blog' ) );
	if ( ! is_home() ) {
		$crumbs[] = array( wp_strip_all_tags( get_the_archive_title() ), '' );
	}
} elseif ( is_search() ) {
	$crumbs[] = array( __( 'Search', 'wavex' ), '' );
} elseif ( is_404() ) {
	$crumbs[] = array( __( 'Page not found', 'wavex' ), '' );
}

if ( count( $crumbs ) < 2 ) {
	return;
}
?>
<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'wavex' ); ?>">
	<ol>
		<?php foreach ( $crumbs as $i => $crumb ) : ?>
			<li<?php echo ( $i === count( $crumbs ) - 1 ) ? ' aria-current="page"' : ''; ?>>
				<?php if ( $crumb[1] ) : ?>
					<a href="<?php echo esc_url( $crumb[1] ); ?>"><?php echo esc_html( $crumb[0] ); ?></a>
				<?php else : ?>
					<span><?php echo esc_html( $crumb[0] ); ?></span>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	</ol>
</nav>
