<?php
/**
 * SEO output for service pages that have long-form copy: document title,
 * meta description and FAQ structured data.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Long-form content entry for the current page, if it has one.
 *
 * @return array|null
 */
function wavex_current_service_content() {
	if ( ! is_page() ) {
		return null;
	}
	$all  = wavex_service_content();
	$slug = (string) get_post_field( 'post_name', get_queried_object_id() );
	return isset( $all[ $slug ] ) ? $all[ $slug ] : null;
}

/**
 * Use the supplied SEO title on those pages.
 *
 * @param string $title Default title.
 * @return string
 */
function wavex_service_document_title( $title ) {
	$rich = wavex_current_service_content();
	return ( $rich && ! empty( $rich['seo_title'] ) ) ? $rich['seo_title'] : $title;
}
add_filter( 'pre_get_document_title', 'wavex_service_document_title' );

/**
 * Meta description and FAQPage JSON-LD.
 */
function wavex_service_head() {
	$rich = wavex_current_service_content();
	if ( ! $rich ) {
		return;
	}
	if ( ! empty( $rich['meta'] ) ) {
		echo '<meta name="description" content="' . esc_attr( $rich['meta'] ) . '">' . "\n";
	}

	$entities = array();
	foreach ( $rich['sections'] as $sec ) {
		if ( 'faq' !== $sec['kind'] ) {
			continue;
		}
		foreach ( $sec['subs'] as $q ) {
			if ( empty( $q['paras'] ) ) {
				continue;
			}
			$entities[] = array(
				'@type'          => 'Question',
				'name'           => $q['title'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => implode( ' ', $q['paras'] ),
				),
			);
		}
	}
	if ( $entities ) {
		echo '<script type="application/ld+json">' . wp_json_encode(
			array(
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'mainEntity' => $entities,
			),
			JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG
		) . '</script>' . "\n";
	}
}
add_action( 'wp_head', 'wavex_service_head', 5 );
