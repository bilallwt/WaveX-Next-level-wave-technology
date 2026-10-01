<?php
/**
 * Search form.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$uid = wp_unique_id( 'search-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $uid ); ?>"><?php esc_html_e( 'Search for:', 'wavex' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $uid ); ?>" class="search-form__input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search…', 'wavex' ); ?>">
	<button type="submit" class="btn btn--primary"><?php esc_html_e( 'Search', 'wavex' ); ?></button>
</form>
