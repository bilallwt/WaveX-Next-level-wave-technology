<?php
/**
 * Small reusable helpers.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build a clean internal URL from a path such as "services/web-development".
 *
 * @param string $path Path relative to the site root. May include a #fragment.
 * @return string
 */
function wavex_url( $path = '' ) {
	$fragment = '';
	if ( false !== strpos( $path, '#' ) ) {
		list( $path, $fragment ) = explode( '#', $path, 2 );
		$fragment                = '#' . $fragment;
	}
	$path = trim( $path, '/' );
	if ( '' === $path ) {
		return home_url( '/' ) . $fragment;
	}
	return home_url( user_trailingslashit( $path ) ) . $fragment;
}

/**
 * Inline SVG icon (24x24, stroke based).
 *
 * @param string $name  Icon key.
 * @param string $class Extra CSS class.
 * @return string Safe SVG markup.
 */
function wavex_icon( $name, $class = '' ) {
	$icons = array(
		'code'     => '<path d="M8 8l-4 4 4 4M16 8l4 4-4 4M13.5 5l-3 14"/>',
		'layers'   => '<path d="M12 3l9 5-9 5-9-5 9-5zM3 13l9 5 9-5M3 17.5l9 5 9-5"/>',
		'layout'   => '<rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18M9 9v11"/>',
		'refresh'  => '<path d="M20 11a8 8 0 00-14.5-4M4 4v4h4M4 13a8 8 0 0014.5 4M20 20v-4h-4"/>',
		'cart'     => '<path d="M3 4h2l2.4 11h10.2L20 7H6.2"/><circle cx="9" cy="19" r="1.5"/><circle cx="17" cy="19" r="1.5"/>',
		'wordpress' => '<circle cx="12" cy="12" r="9"/><path d="M5 9l4.5 11M9 9h9M12 20l3.5-9M15.5 11L18 18"/>',
		'pen'      => '<path d="M4 20l1-4L16.5 4.5a2 2 0 013 3L8 19l-4 1zM14 7l3 3"/>',
		'wrench'   => '<path d="M14.5 6.5a4 4 0 005 5L20 13l-7 7a2.1 2.1 0 01-3-3l7-7-1-1a4 4 0 00-1.5-2.5z"/>',
		'link'     => '<path d="M10 14a4 4 0 005.7 0l3-3a4 4 0 00-5.7-5.7l-1 1M14 10a4 4 0 00-5.7 0l-3 3A4 4 0 0011 18.7l1-1"/>',
		'cube'     => '<path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3zM12 12l8-4.5M12 12v9M12 12L4 7.5"/>',
		'mobile'   => '<rect x="7" y="2.5" width="10" height="19" rx="2.5"/><path d="M11 18.5h2"/>',
		'rocket'   => '<path d="M5 15c-1.5 1-2 3.5-2 5 1.5 0 4-.5 5-2M14 4c3-1 6-1 7-1 0 1 0 4-1 7l-6 6-6-6 6-6zM9 11L5.5 10 3 12.5l4 1M13 15l1 3.5L16.5 21l1.5-4"/>',
		'search'   => '<circle cx="11" cy="11" r="6.5"/><path d="M16 16l5 5"/>',
		'check'    => '<path d="M4 12.5l5 5L20 6.5"/>',
		'megaphone' => '<path d="M4 10v4h3l8 4V6L7 10H4zM18 9a4 4 0 010 6M7 14l1 5h3"/>',
		'share'    => '<circle cx="6" cy="12" r="2.5"/><circle cx="18" cy="6" r="2.5"/><circle cx="18" cy="18" r="2.5"/><path d="M8.2 10.8l7.6-3.6M8.2 13.2l7.6 3.6"/>',
		'compass'  => '<circle cx="12" cy="12" r="9"/><path d="M15.5 8.5l-2 5-5 2 2-5 5-2z"/>',
		'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'chevron'  => '<path d="M6 9l6 6 6-6"/>',
		'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'    => '<path d="M6 6l12 12M18 6L6 18"/>',
		'grid'     => '<rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>',
		'help'     => '<circle cx="12" cy="12" r="9"/><path d="M9.5 9.5a2.5 2.5 0 114 2c-.9.6-1.5 1.1-1.5 2.2M12 17.2h.01"/>',
		'chat'     => '<path d="M4 5h16v11H9l-5 4V5z"/><path d="M8 9.5h8M8 12.5h5"/>',
		'users'    => '<circle cx="9" cy="8.5" r="3.2"/><path d="M3 20c.4-3.4 3-5.5 6-5.5s5.6 2.1 6 5.5M16 5.5a3 3 0 010 6M18 14.8c1.8.7 3 2.4 3.2 5"/>',
		'shield'   => '<path d="M12 3l8 3v6c0 4.5-3.2 7.8-8 9-4.8-1.2-8-4.5-8-9V6l8-3z"/><path d="M8.5 12l2.5 2.5 4.5-5"/>',
		'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2M3 13h18"/>',
		'home'     => '<path d="M4 11l8-7 8 7v9h-5v-6H9v6H4v-9z"/>',
		'mail'     => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
	);

	if ( ! isset( $icons[ $name ] ) ) {
		$name = 'code';
	}

	return sprintf(
		'<svg class="icon %1$s" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg>',
		esc_attr( $class ),
		$icons[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static markup defined above.
	);
}

/**
 * Print a button / link component.
 *
 * @param string $label   Visible label.
 * @param string $url     Destination.
 * @param string $variant primary|ghost|light.
 */
function wavex_button( $label, $url, $variant = 'primary' ) {
	printf(
		'<a class="btn btn--%1$s" href="%2$s">%3$s</a>',
		esc_attr( $variant ),
		esc_url( $url ),
		esc_html( $label )
	);
}

/**
 * Output a section image: the Customizer image if set, otherwise the bundled illustration.
 *
 * @param string $key    Theme mod key holding an attachment ID.
 * @param string $file   Bundled file name in assets/img.
 * @param string $alt    Alt text for the bundled illustration.
 * @param string $class  CSS class.
 * @param array  $extra  Extra attributes (e.g. fetchpriority, loading).
 */
function wavex_theme_image( $key, $file, $alt = '', $class = '', $extra = array() ) {
	$id = (int) get_theme_mod( $key, 0 );

	if ( $id && wp_get_attachment_image_url( $id, 'large' ) ) {
		echo wp_get_attachment_image( $id, 'large', false, array_merge( array( 'class' => $class ), $extra ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}

	$attrs = '';
	foreach ( $extra as $name => $value ) {
		$attrs .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
	}

	printf(
		'<img class="%1$s" src="%2$s" width="800" height="600" alt="%3$s"%4$s>',
		esc_attr( $class ),
		esc_url( WAVEX_URI . '/assets/img/' . $file ),
		esc_attr( $alt ),
		$attrs // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
	);
}
