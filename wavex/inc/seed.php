<?php
/**
 * On theme activation: create the pages and projects the navigation points to,
 * set the static front page and permalink structure. Safe to run repeatedly:
 * existing pages are never modified or duplicated.
 *
 * @package WaveX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bump when new pages or starter content are added.
define( 'WAVEX_SEED_VERSION', 2 );

/**
 * Create a page at a path (parent/child) if it does not exist yet.
 *
 * @param string $path     Full path, e.g. services/web-development.
 * @param string $title    Page title.
 * @param int    $parent   Parent page ID.
 * @param string $template Template file or ''.
 * @param string $excerpt  Optional excerpt.
 * @return int Page ID or 0.
 */
function wavex_ensure_page( $path, $title, $parent = 0, $template = '', $excerpt = '' ) {
	$existing = get_page_by_path( $path );
	if ( $existing ) {
		return (int) $existing->ID;
	}

	$id = wp_insert_post( array(
		'post_type'    => 'page',
		'post_status'  => 'publish',
		'post_title'   => $title,
		'post_name'    => basename( $path ),
		'post_parent'  => $parent,
		'post_excerpt' => $excerpt,
		'post_content' => '',
	), true );

	if ( is_wp_error( $id ) ) {
		return 0;
	}

	if ( $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}

	return (int) $id;
}

/**
 * Seed content.
 */
function wavex_seed_content() {
	if ( (int) get_option( 'wavex_seed_version' ) >= WAVEX_SEED_VERSION ) {
		return;
	}

	// Home + blog pages.
	$home = wavex_ensure_page( 'home', __( 'Home', 'wavex' ) );
	$blog = wavex_ensure_page( 'blog', __( 'Blog', 'wavex' ) );

	if ( $home && $blog && 'posts' === get_option( 'show_on_front' ) && ! get_option( 'page_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
		update_option( 'page_for_posts', $blog );
	}

	// Core pages.
	$services_id = 0;
	foreach ( wavex_core_pages() as $path => $data ) {
		$id = wavex_ensure_page( $path, $data[0], 0, $data[1] );
		if ( 'services' === $path ) {
			$services_id = $id;
		}
	}

	// One page per service, children of /services/.
	if ( $services_id ) {
		foreach ( wavex_services() as $slug => $service ) {
			wavex_ensure_page(
				'services/' . $slug,
				$service['title'],
				$services_id,
				'template-service.php',
				$service['text']
			);
		}
	}

	// Project terms and projects (names only, no invented details).
	$types = array(
		'web' => __( 'Websites & Platforms', 'wavex' ),
		'app' => __( 'Mobile Applications', 'wavex' ),
	);
	foreach ( $types as $slug => $name ) {
		if ( ! term_exists( $slug, 'project_type' ) ) {
			wp_insert_term( $name, 'project_type', array( 'slug' => $slug ) );
		}
	}

	$order = 0;
	foreach ( wavex_projects() as $slug => $project ) {
		++$order;
		if ( get_page_by_path( $slug, OBJECT, 'project' ) ) {
			continue;
		}
		$pid = wp_insert_post( array(
			'post_type'   => 'project',
			'post_status' => 'publish',
			'post_title'  => $project['title'],
			'post_name'   => $slug,
			'menu_order'  => $order,
		), true );
		if ( ! is_wp_error( $pid ) ) {
			wp_set_object_terms( $pid, $project['type'], 'project_type' );
		}
	}

	// Pretty permalinks (needed for the clean URLs in the navigation).
	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	// Fill starter content only into pages that are still empty.
	foreach ( wavex_starter_content() as $path => $html ) {
		$page = get_page_by_path( $path );
		if ( $page && '' === trim( (string) $page->post_content ) ) {
			wp_update_post( array(
				'ID'           => $page->ID,
				'post_content' => wp_kses_post( $html ),
			) );
		}
	}

	// Use the Privacy Notice as WordPress's privacy page if none is set.
	$privacy_page = get_page_by_path( 'privacy-policy' );
	if ( $privacy_page && ! get_option( 'wp_page_for_privacy_policy' ) ) {
		update_option( 'wp_page_for_privacy_policy', $privacy_page->ID );
	}

	update_option( 'wavex_seed_version', WAVEX_SEED_VERSION );
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'wavex_seed_content' );

/**
 * Also seed on admin load, so updating the theme files adds new starter content
 * without having to switch themes.
 */
function wavex_maybe_seed_on_admin() {
	if ( current_user_can( 'switch_themes' ) ) {
		wavex_seed_content();
	}
}
add_action( 'admin_init', 'wavex_maybe_seed_on_admin' );
