<?php
/**
 * Internal linking: related services map and contextual auto-links.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Related services for each service (cross-area on purpose, for internal links).
 *
 * @return array<string,string[]>
 */
function wavex_related_services() {
	return array(
		'web-development'             => array( 'responsive-web-design', 'wordpress-development', 'ecommerce-development', 'api-integration' ),
		'responsive-web-design'       => array( 'web-development', 'wordpress-design', 'website-redesign', 'technical-seo' ),
		'website-redesign'            => array( 'responsive-web-design', 'wordpress-development', 'technical-seo', 'website-maintenance' ),
		'ecommerce-development'       => array( 'api-integration', 'wordpress-development', 'technical-seo', 'website-maintenance' ),
		'wordpress-development'       => array( 'wordpress-design', 'ecommerce-development', 'api-integration', 'website-maintenance' ),
		'wordpress-design'            => array( 'wordpress-development', 'responsive-web-design', 'website-redesign', 'on-page-seo' ),
		'website-maintenance'         => array( 'wordpress-development', 'technical-seo', 'website-redesign', 'app-maintenance' ),
		'api-integration'             => array( 'custom-software-development', 'ecommerce-development', 'web-development', 'mobile-app-development' ),
		'custom-software-development' => array( 'api-integration', 'web-development', 'mobile-app-development', 'app-modernization' ),
		'technical-seo'               => array( 'search-engine-optimization', 'on-page-seo', 'website-redesign', 'website-maintenance' ),
		'mobile-app-development'      => array( 'mobile-app-design', 'mvp-development', 'api-integration', 'app-maintenance' ),
		'mobile-app-design'           => array( 'mobile-app-development', 'mvp-development', 'responsive-web-design', 'app-modernization' ),
		'mvp-development'             => array( 'mobile-app-design', 'mobile-app-development', 'custom-software-development', 'digital-strategy' ),
		'app-modernization'           => array( 'mobile-app-development', 'app-maintenance', 'custom-software-development', 'api-integration' ),
		'app-maintenance'             => array( 'mobile-app-development', 'app-modernization', 'website-maintenance', 'custom-software-development' ),
		'search-engine-optimization'  => array( 'technical-seo', 'on-page-seo', 'content-marketing', 'digital-strategy' ),
		'on-page-seo'                 => array( 'search-engine-optimization', 'technical-seo', 'content-marketing', 'wordpress-design' ),
		'digital-marketing'           => array( 'search-engine-optimization', 'content-marketing', 'social-media-marketing', 'digital-strategy' ),
		'content-marketing'           => array( 'search-engine-optimization', 'on-page-seo', 'social-media-marketing', 'digital-marketing' ),
		'social-media-marketing'      => array( 'content-marketing', 'digital-marketing', 'digital-strategy', 'search-engine-optimization' ),
		'digital-strategy'            => array( 'digital-marketing', 'search-engine-optimization', 'content-marketing', 'mvp-development' ),
	);
}

/**
 * Phrases that become links to a service page, longest first.
 *
 * @return array<string,string>
 */
function wavex_autolink_phrases() {
	$phrases = array(
		'custom software development' => 'custom-software-development',
		'custom software'             => 'custom-software-development',
		'mobile app development'      => 'mobile-app-development',
		'mobile app design'           => 'mobile-app-design',
		'responsive web design'       => 'responsive-web-design',
		'e-commerce development'      => 'ecommerce-development',
		'ecommerce development'       => 'ecommerce-development',
		'wordpress development'       => 'wordpress-development',
		'wordpress design'            => 'wordpress-design',
		'website maintenance'         => 'website-maintenance',
		'website redesign'            => 'website-redesign',
		'api integration'             => 'api-integration',
		'technical seo'               => 'technical-seo',
		'on-page seo'                 => 'on-page-seo',
		'search engine optimization'  => 'search-engine-optimization',
		'digital marketing'           => 'digital-marketing',
		'content marketing'           => 'content-marketing',
		'social media strategy'       => 'social-media-marketing',
		'digital strategy'            => 'digital-strategy',
		'app modernization'           => 'app-modernization',
		'app maintenance'             => 'app-maintenance',
		'mvp development'             => 'mvp-development',
		'web development'             => 'web-development',
		'web application development' => 'custom-software-development',
		'business software'           => 'custom-software-development',
		'software integration'        => 'api-integration',
		'third-party api'             => 'api-integration',
		'rest api'                    => 'api-integration',
		'woocommerce store'           => 'ecommerce-development',
		'online store'                => 'ecommerce-development',
		'e-commerce website'          => 'ecommerce-development',
		'responsive design'           => 'responsive-web-design',
		'responsive website'          => 'responsive-web-design',
		'mobile-first'                => 'responsive-web-design',
		'wordpress maintenance'       => 'website-maintenance',
		'wordpress theme'             => 'wordpress-development',
		'wordpress plugin'            => 'wordpress-development',
		'structured data'             => 'technical-seo',
		'core web vitals'             => 'technical-seo',
		'xml sitemap'                 => 'technical-seo',
		'on-page optimization'        => 'on-page-seo',
		'seo services'                => 'search-engine-optimization',
		'mobile apps'                 => 'mobile-app-development',
		'mobile application'          => 'mobile-app-development',
	);
	uksort(
		$phrases,
		static function ( $a, $b ) {
			return strlen( $b ) - strlen( $a );
		}
	);
	return $phrases;
}

/**
 * Per-page state for auto-links: which services are already linked.
 *
 * @param bool $reset Clear the state.
 * @return array
 */
function &wavex_autolink_state( $reset = false ) {
	static $state = array( 'used' => array(), 'count' => 0 );
	if ( $reset ) {
		$state = array( 'used' => array(), 'count' => 0 );
	}
	return $state;
}

/**
 * Mark a service as already linked on this page.
 *
 * @param string $slug Service slug.
 */
function wavex_autolink_mark( $slug ) {
	$state                  = &wavex_autolink_state();
	$state['used'][ $slug ] = true;
}

/**
 * Link the first mention of other services in an already escaped text.
 * Each service is linked once per page, with a page limit.
 *
 * @param string $html    Escaped HTML text without tags.
 * @param string $exclude Slug of the current page (never linked to itself).
 * @param int    $max     Maximum links in this call.
 * @return string
 */
function wavex_autolink( $html, $exclude = '', $max = 2 ) {
	$state  = &wavex_autolink_state();
	$tokens = array();
	$added  = 0;

	foreach ( wavex_autolink_phrases() as $phrase => $slug ) {
		if ( $added >= $max || $state['count'] >= 12 ) {
			break;
		}
		if ( $slug === $exclude || isset( $state['used'][ $slug ] ) ) {
			continue;
		}
		$pattern = '/(?<![\w\-])(' . preg_quote( $phrase, '/' ) . 's?)(?![\w\-])/iu';
		$new     = preg_replace_callback(
			$pattern,
			static function ( $m ) use ( $slug, &$tokens ) {
				$key            = "\x01" . count( $tokens ) . "\x02";
				$tokens[ $key ] = sprintf( '<a class="inline-link" href="%s">%s</a>', esc_url( wavex_url( 'services/' . $slug ) ), $m[1] );
				return $key;
			},
			$html,
			1,
			$n
		);
		if ( $n && null !== $new ) {
			$html                   = $new;
			$state['used'][ $slug ] = true;
			++$added;
			++$state['count'];
		}
	}
	return $tokens ? strtr( $html, $tokens ) : $html;
}

/**
 * Add contextual service links to plain paragraphs of pages and posts.
 *
 * @param string $content Post content.
 * @return string
 */
function wavex_content_autolinks( $content ) {
	if ( is_admin() || ! in_the_loop() || ! is_main_query() ) {
		return $content;
	}
	$is_service = is_page() && 'template-service.php' === get_page_template_slug();
	if ( $is_service || is_front_page() || ! ( is_singular( 'post' ) || is_page() ) ) {
		return $content;
	}
	if ( is_page( 'privacy-policy' ) ) {
		return $content;
	}
	wavex_autolink_state( true );
	return preg_replace_callback(
		'/<p>([^<]+)<\/p>/u',
		static function ( $m ) {
			return '<p>' . wavex_autolink( $m[1], '', 2 ) . '</p>';
		},
		$content
	);
}
add_filter( 'the_content', 'wavex_content_autolinks', 20 );
