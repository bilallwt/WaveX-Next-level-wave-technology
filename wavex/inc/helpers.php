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
		'trend'    => '<path d="M3 17l6-6 4 4 8-9M15 6h6v6"/>',
		'grid'     => '<rect x="3.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="3.5" width="7" height="7" rx="1.5"/><rect x="3.5" y="13.5" width="7" height="7" rx="1.5"/><rect x="13.5" y="13.5" width="7" height="7" rx="1.5"/>',
		'help'     => '<circle cx="12" cy="12" r="9"/><path d="M9.5 9.5a2.5 2.5 0 114 2c-.9.6-1.5 1.1-1.5 2.2M12 17.2h.01"/>',
		'chat'     => '<path d="M4 5h16v11H9l-5 4V5z"/><path d="M8 9.5h8M8 12.5h5"/>',
		'users'    => '<circle cx="9" cy="8.5" r="3.2"/><path d="M3 20c.4-3.4 3-5.5 6-5.5s5.6 2.1 6 5.5M16 5.5a3 3 0 010 6M18 14.8c1.8.7 3 2.4 3.2 5"/>',
		'shield'   => '<path d="M12 3l8 3v6c0 4.5-3.2 7.8-8 9-4.8-1.2-8-4.5-8-9V6l8-3z"/><path d="M8.5 12l2.5 2.5 4.5-5"/>',
		'briefcase' => '<rect x="3" y="7" width="18" height="13" rx="2"/><path d="M9 7V5a1 1 0 011-1h4a1 1 0 011 1v2M3 13h18"/>',
		'home'     => '<path d="M4 11l8-7 8 7v9h-5v-6H9v6H4v-9z"/>',
		'whatsapp' => '<path d="M3.5 20.5l1.4-4.6A8.6 8.6 0 1 1 8.2 19L3.5 20.5z"/><path d="M9 8.8c.2 2.4 2.7 5 5.3 5.4l1.3-1.3-2-1-.9.8c-.9-.4-1.7-1.2-2.1-2.1l.8-.9-1-2L9 8.8z"/>',
		'play'     => '<path d="M8 5l11 7-11 7V5z"/>',
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

	$width  = isset( $extra['width'] ) ? (int) $extra['width'] : 800;
	$height = isset( $extra['height'] ) ? (int) $extra['height'] : 600;
	unset( $extra['width'], $extra['height'] );

	$attrs = '';
	foreach ( $extra as $name => $value ) {
		$attrs .= sprintf( ' %s="%s"', esc_attr( $name ), esc_attr( $value ) );
	}

	printf(
		'<img class="%1$s" src="%2$s" width="%5$d" height="%6$d" alt="%3$s"%4$s>',
		esc_attr( $class ),
		esc_url( WAVEX_URI . '/assets/img/' . $file ),
		esc_attr( $alt ),
		$attrs, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped above.
		$width,
		$height
	);
}

/**
 * Direct contact details and ready-made links (WhatsApp / email).
 * WhatsApp is only offered when a number is set in the Customizer;
 * email falls back to the Contact page when no address is set.
 *
 * @param string $topic Optional topic added to the prefilled message.
 * @return array{whatsapp:string,whatsapp_label:string,email:string,email_url:string,phone:string}
 */
function wavex_contact( $topic = '' ) {
	$digits  = preg_replace( '/\D/', '', wavex_opt( 'whatsapp' ) );
	$email   = sanitize_email( wavex_opt( 'contact_email' ) );
	$subject = $topic ? sprintf( /* translators: %s: topic. */ __( 'Enquiry: %s', 'wavex' ), $topic ) : __( 'Project enquiry', 'wavex' );
	$message = $topic ? sprintf( /* translators: %s: topic. */ __( 'Hello WaveX Technology, I would like to talk about %s.', 'wavex' ), $topic ) : __( 'Hello WaveX Technology, I would like to talk about a project.', 'wavex' );

	return array(
		'whatsapp'       => $digits ? 'https://wa.me/' . $digits . '?text=' . rawurlencode( $message ) : '',
		'whatsapp_label' => wavex_opt( 'whatsapp' ),
		'email'          => $email,
		'email_url'      => $email ? 'mailto:' . $email . '?subject=' . rawurlencode( $subject ) : wavex_url( 'contact' ),
		'phone'          => wavex_opt( 'contact_phone' ),
	);
}

/**
 * Estimated reading time in minutes for the current post.
 *
 * @return int
 */
function wavex_reading_time() {
	$words = str_word_count( wp_strip_all_tags( get_the_content() ) );
	return max( 1, (int) ceil( $words / 220 ) );
}

/**
 * Category filter chips for blog templates.
 */
function wavex_blog_filters() {
	$cats = get_categories( array( 'hide_empty' => true ) );
	if ( ! $cats ) {
		return;
	}
	$current = is_category() ? get_queried_object_id() : 0;
	echo '<ul class="filters" aria-label="' . esc_attr__( 'Filter articles', 'wavex' ) . '">';
	printf(
		'<li><a href="%s"%s>%s</a></li>',
		esc_url( wavex_url( 'blog' ) ),
		$current ? '' : ' aria-current="true"', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_html__( 'All articles', 'wavex' )
	);
	foreach ( $cats as $cat ) {
		printf(
			'<li><a href="%s"%s>%s</a></li>',
			esc_url( get_category_link( $cat ) ),
			( $current === $cat->term_id ) ? ' aria-current="true"' : '', // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			esc_html( $cat->name )
		);
	}
	echo '</ul>';
}

/**
 * Output a section visual: the Customizer image if one is set, otherwise a live,
 * code-drawn technology scene from template-parts/{dir}/scene-{name}.php (or visuals/{name}.php).
 *
 * @param string $key   Theme mod key holding an attachment ID.
 * @param string $dir   "studio" or "visuals".
 * @param string $name  Scene name.
 * @param string $class Extra CSS class.
 * @param array  $extra Extra image attributes when a Customizer image is used.
 */
function wavex_visual( $key, $dir, $name, $class = '', $extra = array() ) {
	$id = (int) get_theme_mod( $key, 0 );

	if ( $id && wp_get_attachment_image_url( $id, 'large' ) ) {
		echo wp_get_attachment_image( $id, 'large', false, array_merge( array( 'class' => $class . ' vis-photo' ), $extra ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}

	printf( '<div class="vis %s" data-vis aria-hidden="true">', esc_attr( $class ) );
	if ( 'studio' === $dir ) {
		echo '<div class="stage vis__stage">';
		get_template_part( 'template-parts/studio/scene', $name );
		echo '</div>';
	} else {
		get_template_part( 'template-parts/visuals/' . $name );
	}
	echo '</div>';
}

/**
 * Segmented ring made of rounded arcs with an icon on each arc.
 *
 * @param array[] $items     Each: icon, label, optional url.
 * @param string  $core_html Markup shown in the centre circle (already escaped).
 * @param string  $class     Extra CSS class.
 */
function wavex_ring( $items, $core_html, $class = '' ) {
	$n = count( $items );
	if ( $n < 1 ) {
		return;
	}
	$palette = array(
		array( '#cfe0ff', '#2563e0' ),
		array( '#bdeae5', '#25b0a4' ),
		array( '#ebd2ee', '#a43fb0' ),
		array( '#c3ecd6', '#2bbf78' ),
	);
	$r    = 164;
	$span = 360 / $n;
	$gap  = min( 14, $span * 0.18 );
	$pt   = function ( $deg ) use ( $r ) {
		$rad = deg2rad( $deg );
		return round( 220 + $r * cos( $rad ), 2 ) . ' ' . round( 220 + $r * sin( $rad ), 2 );
	};

	printf( '<div class="rg %s"><svg viewBox="0 0 440 440" class="rg__svg" aria-hidden="true" focusable="false">', esc_attr( $class ) );
	$badges = '';
	foreach ( array_values( $items ) as $i => $item ) {
		$start = -90 + $i * $span;
		$col   = $palette[ $i % 4 ];
		$path = sprintf(
			'<path class="rg__arc" pathLength="100" style="--i:%1$d;--sc:%2$s;--sd:%3$s" d="M %4$s A %5$d %5$d 0 0 1 %6$s"/>',
			(int) $i,
			esc_attr( $col[0] ),
			esc_attr( $col[1] ),
			esc_attr( $pt( $start + $gap ) ),
			(int) $r,
			esc_attr( $pt( $start + $span - $gap ) )
		);
		if ( ! empty( $item['url'] ) ) {
			printf( '<a class="rg__link" href="%s"><title>%s</title>%s</a>', esc_url( $item['url'] ), esc_html( $item['label'] ), $path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			echo $path; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		$mid  = deg2rad( $start + $span / 2 );
		$left = 50 + ( $r / 440 * 100 ) * cos( $mid );
		$top  = 50 + ( $r / 440 * 100 ) * sin( $mid );
		$pos  = sprintf( 'left:%s%%;top:%s%%;color:%s', round( $left, 2 ), round( $top, 2 ), $col[1] );
		$icon = wavex_icon( $item['icon'] );
		if ( ! empty( $item['url'] ) ) {
			$badges .= sprintf( '<a class="rg__badge" style="%s" href="%s" title="%s">%s<span class="screen-reader-text">%s</span></a>', esc_attr( $pos ), esc_url( $item['url'] ), esc_attr( $item['label'] ), $icon, esc_html( $item['label'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			$badges .= sprintf( '<span class="rg__badge" style="%s">%s</span>', esc_attr( $pos ), $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
	echo '<circle class="rg__core-bg" cx="220" cy="220" r="104"/><circle class="rg__orbit" cx="220" cy="220" r="118" fill="none"/></svg>';
	echo '<div class="rg__core">' . $core_html . '</div>' . $badges . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Ring for a service group (web, mobile, seo) with four representative services.
 *
 * @param string $group web|mobile|seo.
 */
function wavex_group_ring( $group, $variant = 'thick' ) {
	$picks = array(
		'web'    => array( 'web-development', 'wordpress-development', 'ecommerce-development', 'api-integration' ),
		'mobile' => array( 'mobile-app-development', 'mobile-app-design', 'mvp-development', 'app-modernization' ),
		'seo'    => array( 'technical-seo', 'on-page-seo', 'content-marketing', 'digital-strategy' ),
	);
	$groups   = wavex_studio_groups();
	$services = wavex_services();
	if ( ! isset( $picks[ $group ] ) ) {
		return;
	}
	$items = array();
	foreach ( $picks[ $group ] as $slug ) {
		$items[] = array( 'icon' => $services[ $slug ]['icon'], 'label' => $services[ $slug ]['title'], 'url' => wavex_url( 'services/' . $slug ) );
	}
	$core = '<strong>' . (int) count( $groups[ $group ]['services'] ) . '</strong><span>' . esc_html__( 'services', 'wavex' ) . '</span><em>' . esc_html( $groups[ $group ]['label'] ) . '</em>';
	wavex_ring_v( $variant, $items, $core, 'rg--' . $group );
}

/**
 * Ring in one of several different designs.
 *
 * @param string  $variant thick|thin|ticks|radial|orbit|dots|gauge.
 * @param array[] $items   Each: icon, label, optional url.
 * @param string  $core_html Centre markup (escaped).
 * @param string  $class   Extra class.
 */
function wavex_ring_v( $variant, $items, $core_html, $class = '' ) {
	if ( 'thick' === $variant || ! $items ) {
		wavex_ring( $items, $core_html, $class );
		return;
	}
	$n   = count( $items );
	$pal = array(
		array( '#cfe0ff', '#2563e0' ),
		array( '#bdeae5', '#25b0a4' ),
		array( '#ebd2ee', '#a43fb0' ),
		array( '#c3ecd6', '#2bbf78' ),
	);
	$pt  = function ( $deg, $r ) {
		$rad = deg2rad( $deg );
		return array( round( 220 + $r * cos( $rad ), 2 ), round( 220 + $r * sin( $rad ), 2 ) );
	};
	$wrap = function ( $item, $inner ) {
		if ( empty( $item['url'] ) ) {
			return $inner;
		}
		return sprintf( '<a class="rg__link" href="%s"><title>%s</title>%s</a>', esc_url( $item['url'] ), esc_html( $item['label'] ), $inner );
	};
	$arc = function ( $r, $a0, $a1, $col, $w, $i, $strong = '#2563e0' ) use ( $pt ) {
		$p0 = $pt( $a0, $r );
		$p1 = $pt( $a1, $r );
		return sprintf(
			'<path class="rg__s" pathLength="100" style="--i:%d;--sc:%s;--sd:%s;stroke:var(--sc);stroke-width:%s" d="M %s %s A %d %d 0 %d 1 %s %s"/>',
			$i,
			$col,
			$strong,
			$w,
			$p0[0],
			$p0[1],
			$r,
			$r,
			( $a1 - $a0 ) > 180 ? 1 : 0,
			$p1[0],
			$p1[1]
		);
	};
	$badge = function ( $item, $deg, $r, $col, $size = 13 ) use ( $pt ) {
		$p    = $pt( $deg, $r );
		$pos  = sprintf( 'left:%s%%;top:%s%%;width:%s%%;margin:-%s%% 0 0 -%s%%;color:%s', round( $p[0] / 4.4, 2 ), round( $p[1] / 4.4, 2 ), $size, $size / 2, $size / 2, $col );
		$icon = wavex_icon( $item['icon'] );
		if ( ! empty( $item['url'] ) ) {
			return sprintf( '<a class="rg__badge" style="%s" href="%s" title="%s">%s<span class="screen-reader-text">%s</span></a>', esc_attr( $pos ), esc_url( $item['url'] ), esc_attr( $item['label'] ), $icon, esc_html( $item['label'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		return sprintf( '<span class="rg__badge" style="%s">%s</span>', esc_attr( $pos ), $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	};

	$svg    = '';
	$badges = '';
	$items  = array_values( $items );

	switch ( $variant ) {
		case 'thin':
			$svg .= '<circle cx="220" cy="220" r="178" fill="none" stroke="#e3ebf9" stroke-width="16"/><circle cx="220" cy="220" r="138" fill="none" stroke="#c9d9f5" stroke-width="2" stroke-dasharray="3 9" class="rg__ring-o"/>';
			foreach ( $items as $i => $item ) {
				$span = 360 / $n;
				$a0   = -90 + $i * $span + 8;
				$svg .= $wrap( $item, $arc( 178, $a0, $a0 + $span - 16, $pal[ $i % 4 ][1], 16, $i, $pal[ $i % 4 ][1] ) );
				$badges .= $badge( $item, $a0 + ( $span - 16 ) / 2, 178, $pal[ $i % 4 ][1], 12 );
			}
			$svg .= '<circle class="rg__core-bg rg__core-bg--light" cx="220" cy="220" r="104"/>';
			break;
		case 'ticks':
			$groups = array_fill( 0, $n, '' );
			for ( $k = 0; $k < 72; $k++ ) {
				$seg  = (int) floor( $k * $n / 72 );
				$long = ( 0 === $k % 6 );
				$a    = $pt( -90 + $k * 5, $long ? 150 : 162 );
				$b    = $pt( -90 + $k * 5, 188 );
				$groups[ $seg ] .= sprintf( '<line class="rg__tick" style="--k:%d;--sc:%s;--sd:%s;stroke:var(--sc)" x1="%s" y1="%s" x2="%s" y2="%s" stroke-width="%d" stroke-linecap="round"/>', $k, $long ? $pal[ $seg % 4 ][1] : $pal[ $seg % 4 ][0], $pal[ $seg % 4 ][1], $a[0], $a[1], $b[0], $b[1], $long ? 5 : 4 );
			}
			foreach ( $items as $i => $item ) {
				$svg .= $wrap( $item, '<g class="rg__tg">' . $groups[ $i ] . '</g>' );
			}
			$svg .= '<circle class="rg__core-bg" cx="220" cy="220" r="118"/>';
			foreach ( $items as $i => $item ) {
				$badges .= $badge( $item, -90 + ( $i + .5 ) * 360 / $n, 188, $pal[ $i % 4 ][1], 12 );
			}
			break;
		case 'radial':
			$radii = array( 186, 152, 118, 84 );
			$frac  = array( .8, .65, .92, .5 );
			foreach ( $items as $i => $item ) {
				if ( $i > 3 ) {
					break;
				}
				$svg .= sprintf( '<circle cx="220" cy="220" r="%d" fill="none" stroke="%s" stroke-width="22" opacity=".55"/>', $radii[ $i ], $pal[ $i ][0] );
				$end  = -90 + $frac[ $i ] * 359.9;
				$svg .= $wrap( $item, $arc( $radii[ $i ], -90, $end, $pal[ $i ][1], 22, $i, $pal[ $i ][1] ) );
				$badges .= $badge( $item, $end, $radii[ $i ], $pal[ $i ][1], 9 );
			}
			$svg .= '<circle class="rg__core-bg" cx="220" cy="220" r="56"/>';
			break;
		case 'orbit':
			foreach ( array( 190, 146, 102 ) as $r ) {
				$svg .= sprintf( '<circle cx="220" cy="220" r="%d" fill="none" stroke="#c9d6ee" stroke-width="2" stroke-dasharray="4 8"/>', $r );
			}
			$radii = array( 190, 146, 102, 190 );
			$dur   = array( 46, 34, 24, 58 );
			foreach ( $items as $i => $item ) {
				$rp   = $radii[ $i % 4 ] / 4.4;
				$st   = sprintf( '--a:%sdeg;--r:%scqw;--dur:%ss;color:%s', -60 + $i * 105, round( $rp, 2 ), $dur[ $i % 4 ], $pal[ $i % 4 ][1] );
				$icon = wavex_icon( $item['icon'] );
				if ( ! empty( $item['url'] ) ) {
					$badges .= sprintf( '<a class="rg__badge rg__planet" style="%s" href="%s" title="%s">%s<span class="screen-reader-text">%s</span></a>', esc_attr( $st ), esc_url( $item['url'] ), esc_attr( $item['label'] ), $icon, esc_html( $item['label'] ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				} else {
					$badges .= sprintf( '<span class="rg__badge rg__planet" style="%s">%s</span>', esc_attr( $st ), $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
			$svg .= '<circle class="rg__core-bg" cx="220" cy="220" r="62"/>';
			break;
		case 'dots':
			for ( $k = 0; $k < 36; $k++ ) {
				$p    = $pt( -90 + $k * 10, 176 );
				$big  = ( 0 === $k % 9 );
				$svg .= sprintf( '<circle class="rg__dot" style="--k:%d" cx="%s" cy="%s" r="%d" fill="%s"/>', $k, $p[0], $p[1], $big ? 9 : 5, $pal[ (int) floor( $k / 9 ) % 4 ][ $big ? 1 : 0 ] );
			}
			$svg .= '<circle cx="220" cy="220" r="136" fill="none" stroke="#dbe6f8" stroke-width="2"/><circle class="rg__core-bg" cx="220" cy="220" r="112"/>';
			foreach ( $items as $i => $item ) {
				$badges .= $badge( $item, -90 + ( $i + .5 ) * 360 / $n, 136, $pal[ $i % 4 ][1], 13 );
			}
			break;
		case 'gauge':
			$total = 220;
			$span  = $total / $n;
			foreach ( $items as $i => $item ) {
				$a0    = 160 + $i * $span + 4;
				$a1    = 160 + ( $i + 1 ) * $span - 4;
				$svg  .= $wrap( $item, $arc( 170, $a0, $a1, $pal[ $i % 4 ][0], 44, $i, $pal[ $i % 4 ][1] ) );
				$badges .= $badge( $item, ( $a0 + $a1 ) / 2, 170, $pal[ $i % 4 ][1], 14 );
			}
			for ( $k = 0; $k <= 22; $k++ ) {
				$a    = $pt( 160 + $k * 10, 128 );
				$b    = $pt( 160 + $k * 10, 118 );
				$svg .= sprintf( '<line x1="%s" y1="%s" x2="%s" y2="%s" stroke="#b9c9e6" stroke-width="2" stroke-linecap="round"/>', $a[0], $a[1], $b[0], $b[1] );
			}
			$svg .= '<circle class="rg__core-bg" cx="220" cy="220" r="86"/><g class="rg__needle"><line x1="220" y1="124" x2="220" y2="92" stroke="#0e4ea8" stroke-width="5" stroke-linecap="round"/><circle cx="220" cy="88" r="7" fill="#0e4ea8"/></g>';
			break;
	}

	printf( '<div class="rg rg--%s %s"><svg viewBox="0 0 440 440" class="rg__svg" aria-hidden="true" focusable="false">%s</svg><div class="rg__core">%s</div>%s</div>', esc_attr( $variant ), esc_attr( $class ), $svg, $core_html, $badges ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
